<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(<?= get_picture("settings_v", $settings->about_logo) ?>)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-center">
                    <div class="breadcrumb-title">
                        <h2 class="mb-0"><?= lang("pageNotFound") ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Error Page Start-->
<section class="about-area about-p pt-120 pb-120 p-relative fix">
    <div class="animations-01"><img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/bg/an-img-01.webp") ?>" alt="<?= lang("pageNotFound") ?>"></div>
    <div class="animations-02"><img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/bg/an-img-02.webp") ?>" alt="<?= lang("pageNotFound") ?>"></div>
    <div class="container">
        <div class="row align-items-center align-self-center align-content-center">
            <div class="col-xl-6 col-lg-6">
                <div class="about-content s-about-content  wow fadeInRight  animated" data-animation="fadeInRight" data-delay=".4s">
                    <div class="about-title second-title pb-25">
                        <h3><i class="fa-regular fa-face-sad-cry"></i> <?= lang("pageNotFound") ?></h3>
                    </div>
                    <p><?= lang("404Desc") ?></p>
                    <div class="slider-btn mt-20">
                        <a rel="dofollow" href="<?= base_url() ?>" title="<?= lang("404Home") ?>" class="btn ss-btn smoth-scroll"><?= lang("404Home") ?> <i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="services-details-one__massages-right">
                    <div class="s-about-img p-relative  wow fadeInLeft animated" data-animation="fadeInLeft" data-delay=".4s">
                        <img loading="lazy" class="lazyload" data-src="<?= asset_url("public/images/404.webp") ?>" alt="<?= lang("pageNotFound") ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Error Page End-->