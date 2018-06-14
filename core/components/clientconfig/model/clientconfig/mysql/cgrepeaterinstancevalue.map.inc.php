<?php
$xpdo_meta_map['cgRepeaterInstanceValue']= array (
  'package' => 'clientconfig',
  'version' => '1.1',
  'table' => 'clientconfig_repeater_instance_values',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'MyISAM',
  ),
  'fields' => 
  array (
    'repeater_instance_id' => 0,
    'key' => '',
    'value' => '',
  ),
  'fieldMeta' => 
  array (
    'repeater_instance_id' => 
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
    'value' => 
    array (
      'dbtype' => 'mediumtext',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
  ),
  'aggregates' => 
  array (
    'RepeaterInstance' => 
    array (
      'local' => 'repeater_instance_id',
      'class' => 'cgRepeaterInstance',
      'foreign' => 'id',
      'owner' => 'foreign',
      'cardinality' => 'one',
    ),
  ),
);
