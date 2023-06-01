<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "products_v";
        $this->load->model("product_model");
        $this->load->model("product_category_model");
        $this->load->model("products_w_categories_model");
        $this->load->model("product_image_model");
        if (!get_active_user()) :
            redirect(base_url("login"));
        endif;
    }
    public function index()
    {
        $viewData = new stdClass();
        $items = $this->product_model->get_all([], "rank ASC");
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function datatable()
    {
        $items = $this->product_model->getRows([], $_POST);
        $data = [];
        $i = (!empty($_POST['start']) ? $_POST['start'] : 0);
        if (!empty($items)) :
            foreach ($items as $item) :
                $avCats = [];
                $avcategories = $this->products_w_categories_model->get_all(["product_id" => $item->id]);
                if (!empty($avcategories)) :
                    foreach ($avcategories as $avKey => $avValue) :
                        if (!in_array($avValue->category_id, $avCats)) :
                            $avCats[] = $avValue->category_id;
                        endif;
                    endforeach;
                endif;
                $categoriesHtml = "";
                if (!empty($avCats)) :
                    $categories = @$this->general_model->get_all("product_categories", null, null, [], [], [], [], ["id" => @$avCats]);
                    if (!empty($categories)) :
                        foreach ($categories as $category) :
                            $categoriesHtml .= "<span class='badge badge-secondary mr-1 mb-1'>{$category->title}</span>";
                        endforeach;
                    endif;
                endif;
                $i++;
                $proccessing = '
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-primary rounded-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        İşlemler
                    </button>
                    <div class="dropdown-menu rounded-0 dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item updateProductBtn" href="javascript:void(0)" data-url="' . base_url("products/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                        <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="productTable" data-url="' . base_url("products/delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                        <a class="dropdown-item" href="' . base_url("products/upload_form/$item->id") . '"><i class="fa fa-image mr-2"></i>Resimler</a>
                    </div>
                </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("products/isActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch4' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch4' . $i . '"></label></div>';
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $item->title, $categoriesHtml, $checkbox, turkishDate("d F Y, l H:i:s", $item->updatedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->product_model->rowCount([]),
            "recordsFiltered" => $this->product_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        ];
        // Output to JSON format
        echo json_encode($output);
    }
    public function new_form()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $viewData->pages = $this->general_model->get_all("pages", null, "rank ASC", ["isActive" => 1]);
        $viewData->categories = $this->general_model->get_all("product_categories", null, "rank ASC", ["isActive" => 1]);
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function save()
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"] && checkEmpty($data)["key"] !== "description" && checkEmpty($data)["key"] !== "price" && checkEmpty($data)["key"] !== "discounted_price") :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Güncelleştirilirken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            $getRank = $this->product_model->rowCount();
            if (!empty($_FILES)) :
                if (!empty($_FILES["img_url"]["name"])) :
                    $image = upload_picture("img_url", "uploads/$this->viewFolder", ["width" => 1920, "height" => 400], "*");
                    if ($image["success"]) :
                        $data["img_url"] = $image["file_name"];
                    else :
                        echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Kaydı Yapılırken Hata Oluştu. Ürün Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                        die();
                    endif;
                endif;
            endif;
            unset($data["category_id"]);
            $data["seo_url"] = seo($data["title"]);
            $data["description"] = clean($_POST["description"]) ? $_POST["description"] : NULL;
            $data["isActive"] = 1;
            $data["rank"] = $getRank + 1;
            $insert = $this->product_model->add($data);
            if ($insert) :
                if (!empty($_POST["category_id"])) :
                    $this->products_w_categories_model->delete(["product_id" => $insert]);
                    foreach (array_unique($_POST["category_id"]) as $key => $value) :
                        $this->products_w_categories_model->add(["product_id" => $insert, "category_id" => $value]);
                    endforeach;
                endif;
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Başarıyla Eklendi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Eklenirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function update_form($id)
    {
        $viewData = new stdClass();
        $viewData->item = $this->general_model->get("products", "*", ["id" => $id], [], [], [], true, "id");
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->categories = $this->general_model->get_all("product_categories", null, "rank ASC", ["isActive" => 1]);
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function update($id)
    {
        $data = $this->input->post();
        if (checkEmpty($data)["error"] && checkEmpty($data)["key"] !== "description" && checkEmpty($data)["key"] !== "price" && checkEmpty($data)["key"] !== "discounted_price") :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Güncelleştirilirken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            if (!empty($_FILES)) :
                if (!empty($_FILES["img_url"]["name"])) :
                    $image = upload_picture("img_url", "uploads/$this->viewFolder", ["width" => 1920, "height" => 400], "*");
                    if ($image["success"]) :
                        $data["img_url"] = $image["file_name"];
                    else :
                        echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Kaydı Yapılırken Hata Oluştu. Ürün Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                        die();
                    endif;
                endif;
            endif;
            unset($data["category_id"]);
            $data["seo_url"] = seo($data["title"]);
            $data["description"] = clean($_POST["description"]) ? $_POST["description"] : NULL;
            if ($this->product_model->update(["id" => $id], $data)) :
                if (!empty($_POST["category_id"])) :
                    $this->products_w_categories_model->delete(["product_id" => $id]);
                    foreach (array_unique($_POST["category_id"]) as $key => $value) :
                        $this->products_w_categories_model->add(["product_id" => $id, "category_id" => $value]);
                    endforeach;
                endif;
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Başarıyla Güncelleştirildi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Güncelleştirilirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function delete($id)
    {
        $product = $this->product_model->get(["id" => $id]);
        if (!empty($product)) :
            $delete = $this->product_model->delete(["id"    => $id]);
            if ($delete) :
                /**
                 * Remove Product Image
                 */
                if (!empty($product->img_url)) :
                    $url = FCPATH . "uploads/{$this->viewFolder}/" . @$product->img_url;
                    if (!is_dir($url) && file_exists($url)) :
                        unlink($url);
                    endif;
                endif;
                $product_images = $this->product_image_model->get_all(["product_id" => $id]);
                if (!empty($product_images)) :
                    $this->product_image_model->delete(["product_id" => $id]);
                    foreach ($product_images as $key => $value) :
                        $url = FCPATH . "uploads/{$this->viewFolder}/{$value->url}";
                        if (!is_dir($url) && file_exists($url)) :
                            unlink($url);
                        endif;
                    endforeach;
                endif;
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Başarıyla Silindi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function rankSetter()
    {
        $rows = $this->input->post("rows");
        if (!empty($rows)) :
            foreach ($rows as $row) :
                $this->product_model->update(
                    [
                        "id" => $row["id"]
                    ],
                    ["rank" => $row["position"]]
                );
            endforeach;
        endif;
    }
    public function isActiveSetter($id)
    {
        if (!empty($id)) :
            $isActive = (intval($this->input->post("data")) === 1) ? 1 : 0;
            if ($this->product_model->update(["id" => $id], ["isActive" => $isActive])) :
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "message" => "Güncelleme İşlemi Yapıldı."]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "message" => "Güncelleme İşlemi Yapılamadı."]);
            endif;
        endif;
    }
    public function detailDatatable($id)
    {
        $items = $this->product_image_model->getRows(
            ["product_id" => $id],
            $_POST
        );
        $data = [];
        $i = (!empty($_POST['start']) ? $_POST['start'] : 0);
        if (!empty($items)) :
            foreach ($items as $item) :
                $i++;
                $proccessing = '
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-primary rounded-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        İşlemler
                    </button>
                    <div class="dropdown-menu rounded-0 dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="detailTable" data-url="' . base_url("products/fileDelete/{$item->id}") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                        </div>
                </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("products/fileIsActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch' . $i . '"></label></div>';
                $checkbox2 = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-table="detailTable" data-url="' . base_url("products/fileIsCoverSetter/{$item->id}/$item->product_id/$item->lang") . '" data-status="' . ($item->isCover == 1 ? "checked" : null) . '" id="customSwitch2' . $i . '" type="checkbox" ' . ($item->isCover == 1 ? "checked" : null) . ' class="isCover custom-control-input" >  <label class="custom-control-label" for="customSwitch2' . $i . '"></label></div>';
                $image = '<img src="' . base_url("uploads/{$this->viewFolder}/{$item->url}") . '" width="75">';
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $image, $item->url, $item->lang, $checkbox2, $checkbox, turkishDate("d F Y, l H:i:s", $item->createdAt), turkishDate("d F Y, l H:i:s", $item->updatedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->product_image_model->rowCount(["product_id" => $id]),
            "recordsFiltered" => $this->product_image_model->countFiltered(["product_id" => $id], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        ];
        // Output to JSON format
        echo json_encode($output);
    }
    public function upload_form($id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $viewData->item = $this->product_model->get(["id" => $id]);
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $viewData->items = $this->product_image_model->get_all(["product_id" => $id], "rank ASC");
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function file_upload($id, $lang)
    {
        $resize = ['height' => 1000, 'width' => 1000, 'maintain_ratio' => FALSE, 'master_dim' => 'height'];
        $image = upload_picture("file", "uploads/$this->viewFolder/", $resize, "*");
        if ($image["success"]) :
            $getRank = $this->product_image_model->rowCount();
            $this->product_image_model->add(
                [
                    "url"           => $image["file_name"],
                    "rank"          => $getRank + 1,
                    "product_id"      => $id,
                    "isActive"      => 1,
                    "lang"          => $lang
                ]
            );
        else :
            echo $image["error"];
        endif;
    }
    public function fileDelete($id)
    {
        $fileName = $this->product_image_model->get(["id" => $id]);
        $delete = $this->product_image_model->delete(["id" => $id]);
        if ($delete) :
            $url = FCPATH . "uploads/{$this->viewFolder}/{$fileName->url}";
            if (!is_dir($url) && file_exists($url)) :
                unlink($url);
            endif;
            echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Görseli Başarıyla Silindi."]);
        else :
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Görseli Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
        endif;
    }
    public function fileIsActiveSetter($id)
    {
        if (!empty($id)) :
            $isActive = (intval($this->input->post("data")) === 1) ? 1 : 0;
            if ($this->product_image_model->update(["id" => $id], ["isActive" => $isActive])) :
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı"]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı"]);
            endif;
        endif;
    }
    public function fileRankSetter($id)
    {
        $rows = $this->input->post("rows");
        if (!empty($rows)) :
            foreach ($rows as $row) :
                $this->product_image_model->update(
                    [
                        "id" => $row["id"],
                        "product_id" => $id,
                    ],
                    ["rank" => $row["position"]]
                );
            endforeach;
        endif;
    }
    public function fileIsCoverSetter($id, $product_id, $lang)
    {
        if (!empty($id) && !empty($lang)) :
            $isCover = (intval($this->input->post("data")) === 1) ? 1 : 0;
            if ($this->product_image_model->update(["id" => $id, "product_id" => $product_id], ["isCover" => $isCover, "lang" => $lang])) :
                $this->product_image_model->update(["id!=" => $id, "product_id" => $product_id], ["isCover" => 0, "lang" => $lang]);
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı"]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı"]);
            endif;
        endif;
    }
}
