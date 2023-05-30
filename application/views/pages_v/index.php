<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(<?= !empty($item->banner_url) ? get_picture("pages_v", $item->banner_url)  : get_picture("settings_v", $settings->about_logo) ?>)">
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

<!-- about-area -->
<section class="about-area about-p pt-120 pb-120 p-relative fix">
    <div class="animations-01"><img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/bg/an-img-01.webp") ?>" alt="<?= $item->title ?>"></div>
    <div class="animations-02"><img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/bg/an-img-02.webp") ?>" alt="<?= $item->title ?>"></div>
    <div class="container">
        <div class="row align-items-stretch align-self-stretch align-content-stretch">
            <?php if (!empty($item->img_url)) : ?>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-5">
                    <div class="s-about-img p-relative  wow fadeInLeft animated"   data-animation="fadeInLeft" data-delay=".4s">
                        <img width="1920" height="400" loading="lazy" class="img-fluid position-sticky lazyload" style="top:120px" data-src="<?= get_picture("pages_v", $item->img_url) ?>" title="<?= $item->title ?>" alt="<?= $item->title ?>">
                    </div>
                </div>
            <?php endif ?>
            <div class="col-lg-<?= !empty($item->img_url) ? "12" : "12" ?> col-md-12 col-sm-12">
                <div class="about-content s-about-content  wow fadeInRight  animated" data-animation="fadeInRight" data-delay=".4s">
                    <div class="about-title second-title pb-25">
                        <h5><?= $settings->company_name ?></h5>
                        <h2><?= $item->title ?></h2>
                    </div>
                    <p><?= $item->content ?></p>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- about-area-end -->