<?php
/**
*************************************************************************************
 Please Do not edit or add any code in this file without permission.

Magento version 1.9.0.1                 CmsMagento Version 1.0
                              
Module Version. cms-1.0                 Module release: May 2017
**************************************************************************************
*/


class Mage_CmsMagento_Model_Source_CmsMagentotype
{
    
    public function getAllowedTypes()
    {
        return array();
    }

    public function toOptionArray()
    {
       
        $allowed = $this->getAllowedTypes();
        $options = array();

        foreach (Mage::getSingleton('CmsMagento/config')->getCmsMagentoTypes() as $code => $name) {
            if (in_array($code, $allowed) || !count($allowed)) {
                $options[] = array(
                   'value' => $code,
                   'label' => $name
                );
            }
        }

        return $options;
    }
}
