<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends MY_Controller
{
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "products_v";
    }
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */

    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================ PRODUCTS ================================= !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Products
     */
    public function index()
    {
        $search = null;
        if (!empty(clean($this->input->get("search")))) :
            $search = clean($this->input->get("search"));
        endif;
        $seo_url = $this->uri->segment(3);
        $category_id = null;
        $category = null;
        if (!empty($seo_url) && !is_numeric($seo_url)) :
            $category = $this->general_model->get("product_categories", null, ["isActive" => 1, "lang" => $this->viewData->lang, "seo_url" => $seo_url]);
            if (!empty($category)) :
                $category_id = $category->id;
                $category->seo_url = (!empty($category->seo_url) ? $category->seo_url : null);
                $category->title = (!empty($category->title) ? $category->title : null);
            endif;
        endif;
        /**
         * Order
         */
        $order = "p.id DESC";
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 1) :
            $order = "p.id DESC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 2) :
            $order = "p.id ASC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 3) :
            $order = "p.title ASC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 4) :
            $order = "p.title DESC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 5) :
            $order = "(CASE WHEN discounted_price = NULL then  CAST(price as INT) ELSE CAST(discounted_price as INT) end) ASC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 6) :
            $order = "(CASE WHEN discounted_price = NULL then  CAST(price as INT) ELSE CAST(discounted_price as INT) end) DESC";
        endif;
        /**
         * Likes
         */
        $likes = [];
        if (!empty($search)) :
            $likes["p.title"] = $search;
            $likes["p.createdAt"] = $search;
            $likes["p.updatedAt"] = $search;
            $likes["p.description"] = $search;
        endif;

        /**
         * Apply Filter
         */
        $whereIn = [];
        if (!empty($_GET["patternChecks"])) :
            $whereIn["p.pattern_id"] = array_map("intVal", explode(",", clean($_GET["patternChecks"])));
        endif;
        if (!empty($_GET["dimensionChecks"])) :
            $whereIn["p.dimension_id"] = array_map("intVal", explode(",", clean($_GET["dimensionChecks"])));
        endif;
        if (!empty($_GET["colorChecks"])) :
            $whereIn["p.color_id"] = array_map("intVal", explode(",", clean($_GET["colorChecks"])));
        endif;
        /**
         * #Apply Filter
         */

        $wheres = [];
        if (!empty($category_id)) :
            $wheres["pwc.category_id"] = $category_id;
        endif;
        /**
         * Wheres
         */
        $wheres["p.isActive"] = 1;
        $wheres["pi.isCover"] = 1;
        $wheres["p.lang"] = $this->viewData->lang;
        $joins = ["products_w_categories pwc" => ["p.id = pwc.product_id", "left"], "product_categories pc" => ["pwc.category_id = pc.id", "left"], "product_images pi" => ["pi.product_id = p.id", "left"]];

        $select = "p.price,p.discounted_price,p.title,p.id, p.seo_url,pi.url img_url,p.isActive";
        $distinct = true;
        $groupBy = ["p.id", "pwc.product_id"];
        /**
         * Pagination
         */
        $config = [];
        $config['base_url'] = (!empty($seo_url) && !is_numeric($seo_url) ? base_url(lang("routes_products") . "/" . $this->uri->segment(3) . "/{$seo_url}/") : base_url(lang("routes_products") . "/" . $this->uri->segment(3) . "/"));
        $config['uri_segment'] = (!empty($seo_url) && !is_numeric($seo_url) && !empty($this->uri->segment(5)) ? 5 : (is_numeric($this->uri->segment(4)) ? 4 : 2));
        $config['use_page_numbers'] = TRUE;
        $config["full_tag_open"] = "<ul class='pagination justify-content-center'>";
        $config["first_link"] = "<i class='fa fa-angles-left'></i>";
        $config["first_tag_open"] = "<li class='page-item'>";
        $config["first_tag_close"] = "</li>";
        $config["prev_link"] = "<i class='fa fa-angle-left'></i>";
        $config["prev_tag_open"] = "<li class='page-item'>";
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='page-item active'><a class='page-link active' title='" . $this->viewData->settings->company_name . "' rel='dofollow' href='" . str_replace("tr/index.php/", "", current_url()) . "'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li class='page-item'>";
        $config["num_tag_close"] = "</li>";
        $config["next_link"] = "<i class='fa fa-angle-right'></i>";
        $config["next_tag_open"] = "<li class='page-item'>";
        $config["next_tag_close"] = "</li>";
        $config["last_link"] = "<i class='fa fa-angles-right'></i>";
        $config["last_tag_open"] = "<li class='page-item'>";
        $config["last_tag_close"] = "</li>";
        $config["full_tag_close"] = "</ul>";
        $config['attributes'] = array('class' => 'page-link');
        $config['total_rows'] = $this->general_model->rowCount("products p", $wheres, $likes, $joins, $whereIn, $distinct, $groupBy, "p.id");
        $config['per_page'] = 24;
        $config["num_links"] = 5;
        $config['reuse_query_string'] = true;
        $this->pagination->initialize($config);
        if (!empty($seo_url) && !is_numeric($seo_url)) :
            $uri_segment = $this->uri->segment(5);
        elseif (!empty($this->uri->segment(4)) && is_numeric($this->uri->segment(4))) :
            $uri_segment = $this->uri->segment(4);
        else :
            $uri_segment = $this->uri->segment(4);
        endif;
        if (empty($uri_segment)) :
            $uri_segment = 1;
        endif;
        $offset = (!empty($uri_segment) ? $uri_segment - 1 : 0) * $config['per_page'];
        $this->viewData->offset = $offset;
        $this->viewData->per_page = $config['per_page'];
        $this->viewData->total_rows = $config['total_rows'];
        $this->viewData->products_category = $category;
        /**
         * Get All Categories
         */
        $this->viewData->categories = $this->general_model->get_all("product_categories", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        /** 
         * Get Products
         */
        $this->viewData->products = $this->general_model->get_all("products p", $select, $order, $wheres, $likes, $joins, [$config["per_page"], $offset], $whereIn, $distinct, $groupBy);
        /**
         * Meta
         */
        $this->viewData->page_title = (!empty($category) ? strto("lower|ucwords", $category->title) : strto("lower|ucwords", lang("products")));
        $this->viewData->meta_title = strto("lower|ucwords", (!empty($category) ? $category->title : lang("products"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));
        $this->viewData->og_url                 = clean(base_url(lang("routes_products")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "product";
        $this->viewData->og_title           = strto("lower|ucwords", (!empty($category) ? $category->title : lang("products"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->viewData->links = $this->pagination->create_links();
        $this->viewFolder = "products_v/index";
        $this->render();
        //$this->output->enable_profiler(true); // OPEN FOR PERFORMANCE
        //$this->benchmark->mark('code_end');
        //echo $this->benchmark->elapsed_time('code_start','code_end');
    }
    /**
     * Product Detail
     */
    public function product_detail($seo_url)
    {
        $result =  $this->product_detail_ajax($seo_url);

        if (!$result) :
            $this->viewFolder = "404_v/index";
        else :
            $this->viewFolder = "product_detail_v/index";
        endif;
        $this->render();
    }

    public function product_detail_ajax($seo_url = null)
    {
        $wheres["p.isActive"] = 1;
        $wheres["p.lang"] = $this->viewData->lang;
        $joins = ["products_w_categories pwc" => ["p.id = pwc.product_id", "left"], "product_categories pc" => ["pwc.category_id = pc.id", "left"], "product_images pi" => ["pi.product_id = p.id", "left"]];
        $select = "p.price,p.discounted_price,pc.title category_title,pc.seo_url category_seo_url,p.id,p.title,p.seo_url,pi.url img_url,p.description,p.isActive";
        $distinct = true;
        $groupBy = ["p.id", "pwc.product_id"];
        $wheres['p.seo_url'] =  $seo_url;
        /**
         * Get Product Detail
         */
        $this->viewData->product = $this->general_model->get("products p", $select, $wheres, $joins, [], [], $distinct, $groupBy);

        if (!empty($this->viewData->product)) :
            /**
             * Get All Categories
             */
            $this->viewData->categories = $this->general_model->get_all("product_categories", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
            /**
             * Get Product Images
             */
            $imgURL = null;
            $this->viewData->product_own_images = $this->general_model->get_all("product_images", null, "isCover DESC,rank ASC", ["isActive" => 1, "product_id" => $this->viewData->product->id, "lang" => $this->viewData->lang], [], [], [], [], true);
            if (!empty($this->viewData->product_own_images)) :
                foreach ($this->viewData->product_own_images as $key => $value) :
                    if ($value->isCover) :
                        $imgURL = $value->url;
                    endif;
                endforeach;
            endif;
            /**
             * Get All Cover Product Images
             */
            $this->viewData->product_images = $this->general_model->get_all("product_images", null, "rank ASC", ["isActive" => 1, "isCover" => 1, "lang" => $this->viewData->lang]);
            /**
             * Meta
             */
            $this->viewData->page_title = strto("lower|ucwords", $this->viewData->product->title);
            $this->viewData->meta_title = strto("lower|ucwords", $this->viewData->product->title) . " - " . $this->viewData->settings->company_name;
            $this->viewData->meta_desc  = !empty($this->viewData->product->content) ? str_replace("”", "\"", @stripslashes($this->viewData->product->content)) : str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));
            $this->viewData->og_url                 = clean(base_url(lang("routes_product") . "/" . lang("routes_product") . "/" . $seo_url));
            $this->viewData->og_image           = clean(get_picture("products_v", $imgURL));
            $this->viewData->og_type          = "product.item";
            $this->viewData->og_title           = strto("lower|ucwords", $this->viewData->product->title) . " - " . $this->viewData->settings->company_name;
            $this->viewData->og_description           = clean(str_replace("”", "\"", @stripslashes($this->viewData->product->content)));
            if (!empty($this->input->post("id"))) :
                echo $this->load->view("product_detail_v/detail", $this->viewData, true);
            else :
                return $this->viewData;
            endif;
        else :
            return false;
        endif;
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================ PRODUCTS ================================= !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
}
