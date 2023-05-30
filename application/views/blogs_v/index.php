<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(<?= get_picture("settings_v", $settings->blog_logo) ?>)">
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

<!-- inner-blog -->
<section class="inner-blog pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if (!empty($blogs)) : ?>
                    <?php foreach ($blogs as $key => $value) : ?>
                        <?php if (strtotime($value->sharedAt) <= strtotime("now")) : ?>
                            <div class="bsingle__post mb-50">
                                <div class="bsingle__post-thumb">
                                    <img width="1000" height="1000" data-src="<?= get_picture("blogs_v", $value->img_url) ?>" class="img-fluid lazyload" alt="<?= $value->title ?>" title="<?= $value->title ?>" />
                                </div>
                                <div class="bsingle__content">
                                    <div class="meta-info">
                                        <ul>
                                            <?php foreach ($categories as $k => $v) : ?>
                                                <?php if ($v->id == $value->category_id) : ?>
                                                    <li><a rel="dofollow" href="<?= base_url(lang("routes_blog") . "/{$v->seo_url}") ?>" title="<?= $v->title ?>"><i class="fa fa-folder-open"></i> <?= $v->title ?></a></li>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                    <h2><a href="<?= base_url(lang("routes_blog") . "/" . lang("routes_blog_detail") . "/" . $value->seo_url) ?>" rel="dofollow" title="<?= lang("viewService") ?>"><?= $value->title ?></a></h2>
                                    <p><?= nl2br(strip_tags(mb_word_wrap($value->content, 475, "..."))) ?></p>
                                    <div class="blog__btn">
                                        <a class="btn" href="<?= base_url(lang("routes_blog") . "/" . lang("routes_blog_detail") . "/{$value->seo_url}") ?>" title="<?= $value->title ?>"><?= lang("viewBlog") ?> <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                    <?php if (!empty($links)) : ?>
                        <div class="pagination-wrap mb-50">
                            <nav>
                                <?= $links ?>
                            </nav>
                        </div>
                    <?php endif ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>
<!-- inner-blog-end -->