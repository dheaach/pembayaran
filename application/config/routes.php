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

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['overview'] = 'admin/overview';
$route['overview/(:any)'] = 'admin/overview/$1';
$route['transaction'] = 'admin/transaction';
$route['transaction/(:any)'] = 'admin/transaction/$1';
$route['transaction/uploadImage/(:any)'] = 'admin/transaction/uploadImage/$1';
$route['transaction/upload/(:any)/(:any)'] = 'admin/transaction/upload/$1/$2';
$route['transaction-detail/(:any)'] = 'admin/transaction/detail/$1';
$route['profile'] = 'admin/profile';
$route['profile/(:any)'] = 'admin/profile/$1';
$route['login'] = 'login';
$route['login/(:any)'] = 'login/$1';
$route['database'] = 'login/database';
$route['config'] = 'login/db_config';
$route['connect'] = 'login/db_select';
// $route['database'] = 'database';
// $route['rewrite'] = 'database/rewrite_config';
$route['action'] = 'login/aksi_login';
// $route['config'] = 'database/configure_database';
$route['logout'] = 'login/logout';
$route['detail-invoice/(:any)/(:any)'] = 'admin/transaction/detail_invoice/$1/$2';
$route['transaction/search'] = 'admin/transaction/search';
$route['setting'] = 'admin/setting';
$route['setting/(:any)'] = 'admin/setting/$1';
$route['notifikasi'] = 'admin/notifikasi';
$route['notifikasi/detail/(:any)/(:any)'] = 'admin/transaction/notif_detail/$1/$2';
$route['notifikasi/search'] = 'admin/notifikasi/search';

