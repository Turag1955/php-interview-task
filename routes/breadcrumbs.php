<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::for('setting', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('validation.attributes.settings'));
});


Breadcrumbs::for('store-report', function ($trail) {
    $trail->push('Store Report', route('store.report'));
});


Breadcrumbs::for('board', function ($trail) {
    $trail->push('Board');
});

Breadcrumbs::for('list', function ($trail) {
    $trail->parent('board');
    $trail->push('List');
});
