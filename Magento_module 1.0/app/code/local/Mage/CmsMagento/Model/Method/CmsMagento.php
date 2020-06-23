<?php
/**
*************************************************************************************
 Please Do not edit or add any code in this file without permission.

Magento version 1.9.0.1                 CmsMagento Version 1.0
                              
Module Version. cms-1.0                 Module release: May 2017
**************************************************************************************
*/


class Mage_CmsMagento_Model_Method_CmsMagento extends Mage_Payment_Model_Method_Abstract
{
    protected $_formBlockType = 'CmsMagento/form_CmsMagento';
    protected $_infoBlockType = 'CmsMagento/info_CmsMagento';
    protected $_canSaveCmsMagento     = false;
	protected $_code  = 'CmsMagento';

   
    public function assignData($data)
    {
		if (!($data instanceof Varien_Object)) {
            $data = new Varien_Object($data);
        }
        $info = $this->getInfoInstance();
        $info->setCmsMagentoType($this->getCmsMagentoAccountId1())	
			->settoid($data->gettoid())
			->setpartenerid($data->getpartenerid())
			->setipaddr($data->getipaddr())
			->setpctype($data->getpctype())
			->setdescription($data->getdescription())
			->setamount($data->getamount())
			->setCurrency_code($data->getCurrency_code())
			->setShipping($data->getShipping())
			->setchecksum($data->getchecksum())
			->setTax($data->getTax())
			->setTMPL_street($data->getTMPL_street())
			->setTMPL_city($data->getTMPL_city())
			->setTMPL_state($data->getTMPL_state())
			->setTMPL_COUNTRY($data->getTMPL_COUNTRY())
			->setTMPL_zip($data->getTMPL_zip())
			->setTMPL_IN($data->getTMPL_IN())
			->setTMPL_telno($data->getTMPL_telno())
			->setTMPL_telnocc($data->getTMPL_telnocc())
			->setTMPL_emailaddr($data->getTMPL_emailaddr())
			->setorderdescription($data->getorderdescription())
			->setreservedField1($data->getreservedField1())
			->setreservedField2($data->getreservedField2())
			->settotype($data->gettotype())
			->setpaymenttype($data->getpaymenttype())
			->setcardtype($data->getcardtype())
			->setTMPL_AMOUNT($data->getTMPL_AMOUNT())
			->setTMPL_CURRENCY($data->getTMPL_CURRENCY())
			->setredirecturl($data->getredirecturl());
		
        return $this;
    }

    
    public function prepareSave()
    {
        $info = $this->getInfoInstance();
        if ($this->_canSaveCmsMagento) {
            $info->setCmsMagentoNumberEnc($info->encrypt($info->getCmsMagentoNumber()));
        }
        $info->setCmsMagentoNumber(null)
            ->setCmsMagentoCid(null);
        return $this;
    }
	public function getProtocolVersion()
    {
        return '1.0';
    }
	
	
    public function getSession()
    {
        return Mage::getSingleton('CmsMagento/session');
    }

    
    public function getCheckout()
    {
        return Mage::getSingleton('checkout/session');
    }
	
    public function getQuote()
    {
        
	    return $this->getCheckout()->getQuote();
    }
	
	public function getStandardCheckoutFormFields($option = '')
    {
       
	    if ($this->getQuote()->getIsVirtual()) {
            $a = $this->getQuote()->getBillingAddress();
            $b = $this->getQuote()->getShippingAddress();
        } else {
            $a = $this->getQuote()->getShippingAddress();
            $b = $this->getQuote()->getBillingAddress();
        }



		$data=$this->getQuoteData($option);
		
		
		/********************************************/
			
					$country_code = array(
					"AF"=>"093", 
					"AX"=>"358", 
					"AL"=>"355",
					"DZ"=>"231",
					"AS"=>"684",
					"AD"=>"376",
					"AO"=>"244",
					"AI"=>"001",
					"AQ"=>"000",
					"AG"=>"001",
					"AR"=>"054",
					"AM"=>"374",
					"AW"=>"297",
					"AU"=>"061",
					"AT"=>"043",
					"AZ"=>"994",
					"BS"=>"001",
					"BH"=>"973",
					"BD"=>"880",
					"BB"=>"001",
					"BY"=>"375",
					"BE"=>"032",
					"BZ"=>"501",
					"BJ"=>"229",
					"BM"=>"001",
					"BT"=>"975",
					"BO"=>"591",
					"BA"=>"387",
					"BW"=>"267",
					"BV"=>"000",
					"BR"=>"055",
					"IO"=>"246",
					"VG"=>"001",
					"BN"=>"673",
					"BG"=>"359",
					"BF"=>"226",
					"BI"=>"257",
					"KH"=>"855",
					"CM"=>"237",
					"CA"=>"001",
					"CV"=>"238",
					"KY"=>"001",
					"CF"=>"236",
					"TD"=>"235",
					"CL"=>"056",
					"CN"=>"086",
					"CX"=>"061",
					"CC"=>"061",
					"CC"=>"061",
					"CO"=>"057",
					"KM"=>"269",
					"CK"=>"682",
					"CR"=>"506",
					"CI"=>"225",
					"HR"=>"385",
					"CU"=>"053",
					"CY"=>"357",
					"CZ"=>"420",
					"CD"=>"243",
					"DK"=>"045",
					"DJ"=>"253",
					"DM"=>"001",
					"DO"=>"001",
					"EC"=>"593",
					"EG"=>"020",
					"SV"=>"503",
					"GQ"=>"240",
					"ER"=>"291",
					"EE"=>"372",
					"ET"=>"251",
					"FK"=>"500",
					"FO"=>"298",
					"FJ"=>"679",
					"FI"=>"358",
					"FR"=>"033",
					"GF"=>"594",
					"PF"=>"689",
					"TF"=>"000",
					"GA"=>"241",
					"GM"=>"220",
					"GE"=>"995",
					"DE"=>"049",
					"GH"=>"233",
					"GI"=>"350",
					"GR"=>"030",
					"GL"=>"299",
					"GD"=>"001",
					"GP"=>"590",
					"GU"=>"001",
					"GT"=>"502",
					"GG"=>"000",
					"GN"=>"224",
					"GW"=>"245",
					"GY"=>"592",
					"HT"=>"509",
					"HM"=>"672",
					"HN"=>"504",
					"HK"=>"852",
					"HU"=>"036",
					"IS"=>"354",
					"IN"=>"091",
					"ID"=>"062",
					"IR"=>"098",
					"IQ"=>"964",
					"IE"=>"353",
					"IL"=>"972",
					"IT"=>"039",
					"JM"=>"001",
					"JP"=>"081",
					"JE"=>"044",
					"JO"=>"962",
					"KZ"=>"007",
					"KE"=>"254",
					"KI"=>"686",
					"KW"=>"965",
					"KG"=>"996",
					"LA"=>"856",
					"LV"=>"371",
					"LB"=>"961",
					"LS"=>"266",
					"LR"=>"231",
					"LY"=>"218",
					"LI"=>"423",
					"LT"=>"370",
					"LU"=>"352",
					"MO"=>"853",
					"MK"=>"389",
					"MG"=>"261",
					"MW"=>"265",
					"MY"=>"060",
					"MV"=>"960",
					"ML"=>"223",
					"MT"=>"356",
					"MH"=>"692",
					"MQ"=>"596",
					"MR"=>"222",
					"MU"=>"230",
					"YT"=>"269",
					"MX"=>"052",
					"FM"=>"691",
					"MD"=>"373",
					"MC"=>"377",
					"MN"=>"976",
					"ME"=>"382",
					"MS"=>"001",
					"MA"=>"212",
					"MZ"=>"258",
					"MM"=>"095",
					"NA"=>"264",
					"NR"=>"674",
					"NP"=>"977",
					"AN"=>"599",
					"NL"=>"031",
					"NC"=>"687",
					"NZ"=>"064",
					"NI"=>"505",
					"NE"=>"227",
					"NG"=>"234",
					"NU"=>"683",
					"NF"=>"672",
					"KP"=>"850",
					"MP"=>"001",
					"NO"=>"047",
					"OM"=>"968",
					"PK"=>"092",
					"PW"=>"680",
					"PS"=>"970",
					"PA"=>"507",
					"PG"=>"675",
					"PY"=>"595",
					"PE"=>"051",
					"PH"=>"063",
					"PN"=>"064",
					"PL"=>"048",
					"PT"=>"351",
					"PR"=>"001",
					"QA"=>"974",
					"CG"=>"242",
					"RE"=>"262",
					"RO"=>"040",
					"RU"=>"007",
					"RW"=>"250",
					"BL"=>"590",
					"SH"=>"290",
					"KN"=>"001",
					"LC"=>"001",
					"MF"=>"590",
					"PM"=>"508",
					"VC"=>"001",
					"WS"=>"685",
					"SM"=>"378",
					"ST"=>"239",
					"SA"=>"966",
					"SN"=>"221",
					"RS"=>"381",
					"SC"=>"248",
					"SL"=>"232",
					"SG"=>"065",
					"SK"=>"421",
					"SI"=>"386",
					"SB"=>"677",
					"SO"=>"252",
					"ZA"=>"027",
					"GS"=>"000",
					"KR"=>"082",
					"ES"=>"034",
					"LK"=>"094",
					"SD"=>"249",
					"SR"=>"597",
					"SJ"=>"047",
					"SZ"=>"268",
					"SE"=>"046",
					"CH"=>"041",
					"SY"=>"963",
					"TW"=>"886",
					"TJ"=>"992",
					"TZ"=>"255",
					"TH"=>"066",
					"TL"=>"670",
					"TG"=>"228",
					"TK"=>"690",
					"TO"=>"676",
					"TT"=>"001",
					"TN"=>"216",
					"TR"=>"090",
					"TM"=>"993",
					"TC"=>"001",
					"TV"=>"688",
					"UG"=>"256",
					"UA"=>"380",
					"AE"=>"971",
					"GB"=>"044",
					"US"=>"001",
					"VI"=>"001",
					"UY"=>"598",
					"UZ"=>"998",
					"VU"=>"678",
					"VA"=>"379",
					"VE"=>"058",
					"VN"=>"084",
					"WF"=>"681",
					"EH"=>"212",
					"YE"=>"967",
					"ZM"=>"260",
					"ZW"=>"263"
					);
			
			/*******************************************/
			
		
		
        $sArr = array(	
		    'toid' => $data['toid'],
		    'partenerid' => $data['partenerid'],
		    'pctype' => "1_1|1_2",
		    'paymenttype' => "",
		    'cardtype' => "",
		   
		    'ipaddr' => $data['ipaddr'],
		    'totype' => $data['totype'],
    		'description' => $data['description'],
			'amount' => $data['amount'],
			'currency_code' => 	$data['currency_code'],
			'shipping'=>$data['shipping'],
			'tax'=>$data['tax'],
			'checksum'=>$data['checksum'],
			'TMPL_street'  		=> $data['TMPL_street'],
			'TMPL_city' 			=> $data['TMPL_city'],
			'TMPL_COUNTRY' 			=> $data['TMPL_COUNTRY'],
			'TMPL_state'    		=> $data['TMPL_state'],
			'TMPL_zip'      		=> $data['TMPL_zip'],
			'TMPL_IN'  		=> $data['TMPL_IN'],
			'TMPL_telno'      		=> $data['TMPL_telno'],
			$country_value = $country_code[$data['TMPL_COUNTRY']],
			'telnocc'      		=> $country_value,
			'TMPL_emailaddr'    		=> $data['TMPL_emailaddr'],
			'redirecturl'              	=> $data['redirecturl'],
			'orderdescription'              	=> $data['orderdescription'],
			'toid'              	=> $data['toid'],
			'totype'              	=> $data['totype'],
			'reservedField1'              	=> $data['reservedField1'],
			'reservedField2'              	=> $data['reservedField2'],
			'paymenttype'              	=> $data['paymenttype'],
			'cardtype'              	=> $data['cardtype'],			
			
			'TMPL_CURRENCY'              	=> $data['TMPL_CURRENCY'],	
				
			);
			
			 /* echo "<pre>";
		     print_r($sArr);
			 echo "</pre>";
			 exit(); */
        $sReq = '';
        $rArr = array();
        foreach ($sArr as $k=>$v) {
           
            $value =  str_replace("&","and",$v);
            $rArr[$k] =  $value;
            $sReq .= '&'.$k.'='.$value;
        }
        return $rArr;
    }

    public function getCmsMagentoUrl()
    {    
		 $url=$this->_getCmsMagentoConfig()->getCmsMagentoServerUrl();
         return $url;
    }
	
	
	 public function getOrderPlaceRedirectUrl()
    {
	         return Mage::getUrl('CmsMagento/CmsMagento/redirect');
    }

	public function getQuoteData($option = '')
    {					
	
		if ($option == 'redirect') {
    		$orderIncrementId = $this->getCheckout()->getLastRealOrderId();
    		$quote = Mage::getModel('sales/order')->loadByIncrementId($orderIncrementId);
		} else {
			$quote = $this->getQuote();
		}

		$data=array();
				 	
		if ($quote)
		{
			if($quote->getShippingAddress())
			{
				if ($quote->getIsVirtual()) {
					$a = $quote->getBillingAddress();
					$b = $quote->getShippingAddress();
				} else {
					$a = $quote->getShippingAddress();
					$b = $quote->getBillingAddress();
				}
			}
			else
			{
				$a = $quote->getBillingAddress();
				$b = $quote->getBillingAddress();
			}


			$toid = Mage::getStoreConfig('payment/CmsMagento/merchantid');
			$totype = Mage::getStoreConfig('payment/CmsMagento/partnername');
			$description = $this->getCheckout()->getLastRealOrderId();
			$amount2  = Mage::app()->getStore()->roundPrice($quote->getGrandTotal());
			$amount = number_format((float)$amount2, 2, '.', '');
			$key = Mage::getStoreConfig('payment/CmsMagento/workingkey');
			$Url = $this->_getCmsMagentoConfig()->getCmsMagentoRedirecturl();

			$pattern='http://www.';
			if(!(Eregi($pattern,$Url,$reg)))
			eregi_replace('http://', $pattern, $Url);
			$WorkingKey =  Mage::getStoreConfig('payment/CmsMagento/workingkey');
						
		    $str ="$MerchantId|$OrderId|$Amount|$Url|$WorkingKey";
			$adler = 1;
			$BASE =  65521 ;
			
			$s1 = $adler & 0xffff ;
			$s2 = ($adler >> 16) & 0xffff;
			for($i = 0 ; $i < strlen($str) ; $i++)
			{
				$s1 = ($s1 + Ord($str[$i])) % $BASE ;
				$s2 = ($s2 + $s1) % $BASE ;
			
			}
			
			$str = $s2;
			$num = 16;
			$dec ='';
			
			$str = DecBin($str);
			
			for( $i = 0 ; $i < (64 - strlen($str)) ; $i++)
			$str = "0".$str ;
			
			for($i = 0 ; $i < $num ; $i++) 
			{
				$str = $str."0";
				$str = substr($str , 1 ) ;
			}
			$num=$str;
			for ($n = 0 ; $n < strlen($num) ; $n++)
			{
				$temp = $num[$n] ;
				$dec =  $dec + $temp*pow(2 , strlen($num) - $n - 1);
			}

		
			$redirecturl = $this->_getCmsMagentoConfig()->getCmsMagentoRedirecturl();
			$strnew = "$toid|$totype|$amount|$description|$redirecturl|$key";
			$checksum = md5($strnew);


			$AuthDesc = 'N';
			
			$data['toid'] = Mage::getStoreConfig('payment/CmsMagento/merchantid');
			$data['partenerid'] = Mage::getStoreConfig('payment/CmsMagento/partenerid');
			$data['ipaddr'] = Mage::getStoreConfig('payment/CmsMagento/ipaddr');
			$data['totype'] = Mage::getStoreConfig('payment/CmsMagento/partnername');
			$data['description'] = $this->getCheckout()->getLastRealOrderId();
			$data['amount']  = $amount;
			$data['TMPL_CURRENCY']  = $quote->getBaseCurrencyCode();
			$data['TMPL_COUNTRY']  = $quote->getBaseCountry();
			$data['currency_code']  = $quote->getBaseCurrencyCode();
			if($quote->getShippingAmount())
			{
				$data['shipping'] = sprintf('%.2f', $quote->getShippingAmount());
			}
			else
			{
				$data['shipping'] = '0';
			}
			$data['tax']      = sprintf('%.2f', $quote->getTaxAmount());
			//$data['checksum']=$checksum;
			
			if($this->getQuote()->getCustomer())
			{
				$email_id =$this->getQuote()->getCustomer()->getEmail();
			}
			
			$data['TMPL_street'] 		=$b->getStreet(1)."   ".$b->getStreet(2);
			$data['TMPL_city'] 			=$b->getCity();
			$data['TMPL_COUNTRY'] 			=$b->getCountry();
			$data['TMPL_state'] 		=$b->getRegionCode();
			$data['TMPL_zip']   		=$b->getPostcode();
			$data['TMPL_IN'] 		=$b->getCountryModel()->getName();
			$data['TMPL_telno'] 		    =$b->getTelephone();
			$data['TMPL_emailaddr'] 		=$quote->getCustomerEmail();
			$data['orderdescription'] 		='CmsMagento eCommerce Platform';
			$data['totype'] 		=$totype;
			$data['reservedField1'] 		='';
			$data['reservedField2'] 		='';
			
			$data['paymenttype'] 		= "";
			$data['cardtype'] 		= "";
			$data['redirecturl']    =$redirecturl;
			
			$data['checksum']=$checksum;

			}
		 
		return $data; 
	}
	

public function getchecksum($toid,$totype,$amount,$description , $redirecturl,$key)
{
	$strnew = "$toid|$totype|$amount|$description|$redirecturl|$key";
	$generatedChecksum = md5($strnew);
	return $generatedChecksum;
}

	public function verifychecksum($MerchantId,$OrderId,$Amount,$AuthDesc,$CheckSum,$WorkingKey)
	{
		$str = "$MerchantId|$OrderId|$Amount|$AuthDesc|$WorkingKey";
		$adler = 1;
		$adler = $this->adler32($adler,$str);
		
		if($adler == $checkSum)
			return "true" ;
		else
			return "false" ;
	}
	
	public function adler32($adler , $str)
	{
		$BASE =  65521 ;
	
		$s1 = $adler & 0xffff ;
		$s2 = ($adler >> 16) & 0xffff;
		for($i = 0 ; $i < strlen($str) ; $i++)
		{
			$s1 = ($s1 + Ord($str[$i])) % $BASE ;
			$s2 = ($s2 + $s1) % $BASE ;
	
		}
		return $this->leftshift($s2 , 16) + $s1;
	}
	
	public function leftshift($str , $num)
	{
	
		$str = DecBin($str);
	
		for( $i = 0 ; $i < (64 - strlen($str)) ; $i++)
			$str = "0".$str ;
	
		for($i = 0 ; $i < $num ; $i++) 
		{
			$str = $str."0";
			$str = substr($str , 1 ) ;
		}
		return $this->cdec($str) ;
	}
	
	public function cdec($num)
	{
		$dec = '';
		for ($n = 0 ; $n < strlen($num) ; $n++)
		{
		   $temp = $num[$n] ;
		   $dec =  $dec + $temp*pow(2 , strlen($num) - $n - 1);
		}
	
		return $dec;
	}

	 protected function _getCmsMagentoConfig()
    {
        return Mage::getSingleton('CmsMagento/config');
    }
	
	public function isAvailable($quote=null)
    {
        if (is_null($quote)) {
           return false;
        }
		$return = parent::isAvailable($quote);
		if($return==false)return false;
				
		return true;
		
    }	
}
 