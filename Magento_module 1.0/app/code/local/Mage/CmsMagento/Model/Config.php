<?php
/**
*************************************************************************************
 Please Do not edit or add any code in this file without permission.

Magento version 1.9.0.1                 CmsMagento Version 1.0
                              
Module Version. cms-1.0                 Module release: May 2017
**************************************************************************************
*/


class Mage_CmsMagento_Model_Config
{
    protected static $_methods;

    
    public function getActiveMethods($store=null)
    {
        $methods = array();
        $config = Mage::getStoreConfig('CmsMagento', $store);
        foreach ($config as $code => $methodConfig) {
            if (Mage::getStoreConfigFlag('CmsMagento/'.$code.'/active', $store)) {
                $methods[$code] = $this->_getMethod($code, $methodConfig);
            }
        }
        return $methods;
    }

    
    public function getAllMethods($store=null)
    {
        $methods = array();
        $config = Mage::getStoreConfig('CmsMagento', $store);
        foreach ($config as $code => $methodConfig) {
            $methods[$code] = $this->_getMethod($code, $methodConfig);
        }
        return $methods;
    }

    protected function _getMethod($code, $config, $store=null)
    {
        if (isset(self::$_methods[$code])) {
            return self::$_methods[$code];
        }
        $modelName = $config['model'];
        $method = Mage::getModel($modelName);
        $method->setId($code)->setStore($store);
        self::$_methods[$code] = $method;
        return self::$_methods[$code];
    }

	 
   
    public function getMonths()
    {
        $data = Mage::app()->getLocale()->getTranslationList('month');
        foreach ($data as $key => $value) {
            $monthNum = ($key < 10) ? '0'.$key : $key;
            $data[$key] = $monthNum . ' - ' . $value;
        }
        return $data;
    }

   
    public function getYears()
    {
        $years = array();
        $first = date("Y");

        for ($index=0; $index <= 10; $index++) {
            $year = $first + $index;
            $years[$year] = $year;
        }
        return $years;
    }

    
    static function compareCmsMagentoTypes($a, $b)
    {
        if (!isset($a['order'])) {
            $a['order'] = 0;
        }

        if (!isset($b['order'])) {
            $b['order'] = 0;
        }

        if ($a['order'] == $b['order']) {
            return 0;
        } else if ($a['order'] > $b['order']) {
            return 1;
        } else {
            return -1;
        }

    }
	public function getCmsMagentoServerUrl()
	{   if(Mage::getStoreConfig('payment/CmsMagento/test')){
		
		$url=Mage::getStoreConfig('payment/CmsMagento/testurl');
		return $url;
	} else
	    
		 $urllive = Mage::getStoreConfig('payment/CmsMagento/liveurl');
		
         return $urllive;
	}
	
	public function getCmsMagentoRedirecturl()
	{
		  $url= Mage::getUrl('CmsMagento/CmsMagento/success',array('_secure' => true));
	
		 return $url;
	}
}
		
 