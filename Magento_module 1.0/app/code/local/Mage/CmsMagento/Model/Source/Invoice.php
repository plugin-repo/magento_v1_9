<?php
/**
*************************************************************************************
 Please Do not edit or add any code in this file without permission.

Magento version 1.9.0.1                 CmsMagento Version 1.0
                              
Module Version. cms-1.0                 Module release: May 2017
**************************************************************************************
*/


class Mage_CmsMagento_Model_Source_Invoice
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => Mage_CmsMagento_Model_Method_Abstract::ACTION_AUTHORIZE_CAPTURE,
                'label' => Mage::helper('core')->__('Yes')
            ),
            array(
                'value' => '',
                'label' => Mage::helper('core')->__('No')
            ),
        );
    }
}
