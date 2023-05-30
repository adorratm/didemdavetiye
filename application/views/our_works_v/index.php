<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(<?= get_picture("settings_v", $settings->about_logo) ?>)">
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

<!--Project V-1 Start-->
<section class="shop-area pt-120 pb-120 p-relative " data-animation="fadeInUp animated" data-delay=".2s">
    <div class="container">
        <div class="row align-items-stretch align-self-stretch align-content-stretch">
            <?php foreach ($our_works as $key => $value) : ?>
                <!--Project One Single Start-->
                <div class="col-6 col-sm-6 col-md-4 col-lg-2 mb-3">
                    <div class="product mb-40 h-100">
                        <div class="product__img">
                            <img data-src="<?= get_picture("our_works_v", $value->img_url) ?>" title="<?= $value->title ?>" alt="<?= $value->title ?>" class="lazyload img-fluid w-100">
                        </div>
                    </div>
                </div>
                <!--Project One Single End-->
            <?php endforeach ?>
        </div>
    </div>
</section>
<!--Project V-1 End-->