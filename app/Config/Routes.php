<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('peminjaman/add', 'PeminjamanController::addPengajuan');
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
$routes->post('/peminjaman/submit', 'PeminjamanController::submitPengajuan');
$routes->get('/peminjaman/success', 'PeminjamanController::success');
$routes->get('/peminjaman/error', 'PeminjamanController::error');


