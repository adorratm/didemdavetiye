<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(<?= !empty($products_category) && !empty($products_category->img_url) ? get_picture("product_categories_v", $products_category->banner_url) : get_picture("settings_v", $settings->product_logo) ?>)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-center">
                    <div class="breadcrumb-title">
                        <h2 class="mb-0"><?= $page_title ?></h2>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- shop-area -->
<form id="searchProductForm" action="<?= !empty($this->uri->segment(4) && !is_numeric($this->uri->segment(5))) ? base_url(lang("routes_products") . "/" . $this->uri->segment(3) . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(5)) : base_url(lang("routes_products") . "/" . $this->uri->segment(3) . "/" . $this->uri->segment(4)) ?>" method="GET" enctype="multipart/form-data">
    <section class="shop-area pt-120 pb-120 p-relative " data-animation="fadeInUp animated" data-delay=".2s">
        <div class="container">
            <div class="row shopAccessRow align-items-center align-content-center align-self-center shadow p-2 mb-5">
                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 my-2">
                    <div class="productCount"><?= $offset == 0 ? (!empty($products) ? 1 : 0) : (empty($products) ? 0 : $offset) ?>–<?= $total_rows > $offset + $per_page ? (empty($products) ? 0 : $offset + $per_page) : (empty($products) ? 0 : $total_rows) ?> / <?= empty($products) ? 0 : $total_rows ?></div>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6 col-xl-7 d-xl-flex my-2">
                    <div class="input-group">
                        <input style="padding-right:37px" class="form-control" placeholder="<?= lang("searchProducts") ?>" type="text" name="search" value="<?= (!empty($_GET["search"]) ? $_GET["search"] : null) ?>">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                        <button type="button" class="btn rounded-0" onclick="$('#searchProductForm').find('input[name=search]').val('');$('#searchProductForm').submit()">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-4 col-xl-3 my-2">
                    <div class="shopAccessBar">
                        <div class="d-flex align-items-center align-self-center align-content-center">
                            <label class="text-nowrap me-2"><?= lang("orderBy") ?></label>
                            <select class="form-control" name="orderBy" onchange="$('#searchProductForm').submit()">
                                <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 1 ? "selected" : null) ?> value="1"><?= lang("newToOld") ?></option>
                                <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 2 ? "selected" : null) ?> value="2"><?= lang("oldToNew") ?></option>
                                <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 3 ? "selected" : null) ?> value="3"><?= lang("aToZ") ?></option>
                                <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 4 ? "selected" : null) ?> value="4"><?= lang("zToA") ?></option>
                                <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 5 ? "selected" : null) ?> value="5"><?= lang("priceAsc") ?></option>
                                <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 6 ? "selected" : null) ?> value="6"><?= lang("priceDesc") ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-stretch align-self-stretch align-content-stretch">
                <?php if (!empty($products)) : ?>
                    <?php foreach ($products as $k => $v) : ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="product h-100 border">
                                <div class="product__img">
                                    <a href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/" . $v->seo_url) ?>" rel="dofollow" title="<?= lang("viewProduct") ?>">
                                        <img width="1000" height="1000" data-src="<?= get_picture("products_v", $v->img_url) ?>" class="img-fluid lazyload" alt="<?= $v->title ?>" title="<?= $v->title ?>" />
                                    </a>
                                </div>
                                <div class="product__content text-center pt-30 pb-30">
                                    <h4 class="pro-title"><a href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/" . $v->seo_url) ?>" rel="dofollow" title="<?= lang("viewProduct") ?>"><?= $v->title ?></a></h4>
                                    <div class="pi01Price text-center d-flex mx-auto justify-content-center">
                                        <?php if (!empty($v->price) || !empty($v->discounted_price)) : ?>
                                            <ins class="fw-bold fs-5 me-2"><?= !empty($v->discounted_price) ? $v->discounted_price : $v->price ?> <?= $symbol ?></ins>
                                        <?php endif ?>
                                        <?php if (!empty($v->discounted_price) && $v->discounted_price > 0) : ?>
                                            <del><?= $v->price ?> <?= $symbol ?></del>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>

                <?php if (empty($products)) : ?>
                    <div class="col-12">
                        <div class="alert alert-warning rounded-0 shadow" role="alert">
                            <h4 class="alert-heading"><?= lang("warning") ?></h4>
                            <p><?= lang("weCantFindAnyProductsWithYourSearch") ?></p>
                            <hr>
                            <p class="mb-0"><?= lang("youCanSearchDifferentProducts") ?></p>
                        </div>
                    </div>
                <?php endif ?>
            </div>
            <?php if (!empty($links)) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="pagination-wrap mt-50 text-center">
                            <nav>
                                <?= @$links ?>
                            </nav>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </section>
</form>
<!-- shop-area-end -->