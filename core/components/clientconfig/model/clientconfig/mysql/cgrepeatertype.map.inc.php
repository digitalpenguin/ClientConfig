<?php
$xpdo_meta_map['cgRepeaterType']= array (
  'package' => 'clientconfig',
  'version' => '1.1',
  'table' => 'clientconfig_repeater_types',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'MyISAM',
  ),
  'fields' => 
  array (
    'key' => '',
    'label' => '',
    'description' => '0',
    'sortorder' => 0,
  ),
  'fieldMeta' => 
  array (
    'key' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '75',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'label' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '75',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'description' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
      'default' => '0',
    ),
    'sortorder' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
  ),
  'composites' => 
  array (
    'Field' => 
    array (
      'local' => 'id',
      'class' => 'cgRepeaterField',
      'foreign' => 'repeater_type_id',
      'owner' => 'local',
      'cardinality' => 'many',
    ),
    'RepeaterInstance' => 
    array (
      'local' => 'id',
      'class' => 'cgRepeaterInstance',
      'foreign' => 'repeater_type_id',
      'owner' => 'local',
      'cardinality' => 'many',
    ),
  ),
);
