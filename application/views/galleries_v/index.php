<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(<?= get_picture("settings_v", $settings->gallery_logo) ?>)">
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


<!-- gallery-area -->
<section id="work" class="pt-120 pb-105">
    <div class="container">
        <div class="row align-items-stretch align-self-stretch align-content-stretch">
            <?php if (!empty($galleries)) : ?>
                <?php foreach ($galleries as $k => $v) : ?>
                    <!--Services One Single Start-->
                    <div class="col-xl-4 col-lg-4 wow fadeInUp animated mb-4">
                        <div class="product">
                            <div class="product__img">
                                <a href="<?= base_url(lang("routes_galleries") . "/" . lang("routes_gallery") . "/" . $v->url) ?>" rel="dofollow" title="<?= lang("viewService") ?>">
                                    <img width="1000" height="1000" data-src="<?= get_picture("galleries_v", $v->img_url) ?>" class="img-fluid lazyload" alt="<?= $v->title ?>" title="<?= $v->title ?>" />
                                </a>
                            </div>
                            <div class="product__content text-center pt-30">
                                <h4 class="pro-title"><a href="<?= base_url(lang("routes_galleries") . "/" . lang("routes_gallery") . "/" . $v->url) ?>" rel="dofollow" title="<?= lang("viewGallery") ?>"><?= $v->title ?></a></h4>
                            </div>
                        </div>
                    </div>
                    <!--Services One Single End-->
                <?php endforeach ?>
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
<!-- gallery-area-end -->