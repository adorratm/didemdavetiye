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
        <div class="row align-items-stretch align-self-stretch align-content-stretch <?= ($gallery->gallery_type != "files" ? "lightgallery" : null) ?>">
            <?php if (!empty($gallery_items)) : ?>
                <?php $j = 0 ?>
                <?php foreach ($gallery_items as $key => $value) : ?>
                    <?php if ($gallery->gallery_type == "files") : ?>
                        <?php $extension = pathinfo(FCPATH . "galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}/" . $value->url)["extension"] ?>
                        <div class="<?= strto("lower", $extension) === "pdf" ? "col-lg-6 col-md-12" : "col-xl-4 col-lg-4" ?>  wow fadeInUp animated mb-4" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                            <?php if (strto("lower", $extension) === "pdf") : ?>
                                <iframe loading="lazy" data-src="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" frameborder="0" class="w-100 lazyload vh-100"></iframe>
                            <?php else : ?>
                                <div class="product h-100">
                                    <div class="product__img">
                                        <img width="1000" height="1000" data-src="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $gallery->img_url) ?>" class="img-fluid lazyload" alt="<?= $value->title ?>" title="<?= $value->title ?>" />
                                    </div>
                                    <div class="product__content text-center pt-30">
                                        <h4 class="pro-title"><a rel="dofollow" href="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" alt="<?= $value->title ?>" <?= (!empty($extension) && $extension != "pdf" ? "download='" . (!empty($value->title) ? $value->title . "." . $extension : null) . "'" : "target='_blank'") ?>><?= !empty($value->title) && !empty($extension) ? $value->title . "." . $extension : $value->url ?></a></h4>
                                        <div>
                                            <a class="btn" rel="dofollow" href="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" alt="<?= $value->title ?>" <?= (!empty($extension) && $extension != "pdf" ? "download='" . (!empty($value->title) ? $value->title . "." . $extension : null) . "'" : "target='_blank'") ?>><i class="fa fa-download"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    <?php else : ?>
                        <div class="<?= ($gallery->gallery_type == "videos" || $gallery->gallery_type == "video_urls" ? "col-12 col-lg-6 col-xl-6" : "col-xl-4 col-lg-4") ?> wow fadeInUp animated mb-4" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                            <?php if ($gallery->gallery_type == "videos") : ?>
                                <video id="my-video<?= $key ?>" controls preload="auto" width="100%">
                                    <source src="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" />
                                </video>
                            <?php elseif ($gallery->gallery_type == "video_urls") : ?>
                                <?= htmlspecialchars_decode($value->url) ?>
                            <?php else : ?>
                                <div class="product h-100">
                                    <div class="product__img">
                                        <a class="lightimg lightimg<?= $j ?>" rel="dofollow" data-exthumbimage="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" href="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" title="<?= $value->title ?>">
                                            <div class="services-one__img-box">
                                                <div class="services-one__img">
                                                    <img width="1000" height="1000" data-src="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" class="img-fluid lazyload" alt="<?= $value->title ?>" title="<?= $value->title ?>" />
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php if (!empty($value->title) || !empty($value->description)) : ?>
                                        <div class="product__content text-center pt-30">
                                            <h4 class="pro-title"><a href="<?= base_url(lang("routes_galleries") . "/" . lang("routes_gallery") . "/" . $value->url) ?>" rel="dofollow" title="<?= lang("viewService") ?>"><?= $value->title ?></a></h4>
                                            <p><?= $value->description ?></p>
                                        </div>
                                    <?php endif ?>
                                </div>
                            <?php endif ?>
                        </div>
                    <?php endif ?>
                    <?php $j++ ?>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</section>
<!-- gallery-area-end -->

<script>
    window.addEventListener('DOMContentLoaded', function() {
        if (($('#lightgallery, .lightgallery').length > 0)) {
            $('#lightgallery, .lightgallery').lightGallery({
                selector: '.lightimg',
                loop: !0,
                thumbnail: !0,
                exThumbImage: 'data-exthumbimage'
            })
        }
    });
</script>