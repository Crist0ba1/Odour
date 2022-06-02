<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::login');
$routes->get('/registrar', 'Home::registrar');

$routes->POST('/iniciarSession', 'Home::iniciarSession');
$routes->POST('/enviarCorreo', 'Home::enviarCorreo');


$routes->get('/logout', 'Home::logout');

$routes->get('/inicio', 'Home::inicio');
$routes->get('/dashbord', 'Home::dashbord');
$routes->get('/initChart', 'Home::initChart');

$routes->POST('/registrarDatos/(:any)/(:any)/(:any)', 'Home::registrarDatos/$1/$2/$3');
$routes->get('/inputs', 'Home::inputs');
$routes->get('/reset', 'Home::reset');

/* Gestion de usuarios*/
$routes->get('/gestionUsuarios', 'UsuarioController::gestionUsuarios');//Por si se quiere cargar por ceparado
$routes->post('/Usuario_fetch_all', 'UsuarioController::Usuario_fetch_all');
$routes->post('/addUsuario', 'UsuarioController::addUsuario');
$routes->post('/deleteUsuario', 'UsuarioController::deleteUsuario');
$routes->post('/editUsuario', 'UsuarioController::editUsuario');
$routes->post('/editarUsuario', 'UsuarioController::editarUsuario');
$routes->get('/tablaUsuario', 'UsuarioController::tablaUsuario');

/* Gestion de tableros*/
$routes->get('/gestionTableros', 'TableroController::gestionTableros');//Por si se quiere cargar por ceparado
$routes->post('/tableros_fetch_all', 'TableroController::tableros_fetch_all');
$routes->post('/addTableros', 'TableroController::addTablero');
$routes->post('/deleteTablero', 'TableroController::deleteTablero');
$routes->post('/editTablero', 'TableroController::editTablero');
$routes->get('/tablaTableros', 'TableroController::tablaTableros');
$routes->get('/usuariosTableros/(:any)', 'TableroController::usuariosTableros/$1');

/* Gestion de sensores*/
$routes->get('/gestionSensores', 'SensoresController::gestionSensores');//Por si se quiere cargar por ceparado
$routes->post('/sensores_fetch_all', 'SensoresController::sensores_fetch_all');
$routes->post('/addSensor', 'SensoresController::addSensor');
$routes->post('/deleteSensor', 'SensoresController::deleteSensor');
$routes->post('/editSensor', 'SensoresController::editSensor');
$routes->get('/tablaSensores', 'SensoresController::tablaSensores');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
