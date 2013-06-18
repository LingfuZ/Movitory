<?php
/**
 * @package MOVITORY
 *
 * APPLICATION-WIDE CONFIGURATION SETTINGS
 *
 * This file contains application-wide configuration settings.  The settings
 * here will be the same regardless of the machine on which the app is running.
 *
 * This configuration should be added to version control.
 *
 * No settings should be added to this file that would need to be changed
 * on a per-machine basic (ie local, staging or production).  Any
 * machine-specific settings should be added to _machine_config.php
 */

/**
 * APPLICATION ROOT DIRECTORY
 * If the application doesn't detect this correctly then it can be set explicitly
 */
GlobalConfig::$APP_ROOT = realpath("./");

/**
 * check is needed to ensure asp_tags is not enabled
 */
if (ini_get('asp_tags')) 
	die('<h3>Server Configuration Problem: asp_tags is enabled, but is not compatible with Savant.</h3>'
	. '<p>You can disable asp_tags in .htaccess, php.ini or generate your app with another template engine such as Smarty.</p>');

/**
 * INCLUDE PATH
 * Adjust the include path as necessary so PHP can locate required libraries
 */
set_include_path(
		GlobalConfig::$APP_ROOT . '/libs/' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/../phreeze/libs' . PATH_SEPARATOR .
		get_include_path()
);

/**
 * SESSION CLASSES
 * Any classes that will be stored in the session can be added here
 * and will be pre-loaded on every page
 */
require_once "App/ExampleUser.php";

/**
 * RENDER ENGINE
 * You can use any template system that implements
 * IRenderEngine for the view layer.  Phreeze provides pre-built
 * implementations for Smarty, Savant and plain PHP.
 */
require_once 'verysimple/Phreeze/SavantRenderEngine.php';
GlobalConfig::$TEMPLATE_ENGINE = 'SavantRenderEngine';
GlobalConfig::$TEMPLATE_PATH = GlobalConfig::$APP_ROOT . '/templates/';

/**
 * ROUTE MAP
 * The route map connects URLs to Controller+Method and additionally maps the
 * wildcards to a named parameter so that they are accessible inside the
 * Controller without having to parse the URL for parameters such as IDs
 */
GlobalConfig::$ROUTE_MAP = array(

	// default controller when no route specified
	'GET:' => array('route' => 'Default.Home'),
		
	// example authentication routes
	'GET:loginform' => array('route' => 'SecureExample.LoginForm'),
	'POST:login' => array('route' => 'SecureExample.Login'),
	'GET:secureuser' => array('route' => 'SecureExample.UserPage'),
	'GET:secureadmin' => array('route' => 'SecureExample.AdminPage'),
	'GET:logout' => array('route' => 'SecureExample.Logout'),
		
	// Actor
	'GET:actors' => array('route' => 'Actor.ListView'),
	'GET:actor/(:num)' => array('route' => 'Actor.SingleView', 'params' => array('id' => 1)),
	'GET:api/actors' => array('route' => 'Actor.Query'),
	'POST:api/actor' => array('route' => 'Actor.Create'),
	'GET:api/actor/(:num)' => array('route' => 'Actor.Read', 'params' => array('id' => 2)),
	'PUT:api/actor/(:num)' => array('route' => 'Actor.Update', 'params' => array('id' => 2)),
	'DELETE:api/actor/(:num)' => array('route' => 'Actor.Delete', 'params' => array('id' => 2)),
		
	// Contact
	'GET:contacts' => array('route' => 'Contact.ListView'),
	'GET:contact/(:num)' => array('route' => 'Contact.SingleView', 'params' => array('id' => 1)),
	'GET:api/contacts' => array('route' => 'Contact.Query'),
	'POST:api/contact' => array('route' => 'Contact.Create'),
	'GET:api/contact/(:num)' => array('route' => 'Contact.Read', 'params' => array('id' => 2)),
	'PUT:api/contact/(:num)' => array('route' => 'Contact.Update', 'params' => array('id' => 2)),
	'DELETE:api/contact/(:num)' => array('route' => 'Contact.Delete', 'params' => array('id' => 2)),
		
	// Extra
	'GET:extras' => array('route' => 'Extra.ListView'),
	'GET:extra/(:num)' => array('route' => 'Extra.SingleView', 'params' => array('id' => 1)),
	'GET:api/extras' => array('route' => 'Extra.Query'),
	'POST:api/extra' => array('route' => 'Extra.Create'),
	'GET:api/extra/(:num)' => array('route' => 'Extra.Read', 'params' => array('id' => 2)),
	'PUT:api/extra/(:num)' => array('route' => 'Extra.Update', 'params' => array('id' => 2)),
	'DELETE:api/extra/(:num)' => array('route' => 'Extra.Delete', 'params' => array('id' => 2)),
		
	// Genre
	'GET:genres' => array('route' => 'Genre.ListView'),
	'GET:genre/(:num)' => array('route' => 'Genre.SingleView', 'params' => array('id' => 1)),
	'GET:api/genres' => array('route' => 'Genre.Query'),
	'POST:api/genre' => array('route' => 'Genre.Create'),
	'GET:api/genre/(:num)' => array('route' => 'Genre.Read', 'params' => array('id' => 2)),
	'PUT:api/genre/(:num)' => array('route' => 'Genre.Update', 'params' => array('id' => 2)),
	'DELETE:api/genre/(:num)' => array('route' => 'Genre.Delete', 'params' => array('id' => 2)),
		
	// Group
	'GET:groups' => array('route' => 'Group.ListView'),
	'GET:group/(:num)' => array('route' => 'Group.SingleView', 'params' => array('id' => 1)),
	'GET:api/groups' => array('route' => 'Group.Query'),
	'POST:api/group' => array('route' => 'Group.Create'),
	'GET:api/group/(:num)' => array('route' => 'Group.Read', 'params' => array('id' => 2)),
	'PUT:api/group/(:num)' => array('route' => 'Group.Update', 'params' => array('id' => 2)),
	'DELETE:api/group/(:num)' => array('route' => 'Group.Delete', 'params' => array('id' => 2)),
		
	// Movie
	'GET:movies' => array('route' => 'Movie.ListView'),
	'GET:movie/(:num)' => array('route' => 'Movie.SingleView', 'params' => array('id' => 1)),
	'GET:api/movies' => array('route' => 'Movie.Query'),
	'POST:api/movie' => array('route' => 'Movie.Create'),
	'GET:api/movie/(:num)' => array('route' => 'Movie.Read', 'params' => array('id' => 2)),
	'PUT:api/movie/(:num)' => array('route' => 'Movie.Update', 'params' => array('id' => 2)),
	'DELETE:api/movie/(:num)' => array('route' => 'Movie.Delete', 'params' => array('id' => 2)),
		
	// Movie_Actor
	'GET:movies_actors' => array('route' => 'Movie_Actor.ListView'),
	'GET:movie_actor/(:any)' => array('route' => 'Movie_Actor.SingleView', 'params' => array('movieid' => 1)),
	'GET:api/movies_actors' => array('route' => 'Movie_Actor.Query'),
	'POST:api/movie_actor' => array('route' => 'Movie_Actor.Create'),
	'GET:api/movie_actor/(:any)' => array('route' => 'Movie_Actor.Read', 'params' => array('movieid' => 2)),
	'PUT:api/movie_actor/(:any)' => array('route' => 'Movie_Actor.Update', 'params' => array('movieid' => 2)),
	'DELETE:api/movie_actor/(:any)' => array('route' => 'Movie_Actor.Delete', 'params' => array('movieid' => 2)),
		
	// Movie_Genre
	'GET:movies_genres' => array('route' => 'Movie_Genre.ListView'),
	'GET:movie_genre/(:any)' => array('route' => 'Movie_Genre.SingleView', 'params' => array('movieid' => 1)),
	'GET:api/movies_genres' => array('route' => 'Movie_Genre.Query'),
	'POST:api/movie_genre' => array('route' => 'Movie_Genre.Create'),
	'GET:api/movie_genre/(:any)' => array('route' => 'Movie_Genre.Read', 'params' => array('movieid' => 2)),
	'PUT:api/movie_genre/(:any)' => array('route' => 'Movie_Genre.Update', 'params' => array('movieid' => 2)),
	'DELETE:api/movie_genre/(:any)' => array('route' => 'Movie_Genre.Delete', 'params' => array('movieid' => 2)),
		
	// Movie_Group
	'GET:movies_groups' => array('route' => 'Movie_Group.ListView'),
	'GET:movie_group/(:any)' => array('route' => 'Movie_Group.SingleView', 'params' => array('movieid' => 1)),
	'GET:api/movies_groups' => array('route' => 'Movie_Group.Query'),
	'POST:api/movie_group' => array('route' => 'Movie_Group.Create'),
	'GET:api/movie_group/(:any)' => array('route' => 'Movie_Group.Read', 'params' => array('movieid' => 2)),
	'PUT:api/movie_group/(:any)' => array('route' => 'Movie_Group.Update', 'params' => array('movieid' => 2)),
	'DELETE:api/movie_group/(:any)' => array('route' => 'Movie_Group.Delete', 'params' => array('movieid' => 2)),

	// catch any broken API urls
	'GET:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'PUT:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'POST:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'DELETE:api/(:any)' => array('route' => 'Default.ErrorApi404')
);

/**
 * FETCHING STRATEGY
 * You may uncomment any of the lines below to specify always eager fetching.
 * Alternatively, you can copy/paste to a specific page for one-time eager fetching
 * If you paste into a controller method, replace $G_PHREEZER with $this->Phreezer
 */
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Movies","movies_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Movies","movies_ibfk_2",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Moviesactors","moviesActors_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Moviesactors","moviesActors_ibfk_2",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Moviesgenres","moviesGenres_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Moviesgenres","moviesGenres_ibfk_2",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Moviesgroups","moviesGroups_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Moviesgroups","moviesGroups_ibfk_2",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
?>