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
$route['default_controller'] = 'web/login';
$route['404_override'] = 'web/error_not_found';
$route['dashboard']    = 'users/index';
$route['cabang']    = 'cabang/index';
$route['jamaah']    = 'jamaah/index';
$route['agen_presdir']    = 'agen_presdir/index';
$route['agen_dir_mujahid']    = 'agen_dir_mujahid/index';
$route['agen_man_mujahid']    = 'agen_man_mujahid/index';
$route['agen_bait_mujahid']    = 'agen_bait_mujahid/index';
$route['daftar']    = 'daftar/index';
$route['pendaftar']    = 'pendaftar/index';
$route['page']         = 'users/index';
// $route['page/(:any)']  = 'web/index/$1';
// $route['page/pengurus/(:any)']  = 'web/pengurus/$1';
$route['index']        = 'users/index';
$route['profile']      = 'users/profile';
$route['update_pass']      = 'users/update_pass';
// $route['download']     = 'web/download';
// $route['kontak']       = 'web/kontak';
$route['translate_uri_dashes'] = FALSE;
