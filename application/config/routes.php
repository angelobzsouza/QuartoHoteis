<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';

// Routes relacionadas ao login
$route['entrar'] = "Credenciais/loginView";
$route['login'] = "Credenciais/login";
$route['sair'] = "Credenciais/logout";

// Routes para buscar hoteis
$route['hotel/(:any)'] = "Hoteis/hotel/$1";

// Routes de cadastro de hoteis
$route['cadastrar'] = "Hoteis/createView";

// Routes de edição de hoteis
$route['editar-perfil/(:num)'] = "Hoteis/updateView/$1";
$route['editar-perfil/(:num)/(:num)'] = "Hoteis/updateView/$1/$2";

// Routes de cadastro de quartos
$route['novo-quarto'] = "Quartos/createView";

// Routes para editar quarto
$route['editar-quarto/(:num)'] = "Quartos/updateView/$1";

// Routes para eleminar quarto
$route['excluir-quarto/(:num)'] = "Quartos/delete/$1";

// Routes para buscar quartos/quarto
$route['quartos'] = "Quartos";
$route['quartos/(:num)'] = "Quatos/index/$1";
$route['filtra-quartos'] = "Quartos/filtraQuartos";
$route['filtra-quartos/(:num)'] = "Quartos/filtraQuartos/$1";
$route['quarto/(:num)'] = "Quartos/quarto/$1";
