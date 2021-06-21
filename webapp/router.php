<?php
/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 02-05-2016
 * Time: 11:18
 */
use ArmoredCore\Facades\Router;

/****************************************************************************
 *  URLEncoder/HTTPRouter Routing Rules
 *  Use convention: controllerName/methodActionName
 ****************************************************************************/

Router::get('/',			'HomeController/index');
Router::get('home/',		'HomeController/index');
Router::get('home/index',	'HomeController/index');
Router::get('home/start',	'HomeController/start');


Router::get('login/loginform', 'LoginController/getLoginForm');
Router::post('login/dologin', 'LoginController/doLogin');
Router::get('login/registerform', 'LoginController/getRegistrationForm');
Router::post('login/doregistration', 'LoginController/doRegistration');

Router::get('admin/index', 'AdminAppController/index');

Router::get('gestorvoo/index', 'GestorVooController/index');

Router::get('passenger/index', 'PassengerController/index');

Router::resource('user', 'UserController');

Router::resource('airport', 'AirportController');

Router::resource('flight', 'FlightController');

Router::resource('plane', 'PlaneController');

Router::get('passenger/edit', 'PassengerController/edit');

Router::post('passenger/update', 'PassengerController/update');

Router::get('layover/index', 'LayoverController/index');

Router::get('layover/create', 'LayoverController/create');

Router::get('layover/edit', 'LayoverController/edit');

Router::post('layover/store', 'LayoverController/store');

Router::get('layover/show', 'LayoverController/show');

Router::post('layover/update', 'LayoverController/update');

Router::get('layover/destroy', 'LayoverController/destroy');

Router::get('planelayover/create','PlaneLayoverController/create');

Router::post('planelayover/store','PlaneLayoverController/store');

Router::get('planelayover/edit', 'PlaneLayoverController/edit');

Router::get('operadorcheckin/index', 'OperadorCheckinController/index');
Router::resource('checkin', 'CheckinController');
Router::resource('detalhesvoo', 'DetalhesVooController');

// ** ReservarController **
Router::get('reservar/index',	'ReservarController/index');
Router::resource('reservar', 'ReservarController');
Router::resource('busca', 'ReservarController');

// ** HistoricoController **
Router::get('historico/index', 'HistoricoController/index');
Router::resource('historico', 'HistoricoController');

// ** PerfilController **
Router::get('perfil/index', 'PerfilController/index');
Router::resource('perfil', 'PerfilController');
/************** End of URLEncoder Routing Rules ************************************/
