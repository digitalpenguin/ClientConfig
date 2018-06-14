<?php
/* Get the core config */
if (!file_exists(dirname(dirname(__FILE__)).'/config.core.php')) {
    die('ERROR: missing '.dirname(dirname(__FILE__)).'/config.core.php file defining the MODX core path.');
}

echo "<pre>";
/* Boot up MODX */
echo "Loading modX...\n";
require_once dirname(dirname(__FILE__)).'/config.core.php';
require_once MODX_CORE_PATH.'model/modx/modx.class.php';
$modx = new modX();
echo "Initializing manager...\n";
$modx->initialize('mgr');
$modx->getService('error','error.modError', '', '');

$componentPath = dirname(dirname(__FILE__));

$ClientConfig = $modx->getService('clientconfig','ClientConfig', $componentPath.'/core/components/clientconfig/model/clientconfig/', array(
    'clientconfig.core_path' => $componentPath.'/core/components/clientconfig/',
));


/* Namespace */
if (!createObject('modNamespace',array(
    'name' => 'clientconfig',
    'path' => $componentPath.'/core/components/clientconfig/',
    'assets_path' => $componentPath.'/assets/components/clientconfig/',
),'name', true)) {
    echo "Error creating namespace clientconfig.\n";
}

/* Path settings */
if (!createObject('modSystemSetting', array(
    'key' => 'clientconfig.core_path',
    'value' => $componentPath.'/core/components/clientconfig/',
    'xtype' => 'textfield',
    'namespace' => 'clientconfig',
    'area' => 'Paths',
    'editedon' => time(),
), 'key', false)) {
    echo "Error creating clientconfig.core_path setting.\n";
}

if (!createObject('modSystemSetting', array(
    'key' => 'clientconfig.assets_path',
    'value' => $componentPath.'/assets/components/clientconfig/',
    'xtype' => 'textfield',
    'namespace' => 'clientconfig',
    'area' => 'Paths',
    'editedon' => time(),
), 'key', false)) {
    echo "Error creating clientconfig.assets_path setting.\n";
}

/* Fetch assets url */
$url = 'http';
if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) {
    $url .= 's';
}
$url .= '://'.$_SERVER["SERVER_NAME"];
if ($_SERVER['SERVER_PORT'] != '80') {
    $url .= ':'.$_SERVER['SERVER_PORT'];
}
$requestUri = $_SERVER['REQUEST_URI'];
$bootstrapPos = strpos($requestUri, '_bootstrap/');
$requestUri = rtrim(substr($requestUri, 0, $bootstrapPos), '/').'/';
$assetsUrl = "{$url}{$requestUri}assets/components/clientconfig/";

if (!createObject('modSystemSetting', array(
    'key' => 'clientconfig.assets_url',
    'value' => $assetsUrl,
    'xtype' => 'textfield',
    'namespace' => 'clientconfig',
    'area' => 'Paths',
    'editedon' => time(),
), 'key', false)) {
    echo "Error creating clientconfig.assets_url setting.\n";
}
if (!createObject('modPlugin', array(
    'name' => 'ClientConfig',
    'static' => true,
    'static_file' => $componentPath.'/core/components/clientconfig/elements/plugins/clientconfig.plugin.php',
), 'name', true)) {
    echo "Error creating ClientConfig Plugin.\n";
}
$vcPlugin = $modx->getObject('modPlugin', array('name' => 'ClientConfig'));
if ($vcPlugin) {
    if (!createObject('modPluginEvent', array(
        'pluginid' => $vcPlugin->get('id'),
        'event' => 'OnMODXInit',
        'priority' => 0,
    ), array('pluginid','event'), false)) {
        echo "Error creating modPluginEvent.\n";
    }
}

if (!createObject('modAction', array(
    'namespace' => 'clientconfig',
    'parent' => '0',
    'controller' => 'index',
    'haslayout' => '1',
    'lang_topics' => 'clientconfig:default',
    'permissions' => ''
), 'namespace', false)) {
    echo "Error creating action.\n";
}
$action = $modx->getObject('modAction', array(
    'namespace' => 'clientconfig'
));

if ($action) {
    if (!createObject('modMenu', array(
        'text' => 'clientconfig',
        'parent' => 'components',
        'description' => 'clientconfig.desc',
        'icon' => '',
        'menuindex' => '10',
        'action' => $action->get('id')
    ), 'text', false)) {
        echo "Error creating menu.\n";
    }
}

//$settings = include dirname(dirname(__FILE__)).'/_build/data/settings.php';
//foreach ($settings as $key => $opts) {
//    if (!createObject('modSystemSetting', array(
//        'key' => 'clientconfig.' . $key,
//        'value' => $opts['value'],
//        'xtype' => (isset($opts['xtype'])) ? $opts['xtype'] : 'textfield',
//        'namespace' => 'clientconfig',
//        'area' => $opts['area'],
//        'editedon' => time(),
//    ), 'key', false)) {
//        echo "Error creating clientconfig.".$key." setting.\n";
//    }
//}


/* Create the tables */
$objectContainers = array(
    'cgGroup',
    'cgSetting',
    'cgContextValue',
    'cgRepeaterType',
    'cgRepeaterField',
    'cgRepeaterInstance',
    'cgRepeaterInstanceValue',
);
echo "Creating tables...\n";
$manager = $modx->getManager();
foreach ($objectContainers as $oC) {
    $manager->createObjectContainer($oC);
}
$manager->addField('cgSetting', 'process_options');
echo "Done.";

// Refresh the cache
$modx->cacheManager->refresh();


/**
 * Creates an object.
 *
 * @param string $className
 * @param array $data
 * @param string $primaryField
 * @param bool $update
 * @return bool
 */
function createObject ($className = '', array $data = array(), $primaryField = '', $update = true) {
    global $modx;
    /* @var xPDOObject $object */
    $object = null;

    /* Attempt to get the existing object */
    if (!empty($primaryField)) {
        if (is_array($primaryField)) {
            $condition = array();
            foreach ($primaryField as $key) {
                $condition[$key] = $data[$key];
            }
        }
        else {
            $condition = array($primaryField => $data[$primaryField]);
        }
        $object = $modx->getObject($className, $condition);
        if ($object instanceof $className) {
            if ($update) {
                $object->fromArray($data);
                return $object->save();
            } else {
                $condition = $modx->toJSON($condition);
                echo "Skipping {$className} {$condition}: already exists.\n";
                return true;
            }
        }
    }

    /* Create new object if it doesn't exist */
    if (!$object) {
        $object = $modx->newObject($className);
        $object->fromArray($data, '', true);
        return $object->save();
    }

    return false;
}
