<?php
/** @package    Movitory::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");

/**
 * GroupMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the GroupDAO to the groups datastore.
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
class GroupMap implements IDaoMap
{
	/**
	 * Returns a singleton array of FieldMaps for the Group object
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
			$fm["Id"] = new FieldMap("Id","groups","id",true,FM_TYPE_INT,10,null,true);
			$fm["Name"] = new FieldMap("Name","groups","name",false,FM_TYPE_VARCHAR,99,null,false);
		}
		return $fm;
	}

	/**
	 * Returns a singleton array of KeyMaps for the Group object
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
			$km["moviesGroups_ibfk_2"] = new KeyMap("moviesGroups_ibfk_2", "Id", "Moviesgroups", "Groupid", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
		}
		return $km;
	}

}

?>