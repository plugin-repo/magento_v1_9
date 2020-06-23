<?php

/**
 * ************************************************************************************
  Please Do not edit or add any code in this file without permission.

  Magento version 1.9.0.1                 CmsMagento Version 1.0

  Module Version. cms-1.0                 Module release: May 2017
 * *************************************************************************************
 */

class Mage_CmsMagento_CmsMagentoController extends Mage_Core_Controller_Front_Action {

    protected $_order;

    public function getOrder() {
        if ($this->_order == null) {
            
        }
        return $this->_order;
    }

    protected function _expireAjax() {
        if (!Mage::getSingleton('checkout/session')->getQuote()->hasItems()) {
            $this->getResponse()->setHeader('HTTP/1.1', '403 Session Expired');
            exit;
        }
    }

    public function getStandard() {
        return Mage::getSingleton('CmsMagento/standard');
    }

    public function redirectAction() {

        $session = Mage::getSingleton('checkout/session');
        $session->setCmsMagentoStandardQuoteId($session->getQuoteId());
        $order = Mage::getModel('sales/order');
        $order->load(Mage::getSingleton('checkout/session')->getLastOrderId());
        $order->sendNewOrderEmail();
        $order->save();

        $this->getResponse()->setBody($this->getLayout()->createBlock('CmsMagento/form_redirect')->toHtml());
        $session->unsQuoteId();
    }

    public function cancelAction() {
        $session = Mage::getSingleton('checkout/session');
        $session->setQuoteId($session->getCmsMagentoStandardQuoteId(true));


        if ($session->getLastRealOrderId()) {
            $order = Mage::getModel('sales/order')->loadByIncrementId($session->getLastRealOrderId());
            if ($order->getId()) {
                $order->setData('state', "closed");
                $order->setStatus("closed");
                $history = $order->addStatusHistoryComment('Order marked as Canceled Deposit.', false);
                $history->setIsCustomerNotified(false);
                $order->save();
            }
        }


        Mage::getSingleton('checkout/session')->addError("Thank you for shopping with us. However, the transaction has been canceled.");
        $this->_redirect('checkout/cart');
    }
	
	public function failureAction()
	{	
		$session = Mage::getSingleton('checkout/session');
        $session->setQuoteId($session->getCmsMagentoStandardQuoteId(true));


        if ($session->getLastRealOrderId()) {
            $order = Mage::getModel('sales/order')->loadByIncrementId($session->getLastRealOrderId());
            if ($order->getId()) {
                $order->cancel()->save();
                $history = $order->addStatusHistoryComment('Order marked as Transaction Failed.', false);
                $history->setIsCustomerNotified(false);
                $order->save();
            }
        }


        Mage::getSingleton('checkout/session')->addError("Transaction failed. Please try again later!");
        $this->_redirect('checkout/cart');
		
		
			/*$lastQuoteId = $this->getOnepage()->getCheckout()->getLastQuoteId();
			$lastOrderId = $this->getOnepage()->getCheckout()->getLastOrderId();

			if(Mage::getSingleton('checkout/session')->getLastRealOrderId()){
				if ($lastQuoteId = Mage::getSingleton('checkout/session')->getLastQuoteId()){
					$quote = Mage::getModel('sales/quote')->load($lastQuoteId);
					$quote->setIsActive(true)->save();
				}
				Mage::getSingleton('core/session')->addError(Mage::helper('module_name')->__('Inform the customer for failed transaction'));
				$this->_redirect('checkout/cart'); //Redirect to cart
				return;
			}

			if (!$lastQuoteId || !$lastOrderId) {
				$this->_redirect('checkout/cart');
				return;
			}

			$this->loadLayout();
			$this->renderLayout();*/
	}

    public function successAction() {
        $status = true;
        $authDesc = "N";

        if (!$this->getRequest()->isPost()) {
            $this->cancelAction();
            return false;
        }

        $response = $this->getRequest()->getPost();
        if (empty($response)) {
            $status = false;
        }

        
        if (isset($response["amount"]))
            $amount = $response["amount"];
        if (isset($response["desc"]))
            $order_Id = $response["desc"];
        if (isset($response["newchecksum"]))
            $checksum = $response["newchecksum"];
        if (isset($response["status"]))
            $authDesc = $response["status"];

        $order = Mage::getModel('sales/order')->loadByIncrementId($order_Id);
        if (!$order) {
            return;
        }

        if ($authDesc == "Y") {
            // $order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true, 'Payment Success.');
            // $order->save();
                $order->setData('state', "complete");
                $order->setStatus("complete");
                $history = $order->addStatusHistoryComment('Order marked as Transaction Successful.', false);
                $history->setIsCustomerNotified(false);
                $order->save();
        } else if ($authDesc == "N") {
            $this->getCheckout()->setCmsMagentoErrorMessage('Payment Failed');
            $this->failureAction();
            return false;
        }	 else if ($authDesc == "C") {
            $this->getCheckout()->setCmsMagentoErrorMessage('Payment Cancelled');
            $this->cancelAction();
            return false;
        }

        $f_passed_status = Mage::getStoreConfig('payment/CmsMagento/payment_success_status');
        $message = Mage::helper('CmsMagento')->__('Your payment is authorized.');

        $payment_confirmation_mail = Mage::getStoreConfig('payment/CmsMagento/payment_confirmation_mail');
        if ($payment_confirmation_mail == "1") {
            $order->sendOrderUpdateEmail(true, 'Your payment is authorized.');
        }

        $order->save();
        $session = Mage::getSingleton('checkout/session');
        $session->addError("Thank you for shopping with us. Your account has been charged and your transaction is successful. We will be shipping your order to you soon.");
        $session->setQuoteId($session->getCmsMagentoStandardQuoteId(true));

        Mage::getSingleton('checkout/session')->getQuote()->setIsActive(false)->save();
        $this->_redirect('checkout/onepage/success', array('_secure' => true));
        
       
        
    }

    public function errorAction() {
        $this->_redirect('checkout/onepage/');
    }

    public function getCheckout() {
        return Mage::getSingleton('checkout/session');
    }

}
