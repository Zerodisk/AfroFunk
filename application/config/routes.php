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
|	example.com/class/method/id/
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';

//route category to home
$route['[C,c]ategory'] = "home";

//product and category by primary key
$route['[P,p]roduct/(:any)']   = "product/view/$1";
$route['[P,p]roducts/(:any)']  = "product/view/$1";
$route['[C,c]ategory/(:num)']  = "category/view/$1";
$route['[C,c]ategories/(:num)']  = "category/view/$1";

//category boy/boys/men/man
$route['[C,c]ategory/[B,b]oys']   = "category/view/2";
$route['[C,c]ategory/[B,b]oy']    = "category/view/2";
$route['[C,c]ategory/[M,m]en']    = "category/view/2";
$route['[C,c]ategory/[M,m]an']    = "category/view/2";

//category girl/girls/woman/women
$route['[C,c]ategory/[G,g]irls']  = "category/view/1";
$route['[C,c]ategory/[G,g]irl']   = "category/view/1";
$route['[C,c]ategory/[W,w]oman']  = "category/view/1";
$route['[C,c]ategory/[W,w]omen']  = "category/view/1";

//category accessory/accessories
$route['[C,c]ategory/[A,a]ccessories']  = "category/view/3";
$route['[C,c]ategory/[A,a]ccessory']    = "category/view/3";

$route['[C,c]ategory/[B,b]oys/(:any)']   	   = "product/view/$1";
$route['[C,c]ategory/[G,g]irls/(:any)']  	   = "product/view/$1";
$route['[C,c]ategory/[A,a]ccessories/(:any)']  = "product/view/$1";


/*
 * start rounting for admin area
 */
$route['[A,a]dmin'] = 				"admin/home";
$route['[A,a]dmin/logout'] = 		"admin/sessions/logout";
$route['[A,a]dmin/login'] = 		"admin/sessions/login";
$route['[A,a]dmin/login/(:any)'] = 	"admin/sessions/login/$1";








/* End of file routes.php */
/* Location: ./application/config/routes.php */