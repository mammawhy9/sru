<?
/**
 * mapping do surowego zapytania SQL dla ostatnich akcji admina - komputery
 */
class UFmap_Sru_Computer_FullHistory
extends UFmap {

	protected $columns = array(
		'id'     		 => 'id',
		'host'           => 'host',
		'userid'		 => 'userid',
		'modifiedat'     => 'modifiedat',
		'active'         => 'active',
		'banned'         => 'banned',
		'name'			 => 'name',
		'surname'		 => 'surname',
		'active'		 => 'active',
		'u_active'		 => 'u_active',
		'login'			 => 'login',
		
	);
	protected $columnTypes = array(
		'id'    		 => self::INT,
		'host'           => self::TEXT,
		'userid'		 => self::INT,
		'modifiedby'     => self::NULL_INT,
		'modifiedat'     => self::TS,
		'active'         => self::BOOL,
		'banned'         => self::BOOL,
		'name'			 => self::TEXT,
		'surname'		 => self::TEXT,
		'active'		 => self::BOOL,
		'u_active'		 => self::BOOL,
		'login'			 => self::TEXT,
	);
}
