<?php
/** @package    Movitory::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");

/**
 * ActorMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the ActorDAO to the actors datastore.
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
class ActorMap implements IDaoMap
{
	/**
	 * Returns a singleton array of FieldMaps for the Actor object
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
			$fm["Id"] = new FieldMap("Id","actors","id",true,FM_TYPE_INT,10,null,true);
			$fm["Firstname"] = new FieldMap("Firstname","actors","firstName",false,FM_TYPE_VARCHAR,45,null,false);
			$fm["Lastname"] = new FieldMap("Lastname","actors","lastName",false,FM_TYPE_VARCHAR,45,null,false);
			$fm["Dateofbirth"] = new FieldMap("Dateofbirth","actors","dateOfBirth",false,FM_TYPE_DATE,null,null,false);
			$fm["City"] = new FieldMap("City","actors","city",false,FM_TYPE_VARCHAR,45,null,false);
			$fm["State"] = new FieldMap("State","actors","state",false,FM_TYPE_VARCHAR,45,null,false);
		}
		return $fm;
	}

	/**
	 * Returns a singleton array of KeyMaps for the Actor object
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
			$km["moviesActors_ibfk_2"] = new KeyMap("moviesActors_ibfk_2", "Id", "Moviesactors", "Actorid", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
		}
		return $km;
	}

}

?>