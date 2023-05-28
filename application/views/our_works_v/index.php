<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="page-header">
    <div class="page-header__bg" style="background-image: url(<?= get_picture("settings_v", $settings->about_logo) ?>);">
    </div>
    <div class="container">
        <div class="page-header__inner">
            <h2><?= $page_title ?></h2>
        </div>
    </div>
</section>

<!--Project V-1 Start-->
<section class="project-v-1">
    <div class="container">
        <div class="row align-items-stretch align-self-stretch align-content-stretch">
            <?php foreach ($our_works as $key => $value) : ?>
                <!--Project One Single Start-->
                <div class="col-6 col-sm-6 col-md-4 col-lg-2 mb-3">
                    <div class="project-one__single h-100 bg-transparent mb-0">
                        <div class="project-one__img bg-transparent shadow">
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