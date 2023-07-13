    <?php
    defined('BASEPATH') or exit('No direct script access allowed');

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

    $route['default_controller'] = 'site';
    $route['404_override'] = '';
    $route['translate_uri_dashes'] = FALSE;


    $route['registrate'] = 'site/register';
    $route['registrarse'] = 'site/insert_register';
    $route['reenviar-correo'] = 'site/resend_mail';
    $route['reception/(:any)'] = 'site/reception/$1';
    $route['confirmar-cuenta/(:any)'] = 'site/check_mail/$1';
    $route['iniciar-sesion'] = 'site/login';
    $route['autenticacion/(:any)'] = 'site/authentication/$1';
    $route['cerrar-session'] = 'site/logout';
    $route['login/(:any)'] = 'site/login/$1';
    $route['token/(:any)'] = 'site/token/$1';



    /* Router dashboard */
    $route['mi-perfil'] = 'admin/dashboard/profile';
    $route['configuracion'] = 'admin/dashboard/config';

    /*
    /RUTAS DACE
*/

    $route['admin'] = 'admin/dashboard';
    $route['formulario-DACE'] = 'admin/dace/formDace';
    $route['guardar-dace'] = 'admin/dace/addForm';
    $route['pdf-dace/(:any)'] = 'admin/dace/pdf_dace/$1';
    $route['lista-DACE'] = 'admin/dace/list';
    $route['editar-DACE/(:any)'] = 'admin/dace/editForm/$1';

    /*
    /RUTAS DAS
*/

    $route['Das/universidad'] = 'admin/das/university';
    $route['guardar-registro-universidad'] = 'admin/das/addUniversity';
    $route['das/pdf-universidad/(:any)'] = 'admin/das/pdf_university/$1';
    $route['das/editar-solicitud/(:any)'] = 'admin/das/editUniversity/$1';
    $route['editar-solicitud-universidad'] = 'admin/das/editUni';
    $route['eliminar-solicitud-universidad'] = 'admin/das/deleteUni';


    $route['Das/Instituto'] = 'admin/das/institute';
    $route['guardar-registro-instituto'] = 'admin/das/addInstitute';
    $route['das/pdf-instituto/(:any)'] = 'admin/das/pdf_institute/$1';
    $route['editar-solicitud-instituto'] = 'admin/das/editIns';
    $route['das/editar-solicitud-instituto/(:any)'] = 'admin/das/editInstituto/$1';
    $route['eliminar-solicitud-instituto'] = 'admin/das/deleteIns';


    $route['Das/Britanico'] = 'admin/das/britanico';
    $route['guardar-registro-britanico'] = 'admin/das/addBritanico';
    $route['das/pdf-britanico/(:any)'] = 'admin/das/pdf_britanico/$1';
    $route['das/editar-solicitud-britanico/(:any)'] = 'admin/das/editBritanico/$1';
    $route['editar-solicitud-britanico'] = 'admin/das/editBri';
    $route['eliminar-solicitud-britanico'] = 'admin/das/deleteBri';

    /*
    /ROUTES CGI
*/
    $route['admin/datos-adicionales-cgi'] = 'admin/cgi';
    /*
    /ROUTES BE
*/

    $route['be/admin'] = 'be/dashboard';
    $route['be/usuarios'] = 'be/users';
    $route['be/resolucion/(:any)'] = 'be/dashboard/resolution/$1';
    $route['email'] = 'be/dashboard/example';
    $route['be/departamentos'] = 'be/team';
    $route['be/mi-equipo'] = 'be/team/solo';
    $route['be/secciones'] = 'be/team/indexOffice';
    $route['be/oficinas'] = 'be/office';



    /*
    /ROUTES BE CORRESPONDENCE
*/

    $route['be/correspondecias-recibidas'] = 'be/correspondence/received';
    $route['be/correspondecias-remitidas'] = 'be/correspondence/forwarded';
    $route['be/archivos-adjuntos'] = 'be/correspondence/driveFrwrd';
    $route['be/archivos-adjuntos-recibido'] = 'be/correspondence/driveRcvd';
    $route['be/descargar'] = 'be/correspondence/donwload';
    $route['be/ver-decreto/(:any)'] = 'be/correspondence/viewPDFDecree/$1';

    /*
    /ROUTES BE ORDERS
*/
    $route['be/ordenes-de-servicio'] = 'be/orders/orders';
    $route['be/inspeciones-tecnicas'] = 'be/orders/inspection';

    /*
    /ROUTES BE ORDERS
*/
    $route['be/datos-adicionales-personal-civil'] = 'be/staff/formStaff';
    $route['be/lista-personal-civil'] = 'be/staff';
    $route['be/editar-personal-civil/(:any)'] = 'be/staff/edit_personal/$1';
    $route['be/perfil-personal/(:any)'] = 'be/staff/single_personal/$1';

    /*
    KOREKENKE
*/
    $route['Consulta'] = 'korekenke/consulta';
    $route['enviar-consulta'] = 'korekenke/consulta/enviar';
