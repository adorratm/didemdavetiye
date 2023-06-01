<?php if (!empty($menuCategories)) : ?>
    <?php
    $wheres["p.isActive"] = 1;
    $wheres["pi.isCover"] = 1;
    $wheres["p.lang"] = $this->viewData->lang;
    $joins = ["products_w_categories pwc" => ["p.id = pwc.product_id", "left"], "product_categories pc" => ["pwc.category_id = pc.id", "left"], "product_images pi" => ["pi.product_id = p.id", "left"]];
    $select = "GROUP_CONCAT(pc.seo_url) category_seos,GROUP_CONCAT(pc.title) category_titles,GROUP_CONCAT(pc.id) category_ids,p.id,p.title,p.seo_url,pi.url img_url,p.price,p.discounted_price";
    $distinct = true;
    $groupBy = ["p.id", "pwc.product_id"];
    ?>
    <?php foreach ($menuCategories as $mkey => $mvalue) : ?>
        <?php if ($mvalue->top_id == 0) : ?>
            <?php
            $wheres["pc.id"] = $mvalue->id;

            /**
             * Get Home Products
             */
            $homeProducts = $this->general_model->get_all("products p", $select, "RAND()", $wheres, [], $joins, [8], [], $distinct, $groupBy);
            ?>
            <?php if (!empty($homeProducts)) : ?>
                <!-- team-area -->
                <section class="team-area2 fix p-relative pt-50 pb-50">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 p-relative">
                                <div class="section-title center-align mb-50 text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                                    <h2>
                                        <a rel="dofollow" href="<?= base_url(lang("routes_products") . "/" . $mvalue->seo_url) ?>" title="<?= $mvalue->title ?>"><?= $mvalue->title ?></a>
                                    </h2>

                                </div>
                            </div>

                        </div>
                        <div class="row team-active align-items-stretch align-self-stretch align-content-stretch">
                            <?php $i = 0 ?>
                            <?php foreach ($homeProducts as $key => $value) : ?>
                                <?php if (in_array($mvalue->id, explode(",", $value->category_ids))) : ?>
                                    <div class="col-xl-4 mb-4">
                                        <div class="single-team h-100">
                                            <div class="team-thumb">
                                                <div class="brd">
                                                    <a rel="dofollow" href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/{$value->seo_url}") ?>" title="<?= $value->title ?>">
                                                        <img loading="lazy" width="1000" height="1000" data-src="<?= get_picture("products_v", $value->img_url) ?>" alt="<?= $value->title ?>" class="img-fluid lazyload owl-lazy">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="team-info">
                                                <h4><a rel="dofollow" href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/{$value->seo_url}") ?>" title="<?= $value->title ?>"><?= $value->title ?></a></h4>
                                                <p>
                                                    <?php $i = 1 ?>
                                                    <?php $count = count(explode(",", $value->category_ids)) ?>
                                                    <?php foreach (explode(",", $value->category_titles) as $k => $v) : ?>
                                                        <?php $seo_url = explode(",", $value->category_seos)[$k]; ?>
                                                        <?php if ($i < $count) : ?>
                                                            <a style="color:#0d0d0dd1;" rel="dofollow" href="<?= base_url(lang("routes_products") . "/{$seo_url}") ?>" title="<?= $v ?>"><?= $v ?></a>,
                                                        <?php else : ?>
                                                            <a style="color:#0d0d0dd1;" rel="dofollow" href="<?= base_url(lang("routes_products") . "/{$seo_url}") ?>" title="<?= $v ?>"><?= $v ?></a>
                                                        <?php endif ?>
                                                        <?php $i++ ?>
                                                    <?php endforeach ?>
                                                </p>
                                                <div class="pi01Price text-center d-flex mx-auto justify-content-center">
                                                    <?php if (!empty($value->price) || !empty($value->discounted_price)) : ?>
                                                        <ins class="fw-bold fs-5 me-2"><?= !empty($value->discounted_price) ? $value->discounted_price : $value->price ?> <?= $symbol ?></ins>
                                                    <?php endif ?>
                                                    <?php if (!empty($value->discounted_price) && $value->discounted_price > 0) : ?>
                                                        <del><?= $value->price ?> <?= $symbol ?></del>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++ ?>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            <?php endif ?>
        <?php endif ?>
    <?php endforeach ?>
<?php endif ?>

<!--=================  About Section Start Here ================= -->
<?php if (!empty($pages[array_keys($pages)[0]])) : ?>
    <?php $aboutPage = $pages[array_keys($pages)[0]] ?>
    <!-- about-area -->
    <section class="about-area about-p pb-120 p-relative fix">
        <div class="animations-01"><img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/bg/an-img-01.webp") ?>" alt="<?= $aboutPage->title ?>"></div>
        <div class="animations-02"><img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/bg/an-img-02.webp") ?>" alt="<?= $aboutPage->title ?>"></div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
                    <div class="s-about-img p-relative  wow fadeInLeft animated" data-animation="fadeInLeft" data-delay=".4s">
                        <img width="1920" height="400" loading="lazy" class="img-fluid lazyload" data-src="<?= get_picture("pages_v", $aboutPage->img_url) ?>" title="<?= $aboutPage->title ?>" alt="<?= $aboutPage->title ?>">
                    </div>

                </div>

                <div class="col-lg-8 col-md-12 col-sm-12 text-center">
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