<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
</main>


<!-- footer -->
<footer class="footer-bg footer-p pt-90" style="background-color: #0c2957; background-image: url(<?= asset_url("public/images/bg/footer-bg.webp") ?>);">
    <div class="footer-top pb-70">
        <div class="container">
            <div class="row justify-content-between">

                <div class="col-xl-4 col-lg-4 col-sm-6">
                    <div class="footer-widget mb-30">
                        <div class="f-widget-title">
                            <h2>
                                <a rel="dofollow" href="<?= base_url() ?>" title="<?= $settings->company_name ?>">
                                    <picture>
                                        <img style="filter: brightness(100);" width="270" height="58" data-src="<?= get_picture("settings_v", $settings->logo) ?>" alt="<?= $settings->company_name ?>" class="lazyload img-fluid">
                                    </picture>
                                </a>
                            </h2>
                        </div>
                        <div class="f-contact d-block">
                            <?php if (!empty($settings->email)) : ?>
                                <p><a class="d-flex align-items-center align-self-center align-content-center" rel="dofollow" title="Email" href="mailto:<?= $settings->email ?>"><i class="fa fa-envelope-open me-2"></i> <?= $settings->email ?></a></p>
                            <?php endif ?>
                            <?php if (!empty(@json_decode($settings->phone, TRUE)[0])) : ?>
                                <p><a class="d-flex align-items-center align-self-center align-content-center" rel="dofollow" title="<?= lang("phone") ?>" href="tel:<?= @json_decode($settings->phone, TRUE)[0] ?>"><i class="fa fa-phone-volume me-2"></i> <?= @json_decode($settings->phone, TRUE)[0] ?></a></p>
                            <?php endif ?>
                        </div>
                        <div class="footer-social mt-10">
                            <?php if (!empty($settings->facebook)) : ?>
                                <a rel="nofollow" href="<?= $settings->facebook ?>" title="Facebook" target="_blank">
                                    <i class='fa fa-facebook'></i>
                                </a>
                            <?php endif ?>
                            <?php if (!empty($settings->twitter)) : ?>
                                <a rel="nofollow" href="<?= $settings->twitter ?>" title="Twitter" target="_blank">
                                    <i class='fa fa-twitter'></i>
                                </a>
                            <?php endif ?>
                            <?php if (!empty($settings->instagram)) : ?>
                                <a rel="nofollow" href="<?= $settings->instagram ?>" title="Instagram" target="_blank">
                                    <i class='fa fa-instagram'></i>
                                </a>
                            <?php endif ?>
                            <?php if (!empty($settings->linkedin)) : ?>
                                <a rel="nofollow" href="<?= $settings->linkedin ?>" title="Linkedin" target="_blank">
                                    <i class='fa fa-linkedin'></i>
                                </a>
                            <?php endif ?>
                            <?php if (!empty($settings->youtube)) : ?>
                                <a rel="nofollow" href="<?= $settings->youtube ?>" title="Youtube" target="_blank">
                                    <i class='fa fa-youtube'></i>
                                </a>
                            <?php endif ?>
                            <?php if (!empty($settings->medium)) : ?>
                                <a rel="nofollow" href="<?= $settings->medium ?>" title="Medium" target="_blank">
                                    <i class='fa fa-medium'></i>
                                </a>
                            <?php endif ?>
                            <?php if (!empty($settings->pinterest)) : ?>
                                <a rel="nofollow" href="<?= $settings->pinterest ?>" title="Pinterest" target="_blank">
                                    <i class='fa fa-pinterest'></i>
                                </a>
                            <?php endif ?>
                            <?php if (!empty(@json_decode($settings->whatsapp, TRUE)[0])) : ?>
                                <a rel="nofollow" href="https://api.whatsapp.com/send?phone=<?= str_replace(" ", "", @json_decode($settings->whatsapp, TRUE)[0]) ?>&amp;text=<?= urlencode(lang("hello") . " " . $settings->company_name) ?>." title="Whatsapp" target="_blank">
                                    <i class='fa fa-whatsapp'></i>
                                </a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <?php if (!empty($footer_menus)) : ?>
                    <div class="col-xl-2 col-lg-2 col-sm-6">
                        <div class="footer-widget mb-30">
                            <div class="f-widget-title">
                                <h2><?= lang("menus") ?></h2>
                            </div>
                            <div class="footer-link">
                                <?= $footer_menus ?>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <?php if (!empty($footer_products)) : ?>
                    <div class="col-xl-3 col-lg-3 col-sm-6">
                        <div class="footer-widget mb-30">
                            <div class="f-widget-title">
                                <h2><?= lang("products") ?></h2>
                            </div>
                            <div class="footer-link">
                                <ul>
                                    <?php foreach ($footer_products as $key => $value) : ?>
                                        <li>
                                            <a rel="dofollow" title="<?= $value->title ?>" href="<?= base_url(lang("routes_products") . "/" . $value->seo_url) ?>"><?= $value->title ?></a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <?php if (!empty(@json_decode($settings->address, TRUE))) : ?>
                    <div class="col-xl-3 col-lg-3 col-sm-6">
                        <div class="footer-widget mb-30">
                            <div class="f-widget-title">
                                <h2><?= lang("contactWithUs") ?></h2>
                            </div>
                            <div class="footer-link">
                                <ul>
                                    <?php foreach (@json_decode($settings->address, TRUE) as $key => $value) : ?>
                                        <li>
                                            <a rel="dofollow" href="<?= base_url(lang("routes_contact")) ?>" title="<?= lang("address") ?>"><?= @json_decode($settings->address_title, TRUE)[$key] ?> : <?= $value ?></a>
                                            <a href="tel:<?= @str_replace(" ", "", @@json_decode($settings->phone, TRUE)[$key]) ?>" rel="dofollow" title="<?= lang("phone") ?>"><?= @json_decode($settings->phone, TRUE)[$key] ?></a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>

                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="copy-text">
                        © 2023 <a class="text-white" rel="dofollow" href="<?= base_url() ?>" title="<?= $settings->company_name ?>"><?= $settings->company_name ?></a> <?= lang("allRightsReserved") ?>
                    </div>
                </div>
                <div class="col-lg-4 text-right text-xl-right">
                    <a rel="nofollow" href="https://mutfakyapim.com" title="Mutfak Yapım Dijital Reklam Ajansı">
                        <picture>
                            <img style="filter: drop-shadow(1px 1px 1px black);" width="161" height="40" data-src="https://mutfakyapim.com/images/mutfak/logo.png" alt="Mutfak Yapım Dijital Reklam Ajansı" class="lazyload img-fluid">
                        </picture>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer-end -->

<!-- Jquery -->

<script src="<?= asset_url("public/js/modernizr-3.5.0.min.js") ?>"></script>
<script src="<?= asset_url("public/js/jquery.min.js") ?>"></script>
<script>
    jQuery.event.special.touchstart = {
        setup: function(_, ns, handle) {
            this.addEventListener("touchstart", handle, {
                passive: !ns.includes("noPreventDefault")
            });
        }
    };
    jQuery.event.special.touchmove = {
        setup: function(_, ns, handle) {
            this.addEventListener("touchmove", handle, {
                passive: !ns.includes("noPreventDefault")
            });
        }
    };
    jQuery.event.special.wheel = {
        setup: function(_, ns, handle) {
            this.addEventListener("wheel", handle, {
                passive: true
            });
        }
    };
    jQuery.event.special.mousewheel = {
        setup: function(_, ns, handle) {
            this.addEventListener("mousewheel", handle, {
                passive: true
            });
        }
    };
</script>
<!-- #Jquery -->
<!--FOOTER END-->
<?php if (!empty($settings->facebook) || !empty($settings->twitter) || !empty($settings->instagram) || !empty($settings->youtube) || !empty($settings->linkedin) || !empty($settings->medium) || !empty($settings->pinterest)) : ?>
    <div class="btn-group dropstart fixed-linkedin bg-primary">
        <a class="dropdown-toggle" href="<?= base_url() ?>" data-bs-title="<?= lang("social") ?>" data-bs-toggle="dropdown" data-bs-placement="left" data-bs-title="<?= lang("social") ?>" aria-expanded="false">
            <i class="fa fa-comments text-white" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="<?= lang("social") ?>"></i>
        </a>
        <ul class="dropdown-menu">
            <?php if (!empty($settings->facebook)) : ?>
                <li>
                    <a class="dropdown-item" rel="nofollow" href="<?= $settings->facebook ?>" title="Facebook" target="_blank">
                        <i class='fa fa-facebook color'></i> Facebook
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->twitter)) : ?>
                <li>
                    <a class="dropdown-item" rel="nofollow" href="<?= $settings->twitter ?>" title="Twitter" target="_blank">
                        <i class='fa fa-twitter color'></i> Twitter
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->instagram)) : ?>
                <li>
                    <a class="dropdown-item" rel="nofollow" href="<?= $settings->instagram ?>" title="Instagram" target="_blank">
                        <i class='fa fa-instagram color'></i> Instagram
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->linkedin)) : ?>
                <li>
                    <a class="dropdown-item" rel="nofollow" href="<?= $settings->linkedin ?>" title="Linkedin" target="_blank">
                        <i class='fa fa-linkedin color'></i> Linkedin
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->youtube)) : ?>
                <li>
                    <a class="dropdown-item" rel="nofollow" href="<?= $settings->youtube ?>" title="Youtube" target="_blank">
                        <i class='fa fa-youtube color'></i> Youtube
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->medium)) : ?>
                <li>
                    <a class="dropdown-item" rel="nofollow" href="<?= $settings->medium ?>" title="Medium" target="_blank">
                        <i class='fa fa-medium color'></i> Medium
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->pinterest)) : ?>
                <li>
                    <a class="dropdown-item" rel="nofollow" href="<?= $settings->pinterest ?>" title="Pinterest" target="_blank">
                        <i class='fa fa-pinterest color'></i> Pinterest
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </div>
<?php endif ?>
<?php if (!empty(@json_decode($settings->phone, TRUE)[0])) : ?>
    <a rel="dofollow" class="fixed-phone text-white bg-danger" href="tel:<?= @json_decode($settings->phone, TRUE)[0] ?>" data-bs-title="<?= lang("phone") ?>" data-bs-toggle="tooltip" data-bs-placement="left"><i class="fa fa-phone"></i></a>
<?php endif ?>
<?php if (!empty(@json_decode($settings->whatsapp, TRUE)[0])) : ?>
    <a rel="nofollow" target="_blank" class="fixed-whatsapp text-white bg-success" href="https://api.whatsapp.com/send?phone=<?= str_replace(" ", "", @json_decode($settings->whatsapp, TRUE)[0]) ?>&amp;text=<?= urlencode(lang("hello") . " " . $settings->company_name) ?>." data-bs-title="WhatsApp" data-bs-toggle="tooltip" data-bs-placement="left"><i class="fa fa-whatsapp"></i></a>
<?php endif ?>

<!--layout end-->
<!-- SCRIPTS -->
<!-- Lazysizes -->
<script async defer src="<?= asset_url("public/js/lazysizes.min.js") ?>"></script>
<!-- #Lazysizes -->

<!-- iziToast -->
<script defer src="<?= asset_url("public/js/iziToast.min.js") ?>"></script>
<!-- #iziToast -->

<script defer src="<?= asset_url("public/js/lightgallery-all.min.js") ?>"></script>

<!-- Site Scripts -->
<script defer src="<?= asset_url("public/js/jquery-migrate.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/bootstrap.bundle.min.js") ?>"></script>
<script defer src="<?= asset_url("public/vendors/slick.min.js") ?>"></script>
<script defer src="<?= asset_url("public/vendors/paroller.js") ?>"></script>
<script defer src="<?= asset_url("public/vendors/wow.min.js") ?>"></script>
<script defer src="<?= asset_url("public/vendors/js_isotope.pkgd.min.js") ?>"></script>
<script defer src="<?= asset_url("public/vendors/imagesloaded.min.js") ?>"></script>
<script defer src="<?= asset_url("public/vendors/parallax.min.js") ?>"></script>
<script defer src="<?= asset_url("public/vendors/jquery.waypoints.min.js") ?>"></script>
<script defer src="<?= asset_url("public/vendors/jquery.scrollUp.min.js") ?>"></script>
<script defer src="<?= asset_url("public/vendors/jquery.meanmenu.min.js") ?>"></script>
<script defer src="<?= asset_url("public/vendors/parallax-scroll.js") ?>"></script>
<script defer src="<?= asset_url("public/vendors/element-in-view.js") ?>"></script>

<script async defer src="<?= asset_url("public/js/iziModal.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/main.js") ?>"></script>
<script defer src="<?= asset_url("public/js/app.js") ?>"></script>
<!-- #Site Scripts -->

<!-- SCRIPTS -->
<script>
    window.addEventListener('DOMContentLoaded', () => {
        $(document).on("click", ".map-address", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let dest = $(this).data("destination");
            if (navigator.geolocation) {
                if ((navigator.platform.indexOf("iPhone") != -1) ||
                    (navigator.platform.indexOf("iPad") != -1) ||
                    (navigator.platform.indexOf("iPod") != -1))
                    window.open("comgooglemapsurl://maps.google.com/maps/dir/?api=1&destination=" + dest + "&travelmode=driving");
                else {
                    window.open("https://www.google.com/maps/dir/?api=1&destination=" + dest + "&travelmode=driving");
                }
            } else {
                iziToast.show({
                    type: "error",
                    title: "<?= lang("error") ?>",
                    message: "<?= lang("allowGeoLocation") ?>",
                    position: "topCenter"
                });
            }
        });
    });
</script>
<?php $this->load->view("includes/alert") ?>
</body>

</html>