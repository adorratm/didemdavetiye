<!--=================  About Section Start Here ================= -->
<?php if (!empty($pages[array_keys($pages)[0]])) : ?>
    <?php $aboutPage = $pages[array_keys($pages)[0]] ?>
    <!-- about-area -->
    <section class="about-area about-p pb-120 p-relative fix">
        <div class="animations-01"><img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/bg/an-img-01.webp") ?>" alt="<?= $aboutPage->title ?>"></div>
        <div class="animations-02"><img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/bg/an-img-02.webp") ?>" alt="<?= $aboutPage->title ?>"></div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="s-about-img p-relative  wow fadeInLeft animated" data-animation="fadeInLeft" data-delay=".4s">
                        <img width="1000" height="1000" loading="lazy" class="img-fluid lazyload" data-src="<?= get_picture("pages_v", $aboutPage->img_url) ?>" title="<?= $aboutPage->title ?>" alt="<?= $aboutPage->title ?>">
                    </div>

                </div>

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="about-content s-about-content  wow fadeInRight  animated" data-animation="fadeInRight" data-delay=".4s">
                        <div class="about-title second-title pb-25">
                            <h5><?= $settings->company_name ?></h5>
                            <h2><?= $aboutPage->title ?></h2>
                        </div>
                        <p><?= nl2br(strip_tags(mb_word_wrap($aboutPage->content, 475, "..."))) ?></p>
                        <div class="slider-btn mt-20">
                            <a class="btn ss-btn smoth-scroll" href="<?= base_url(lang("routes_page") . "/" . $aboutPage->url) ?>" rel="dofollow" title="<?= $aboutPage->title ?>">
                                <?= $aboutPage->title ?> <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- about-area-end -->
<?php endif ?>
<!--================= About Section End Here ================= -->

<?php if (!empty($services)) : ?>
    <section class="services-one">
        <div class="container">
            <div class="section-title text-center">
                <span class="section-title__tagline"><?= $settings->company_name ?></span>
                <h2 class="section-title__title"><?= lang("service_categories") ?></h2>
            </div>
            <div class="row align-items-stretch align-self-stretch align-content-stretch">
                <?php foreach ($services as $k => $v) : ?>
                    <!--Services One Single Start-->
                    <div class="col-xl-4 col-lg-4 wow fadeInUp animated mb-4" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                        <div class="services-one__single h-100">
                            <div class="services-one__single-inner">
                                <div class="services-one__shape-1">
                                    <img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/shapes/services-one-shape-1.webp") ?>" alt="<?= $v->title ?>">
                                </div>
                                <div class="services-one__shape-2">
                                    <img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/shapes/services-one-shape-2.webp") ?>" alt="<?= $v->title ?>">
                                </div>
                                <a href="<?= base_url(lang("routes_services") . "/" . lang("routes_service") . "/" . $v->seo_url) ?>" rel="dofollow" title="<?= lang("viewService") ?>">
                                    <div class="services-one__img-box">
                                        <div class="services-one__img">
                                            <img width="1000" height="1000" data-src="<?= get_picture("services_v", $v->img_url) ?>" class="img-fluid lazyload" alt="<?= $v->title ?>" title="<?= $v->title ?>" />
                                        </div>
                                    </div>
                                </a>
                                <h3 class="services-one__title"><a href="<?= base_url(lang("routes_services") . "/" . lang("routes_service") . "/" . $v->seo_url) ?>" rel="dofollow" title="<?= lang("viewService") ?>"><?= $v->title ?></a></h3>
                                <div class="services-one__btn-box">
                                    <a class="services-one__btn" href="<?= base_url(lang("routes_services") . "/" . lang("routes_service") . "/" . $v->seo_url) ?>" rel="dofollow" title="<?= lang("viewService") ?>"><?= lang("viewService") ?> <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Services One Single End-->
                <?php endforeach ?>
            </div>
        </div>
    </section>
<?php endif ?>