<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
// dentro de app/Config/Routes.php

$routes->get('pacientes/cadastro', 'Pacientes::cadastro');  
$routes->post('pacientes/cadastrar', 'Pacientes::cadastrar');

