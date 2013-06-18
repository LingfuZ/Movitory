<?php
/** @package    Movitory::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");

/**
 * ExtraMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the ExtraDAO to the extras datastore.
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
class ExtraMap implements IDaoMap
{
	/**
	 * Returns a singleton array of FieldMaps for the Extra object
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
			$fm["Id"] = new FieldMap("Id","extras","id",true,FM_TYPE_INT,10,null,true);
			$fm["Cover"] = new FieldMap("Cover","extras","cover",false,FM_TYPE_VARCHAR,2083,null,false);
			$fm["Trailer"] = new FieldMap("Trailer","extras","trailer",false,FM_TYPE_VARCHAR,2083,null,false);
			$fm["Wiki"] = new FieldMap("Wiki","extras","wiki",false,FM_TYPE_VARCHAR,2083,null,false);
		}
		return $fm;
	}

	/**
	 * Returns a singleton array of KeyMaps for the Extra object
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
			$km["movies_ibfk_2"] = new KeyMap("movies_ibfk_2", "Id", "Movies", "Extraid", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
		}
		return $km;
	}

}

?>