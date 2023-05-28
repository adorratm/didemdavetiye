<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="page-header">
    <div class="page-header__bg" style="background-image: url(<?= get_picture("settings_v", $settings->about_logo) ?>);">
    </div>
    <div class="container">
        <div class="page-header__inner">
            <h2><?= lang("pageNotFound") ?></h2>
        </div>
    </div>
</section>

<!--Error Page Start-->
<section class="services-details-one">
    <div class="container">
        <div class="services-details-one__massages">
            <div class="row align-items-center align-self-center align-content-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="services-details-one__massages-left">
                        <h3 class="services-details-one__massages-title"><i class="fa-regular fa-face-sad-cry"></i> <?= lang("pageNotFound") ?></h3>
                        <p class="services-details-one__massages-text-1"><?= lang("404Desc") ?></p>
                        <p class="services-details-one__massages-text-2">
                            <a rel="dofollow" href="<?= base_url() ?>" title="<?= lang("404Home") ?>" class="thm-btn error-page__btn"><?= lang("404Home") ?></a>
                        </p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="services-details-one__massages-right">
                        <div class="services-details-one__massages-img">
                            <img loading="lazy" class="lazyload" data-src="<?= asset_url("public/images/404.webp") ?>" alt="<?= lang("pageNotFound") ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Error Page End-->