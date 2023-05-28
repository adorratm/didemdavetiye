<!--=================  About Section Start Here ================= -->
<?php if (!empty($pages[array_keys($pages)[0]])) : ?>
    <?php $aboutPage = $pages[array_keys($pages)[0]] ?>
    <?php if ($aboutPage->id == 1) : ?>
        <section class="welcome-one">
            <div class="container">
                <div class="row">
                    <?php if (!empty($aboutPage->img_url)) : ?>
                        <div class="col-xl-6">
                            <div class="welcome-one__left">
                                <div class="welcome-one__img-box wow slideInLeft animated" data-wow-delay="100ms" data-wow-duration="2500ms" style="visibility: visible; animation-duration: 2500ms; animation-delay: 100ms; animation-name: slideInLeft;">
                                    <div class="welcome-one__img">
                                        <img width="1000" height="1000" loading="lazy" class="img-fluid lazyload" data-src="<?= get_picture("pages_v", $aboutPage->img_url) ?>" title="<?= $aboutPage->title ?>" alt="<?= $aboutPage->title ?>">
                                        <div class="welcome-one__shape-1 float-bob-y">
                                            <img loading="lazy" class="img-fluid lazyload" data-src="<?= asset_url("public/images/shapes/welcome-one-shape-1.webp") ?>" alt="<?= $aboutPage->title ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    <div class="col-xl-6">
                        <div class="welcome-one__right">
                            <div class="section-title text-left">
                                <span class="section-title__tagline"><?= $settings->company_name ?></span>
                                <h2 class="section-title__title"><?= $aboutPage->title ?></h2>
                            </div>
                            <p class="welcome-one__text"><?= nl2br(strip_tags(mb_word_wrap($aboutPage->content, 475, "..."))) ?></p>
                            <div class="welcome-one__btn-box">
                                <a class="welcome-one__btn thm-btn" href="<?= base_url(lang("routes_page") . "/" . $aboutPage->url) ?>" rel="dofollow" title="<?= $aboutPage->title ?>">
                                    <?= $aboutPage->title ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif ?>
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

<?php if (!empty($instagramPosts)) : ?>
    <?php $userName = str_replace("/", "", (str_replace("https://www.instagram.com/", "", str_replace("https://instagram.com/", "", $this->viewData->settings->instagram)))); ?>
    <section class="why-choose-one">
        <div class="container">
            <div class="section-title text-center">
                <span class="section-title__tagline"><?= $settings->company_name ?></span>
                <h2 class="section-title__title"><?= lang("followUsOnInstagram") ?> <a rel="nofollow" href="<?= $settings->instagram ?>" target="_blank" title="Instagram" class="text-danger">@<?= $userName ?></a></h2>
            </div>
            <div class="row align-items-stretch align-self-stretch align-content-stretch">
                <?php foreach ($instagramPosts as $mediaKey => $mediaValue) : ?>
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
                                            <img style="object-fit: cover;height:250px; max-height:250px;" width="1000" height="250" data-src="<?= get_picture("instastory", $mediaValue->img_url) ?>" class="lazyload rounded" alt="<?= $settings->company_name ?>">
                                        </div>
                                    </div>
                                </a>
                                <div class="services-one__btn-box">
                                    <a class="services-one__btn" href="<?= base_url(lang("routes_services") . "/" . lang("routes_service") . "/" . $v->seo_url) ?>" rel="dofollow" title="<?= lang("viewOnInstagram") ?>"><?= lang("viewOnInstagram") ?> <i class="fa fa-arrow-right"></i></a>
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