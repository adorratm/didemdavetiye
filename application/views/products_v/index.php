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
<section class="shop-area pt-120 pb-120 p-relative " data-animation="fadeInUp animated" data-delay=".2s">
    <div class="container">
        <div class="row align-items-stretch align-self-stretch align-content-stretch">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $k => $v) : ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="product">
                            <div class="product__img">
                                <a href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/" . $v->seo_url) ?>" rel="dofollow" title="<?= lang("viewProduct") ?>">
                                    <img width="1000" height="1000" data-src="<?= get_picture("products_v", $v->img_url) ?>" class="img-fluid lazyload" alt="<?= $v->title ?>" title="<?= $v->title ?>" />
                                </a>
                            </div>
                            <div class="product__content text-center pt-30">
                                <h4 class="pro-title"><a href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/" . $v->seo_url) ?>" rel="dofollow" title="<?= lang("viewProduct") ?>"><?= $v->title ?></a></h4>
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
<!-- shop-area-end -->