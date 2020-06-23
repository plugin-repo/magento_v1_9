<?php
/**
*************************************************************************************
 Please Do not edit or add any code in this file without permission.


Magento version 1.9.0.1                 CmsMagento Version 1.0
                              
Module Version. cms-1.0                 Module release: May 2017
**************************************************************************************
*/



class Mage_CmsMagento_Block_Info_CmsMagento extends Mage_Payment_Block_Info
{
    
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('CmsMagento/info/CmsMagento.phtml');
    }

    
    public function getCmsMagentoTypeName()
    {
        $types = Mage::getSingleton('CmsMagento/config')->getCmsMagentoTypes();
        if (isset($types[$this->getInfo()->getCmsMagentoType()])) {
            return $types[$this->getInfo()->getCmsMagentoType()];
        }
        return $this->getInfo()->getCmsMagentoType();
    }

   
}
 ?>