<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


// Dashboard / Setting
Breadcrumbs::for ('setting', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.settings'));
});


// Dashboard / Employees
Breadcrumbs::for ('store-report', function ($trail) {
    // $trail->parent('dashboard');
    $trail->push('Store Report', route('store.report'));
});

// // Dashboard / store-report / Add
// Breadcrumbs::for ('store-report/add', function ($trail) {
//     $trail->parent('store-report');
//     $trail->push(trans('validation.attributes.add'));
// });

// // Dashboard / store-report / Edit
// Breadcrumbs::for ('store-report/edit', function ($trail) {
//     $trail->parent('store-report');
//     $trail->push(trans('validation.attributes.edit'));
// });

// // Dashboard / store-report / Show
// Breadcrumbs::for ('store-report/show', function ($trail) {
//     $trail->parent('store-report');
//     $trail->push(trans('validation.attributes.view'));
// });

