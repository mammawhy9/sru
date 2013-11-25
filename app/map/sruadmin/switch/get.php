<?php
/**
 * wyciagniecie pojedynczego switcha
 */
class UFmap_SruAdmin_Switch_Get
extends UFmap {

	protected $columns = array(
		'id'		=> 's.id',
		'hierarchyNo'	=> 's.hierarchy_no',
		'modelId'	=> 's.model',
		'model'		=> 'm.model_name',
		'modelNo'	=> 'm.model_no',
		'modelPorts'	=> 'm.ports_no',
		'modelSfpPorts'	=> 'm.sfp_ports_no',
		'dormitoryId'	=> 's.dormitory',
		'dormitoryName'	=> 'd.name',
		'dormitoryAlias'=> 'd.alias',
		'displayOrder' =>  'd.display_order',
		'serialNo'	=> 's.serial_no',
		'inventoryNo'	=> 's.inventory_no',
		'received'	=> 's.received',
		'inoperational'	=> 's.inoperational',
		'localization'	=> 's.localization',
		'comment'	=> 's.comment',
		'ip'		=> 's.ipv4',
		'lab'		=> 's.lab',
	);
	protected $columnTypes = array(
		'id'		=> self::INT,
		'hierarchyNo'	=> self::NULL_INT,
		'modelId'	=> self::INT,
		'model'		=> self::TEXT,
		'modelNo'	=> self::TEXT,
		'modelPorts'	=> self::INT,
		'modelSfpPorts'	=> self::INT,
		'dormitoryId'	=> self::INT,
		'dormitoryName'	=> self::TEXT,
		'dormitoryAlias'=> self::TEXT,
		'displayOrder'	=> self::INT,
		'serialNo'	=> self::TEXT,
		'inventoryNo'	=> self::NULL_TEXT,
		'received'	=> self::NULL_TS,
		'inoperational'	=> self::BOOL,
		'localization'	=> self::NULL_TEXT,
		'comment'	=> self::NULL_TEXT,
		'ip'		=> self::NULL_TEXT,
		'lab'		=> self::BOOL,
	);
	protected $tables = array(
		's' => 'switches',
	);
	protected $joins = array(
		'm' => 'switches_model',
		'd' => 'dormitories',
	);	
	protected $joinOns = array(
		'm' => 's.model=m.id',
		'd' => 's.dormitory=d.id',
	);
	protected $pk = 'id';
}
