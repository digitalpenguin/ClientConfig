<?php
/**
 * Creates a cgRepeaterType object.
 */
class cgRepeaterTypeCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'cgRepeaterType';
    public $languageTopics = array('clientconfig:default');

    /**
     * Before setting, we check if the key is filled and/or already exists.
     * @return bool
     */
    public function beforeSet() {
        $key = $this->getProperty('key');
        if (empty($key)) {
            $this->addFieldError('key',$this->modx->lexicon('clientconfig.cgsetting_err_ns_key'));
        } else {
            if ($this->doesAlreadyExist(array('key' => $key))) {
                $this->addFieldError('key',$this->modx->lexicon('clientconfig.cgsetting_err_ae_key'));
            }
        }
        $order = (int)$this->getProperty('sortorder', 0);
        if ($order < 1) {
            $order = $this->modx->getCount('cgRepeaterType');
            $this->setProperty('sortorder', $order);
        }
        return parent::beforeSet();
    }

    public function afterSave()
    {
        // Invoke events and clear the cache
        $this->modx->invokeEvent('ClientConfig_ConfigChange');
        $this->modx->getCacheManager()->delete('clientconfig',array(xPDO::OPT_CACHE_KEY => 'system_settings'));
        if ($this->modx->getOption('clientconfig.clear_cache', null, true)) {
            $this->modx->getCacheManager()->delete('',array(xPDO::OPT_CACHE_KEY => 'resource'));
        }

        return parent::afterSave();
    }
}
return 'cgRepeaterTypeCreateProcessor';