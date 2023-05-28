<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if (!empty($slides)) : ?>
    <!--Main Slider Start-->
    <section class="main-slider">
        <div class="swiper-container thm-swiper__slider" data-swiper-options='{"slidesPerView": 1, "loop": true,
        "effect": "fade",
        "pagination": {
        "el": "#main-slider-pagination",
        "type": "bullets",
        "clickable": true
        },
        "navigation": {
        "nextEl": "#main-slider__swiper-button-next",
        "prevEl": "#main-slider__swiper-button-prev"
        },
        "autoplay": {
        "delay": 5000
        }}'>
            <div class="swiper-wrapper">
                <?php $i = 0 ?>
                <?php foreach ($slides as $key => $value) : ?>
                    <?php if (strtotime($value->sharedAt) <= strtotime("now")) : ?>
                        <?php if ($value->allowButton) : ?>
                            <?php $sUrl = null; ?>
                            <?php if (!empty($value->button_url)) : ?>
                                <?php $sUrl = $value->button_url ?>
                            <?php endif ?>
                            <?php if (!empty($value->category_id) && $value->category_id > 0) : ?>
                                <?php $sCategory = $this->general_model->get("service_categories", null, ["isActive" => 1, "id" => $value->category_id]); ?>
                                <?php if (!empty($sCategory)) : ?>
                                    <?php $sUrl = base_url(lang("routes_services") . "/" . $sCategory->seo_url) ?>
                                <?php endif ?>
                            <?php endif ?>
                            <?php if (!empty($value->service_id) && $value->service_id > 0) : ?>
                                <?php $sService = $this->general_model->get("services", null, ["isActive" => 1, "id" => $value->service_id]); ?>
                                <?php if (!empty($sService)) : ?>
                                    <?php $sUrl = base_url(lang("routes_services") . "/" . lang("routes_service") . "/" . $sService->seo_url) ?>
                                <?php endif ?>
                            <?php endif ?>
                            <?php if (!empty($value->page_id) && $value->page_id > 0) : ?>
                                <?php $sPage = $this->general_model->get("service_categories", null, ["isActive" => 1, "id" => $value->page_id]); ?>
                                <?php if (!empty($sPage)) : ?>
                                    <?php $sUrl = base_url(lang("routes_services") . "/" . $sPage->seo_url) ?>
                                <?php endif ?>
                            <?php endif ?>
                            <?php if (!empty($value->sector_id) && $value->sector_id > 0) : ?>
                                <?php $sSector = $this->general_model->get("sectors", null, ["isActive" => 1, "id" => $value->sector_id]); ?>
                                <?php if (!empty($sSector)) : ?>
                                    <?php $sUrl = base_url(lang("routes_sectors") . "/" . lang("routes_sector_detail") . "/" . $sSector->url) ?>
                                <?php endif ?>
                            <?php endif ?>
                        <?php endif ?>
                        <div class="swiper-slide">
                            <div class="image-layer">
                                    <?php if (!empty($value->allowButton) && !empty($value->button_caption) && !empty($sUrl)) : ?>
                                        <a rel="dofollow" title="<?= $value->title ?>" href="<?= $sUrl ?>">
                                            <img width="1920" height="750" data-src="<?= get_picture("slides_v", $value->img_url) ?>" alt="<?= $value->title ?>" class="lazyload img-fluid w-100">
                                        </a>
                                    <?php else : ?>
                                        <img width="1920" height="750" data-src="<?= get_picture("slides_v", $value->img_url) ?>" alt="<?= $value->title ?>" class="lazyload img-fluid w-100">
                                    <?php endif ?>
                            </div>
                            <!-- /.image-layer -->
                        </div>
                        <?php $i++ ?>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
            <div class="swiper-pagination" id="main-slider-pagination"></div>
            <!-- If we need navigation buttons -->
        </div>
    </section>
    <!--Main Slider End-->
<?php endif ?>

    <?php $this->load->view(@str_replace("/index", "", $this->viewFolder) . "/desktop"); ?>
