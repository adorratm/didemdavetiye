<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


<!-- header -->
<header class="header-area header-three">
    <div class="header-top second-header d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-8 d-none d-lg-block">
                    <div class="header-cta">
                        <ul>
                            <li>
                                <i class="fas fa-envelope"></i>
                                <span>
                                    <?php if (!empty($settings->email)) : ?>
                                        <a rel="dofollow" title="Email" href="mailto:<?= $settings->email ?>"><?= $settings->email ?></a>
                                    <?php endif ?>
                                </span>
                            </li>
                            <li>
                                <i class="fas fa-phone"></i>
                                <span>
                                    <?php if (!empty(@json_decode($settings->phone, TRUE)[0])) : ?>
                                        <a rel="dofollow" title="<?= lang("phone") ?>" href="tel:<?= @json_decode($settings->phone, TRUE)[0] ?>"><?= @json_decode($settings->phone, TRUE)[0] ?></a>
                                    <?php endif ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 d-none d-lg-block text-right">
                    <div class="header-social">
                        <span>
                            <?php if (!empty($settings->facebook)) : ?>
                                <a class="facebook" rel="nofollow" href="<?= $settings->facebook ?>" title="Facebook" target="_blank">
                                    <i aria-hidden="true" class="fa fa-facebook"></i>
                                </a>
                            <?php endif ?>
                            <?php if (!empty($settings->twitter)) : ?>
                                <a class="twitter" rel="nofollow" href="<?= $settings->twitter ?>" title="Twitter" target="_blank">
                                    <i aria-hidden="true" class="fa fa-twitter"></i>
                                </a>
                            <?php endif ?>
                            <?php if (!empty($settings->instagram)) : ?>
                                <a class="instagram" rel="nofollow" href="<?= $settings->instagram ?>" title="Instagram" target="_blank">
                                    <i aria-hidden="true" class="fa fa-instagram"></i>
                                </a>
                            <?php endif ?>
                            <?php if (!empty($settings->linkedin)) : ?>
                                <a class="linkedin" rel="nofollow" href="<?= $settings->linkedin ?>" title="Linkedin" target="_blank">
                                    <i aria-hidden="true" class="fa fa-linkedin"></i>
                                </a>
                            <?php endif ?>
                            <?php if (!empty($settings->youtube)) : ?>
                                <a class="youtube" rel="nofollow" href="<?= $settings->youtube ?>" title="Youtube" target="_blank">
                                    <i aria-hidden="true" class="fa fa-youtube"></i>
                                </a>
                            <?php endif ?>
                            <?php if (!empty($settings->medium)) : ?>
                                <a class="medium" rel="nofollow" href="<?= $settings->medium ?>" title="Medium" target="_blank">
                                    <i aria-hidden="true" class="fa fa-medium"></i>
                                </a>
                            <?php endif ?>
                            <?php if (!empty($settings->pinterest)) : ?>
                                <a class="pinterest" rel="nofollow" href="<?= $settings->pinterest ?>" title="Pinterest" target="_blank">
                                    <i aria-hidden="true" class="fa fa-pinterest"></i>
                                </a>
                            <?php endif ?>
                            <?php if (!empty(@json_decode($settings->whatsapp, TRUE)[0])) : ?>
                                <a rel="nofollow" href="https://api.whatsapp.com/send?phone=<?= str_replace(" ", "", @json_decode($settings->whatsapp, TRUE)[0]) ?>&amp;text=<?= urlencode(lang("hello") . " " . $settings->company_name) ?>." title="Whatsapp" target="_blank">
                                    <i class='fa fa-whatsapp'></i>
                                </a>
                            <?php endif ?>
                        </span>
                        <!--  /social media icon redux -->
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div id="header-sticky" class="menu-area">
        <div class="container">
            <div class="second-menu">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo">
                            <a rel="dofollow" href="<?= base_url() ?>" title="<?= $settings->company_name ?>">
                                <picture>
                                    <img style="filter: drop-shadow(1px 1px 1px black);" width="220" height="58" data-src="<?= get_picture("settings_v", $settings->logo) ?>" alt="<?= $settings->company_name ?>" class="lazyload img-fluid">
                                </picture>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-7">

                        <div class="main-menu text-center text-xl-right">
                            <nav id="mobile-menu">
                                <?= $menus ?>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-3 d-none d-lg-block mt-25 mb-25">
                        <div class="right-menu">
                            <ul>
                                <li>
                                    <div class="icon"><img loading="lazy" class="lazyload" data-src="<?= asset_url("public/images/bg/top-m-icon.webp") ?>" alt="<?= lang("callUs") ?> !"></div>
                                    <div class="text">
                                        <span><?= lang("callUs") ?> !</span>
                                        <strong>
                                            <?php if (!empty(@json_decode($settings->phone, TRUE)[0])) : ?>
                                                <a rel="dofollow" title="<?= lang("phone") ?>" href="tel:<?= @json_decode($settings->phone, TRUE)[0] ?>"><?= @json_decode($settings->phone, TRUE)[0] ?></a>
                                            <?php endif ?>
                                        </strong>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>

                    <div class="col-12">
                        <div class="mobile-menu"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-end -->
<main>