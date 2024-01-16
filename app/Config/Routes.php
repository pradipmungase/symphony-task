<?php

use CodeIgniter\Router\RouteCollection;
use App\Filters\AuthMiddleware;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth\LoginController::index');
$routes->post('/', 'Auth\LoginController::CheckLogin');
$routes->get('/register', 'User\UserController::register');
$routes->get('/logOut', 'Auth\LoginController::logOut');
$routes->post('/addNewUser', 'User\UserController::addNewUser');



$routes->get('/dashboard', 'Auth\LoginController::dashboard', ['filter' => 'auth']);
$routes->get('/viewAllUser', 'User\UserController::index', ['filter' => 'auth']);
$routes->post('/addNewUser', 'User\UserController::addNewUser', ['filter' => 'auth']);
$routes->get('/addNewUser', 'User\UserController::createUser', ['filter' => 'auth']);
$routes->get('/viewUser/(:segment)', 'User\UserController::viewUser/$1', ['filter' => 'auth']);
$routes->get('/deleteUser/(:segment)', 'User\UserController::deleteUser/$1', ['filter' => 'auth']);
$routes->get('/editUser/(:segment)', 'User\UserController::editUser/$1', ['filter' => 'auth']);
$routes->post('/updateUser/(:segment)', 'User\UserController::updateUser/$1', ['filter' => 'auth']);



