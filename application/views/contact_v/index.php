<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $addressTitles = @json_decode($settings->address_title, TRUE); ?>
<?php $phones = @json_decode($settings->phone, TRUE); ?>
<?php $faxes = @json_decode($settings->fax, TRUE); ?>
<?php $addresses = @json_decode($settings->address, TRUE); ?>
<?php $whatsapps = @json_decode($settings->whatsapp, TRUE); ?>
<?php $maps = @json_decode($settings->map, TRUE); ?>

<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(<?= get_picture("settings_v", $settings->contact_logo) ?>)">
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

<!-- contact-area -->
<section id="contact" class="contact-area after-none contact-bg pt-120 pb-120 p-relative fix">
    <div class="container">

        <div class="row justify-content-stretch align-items-stretch align-self-stretch">

            <div class="col-lg-4 order-2">

                <div class="contact-info">
                    <?php foreach ($addresses as $key => $value) : ?>
                        <?php if (!empty($value)) : ?>
                            <h3 class="text-center my-4"><?= $addressTitles[$key] ?></h3>
                            <div class="single-cta pb-30 mb-30 wow fadeInUp animated" data-animation="fadeInDown animated" data-delay=".2s">
                                <div class="f-cta-icon">
                                    <i class="fa fa-map-marker-alt"></i>
                                </div>
                                <h5><?= lang("address") ?></h5>
                                <p><?= @$value ?></p>
                                <p><a rel="dofollow" href="<?= base_url() ?>" title="<?= lang("viewOnMap") ?>" onclick="event.preventDefault();event.stopImmediatePropagation();$('.contact-map').html('<?= $maps[$key] ?>');$('html, body').animate({scrollTop: ($('.contact-map').offset().top - $('.stricky-header').height())}, 'slow');"><?= lang("viewOnMap") ?></a></p>
                            </div>
                        <?php endif ?>
                        <?php if (!empty($phones[$key])) : ?>
                            <div class="single-cta pb-30 mb-30 wow fadeInUp animated" data-animation="fadeInDown animated" data-delay=".2s">
                                <div class="f-cta-icon">
                                    <i class="fa fa-phone-volume"></i>
                                </div>
                                <h5><?= lang("phone") ?></h5>
                                <p><a href="tel:<?= @str_replace(" ", "", @$phones[$key]) ?>" rel="dofollow" title="<?= lang("phone") ?>"><?= @$phones[$key] ?></a></p>
                            </div>
                        <?php endif ?>
                        <?php if (!empty($faxes[$key])) : ?>
                            <div class="single-cta pb-30 mb-30 wow fadeInUp animated" data-animation="fadeInDown animated" data-delay=".2s">
                                <div class="f-cta-icon">
                                    <i class="fa fa-fax"></i>
                                </div>
                                <h5><?= lang("fax") ?></h5>
                                <p><a href="tel:<?= @str_replace(" ", "", @$faxes[$key]) ?>" rel="dofollow" title="<?= lang("fax") ?>"><?= @$faxes[$key] ?></a></p>
                            </div>
                        <?php endif ?>
                        <?php if (!empty($whatsapps[$key])) : ?>
                            <div class="single-cta pb-30 mb-30 wow fadeInUp animated" data-animation="fadeInDown animated" data-delay=".2s">
                                <div class="f-cta-icon">
                                    <i class="fa fa-whatsapp"></i>
                                </div>
                                <h5><?= lang("fax") ?></h5>
                                <p><a href="https://api.whatsapp.com/send?phone=<?= @str_replace(" ", "", @$whatsapps[$key]) ?>&amp;text=<?= urlencode(lang("hello") . " " . $settings->company_name) ?>." rel="dofollow" title="<?= lang("whatsapp") ?>"><?= @$whatsapps[$key] ?></a></p>
                            </div>
                        <?php endif ?>
                        <div class="single-cta pb-30 mb-30 wow fadeInUp animated" data-animation="fadeInDown animated" data-delay=".2s">
                            <div class="f-cta-icon">
                                <i class="far fa-envelope-open"></i>
                            </div>
                            <h5><?= lang("mail") ?></h5>
                            <p><a href="mailto:<?= $settings->email ?>" rel="dofollow" title="<?= lang("mail") ?>"><?= $settings->email ?></a></p>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-lg-8 order-1">
                <div class="contact-bg02">
                    <div class="section-title center-align">
                        <h2>
                            <?= lang("contactForm") ?>
                        </h2>
                    </div>
                    <form onsubmit="return false" enctype="multipart/form-data" method="POST" id="contact-form" class="contact-form mt-30">
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="contact-field p-relative c-name mb-20">
                                    <input type="text" name="full_name" id="full_name" placeholder="<?= lang("namesurname") ?>" required minlength="2" maxlength="70">
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="contact-field p-relative c-name mb-20">
                                    <input type="email" name="email" id="email" placeholder="<?= lang("emailaddress") ?>" required>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="contact-field p-relative c-name mb-20">
                                    <input type="text" name="phone" id="phone" placeholder="<?= lang("phonenumber") ?>" required minlength="11" maxlength="20">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="contact-field p-relative c-name mb-20">
                                    <input type="text" name="subject" id="subject" placeholder="<?= lang("subject") ?>" required>
                                </div>
                                <div class="contact-field p-relative c-name mb-20">
                                    <textarea name="comment" id="comment" cols="30" rows="8" placeholder="<?= lang("message") ?>" required></textarea>
                                </div>
                                <div class="slider-btn">
                                    <button type="submit" class="btn ss-btn btnSubmitForm" data-animation="fadeInRight" data-delay=".8s" aria-label="<?= $settings->company_name ?>" type="submit" data-url="<?= base_url(lang("routes_contact-form")) ?>"><?= lang("submit") ?></button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                    </form>

                    <div class="d-flex-justify-content-space-between bg-white border rounded p-3 mt-4" style="width: max-content;">
                        <?php if (!empty($settings->facebook)) : ?>
                            <a rel="nofollow" href="<?= $settings->facebook ?>" title="Facebook" target="_blank">
                                <i class='fa fa-facebook fa-2x'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->twitter)) : ?>
                            <a rel="nofollow" href="<?= $settings->twitter ?>" title="Twitter" target="_blank">
                                <i class='fa fa-twitter fa-2x'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->instagram)) : ?>
                            <a rel="nofollow" href="<?= $settings->instagram ?>" title="Instagram" target="_blank">
                                <i class='fa fa-instagram fa-2x'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->linkedin)) : ?>
                            <a rel="nofollow" href="<?= $settings->linkedin ?>" title="Linkedin" target="_blank">
                                <i class='fa fa-linkedin fa-2x'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->youtube)) : ?>
                            <a rel="nofollow" href="<?= $settings->youtube ?>" title="Youtube" target="_blank">
                                <i class='fa fa-youtube fa-2x'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->medium)) : ?>
                            <a rel="nofollow" href="<?= $settings->medium ?>" title="Medium" target="_blank">
                                <i class='fa fa-medium fa-2x'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->pinterest)) : ?>
                            <a rel="nofollow" href="<?= $settings->pinterest ?>" title="Pinterest" target="_blank">
                                <i class='fa fa-pinterest fa-2x'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty(@json_decode($settings->whatsapp, TRUE)[0])) : ?>
                            <a rel="nofollow" href="https://api.whatsapp.com/send?phone=<?= str_replace(" ", "", @json_decode($settings->whatsapp, TRUE)[0]) ?>&amp;text=<?= urlencode(lang("hello") . " " . $settings->company_name) ?>." title="Whatsapp" target="_blank">
                                <i class='fa fa-whatsapp fa-2x'></i>
                            </a>
                        <?php endif ?>
                    </div>
                </div>

            </div>
        </div>

    </div>

</section>
<!-- contact-area-end -->
<!-- map-area-end -->
<div class="map fix" style="background: #f5f5f5;">
    <div class="container-flud">

        <div class="row">
            <div class="col-lg-12 contact-map">
                <?= @htmlspecialchars_decode(@$maps[0]) ?>
            </div>
        </div>
    </div>
</div>
<!-- map-area-end -->