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
|	https://codeigniter.com/userguide3/general/routing.html
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
//$route['default_controller/:num'] = 'home_controller/$1';
$route['default_controller'] = 'home_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['searchProducts/(:any)'] = 'home_controller/searchProducts/$1';
$route['searchProduct/(:any)/(:num)'] = 'home_controller/searchProducts/$1/$2';

$route['page'] = 'home_controller';
$route['page/(:num)'] = 'home_controller/index/$1';

// backend
$route['login_admin'] = 'backend/LoginController';
$route['loginProcess'] = 'backend/LoginController/loginProcess';
$route['dashboard'] = 'backend/DashboardController';
$route['logout'] = 'backend/DashboardController/logout';

$route['productList'] = 'backend/ProductListController';
$route['productList/page'] = 'backend/ProductListController';
$route['productList/page/(:num)'] = 'backend/ProductListController';
$route['productDelete'] = "backend/ProductListController/productDelete";
$route['singleProduct'] = "backend/ProductListController/singleProduct";
$route['editProduct'] = "backend/ProductListController/editProduct";
$route['addNewProduct'] = "backend/ProductListController/addNewProduct";
$route['uploadCSVFile'] = "backend/ProductListController/uploadCSVFile";

$route['orderList'] = 'backend/OrderListController';
$route['orderDelete'] = 'backend/OrderListController/orderDelete';
$route['orderChangeStatus'] = 'backend/OrderListController/orderChangeStatus';
$route['viewInvoice/(:num)'] = 'backend/OrderListController/viewInvoice/$1';

$route['orderedProductList'] = 'backend/OrderedProductListController';

$route['contactMessage'] = 'backend/ContactController';
// frontend

$route['placeOrder'] = 'frontend/PlaceOrderController';
$route['order'] = 'frontend/PlaceOrderController/order';
$route['shippingInfo'] = 'frontend/PlaceOrderController/shippingInfo';
$route['billingInfo'] = 'frontend/PlaceOrderController/billingInfo';

$route['checkOutCheck'] = 'Cart_controller/checkOutCheck';

$route['login'] = 'frontend/LoginController';
$route['loginClient'] = 'frontend/LoginController/loginClient';

$route['signUp'] = 'frontend/RegistrationController';
$route['registrationProcess'] = 'frontend/RegistrationController/registrationProcess';

$route['profile'] = 'frontend/ProfileController';
$route['clientLogout'] = 'frontend/ProfileController/clientLogout';
$route['changeProfileInfo'] = 'frontend/ProfileController/changeProfileInfo';
$route['changePassword'] = 'frontend/ProfileController/changePassword';

$route['myOrder'] = 'frontend/MyOrderController';
$route['cancelClientOrder'] = 'frontend/MyOrderController/cancelClientOrder';
$route['invoice/(:num)'] = 'frontend/MyOrderController/viewClientInvoice/$1';
$route['pdfDownload/(:num)'] = 'frontend/MyOrderController/pdfDownload/$1';

$route['contactUs'] = 'frontend/contact_us_frontend';
$route['contactUsMessage'] = 'frontend/contact_us_frontend/sendMessage';


