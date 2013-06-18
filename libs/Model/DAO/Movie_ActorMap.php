<?php
/** @package    Movitory::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");

/**
 * Movie_ActorMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the Movie_ActorDAO to the moviesActors datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Movitory::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class Movie_ActorMap implements IDaoMap
{
	/**
	 * Returns a singleton array of FieldMaps for the Movie_Actor object
	 *
	 * @access public
	 * @return array of FieldMaps
	 */
	public static function GetFieldMaps()
	{
		static $fm = null;
		if ($fm == null)
		{
			$fm = Array();
			$fm["Movieid"] = new FieldMap("Movieid","moviesActors","movieId",true,FM_TYPE_INT,10,null,false);
			$fm["Actorid"] = new FieldMap("Actorid","moviesActors","actorId",true,FM_TYPE_INT,10,null,false);
		}
		return $fm;
	}

	/**
	 * Returns a singleton array of KeyMaps for the Movie_Actor object
	 *
	 * @access public
	 * @return array of KeyMaps
	 */
	public static function GetKeyMaps()
	{
		static $km = null;
		if ($km == null)
		{
			$km = Array();
			$km["moviesActors_ibfk_1"] = new KeyMap("moviesActors_ibfk_1", "Movieid", "Movies", "Id", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			$km["moviesActors_ibfk_2"] = new KeyMap("moviesActors_ibfk_2", "Actorid", "Actors", "Id", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return $km;
	}

}

?>