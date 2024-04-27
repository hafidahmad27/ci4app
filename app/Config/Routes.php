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
    $routes->group('category', static function ($routes) {
        $routes->get('/', 'Backend\Category::index', ['as' => 'backend.category.view']);
        $routes->post('insert', 'Backend\Category::insert', ['as' => 'backend.category.insert']);
        $routes->post('update', 'Backend\Category::update', ['as' => 'backend.category.update']);
        $routes->post('delete', 'Backend\Category::delete', ['as' => 'backend.category.delete']);
    });
    $routes->group('item', static function ($routes) {
        $routes->get('/', 'Backend\Item::index', ['as' => 'backend.item.view']);
        $routes->get('form_add', 'Backend\Item::form_add', ['as' => 'backend.item.form_add']);
        $routes->post('insert', 'Backend\Item::insert', ['as' => 'backend.item.insert']);
        $routes->post('update', 'Backend\Item::update', ['as' => 'backend.item.update']);
        $routes->post('delete', 'Backend\Item::delete', ['as' => 'backend.item.delete']);
    });
    $routes->group('user', static function ($routes) {
        $routes->get('/', 'Backend\User::index', ['as' => 'backend.user.view']);
        $routes->post('insert', 'Backend\User::insert', ['as' => 'backend.user.insert']);
        $routes->post('update', 'Backend\User::update', ['as' => 'backend.user.update']);
        $routes->post('delete', 'Backend\User::delete', ['as' => 'backend.user.delete']);
        $routes->post('resetPassword', 'Backend\User::resetPassword', ['as' => 'backend.user.resetPassword']);
        $routes->post('userStatus', 'Backend\User::userStatus', ['as' => 'backend.user.userStatus']);
    });
    $routes->group('transaction', static function ($routes) {
        $routes->get('/', 'Backend\Transaction::index', ['as' => 'backend.transaction.view']);
    });
    $routes->group('report', static function ($routes) {
        $routes->get('/', 'Backend\Report::index', ['as' => 'backend.report.view']);
    });
    $routes->group('setting', static function ($routes) {
        $routes->get('/', 'Backend\Setting::index', ['as' => 'backend.setting.view']);
        $routes->post('changeProfil', 'Backend\Setting::changeProfil', ['as' => 'backend.setting.changeProfil']);
        $routes->post('changePassword', 'Backend\Setting::changePassword', ['as' => 'backend.setting.changePassword']);
    });
});

// get ID with AJAX for edit data
$routes->post('editUserById', 'Backend\User::getEditById');
$routes->post('editItemById', 'Backend\Item::getEditById');
