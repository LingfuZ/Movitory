<?php
/** @package    Movitory::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");

/**
 * MovieMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the MovieDAO to the movies datastore.
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
class MovieMap implements IDaoMap
{
	/**
	 * Returns a singleton array of FieldMaps for the Movie object
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
			$fm["Id"] = new FieldMap("Id","movies","id",true,FM_TYPE_INT,10,null,true);
			$fm["Name"] = new FieldMap("Name","movies","name",false,FM_TYPE_VARCHAR,99,null,false);
			$fm["Year"] = new FieldMap("Year","movies","year",false,FM_TYPE_INT,4,null,false);
			$fm["Location"] = new FieldMap("Location","movies","location",false,FM_TYPE_VARCHAR,500,null,false);
			$fm["Barcode"] = new FieldMap("Barcode","movies","barcode",false,FM_TYPE_TEXT,null,null,false);
			$fm["Rating"] = new FieldMap("Rating","movies","rating",false,FM_TYPE_VARCHAR,20,null,false);
			$fm["Contactid"] = new FieldMap("Contactid","movies","contactId",false,FM_TYPE_INT,10,null,false);
			$fm["Extraid"] = new FieldMap("Extraid","movies","extraId",false,FM_TYPE_INT,10,null,false);
		}
		return $fm;
	}

	/**
	 * Returns a singleton array of KeyMaps for the Movie object
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
			$km["moviesActors_ibfk_1"] = new KeyMap("moviesActors_ibfk_1", "Id", "Moviesactors", "Movieid", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			$km["moviesGenres_ibfk_1"] = new KeyMap("moviesGenres_ibfk_1", "Id", "Moviesgenres", "Movieid", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			$km["moviesGroups_ibfk_1"] = new KeyMap("moviesGroups_ibfk_1", "Id", "Moviesgroups", "Movieid", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			$km["movies_ibfk_1"] = new KeyMap("movies_ibfk_1", "Contactid", "Contacts", "Id", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			$km["movies_ibfk_2"] = new KeyMap("movies_ibfk_2", "Extraid", "Extras", "Id", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return $km;
	}

}

?>