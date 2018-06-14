<?php
/**
 * Gets a list of cgRepeaterType objects.
 */
class cgRepeaterTypeGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'cgRepeaterType';
    public $languageTopics = array('clientconfig:default');
    public $defaultSortField = 'label';
    public $defaultSortDirection = 'ASC';

    /**
     * Transform the xPDOObject derivative to an array;
     * @param xPDOObject $object
     * @return array
     */
    public function prepareRow(xPDOObject $object) {
        $row = $object->toArray('', false, true);
        return $row;
    }
}
return 'cgRepeaterTypeGetListProcessor';
