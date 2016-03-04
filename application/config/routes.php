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
$route['api-rest/geo-data/getRegionsByCountry']	= 'api-rest/C_GEO_Data/ajaxGetRegionsByCountry';
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
$route['admin/tipoempresa']				= 'admin/module/tipoempresa/C_Admin_TipoEmpresa/index';
$route['admin/tipoempresa/agregar']		= 'admin/module/tipoempresa/C_Admin_TipoEmpresa/agregar';
$route['admin/tipoempresa/crear']		= 'admin/module/tipoempresa/C_Admin_TipoEmpresa/insert';
$route['admin/tipoempresa/editar']		= 'admin/module/tipoempresa/C_Admin_TipoEmpresa/update';
$route['admin/tipoempresa/(:num)']  	= "admin/module/tipoempresa/C_Admin_TipoEmpresa/edit/$1";
$route['admin/tipoempresa/delete']	    = 'admin/module/tipoempresa/C_Admin_TipoEmpresa/delete';
$route['admin/tipoempresa/page']		= 'admin/module/tipoempresa/C_Admin_TipoEmpresa';
$route['admin/tipoempresa/page/(:num)']	= 'admin/module/tipoempresa/C_Admin_TipoEmpresa';

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
$route['company/(:num)/admin/product']                  = 'company-admin/product/C_CompanyAdmin_Product';
$route['company/(:num)/admin/product/page']             = 'company-admin/product/C_CompanyAdmin_Product';
$route['company/(:num)/admin/product/page/(:num)']      = 'company-admin/product/C_CompanyAdmin_Product';
$route['company/(:num)/admin/product/add']              = 'company-admin/product/C_CompanyAdmin_Product/addProduct';
$route['company/(:num)/admin/product/edit/(:num)']      = 'company-admin/product/C_CompanyAdmin_Product/editProduct/$2';
$route['company/(:num)/admin/product/ajax/addProduct']  = 'company-admin/product/C_CompanyAdmin_Product/ajaxAddProduct';
$route['company/(:num)/admin/product/ajax/editProduct'] = 'company-admin/product/C_CompanyAdmin_Product/ajaxEditProduct';

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
$route['company/(:num)/admin/category']                      = 'company-admin/module/categorias/C_CompanyAdmin_Categorias/listAllCategories';
$route['company/(:num)/admin/category/view/(:num)']          = 'company-admin/module/categorias/C_CompanyAdmin_Categorias/listSubCategoriesByCategory/$2';
$route['company/(:num)/admin/category/add']                  = 'company-admin/module/categorias/C_CompanyAdmin_Categorias/addCategory';
$route['company/(:num)/admin/category/edit/(:num)']          = 'company-admin/module/categorias/C_CompanyAdmin_Categorias/editCategory/$2';
$route['company/(:num)/admin/category/ajax/addCategory']     = 'company-admin/module/categorias/C_CompanyAdmin_Categorias/ajaxAddCategory';
$route['company/(:num)/admin/category/ajax/editCategory']    = 'company-admin/module/categorias/C_CompanyAdmin_Categorias/ajaxEditCategory';
$route['company/(:num)/admin/category/ajax/deleteCategory']  = 'company-admin/module/categorias/C_CompanyAdmin_Categorias/ajaxDeleteCategory';

/*
| ------------------------------
| URL -> STORE ADMIN
| ------------------------------
*/
$route['store/(:num)/admin']	   = 'company-admin/C_StoreAdmin';
$route['store/(:num)/admin/login'] = 'admin/C_Login';
// $route['store/signIn']			   = 'company-admin/C_Login/signIn';
// $route['store/signOut']			   = 'company-admin/C_Login/signOut';

/*
| ------------------------------
| URL -> STORE ADMIN - PERFIL EMPRESA
| ------------------------------
*/
$route['store/(:num)/admin/perfil-store']                   = 'company-admin/module/empresa/C_StoreAdmin_Empresa';
$route['store/(:num)/admin/perfil-store/updatePerfilStore'] = 'company-admin/module/empresa/C_StoreAdmin_Empresa/updateDatosStore';
$route['store/(:num)/admin/perfil-store/updatePayAccount']  = 'company-admin/module/empresa/C_StoreAdmin_Empresa/updateDatosPayAccount';
$route['store/(:num)/admin/perfil-store/updateLogoStore']   = 'company-admin/module/empresa/C_StoreAdmin_Empresa/updateLogoStore';



/*
| ------------------------------
| URL -> STORE ADMIN - PERFIL USUARIO
| ------------------------------
*/
$route['store/(:num)/admin/user-profile']                        = 'company-admin/module/perfil-usuario/C_StoreAdmin_Perfil_Usuario';
$route['store/(:num)/admin/user-profile/ajax/updateUserProfile'] = 'company-admin/module/perfil-usuario/C_StoreAdmin_Perfil_Usuario/ajaxUpdateUserProfile';
$route['store/(:num)/admin/user-profile/ajax/updateUserAccount'] = 'company-admin/module/perfil-usuario/C_StoreAdmin_Perfil_Usuario/ajaxUpdateUserAccount';

/*
| ------------------------------
| URL -> STORE ADMIN - PRODUCTOS
| ------------------------------
*/
$route['store/(:num)/admin/products']                       = 'company-admin/module/productos/C_StoreAdmin_Productos';
$route['store/(:num)/admin/products/page']                  = 'company-admin/module/productos/C_StoreAdmin_Productos';
$route['store/(:num)/admin/products/page/(:num)']           = 'company-admin/module/productos/C_StoreAdmin_Productos';
$route['store/(:num)/admin/products/add']                   = 'company-admin/module/productos/C_StoreAdmin_Productos/addProduct';
$route['store/(:num)/admin/products/edit/(:num)']           = 'company-admin/module/productos/C_StoreAdmin_Productos/editProduct/$2';
$route['store/(:num)/admin/products/ajax/addProduct']       = 'company-admin/module/productos/C_StoreAdmin_Productos/ajaxAddProduct';
$route['store/(:num)/admin/products/ajax/getSubCategorys']  = 'company-admin/module/productos/C_StoreAdmin_Productos/ajaxGetSubCategorysByIDCategory';

/*
| ------------------------------
| URL -> NOT FOUND PAGE
| ------------------------------
*/
$route['not-found/store'] = 'C_Not_Found/store';
$route['forbidden-access'] = 'C_Forbidden_Access';