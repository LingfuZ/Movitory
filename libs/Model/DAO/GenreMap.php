<?php
/** @package    Movitory::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");

/**
 * GenreMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the GenreDAO to the genres datastore.
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
class GenreMap implements IDaoMap
{
	/**
	 * Returns a singleton array of FieldMaps for the Genre object
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
			$fm["Id"] = new FieldMap("Id","genres","id",true,FM_TYPE_INT,10,null,true);
			$fm["Type"] = new FieldMap("Type","genres","type",false,FM_TYPE_VARCHAR,45,null,false);
		}
		return $fm;
	}

	/**
	 * Returns a singleton array of KeyMaps for the Genre object
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
			$km["moviesGenres_ibfk_2"] = new KeyMap("moviesGenres_ibfk_2", "Id", "Moviesgenres", "Genreid", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
		}
		return $km;
	}

}

?>