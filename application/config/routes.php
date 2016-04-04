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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'C_Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
| ------------------------------
| URL -> ADMIN 
| ------------------------------
*/
$route['admin']					= 'admin/C_Admin';
$route['admin/login']			= 'admin/C_Login';
$route['admin/signIn']			= 'admin/C_Login/signIn';
$route['admin/signOut']			= 'admin/C_Login/signOut';

/*
| ------------------------------
| URL -> MAIN API-REST
| ------------------------------
*/
$route['api-rest/geo-data/getRegionsByCountry']	        = 'api-rest/C_GEO_Data/ajaxGetRegionsByCountry';
$route['api-rest/geo-data/getCitiesByRegionAndCountry']	= 'api-rest/C_GEO_Data/ajaxGetCitiesByRegionAndCountry';

/*
| ------------------------------
| URL -> ADMIN - EMPRESA 
| ------------------------------
*/
$route['admin/empresa']                         = 'admin/module/empresa/C_Admin_Empresa/index';
$route['admin/empresa/agregar']                 = 'admin/module/empresa/C_Admin_Empresa/agregar';
$route['admin/empresa/crear']                   = 'admin/module/empresa/C_Admin_Empresa/insert';
$route['admin/empresa/editar']                  = 'admin/module/empresa/C_Admin_Empresa/update';
$route['admin/empresa/(:num)']                  = "admin/module/empresa/C_Admin_Empresa/edit/$1";
$route['admin/empresa/delete']                  = 'admin/module/empresa/C_Admin_Empresa/delete';
$route['admin/empresa/page']                    = 'admin/module/empresa/C_Admin_Empresa';
$route['admin/empresa/page/(:num)']             = 'admin/module/empresa/C_Admin_Empresa';
$route['admin/empresa/ajax/generatePassword']   = 'admin/module/empresa/C_Admin_Empresa/ajaxGeneratePassword';

/*
| ------------------------------
| URL -> ADMIN - TIPO EMPRESA 
| ------------------------------
*/
$route['admin/tipo-empresa']				= 'admin/module/tipoempresa/C_Admin_TipoEmpresa/index';
$route['admin/tipo-empresa/agregar']		= 'admin/module/tipoempresa/C_Admin_TipoEmpresa/agregar';
$route['admin/tipo-empresa/crear']		    = 'admin/module/tipoempresa/C_Admin_TipoEmpresa/insert';
$route['admin/tipo-empresa/editar']		    = 'admin/module/tipoempresa/C_Admin_TipoEmpresa/update';
$route['admin/tipo-empresa/(:num)']  	    = "admin/module/tipoempresa/C_Admin_TipoEmpresa/edit/$1";
$route['admin/tipo-empresa/delete']	        = 'admin/module/tipoempresa/C_Admin_TipoEmpresa/delete';
$route['admin/tipo-empresa/page']		    = 'admin/module/tipoempresa/C_Admin_TipoEmpresa';
$route['admin/tipo-empresa/page/(:num)']	= 'admin/module/tipoempresa/C_Admin_TipoEmpresa';

/*
| ------------------------------
| URL -> ADMIN - TIPO EMPRESA
| ------------------------------
*/
$route['admin/paquetes-tmo']				= 'admin/module/paquetes-tmo/C_Admin_Paquetes_TMO/index';
$route['admin/paquetes-tmo/agregar']		= 'admin/module/paquetes-tmo/C_Admin_Paquetes_TMO/agregar';
$route['admin/paquetes-tmo/crear']		    = 'admin/module/paquetes-tmo/C_Admin_Paquetes_TMO/insert';
$route['admin/paquetes-tmo/editar']		    = 'admin/module/paquetes-tmo/C_Admin_Paquetes_TMO/update';
$route['admin/paquetes-tmo/(:num)']  	    = "admin/module/paquetes-tmo/C_Admin_Paquetes_TMO/edit/$1";
$route['admin/paquetes-tmo/delete']         = 'admin/module/paquetes-tmo/C_Admin_Paquetes_TMO/delete';
$route['admin/paquetes-tmo/page']           = 'admin/module/paquetes-tmo/C_Admin_Paquetes_TMO';
$route['admin/paquetes-tmo/page/(:num)']    = 'admin/module/paquetes-tmo/C_Admin_Paquetes_TMO';

/*
| ------------------------------
| URL -> ADMIN - USUARIO
| ------------------------------
*/
$route['admin/usuario-store']               = 'admin/module/usuario/C_Admin_Usuario';
$route['admin/usuario-store/page']          = 'admin/module/usuario/C_Admin_Usuario';
$route['admin/usuario-store/page/(:num)']   = 'admin/module/usuario/C_Admin_Usuario';

/*
| ------------------------------
| URL -> ADMIN - PERFIL 
| ------------------------------
*/
$route['admin/perfil']				              = 'admin/module/perfil/C_Admin_Perfil';
$route['admin/perfil/actualizar-perfil-usuario']  = 'admin/module/perfil/C_Admin_Perfil/updatePerfil';
$route['admin/perfil/actualizar-cuenta-usuario']  = 'admin/module/perfil/C_Admin_Perfil/updateCuentaUsuario';

/*
| ------------------------------
| URL -> COMPANY ADMIN
| ------------------------------
*/
$route['company/(:num)/admin']	     = 'company-admin/C_CompanyAdmin';
$route['company/(:num)/admin/login'] = 'admin/C_Login';

/*
| ------------------------------
| URL -> COMPANY ADMIN - PERFIL EMPRESA
| ------------------------------
*/
$route['company/(:num)/admin/company-profile']                          = 'company-admin/perfil-empresa/C_CompanyAdmin_Perfil_Empresa';
$route['company/(:num)/admin/company-profile/ajax/updateLogoEmpresa']   = 'company-admin/perfil-empresa/C_CompanyAdmin_Perfil_Empresa/ajaxUpdateLogoCompany';
$route['company/(:num)/admin/company-profile/ajax/updateDataCompany']   = 'company-admin/perfil-empresa/C_CompanyAdmin_Perfil_Empresa/ajaxUpdateDataCompany';

/*
| ------------------------------
| URL -> COMPANY ADMIN - STORE
| ------------------------------
*/
$route['company/(:num)/admin/store']                = 'company-admin/store/C_CompanyAdmin_Store';
$route['company/(:num)/admin/store/page']		    = 'company-admin/store/C_CompanyAdmin_Store';
$route['company/(:num)/admin/store/page/(:num)']	= 'company-admin/store/C_CompanyAdmin_Store';
$route['company/(:num)/admin/store/add']	        = 'company-admin/store/C_CompanyAdmin_Store/addStore';
$route['company/(:num)/admin/store/edit/(:num)']    = 'company-admin/store/C_CompanyAdmin_Store/editStore/$2';
$route['company/(:num)/admin/store/ajax/addStore']  = 'company-admin/store/C_CompanyAdmin_Store/ajaxAddStore';
$route['company/(:num)/admin/store/ajax/editStore'] = 'company-admin/store/C_CompanyAdmin_Store/ajaxEditStore';

/*
| ------------------------------
| URL -> COMPANY ADMIN - PRODUCTS
| ------------------------------
*/
$route['company/(:num)/admin/product']                              = 'company-admin/product/C_CompanyAdmin_Product';
$route['company/(:num)/admin/product/page']                         = 'company-admin/product/C_CompanyAdmin_Product';
$route['company/(:num)/admin/product/page/(:num)']                  = 'company-admin/product/C_CompanyAdmin_Product';
$route['company/(:num)/admin/product/add']                          = 'company-admin/product/C_CompanyAdmin_Product/addProduct';
$route['company/(:num)/admin/product/edit/(:num)']                  = 'company-admin/product/C_CompanyAdmin_Product/editProduct/$2';
$route['company/(:num)/admin/product/ajax/addProduct']              = 'company-admin/product/C_CompanyAdmin_Product/ajaxAddProduct';
$route['company/(:num)/admin/product/ajax/editProduct']             = 'company-admin/product/C_CompanyAdmin_Product/ajaxEditProduct';
$route['company/(:num)/admin/product/ajax/deleteImageProduct']      = 'company-admin/product/C_CompanyAdmin_Product/ajaxDeleteImageProduct';
$route['company/(:num)/admin/product/ajax/deleteModifierProduct']   = 'company-admin/product/C_CompanyAdmin_Product/ajaxDeleteModifierProduct';

/*
| ------------------------------
| URL -> COMPANY ADMIN - PROMOTIONS
| ------------------------------
*/
$route['company/(:num)/admin/promotion']                                = 'company-admin/promotion/C_CompanyAdmin_Promotion';
$route['company/(:num)/admin/promotion/page']                           = 'company-admin/promotion/C_CompanyAdmin_Promotion';
$route['company/(:num)/admin/promotion/page/(:num)']                    = 'company-admin/promotion/C_CompanyAdmin_Promotion';
$route['company/(:num)/admin/promotion/add']                            = 'company-admin/promotion/C_CompanyAdmin_Promotion/addPromotion';
$route['company/(:num)/admin/promotion/edit/(:num)']                    = 'company-admin/promotion/C_CompanyAdmin_Promotion/editPromotion/$2';
$route['company/(:num)/admin/promotion/ajax/addPromotion']              = 'company-admin/promotion/C_CompanyAdmin_Promotion/ajaxAddPromotion';
$route['company/(:num)/admin/promotion/ajax/editPromotion']               = 'company-admin/promotion/C_CompanyAdmin_Promotion/ajaxEditPromotion';
$route['company/(:num)/admin/promotion/ajax/deletePromotion']           = 'company-admin/promotion/C_CompanyAdmin_Promotion/ajaxDeletePromotion';

/*
| ------------------------------
| URL -> COMPANY ADMIN - USER
| ------------------------------
*/
$route['company/(:num)/admin/user']                         = 'company-admin/user/C_CompanyAdmin_User';
$route['company/(:num)/admin/user/page']		            = 'company-admin/user/C_CompanyAdmin_User';
$route['company/(:num)/admin/user/page/(:num)']	            = 'company-admin/user/C_CompanyAdmin_User';
$route['company/(:num)/admin/user/add']	                    = 'company-admin/user/C_CompanyAdmin_User/addUser';
$route['company/(:num)/admin/user/edit/(:num)']	            = 'company-admin/user/C_CompanyAdmin_User/editUser/$2';
$route['company/(:num)/admin/user/ajax/addUser']            = 'company-admin/user/C_CompanyAdmin_User/ajaxAddUser';
$route['company/(:num)/admin/user/ajax/editUser']           = 'company-admin/user/C_CompanyAdmin_User/ajaxEditUser';
$route['company/(:num)/admin/user/ajax/generatePassword']   = 'company-admin/user/C_CompanyAdmin_User/ajaxGeneratePassword';

/*
| ------------------------------
| URL -> COMPANY ADMIN - PRODUCTOS CATEGORY
| ------------------------------
*/
$route['company/(:num)/admin/category']                             = 'company-admin/categorias/C_CompanyAdmin_Categorias/listAllCategories';
$route['company/(:num)/admin/category/view/(:num)']                 = 'company-admin/categorias/C_CompanyAdmin_Categorias/listSubCategoriesByCategory/$2';
$route['company/(:num)/admin/category/add']                         = 'company-admin/categorias/C_CompanyAdmin_Categorias/addCategory';
$route['company/(:num)/admin/category/edit/(:num)']                 = 'company-admin/categorias/C_CompanyAdmin_Categorias/editCategory/$2';
$route['company/(:num)/admin/category/ajax/addCategory']            = 'company-admin/categorias/C_CompanyAdmin_Categorias/ajaxAddCategory';
$route['company/(:num)/admin/category/ajax/editCategory']           = 'company-admin/categorias/C_CompanyAdmin_Categorias/ajaxEditCategory';
$route['company/(:num)/admin/category/ajax/deleteCategory']         = 'company-admin/categorias/C_CompanyAdmin_Categorias/ajaxDeleteCategory';
$route['company/(:num)/admin/category/ajax/updateImageCategory']    = 'company-admin/categorias/C_CompanyAdmin_Categorias/ajaxUpdateImageCategory';

/*
| ------------------------------
| URL -> STORE
| ------------------------------
*/
$route['company/(:num)/store/(:num)']                           = 'store/C_Store_Home';
$route['company/(:num)/store/(:num)/products/(:num)']           = 'store/C_Store_Product/viewProduct/$3';
$route['company/(:num)/store/(:num)/search']                    = 'store/C_Store_Search';
$route['company/(:num)/store/(:num)/account']                   = 'store/C_Store_Account';
$route['company/(:num)/store/(:num)/account/account-settings']  = 'store/C_Store_Account/accountSettings';
$route['company/(:num)/store/(:num)/account/contact-us']        = 'store/C_Store_Account/contactUs';
$route['company/(:num)/store/(:num)/account/my-orders']         = 'store/C_Store_Account/myOrders';
$route['company/(:num)/store/(:num)/signin']                    = 'store/C_Store_Sign_In';
$route['company/(:num)/store/(:num)/signout']                   = 'store/C_Store_Sign_In/signOut';
$route['company/(:num)/store/(:num)/forgotpassword']            = 'store/C_Store_Sign_In/forgotPassword';
$route['company/(:num)/store/(:num)/register']                  = 'store/C_Store_Register';
$route['company/(:num)/store/(:num)/ajax/registerClient']       = 'store/C_Store_Register/ajaxRegister';
$route['company/(:num)/store/(:num)/ajax/signIn']               = 'store/C_Store_Sign_In/ajaxSignIn';
$route['company/(:num)/store/(:num)/ajax/forgotPassword']       = 'store/C_Store_Sign_In/ajaxForgotPassword';

//$route['company/(:num)/store/(:num)/products/(:num)/tags/(:num)']                                   = 'store/C_Store_Product/viewProduct/$3.$4';
//$route['company/(:num)/store/(:num)/products/(:num)/tags/(:num).(:num)']                            = 'store/C_Store_Product/viewProduct/$3.$4.$5';
//$route['company/(:num)/store/(:num)/products/(:num)/tags/(:num).(:num).(:num)']                     = 'store/C_Store_Product/viewProduct/$3.$4.$5.$6';
//$route['company/(:num)/store/(:num)/products/(:num)/tags/(:num).(:num).(:num).(:num)']              = 'store/C_Store_Product/viewProduct/$3.$4.$5.$6.$7';
//$route['company/(:num)/store/(:num)/products/(:num)/tags/(:num).(:num).(:num).(:num).(:num)']       = 'store/C_Store_Product/viewProduct/$3.$4.$5.$6.$7.$8';


// url para soportar el anidamiento de las subcategorias
$route['company/(:num)/store/(:num)/categories/(:num)']                             = 'store/C_Store_Home/viewSubCategorias/$3';
$route['company/(:num)/store/(:num)/categories/(:num).(:num)']                      = 'store/C_Store_Home/viewSubCategorias/$3.$4';
$route['company/(:num)/store/(:num)/categories/(:num).(:num).(:num)']               = 'store/C_Store_Home/viewSubCategorias/$3.$4.$5';
$route['company/(:num)/store/(:num)/categories/(:num).(:num).(:num).(:num)']        = 'store/C_Store_Home/viewSubCategorias/$3.$4.$5.$6';
$route['company/(:num)/store/(:num)/categories/(:num).(:num).(:num).(:num).(:num)'] = 'store/C_Store_Home/viewSubCategorias/$3.$4.$5.$6.$7';

/*
| ------------------------------
| URL -> CART
| ------------------------------
*/

$route['company/(:num)/store/(:num)/cart']                          = 'store/C_Store_Cart';
$route['company/(:num)/store/(:num)/cart/payment-method']           = 'store/C_Store_Cart/addPaymentMethod';
$route['company/(:num)/store/(:num)/ajax/checkout']                 = 'store/C_Store_Checkout/ajaxCheckout';
$route['company/(:num)/store/(:num)/ajax/shopping/add']             = 'store/C_Store_Cart/addCart';
$route['company/(:num)/store/(:num)/ajax/shopping/update']          = 'store/C_Store_Cart/updateCart';
$route['company/(:num)/store/(:num)/ajax/shopping/delete']          = 'store/C_Store_Cart/deleteitemCart';

/*
| ------------------------------
| URL -> PROMOTIONS
| ------------------------------
*/
$route['company/(:num)/store/(:num)/promotions']                                    = 'store/C_Store_Home/promotions';
$route['company/(:num)/store/(:num)/promotions/(:num)']                             = 'store/C_Store_Product/viewProductPromotions/$3';
$route['company/(:num)/store/(:num)/promotions/(:num)']                             = 'store/C_Store_Home/viewSubCategoriasPromotions/$3';
$route['company/(:num)/store/(:num)/promotions/(:num).(:num)']                      = 'store/C_Store_Home/viewSubCategoriasPromotions/$3.$4';
$route['company/(:num)/store/(:num)/promotions/(:num).(:num).(:num)']               = 'store/C_Store_Home/viewSubCategoriasPromotions/$3.$4.$5';
$route['company/(:num)/store/(:num)/promotions/(:num).(:num).(:num).(:num)']        = 'store/C_Store_Home/viewSubCategoriasPromotions/$3.$4.$5.$6';
$route['company/(:num)/store/(:num)/promotions/(:num).(:num).(:num).(:num).(:num)'] = 'store/C_Store_Home/viewSubCategoriasPromotions/$3.$4.$5.$6.$7';

/*
| ------------------------------
| URL -> NOT FOUND PAGE
| ------------------------------
*/
$route['not-found/store']   = 'C_Not_Found/store';
$route['not-found/company'] = 'C_Not_Found/company';
$route['forbidden-access']  = 'C_Forbidden_Access';