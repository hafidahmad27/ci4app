<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Auth
$routes->get('/', 'Backend\Auth::index', ['filter' => 'userLoggedIn']);
$routes->get('login', 'Backend\Auth::index', ['filter' => 'userLoggedIn']);
$routes->post('login', 'Backend\Auth::login', ['as' => 'backend.login']);
$routes->post('logout', 'Backend\Auth::logout', ['as' => 'backend.logout']);

$routes->group('backend', ['filter' => 'userNotLoggedIn'], static function ($routes) {
    $routes->get('/', 'Backend\Dashboard::index', ['as' => 'backend.dashboard.view']);
    $routes->group('categories', static function ($routes) {
        $routes->get('/', 'Backend\Category::index', ['as' => 'backend.category.view']);
        $routes->post('insert', 'Backend\Category::insert', ['as' => 'backend.category.insert']);
        $routes->post('update', 'Backend\Category::update', ['as' => 'backend.category.update']);
        $routes->post('delete', 'Backend\Category::delete', ['as' => 'backend.category.delete']);
    });
    $routes->group('items', static function ($routes) {
        $routes->get('/', 'Backend\Item::index', ['as' => 'backend.item.view']);
        $routes->get('form_add', 'Backend\Item::form_add', ['as' => 'backend.item.form_add.view']);
        $routes->post('insert', 'Backend\Item::insert', ['as' => 'backend.item.insert']);
        $routes->post('update', 'Backend\Item::update', ['as' => 'backend.item.update']);
        $routes->post('delete', 'Backend\Item::delete', ['as' => 'backend.item.delete']);
    });
    $routes->group('users', static function ($routes) {
        $routes->get('/', 'Backend\User::index', ['as' => 'backend.user.view']);
        $routes->post('insert', 'Backend\User::insert', ['as' => 'backend.user.insert']);
        $routes->post('update', 'Backend\User::update', ['as' => 'backend.user.update']);
        $routes->post('delete', 'Backend\User::delete', ['as' => 'backend.user.delete']);
        $routes->post('resetPassword', 'Backend\User::resetPassword', ['as' => 'backend.user.resetPassword']);
        $routes->post('userStatus', 'Backend\User::userStatus', ['as' => 'backend.user.userStatus']);
    });
    $routes->group('transaction', static function ($routes) {
        $routes->get('form', 'Backend\Transaction::index', ['as' => 'backend.transaction.form.view']);
        $routes->post('addToCart', 'Backend\Transaction::addToCart', ['as' => 'backend.transaction.addToCart']);
        $routes->post('updateCart', 'Backend\Transaction::updateCart', ['as' => 'backend.transaction.updateCart']);
        $routes->post('deleteFromCart', 'Backend\Transaction::deleteFromCart', ['as' => 'backend.transaction.deleteFromCart']);
        $routes->post('insert', 'Backend\Transaction::insert', ['as' => 'backend.transaction.insert']);
        $routes->get('lists', 'Backend\Transaction::lists', ['as' => 'backend.transaction.lists.view']);
        $routes->get('list_details/(:any)', 'Backend\Transaction::list_details/$1', ['as' => 'backend.transaction.list_details.view']);
    });
    $routes->group('reports', static function ($routes) {
        $routes->get('a_reports', 'Backend\Report::a_reports', ['as' => 'backend.report.a_reports.view']);
        $routes->get('b_reports', 'Backend\Report::b_reports', ['as' => 'backend.report.b_reports.view']);
    });
    $routes->group('settings', static function ($routes) {
        $routes->get('/', 'Backend\Setting::index', ['as' => 'backend.setting.view']);
        $routes->post('changeProfil', 'Backend\Setting::changeProfil', ['as' => 'backend.setting.changeProfil']);
        $routes->post('changePassword', 'Backend\Setting::changePassword', ['as' => 'backend.setting.changePassword']);
    });
});

// get value by ID with AJAX for modal edit form
$routes->post('editUserById', 'Backend\User::getEditById');
$routes->post('editItemById', 'Backend\Item::getEditById');
$routes->post('editCartItemById', 'Backend\Transaction::getEditCartItemById');
