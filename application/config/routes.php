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
| URL -> ADMIN - EMPRESA 
| ------------------------------
*/
$route['admin/empresa']				= 'admin/module/empresa/C_Admin_Empresa/index';
$route['admin/empresa/agregar']		= 'admin/module/empresa/C_Admin_Empresa/agregar';
$route['admin/empresa/crear']		= 'admin/module/empresa/C_Admin_Empresa/insert';
$route['admin/empresa/editar']		= 'admin/module/empresa/C_Admin_Empresa/update';
$route['admin/empresa/(:num)']  	= "admin/module/empresa/C_Admin_Empresa/edit/$1";
$route['admin/empresa/eliminar']	= 'admin/module/empresa/C_Admin_Empresa/delete';
$route['admin/empresa/page']		= 'admin/module/empresa/C_Admin_Empresa';
$route['admin/empresa/page/(:num)']	= 'admin/module/empresa/C_Admin_Empresa';

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
$route['admin/tipoempresa/delete']	= 'admin/module/tipoempresa/C_Admin_TipoEmpresa/delete';
$route['admin/tipoempresa/page']		= 'admin/module/tipoempresa/C_Admin_TipoEmpresa';
$route['admin/tipoempresa/page/(:num)']	= 'admin/module/tipoempresa/C_Admin_TipoEmpresa';

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
| URL -> STORE ADMIN 
| ------------------------------
*/
$route['store/(:num)/admin']	   = 'store-admin/C_StoreAdmin';
$route['store/(:num)/admin/login'] = 'admin/C_Login';
// $route['store/signIn']			   = 'store-admin/C_Login/signIn';
// $route['store/signOut']			   = 'store-admin/C_Login/signOut';


/*
| ------------------------------
| URL -> STORE ADMIN - PERFIL EMPRESA
| ------------------------------
*/
$route['store/(:num)/admin']	                            = 'store-admin/C_StoreAdmin';
$route['store/(:num)/admin/login']                          = 'admin/C_Login';
$route['store/(:num)/admin/perfil-store']                   = 'store-admin/module/empresa/C_StoreAdmin_Empresa';
$route['store/(:num)/admin/perfil-store/updatePerfilStore'] = 'store-admin/module/empresa/C_StoreAdmin_Empresa/updateDatosStore';
$route['store/(:num)/admin/perfil-store/updatePayAccount']  = 'store-admin/module/empresa/C_StoreAdmin_Empresa/updateDatosPayAccount';
$route['store/(:num)/admin/perfil-store/updateLogoStore']   = 'store-admin/module/empresa/C_StoreAdmin_Empresa/updateLogoStore';


/*
| ------------------------------
| URL -> STORE ADMIN - PRODUCTOS CATEGORY
| ------------------------------
*/
$route['store/(:num)/admin/categorys']                      = 'store-admin/module/categorias/C_StoreAdmin_Categorias/listAllCategories';
$route['store/(:num)/admin/categorys/view/(:num)']          = 'store-admin/module/categorias/C_StoreAdmin_Categorias/listSubCategoriesByCategory/$2';
$route['store/(:num)/admin/categorys/add']                  = 'store-admin/module/categorias/C_StoreAdmin_Categorias/addCategory';
$route['store/(:num)/admin/categorys/edit/(:num)']          = 'store-admin/module/categorias/C_StoreAdmin_Categorias/editCategory/$1';
$route['store/(:num)/admin/categorys/ajax/addCategory']     = 'store-admin/module/categorias/C_StoreAdmin_Categorias/ajaxAddCategory';
$route['store/(:num)/admin/categorys/ajax/deleteCategory']  = 'store-admin/module/categorias/C_StoreAdmin_Categorias/ajaxDeleteCategory';


/*
| ------------------------------
| URL -> NOT FOUND PAGE
| ------------------------------
*/
$route['not-found/store'] = 'C_Not_Found/store';
$route['forbidden-access'] = 'C_Forbidden_Access';