<?php
/**
*************************************************************************************
 Please Do not edit or add any code in this file without permission.

Magento version 1.9.0.1                 CmsMagento Version 1.0
                              
Module Version. cms-1.0                 Module release: May 2017
**************************************************************************************
*/


class Mage_CmsMagento_Block_Form_CmsMagento extends Mage_Payment_Block_Form
{
    protected function _construct()
    {
        parent::_construct();
		        $this->setTemplate('CmsMagento/form/CmsMagento.phtml');
    }

    
    protected function _getCmsMagentoConfig()
    {
        return Mage::getSingleton('CmsMagento/config');
    }
	

   
	
    public function getCmsMagentoServiceTypes()
    {
		 
		
         $types = $this->_getCmsMagentoConfig()->getCmsMagentoServiceTypes();
        if ($method = $this->getMethod()) {
            $availableTypes = $method->getConfigData('CmsMagentotypes');
            if ($availableTypes) {
                $availableTypes = explode(',', $availableTypes);
                foreach ($types as $code=>$name) {
                    if (!in_array($code, $availableTypes)) {
                        unset($types[$code]);
                    }
                }
            }
        }
		
        return $types;
    }
	
    
    public function getCmsMagentoMonths()
    {
        $months = $this->getData('CmsMagento_months');
        if (is_null($months)) {
            $months[0] =  $this->__('Month');
            $months = array_merge($months, $this->_getCmsMagentoConfig()->getMonths());
            $this->setData('CmsMagento_months', $months);
        }
        return $months;
    }

   
    public function getCmsMagentoYears()
    {
        $years = $this->getData('CmsMagento_years');
        if (is_null($years)) {
            $years = $this->_getCmsMagentoConfig()->getYears();
            $years = array(0=>$this->__('Year'))+$years;
            $this->setData('CmsMagento_years', $years);
        }
        return $years;
    }

    
    public function hasVerification()
    {
        if ($this->getMethod()) {
            $configData = $this->getMethod()->getConfigData('useccv');
            if(is_null($configData)){
                return true;
            }
            return (bool) $configData;
        }
        return true;
    }
	public function getQuoteData()
    {
		return $this->getMethod()->getQuoteData();
	}
	public function getBillingAddress()
	{
		if ($this->getMethod())
		{
			$this->getMethod()->getQuote();
			$aa= $this->getMethod()->getQuote()->getBillingAddress()->getCountry();
		}
	}
}
