<?php 
/**
 Please Do not edit or add any code in this file without permission.

Magento version 1.9.0.1                CmsMagento Version 1.0
                              
Module Version. cms-1.0                 Module release: May 2017

*/

class Mage_CmsMagento_Block_Form_Redirect extends Mage_Core_Block_Abstract
{
    protected function _toHtml()
    {
		 
		 
        $CmsMagento = Mage::getModel('CmsMagento/method_CmsMagento');

        $form = new Varien_Data_Form();
        $form->setAction($CmsMagento->getCmsMagentoUrl())
            ->setId('CmsMagento_standard_checkout')
            ->setName('ecom')
            ->setMethod('post')
		    ->setUseContainer(true);
        foreach ($CmsMagento->getStandardCheckoutFormFields('redirect') as $field=>$value) {
           $form->addField($field, 'hidden', array('name'=>$field, 'value'=>$value));
        }
		
	
        $html = '<html>
				<body style="text-align:center;">';
       
	   echo $totype = "You will be redirected to payment gateway in few seconds...";
       $html.= $form->toHtml();
       $html.= '<script type="text/javascript">
	   			  function formsubmit()
				  {
				  	document.ecom.submit();	
				  }
				  setTimeout("formsubmit()", 3000);
	            </script>';
	  
        $html.= '</body></html>';

        return $html; 
    }
}

