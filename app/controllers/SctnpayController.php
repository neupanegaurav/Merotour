<?php

class SctnpayController extends BaseController {
    
 
    
    public function getIndex() {
     		define("MERCHANT_ID","147");
             //define("MERCHANT_USER_NAME","black_ejourneys_uat_user");
            // define("MERCHANT_PASSWORD","blackejourneys@31-api");
          // define("SIGNATURE_PASSCODE","BEJUAT01");
           define("MERCHANT_USER_NAME","socheko_uat");
            define("MERCHANT_PASSWORD","socheko@uat-api");
           define("SIGNATURE_PASSCODE","SOUAT01");
            define("NPAY_SOAP_URL","https://gateway.sandbox.npay.com.np/websrv/Service.asmx?WSDL");
            define("NPAY_GATEWAY_URL","https://gateway.sandbox.npay.com.np/pay.aspx");
# Define other variables
 
    $random = substr( md5(rand()), 0, 16);
    //echo $random;
            $transaction_id = $random;
            $strAmount = '10';
            $description = "Test transaction Transaction ID: " . $transaction_id . " || Amount: " . $strAmount;

            # Hash password with SHA256. Combination = MERCHANT_USER_NAME + MERCHANT_PASSWORD
            $sha256Pwd = hash ("sha256", MERCHANT_USER_NAME . MERCHANT_PASSWORD);
           // var_dump($sha256Pwd); die();

            # Hash signature with SHA256. Combination = SIGNATURE_PASSCODE + MERCHANT_USER_NAME + transaction_id
            $signature = hash("sha256", SIGNATURE_PASSCODE . MERCHANT_USER_NAME . $transaction_id);
            //var_dump($signature);die();
            # Initialize webservice with WSDL
            $client = new SoapClient(NPAY_SOAP_URL);
			//var_dump($client); die();
            # Set your parameters for the request
            $params = array(
              "MerchantId" => MERCHANT_ID,
              "MerchantTxnId" => $transaction_id,
              "MerchantUserName" => MERCHANT_USER_NAME,
              "MerchantPassword" => $sha256Pwd,
              "Signature" => $signature,
              "AMOUNT" => $strAmount,
              "purchaseDescription" => $description,
            );

             $response = $client->__soapCall("ValidateMerchant", array($params));
         //  var_dump($response); die();

             if($response->ValidateMerchantResult->STATUS_CODE != "0")
            {
                $STATUS_CODE = $response->ValidateMerchantResult->STATUS_CODE;
                # Error occured while validating merchant. End process.
                die("Error on validating merchant. <br> Error Code: " . $STATUS_CODE . " <br>MESSAGE: " . $response->ValidateMerchantResult->MESSAGE);
            }

              $STATUS_CODE = $response->ValidateMerchantResult->STATUS_CODE;
            $PROCESS_ID = $response->ValidateMerchantResult->PROCESSID;

             

            $data = [
                'url' => NPAY_GATEWAY_URL,
                'process_id' => $PROCESS_ID,
                'merchant_id' => MERCHANT_ID,
                'transaction_id' => $transaction_id,
                'amount' => $strAmount,
                'username' => MERCHANT_USER_NAME,
                'description' => $description
            ];
            //var_dump($data); die();

        
      return View::make('frontend.sctnpay')->with('data', $data);      
    
    }
public function sctnpayDlr()
    {
//var_dump('a'); die();
        $merchanttnxid = Input::get('MERCHANTTXNID');
        $gtwrefno = Input::get('GTWREFNO');
//var_dump($merchanttnxid. '/ '.$gtwrefno ); die();
//use these item for payment after use

        if (empty($merchanttnxid) or empty($gtwrefno)) {
            return 1;
        }

        if (is_null($post = DomesticTickets::where('invoice_no', $merchanttnxid )->first())) {
            return 11;
        }

        $sctnpay = new Sctnpay;

        if (isset($post->pnr_no)) {
            $sctnpay->product_type = 'Airlines';
        }
        $sctnpay->product_id = $post->id;
        $sctnpay->merchanttnxid = $merchanttnxid;
        $sctnpay->gtwrefno = $gtwrefno;

        if (!$sctnpay->save()) {
            return 111;
        }

        $post->payment_method = 'sctnpay';
        $post->payment_status = 'Payment Completed';

        if (!$post->save()) {
            return 1111;
        }

        return 0;

    }
          
     
    
    
}
