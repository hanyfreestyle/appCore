<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('<i class="fa-solid fa-house"></i>' , route('page_index'));
});

Breadcrumbs::for('favorite_list', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('web/favorite.breadcrumbs'), route('FavoriteListing'));
});

Breadcrumbs::for('SearchPage', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('web/search.breadcrumbs'), route('Search'));
});

Breadcrumbs::for('contact_us', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('web/contact.breadcrumbs'), route('page_ContactUs'));
});


Breadcrumbs::for('developer_list', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('web/developer.h1'), route('page_developers'));
});


Breadcrumbs::for('developer_view', function (BreadcrumbTrail $trail,$Developer) {
    $trail->parent('developer_list');
    $trail->push( $Developer->name , route('page_developer_view',$Developer->slug));
});

Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('web/blog.breadcrumbs'), route('page_blog'));
});

Breadcrumbs::for('blogCatList', function (BreadcrumbTrail $trail, $Category) {
    $trail->parent('blog');
    $trail->push($Category->name, route('page_blogCatList', $Category->slug));
});

Breadcrumbs::for('post_view', function (BreadcrumbTrail $trail, $Category,$Post) {
    $trail->parent('blog');
    $trail->push($Category->name, route('page_blogCatList', $Category->slug));
    $trail->push($Post->name, route('page_blogCatList', $Post->slug));
});


Breadcrumbs::for('CompoundsList', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('web/compound.breadcrumbs'), route('page_compounds'));
});


Breadcrumbs::for('LocationView', function (BreadcrumbTrail $trail, $trees) {
    $trail->parent('CompoundsList');
    foreach($trees as $tree){
        $trail->push($tree->name, route('page_locationView', $tree->slug));
    }
});


Breadcrumbs::for('ForSale', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('web/compound.breadcrumbs_for_sale'), route('page_for_sale'));
});


Breadcrumbs::for('ProjectView', function (BreadcrumbTrail $trail,$trees,$unit) {
    $trail->parent('CompoundsList');
    foreach($trees as $tree){
        $trail->push($tree->name, route('page_locationView', $tree->slug));
    }
    $trail->push($unit->name, route('page_ListView', $unit->slug));
});





