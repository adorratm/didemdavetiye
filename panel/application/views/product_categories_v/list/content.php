<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h4 class="mb-3">
                Ürün Kategorileri
                <a href="javascript:void(0)" data-url="<?= base_url("product_categories/new_form") ?>" class="btn btn-sm btn-outline-primary rounded-0 btn-sm float-right createProductCategoryBtn"> <i class="fa fa-plus"></i> Ürün Kategorisi Ekle</a>
            </h4>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <form id="filter_form" onsubmit="return false">
                <div class="d-flex flex-wrap">
                    <label for="search" class="flex-fill mx-1">
                        <input class="form-control form-control-sm rounded-0" placeholder="Arama Yapmak İçin Metin Girin." type="text" onkeypress="return runScript(event,'productCategoryTable')" name="search">
                    </label>
                    <label for="clear_button" class="mx-1">
                        <button class="btn btn-sm btn-outline-danger rounded-0 " onclick="clearFilter('filter_form','productCategoryTable')" id="clear_button" data-toggle="tooltip" data-placement="top" data-title="Filtreyi Temizle" data-original-title="" title=""><i class="fa fa-eraser"></i></button>
                    </label>
                    <label for="search_button" class="mx-1">
                        <button class="btn btn-sm btn-outline-success rounded-0 " onclick="reloadTable('productCategoryTable')" id="search_button" data-toggle="tooltip" data-placement="top" data-title="Ürün Kategorisi Ara"><i class="fa fa-search"></i></button>
                </div>
            </form>
            <table class="table table-hover table-striped table-bordered content-container productCategoryTable">
                <thead>
                    <th class="order"><i class="fa fa-reorder"></i></th>
                    <th class="order"><i class="fa fa-reorder"></i></th>
                    <th class="w50">#id</th>
                    <th>Başlık</th>
                    <th>Durumu</th>
                    <th>Oluşturulma Tarihi</th>
                    <th>Güncelleme Tarihi</th>
                    <th class="nosort">İşlem</th>
                </thead>
                <tbody>

                </tbody>
            </table>
            <script>
                function obj(d) {
                    let appendeddata = {};
                    $.each($("#filter_form").serializeArray(), function() {
                        d[this.name] = this.value;
                    });
                    return d;
                }
                $(document).ready(function() {
                    TableInitializerV2("productCategoryTable", obj, {}, "<?= base_url("product_categories/datatable") ?>", "<?= base_url("product_categories/rankSetter") ?>", true);

                });
            </script>
        </div>
    </div>
</div>
</div>

<div id="productCategoryModal"></div>

<script>
    $(document).ready(function() {
        $(document).on("click", ".updateProductCategoryBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#productCategoryModal').iziModal('destroy');
            let url = $(this).data("url");
            createModal("#productCategoryModal", "Ürün Kategorisi Düzenle", "Ürün Kategorisi Düzenle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
                $.post(url, {}, function(response) {
                    $("#productCategoryModal .iziModal-content").html(response);
                    TinyMCEInit();
                    flatPickrInit();
                    $(".tagsInput").select2({
						width: 'resolve',
						theme: "classic",
						tags: true,
						tokenSeparators: [',', ' ']
					});
                });
            });
            openModal("#productCategoryModal");
            $("#productCategoryModal").iziModal("setFullscreen", false);
        });
        $(document).on("click", ".btnUpdate", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("updateProductCategory"));
            createAjax(url, formData, function() {
                closeModal("#productCategoryModal");
                $("#productCategoryModal").iziModal("setFullscreen", false);
                reloadTable("productCategoryTable");
            });
        });
        $(document).on("click", ".createProductCategoryBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#productCategoryModal').iziModal('destroy');
            let url = $(this).data("url");
            createModal("#productCategoryModal", "Ürün Kategorisi Ekle", "Ürün Kategorisi Ekle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
                $.post(url, {}, function(response) {
                    $("#productCategoryModal .iziModal-content").html(response);
                    TinyMCEInit();
                    flatPickrInit();
                    $(".tagsInput").select2({
						width: 'resolve',
						theme: "classic",
						tags: true,
						tokenSeparators: [',', ' ']
					});
                });
            });
            openModal("#productCategoryModal");
            $("#productCategoryModal").iziModal("setFullscreen", false);
        });
        $(document).on("click", ".btnSave", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("createProductCategory"));
            createAjax(url, formData, function() {
                closeModal("#productCategoryModal");
                $("#productCategoryModal").iziModal("setFullscreen", false);
                reloadTable("productCategoryTable");
            });
        });
    });
</script>