<?php
$xpdo_meta_map['cgRepeaterInstance']= array (
  'package' => 'clientconfig',
  'version' => '1.1',
  'table' => 'clientconfig_repeater_instances',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'MyISAM',
  ),
  'fields' => 
  array (
    'repeater_type_id' => 0,
    'setting_id' => 0,
    'key' => '',
  ),
  'fieldMeta' => 
  array (
    'repeater_type_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'setting_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'key' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '75',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
  ),
  'composites' => 
  array (
    'RepeaterInstanceValue' => 
    array (
      'local' => 'id',
      'class' => 'cgRepeaterInstanceValue',
      'foreign' => 'repeater_instance_id',
      'owner' => 'local',
      'cardinality' => 'many',
    ),
  ),
  'aggregates' => 
  array (
    'RepeaterType' => 
    array (
      'local' => 'repeater_type_id',
      'class' => 'cgRepeaterType',
      'foreign' => 'id',
      'owner' => 'foreign',
      'cardinality' => 'one',
    ),
    'Setting' => 
    array (
      'local' => 'setting_id',
      'class' => 'cgSetting',
      'foreign' => 'id',
      'owner' => 'foreign',
      'cardinality' => 'one',
    ),
  ),
);
