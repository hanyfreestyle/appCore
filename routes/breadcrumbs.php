<?php


use Diglactic\Breadcrumbs\Breadcrumbs;


use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('<i class="fa-solid fa-house"></i>' , route('page_index'));
});

Breadcrumbs::for('contact_us', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('web/contact.breadcrumbs'), route('page_ContactUs'));
});

















