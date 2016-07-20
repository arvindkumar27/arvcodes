<?php
//echo "Hi";
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
function combArrToXML($arrC=array(), $root="root", $element="element"){
  $doc = new DOMDocument();
  $doc->formatOutput = true;

  $r = $doc->createElement( $root );
  $doc->appendChild( $r );

  $b = $doc->createElement( $element );
  foreach( $arrC as  $key => $val)
  {
    $$key = $doc->createElement( $key );
    $$key->appendChild(
      $doc->createTextNode( $val )
    );
    $b->appendChild( $$key );
    $r->appendChild( $b );
  }

  return $doc->saveXML();
}

function array_to_xml( $data, &$xml_data ) {
    foreach( $data as $key => $value ) {
		//print_r($value);echo "<br>";
		//if(isset($value) && !empty($value)) {
			if( is_array($value) ) {
				if( is_numeric($key) ){
					$key = 'item'; //dealing with <0/>..<n/> issues
				}
				$subnode = $xml_data->addChild($key);
				array_to_xml($value, $subnode);
			} else {
				$xml_data->addChild("$key",htmlspecialchars("$value"));
			}
		//}
     }
}

    function vendorTxCode($orderId = 1468753836 , $type = "PAYMENT", $prefix = "protxross")
    {
        $parts = array();
        // add prefix
        if (!empty($prefix))
        {
            $parts[] = $prefix;
        }
        // add type
        if (!empty($type))
        {
            $parts[] = $type;
        }
        // add order id
        if (!empty($orderId))
        {
            $parts[] = $orderId;
        }

        $parts[] = rand(0, 1000000000);
        $vendorTxCode = implode('-', $parts);
        
        while (strlen($vendorTxCode) > 40)
        {
            array_shift($parts);
            $vendorTxCode = implode('-', $parts);
        }
        return $vendorTxCode;
    }
	
    function arrayToQueryString(array $data, $delimiter = '&', $urlencoded = false)
    {
        $queryString = '';
        $delimiterLength = strlen($delimiter);

        // Parse each value pairs and concate to query string
        foreach ($data as $name => $value)
        {   
            // Apply urlencode if it is required
            if ($urlencoded)
            {
                $value = urlencode($value);
            }
            $queryString .= $name . '=' . $value . $delimiter;
        }

        // remove the last delimiter
        return substr($queryString, 0, -1 * $delimiterLength);
    }


	

$SagepayItem = array();
$item_1 = array(
                    "description" => "Shaolin Soccer",
                    "productSku" => "DVD1SKU",
                    "productCode" =>  "1236871",
                    "quantity" => "1",
                    "unitNetAmount" => "9.95",
                    "unitTaxAmount" => "0.25",
                    "unitGrossAmount" => "10.20",
                    "totalGrossAmount" => "10.20",
                    "recipientFName" => "",
                    "recipientLName" => "",
                    "recipientMName" => "",
                    "recipientSal" => "",
                    "recipientEmail" => "", 
                    "recipientPhone" => "",
                    "recipientAdd1" => "",
                    "recipientAdd2" => "",
                    "recipientCity" => "",
                    "recipientState" => "",
                    "recipientCountry" => "", 
                    "recipientPostCode" => "",
                    "itemShipNo" => "",
                    "itemGiftMsg" => "");
$item_2 = array(
                    "description" => "Batman - The Dark Knight",
                    "productSku" => "DVD2SKU",
                    "productCode" =>  "9256370",
                    "quantity" => "2",
                    "unitNetAmount" => "10.99",
                    "unitTaxAmount" => "0.50",
                    "unitGrossAmount" => "11.49",
                    "totalGrossAmount" => "22.98",
                    "recipientFName" => "",
                    "recipientLName" => "",
                    "recipientMName" => "",
                    "recipientSal" => "",
                    "recipientEmail" => "", 
                    "recipientPhone" => "",
                    "recipientAdd1" => "",
                    "recipientAdd2" => "",
                    "recipientCity" => "",
                    "recipientState" => "",
                    "recipientCountry" => "", 
                    "recipientPostCode" => "",
                    "itemShipNo" => "",
                    "itemGiftMsg" => "");	
$SagepayItem[] = $item_1;	
$SagepayItem[] = $item_2;	

		
$basket = array(
				//"id"=> 1468750270,
				//"description"=> "DVDs from Sagepay Demo Page",
				"agentId"=> "protxross",
				"items"=> $SagepayItem,
				"deliveryNetAmount"=> "1.50",
				"deliveryTaxAmount"=> "0.05", 
				"deliveryGrossAmount"=> "1.55",
				"discounts"=>array(),
				"shipId"=> "",
				"shippingMethod"=> "",
				"shippingFaxNo"=> "",
				"tourOperator"=> "",
				"carRental"=> "",
				"hotel"=> "",
				"cruise"=> "1",
				"airline"=> "",
				"dinerCustomerRef"=> "",
				"carRental"=> "",
				"deliveryGrossAmount"=> "",
				"exportFields"=> array());	
				
$surcharges = array();
$surcharges[] = array("paymentType" => "MC", "percentage" => 5 );
$surcharges[] = array("paymentType" => "VISA", "percentage" => 3.5 );

					//SagepayCustomer
$customer = array("customerMiddleInitial" => "", "customerBirth" => "", "customerWorkPhone" => "", "customerMobilePhone" => "", "previousCust" => "", "timeOnFile" => "",
					"customerId" => 2);




// creating object of SimpleXMLElement
$xml_data = new SimpleXMLElement('<customer></customer>');
// function call to convert array to xml
array_to_xml($customer,$xml_data);
//saving generated xml file; 
$CustomerXML = $xml_data->asXML();




// creating object of SimpleXMLElement
$xml_data = new SimpleXMLElement('<basket></basket>');
// function call to convert array to xml
array_to_xml($basket,$xml_data);
//saving generated xml file; 
$basket_xml = $xml_data->asXML();

// creating object of SimpleXMLElement
$xml_data = new SimpleXMLElement('<surcharges></surcharges>');
// function call to convert array to xml
array_to_xml($surcharges,$xml_data);
//saving generated xml file; 
$SurchargeXML = $xml_data->asXML();
		
	

					
$data_arr = array(
					"VPSProtocol" => "3.00",
					"TxType" => "PAYMENT",
					"Vendor" => "protxross",
					"VendorTxCode" => vendorTxCode(),
					"Amount" => 34.73,
					"Currency" => "GBP",
					"Description" => "DVDs from Sagepay Demo Page",
					"NotificationURL" => 'https://www.google.co.in/', //"http://192.168.13.11/VspPHPKit/",
                    "RedirectionURL" => 'https://www.google.co.in/', //"http://192.168.13.11/VspPHPKit/",
					"BillingSurname" => "Surname",
					"BillingFirstnames" => "Fname Mname",
					"BillingAddress1" => "BillAddress Line 1", 
					"BillingCity" => "BillCity",
					"BillingPostCode" => "W1A 1BL",
					"BillingCountry" => "GB",
					"DeliverySurname" => "Surname",
					"DeliveryFirstnames" => "Fname Mname",
					"DeliveryAddress1" => "BillAddress Line 1",
					"DeliveryCity" => "BillCity",
					"DeliveryPostCode" => "W1A 1BL",
					"DeliveryCountry" => "GB",
					"StoreToken" => 1,
					"CustomerName" => "Fname Mname Surname",
					"CustomerEMail" => "customer@example.com",
					"VendorEMail" => "",
					"SendEMail" => 0,
					"eMailMessage" => "",
					"BillingAddress2" => "BillAddress Line 2",
					"BillingPhone" => "44 (0)7933 000 000",
					"ApplyAVSCV2" => 0,
					"Apply3DSecure" => 0,
					"AllowGiftAid" => 0,
					"BillingAgreement" => 1,
					//"CustomerXML" => $CustomerXML,
					"DeliveryAddress2" => "BillAddress Line 2",
					"DeliveryPhone" => "44 (0)7933 000 000",
					///"BasketXML" => $basket_xml,
					//"SurchargeXML" => $SurchargeXML,
					"Profile" => "LOW",
					"AccountType" => "E"
				);

	
		$url = 'https://test.sagepay.com/gateway/service/vspserver-register.vsp';
		set_time_limit(60);
		$output = array();
		$ttl = 30; 
		$caCertPath = '';
		
		$curlSession = curl_init();
		
		
		curl_setopt($curlSession, CURLOPT_URL, $url);
		curl_setopt($curlSession, CURLOPT_HEADER, 0);
		curl_setopt($curlSession, CURLOPT_POST, 1);
		curl_setopt($curlSession, CURLOPT_POSTFIELDS, arrayToQueryString($data_arr));
		curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlSession, CURLOPT_TIMEOUT, $ttl);
		curl_setopt($curlSession, CURLOPT_SSL_VERIFYHOST, 2);

        if (!empty($caCertPath))
        {
            curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($curlSession, CURLOPT_CAINFO, $caCertPath);
        } 
        else
        {
            curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, 0);
        }

        $rawresponse = curl_exec($curlSession);
	// Split response into name=value pairs
	$response = split(chr(10), $rawresponse);
        
        // Check that a connection was made
        if (curl_error($curlSession))
        {
                // If it wasn't...
                $output['Status'] = "FAIL";
                $output['StatusDetail'] = curl_error($curlSession);
        }
        
        // Close the cURL session
        curl_close ($curlSession);
        // Tokenise the response
        for ($i=0; $i<count($response); $i++)
        {
                // Find position of first "=" character
                $splitAt = strpos($response[$i], "=");
                // Create an associative (hash) array with key/value pairs ('trim' strips excess whitespace)
                $output[trim(substr($response[$i], 0, $splitAt))] = trim(substr($response[$i], ($splitAt+1)));
        } 
        // Return the output
        //return $output;
        
        $NextURL =  "";
        if( count($output)>0 ){
            if(isset($output['NextURL']))
                $NextURL =  $output['NextURL'];
        }
        
    print"<pre>";
    print_r($output);
    print"</pre>";

?>
<?php if($NextURL){ ?>
<div id="content">

    <div id="contentHeader">Server Payment</div>
    <div class="greyHzShadeBar">&nbsp;</div>
    <iframe src="<?php echo $NextURL; ?>" style="width: 750px; height: 600px"></iframe>

</div>
<?php } ?>