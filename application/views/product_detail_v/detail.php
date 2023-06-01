<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


<!-- shop-banner-area start -->
<section class="shop-banner-area pt-120 pb-90 " data-animation="fadeInUp animated" data-delay=".2s">
    <div class="container">
        <div class="row">
            <div class="col-xl-7">
                <div id="carouselExample" class="carousel slide" data-bs-ride="true">
                    <div class="carousel-inner lightgallery productGallery">
                        <?php $i = 0 ?>
                        <?php if (!empty($product_own_images)) : ?>
                            <?php foreach ($product_own_images as $k => $v) : ?>
                                <?php if ($v->product_id == $product->id) : ?>
                                    <div class="carousel-item <?= $i == 0 ? "active" : null ?>" data-index="<?= $i ?>">
                                        <a rel="dofollow" title="<?= $product->title ?>" data-exthumbimage="<?= get_picture("products_v", $v->url) ?>" href="<?= get_picture("products_v", $v->url) ?>" data-index="<?= $i ?>" class="pgImage lightimg">
                                            <img width="1000" height="1000" loading="lazy" data-src="<?= get_picture("products_v", $v->url) ?>" title="<?= $product->title ?>" alt="<?= $product->title ?>" data-zoom-image="<?= get_picture("products_v", $v->url) ?>" class="rounded img-fluid lazyload w-100 d-block">
                                        </a>
                                    </div>
                                    <?php $i++ ?>
                                <?php endif ?>
                            <?php endforeach ?>
                        <?php endif ?>
                        <button aria-label="<?= $settings->company_name ?>" style="box-shadow:unset!important" class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-secondary border rounded" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button aria-label="<?= $settings->company_name ?>" style="box-shadow:unset!important" class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-secondary border rounded" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="carousel-indicators productGalleryThumb position-relative mx-0 mx-xxl-0 mt-3">
                        <div class="owl-thumbs d-flex">
                            <?php $i = 0 ?>
                            <?php if (!empty($product_own_images)) : ?>
                                <?php foreach ($product_own_images as $k => $v) : ?>
                                    <?php if ($v->product_id == $product->id) : ?>
                                        <div data-bs-target="#carouselExample" style="max-width: 135px;" class="owl-thumb-item border <?= ($i == 0 ? "active" : null) ?>" data-bs-touch="true" data-bs-slide-to="<?= $i ?>" data-bs-image="<?= get_picture("products_v", $v->url) ?>">
                                            <img width="1000" height="1000" loading="lazy" data-src="<?= get_picture("products_v", $v->url) ?>" title="<?= $product->title ?>" alt="<?= $product->title ?>" class="rounded lazyload img-fluid w-100 d-block">
                                        </div>
                                        <?php $i++ ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </div>

                        <button aria-label="<?= $settings->company_name ?>" style="box-shadow:unset!important" class="carousel-control-prev bg-transparent" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-secondary border rounded" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button aria-label="<?= $settings->company_name ?>" style="box-shadow:unset!important" class="carousel-control-next bg-transparent" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-secondary border rounded" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="product-details mb-30">
                    <div class="product-details-title">
                        <p><?= $settings->company_name ?></p>
                        <h1><?= $product->title ?></h1>
                    </div>
                    <div class="product-cat mt-30 mb-30">
                        <?php if (!empty($product->price) || !empty($product->discounted_price)) : ?>
                            <ins class="fw-bold fs-5 me-2"><?= !empty($product->discounted_price) ? $product->discounted_price : $product->price ?> <?= $symbol ?></ins>
                        <?php endif ?>
                        <?php if (!empty($product->discounted_price) && $product->discounted_price > 0) : ?>
                            <del><?= $product->price ?> <?= $symbol ?></del>
                        <?php endif ?>
                    </div>
                    <?= $product->description ?>
                    <?php if ($product->category_title) : ?>
                        <div class="product-cat mt-30 mb-30">
                            <a rel="dofollow" title="<?= $product->category_title ?>" href="<?= base_url(lang("routes_products") . "/" . $product->category_seo_url) ?>"><?= $product->category_title ?></a>
                        </div>
                    <?php endif ?>
                    <div class="product-social mt-45">
                        <span class="me-2"><?= lang("shareProduct") ?> : </span>
                        <a class="fac" rel="nofollow" title="Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&t=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>"><i class="fa-brands fa-facebook"></i></a>
                        <a class="twi" rel="nofollow" title="Twitter" target="_blank" href="https://twitter.com/intent/tweet?text=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&t=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>"><i class="fa-brands fa-twitter"></i></a>
                        <a class="lin" rel="nofollow" title="Linkedin" target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&title=<?= urlencode($product->title) ?>"><i class="fa-brands fa-linkedin"></i></a>
                        <a class="ins" rel="nofollow" title="Pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&description=<?= urlencode($product->title) ?>"><i class="fa-brands fa-pinterest"></i></a>
                        <a class="ins" rel="nofollow" title="Reddit" target="_blank" href="https://www.reddit.com/submit?url=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&title=<?= urlencode($product->title) ?>"><i class="fa-brands fa-reddit"></i></a>
                        <a class="ins" rel="nofollow" title="Whatsapp" target="_blank" href="https://wa.me/?text=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- shop-banner-area end -->

<script>
    window.addEventListener('DOMContentLoaded', () => {
        if (($('#lightgallery, .lightgallery').length > 0)) {
            $('#lightgallery, .lightgallery').lightGallery({
                selector: '.lightimg',
                loop: !0,
                thumbnail: !0,
                exThumbImage: 'data-exthumbimage',
                download: false,
            })
        }
        let carousel = new bootstrap.Carousel(".carousel", {
            interval: 2000,
            touch: true
        });
        $(".carousel").on("slid.bs.carousel", (event) => {
            $(".owl-thumb-item:not('.d-none')[data-bs-slide-to=" + event.from + "]").removeClass("active");
            $(".owl-thumb-item:not('.d-none')[data-bs-slide-to=" + event.to + "]").addClass("active");
            let x = $(".owl-thumb-item.active:not('.d-none')[data-bs-slide-to=" + event.to + "]").width();
            $('.owl-thumbs').animate({
                scrollLeft: event.to * x
            }, 500);
        });
    });
</script>