<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

$route['default_controller'] = "site";
$route['scaffolding_trigger'] = "";

//staticke stranky
$route['([a-zA-Z0-9\-]+)'] = "site/index/$1";

//downloady
$route['download'] = "site/download";
$route['download/([a-zA-Z0-9\-\.]+)'] = "site/download/$1";

//admin
$route['admin'] = "admin/page";
$route['admin/logout'] = "admin/page/logout";

//novinky a aktivity
$route['aktuality'] = "site/articles/1";
$route['aktuality/([0-9]+)'] = "site/articles/1/$1";
$route['aktivity'] = "site/articles/2";
$route['aktivity/([0-9]+)'] = "site/articles/2/$1";
$route['clanky/([a-zA-Z0-9\-]+)'] = "site/article/$1";

//otazky
$route['otazky'] = "site/questions";


/* End of file routes.php */
/* Location: ./system/application/config/routes.php */