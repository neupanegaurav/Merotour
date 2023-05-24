<?php
# Merchant are requested to store following information securely
define("MERCHANT_ID","26");
define("MERCHANT_USER_NAME","black_ejourneys_uat_user");
define("MERCHANT_PASSWORD","blackejourneys@31-api");
define("SIGNATURE_PASSCODE","BEJUAT01");
define("NPAY_SOAP_URL","http://gateway.sandbox.npay.com.np/websrv/Service.asmx?wsdl");
define("NPAY_GATEWAY_URL","http://gateway.sandbox.npay.com.np/pay.aspx");

# Define other variables
$transaction_id = "12345";
$strAmount = "100";
$decription = "Test transaction Transaction ID: " . $transaction_id . " || Amount: " . $strAmount;

# Hash password with SHA256. Combination = MERCHANT_USER_NAME + MERCHANT_PASSWORD
$sha256Pwd = hash ("sha256", MERCHANT_USER_NAME . MERCHANT_PASSWORD);

# Hash signature with SHA256. Combination = SIGNATURE_PASSCODE + MERCHANT_USER_NAME + transaction_id
$signature = hash("sha256", SIGNATURE_PASSCODE . MERCHANT_USER_NAME . $transaction_id);

# Initialize webservice with WSDL
$client = new SoapClient(NPAY_SOAP_URL);

# Set your parameters for the request
$params = array(
  "MerchantId" => MERCHANT_ID,
  "MerchantTxnId" => $transaction_id,
  "MerchantUserName" => MERCHANT_USER_NAME,
  "MerchantPassword" => $sha256Pwd,
  "Signature" => $signature,
  "AMOUNT" => $strAmount,
  "purchaseDescription" => $decription,
);

# Invoke webservice method with parameters, Function Name: ValidateMerchant 
$response = $client->__soapCall("ValidateMerchant", array($params));

# Print webservice response
 print_r($response);		// Uncomment to print

# if validated, STATUS_CODE is returned as 0 (ZERO) else validation error.
if($response->ValidateMerchantResult->STATUS_CODE != "0")
{
	$STATUS_CODE = $response->ValidateMerchantResult->STATUS_CODE;
	# Error occured while validating merchant. End process.
	die("Error on validating merchant. <br> Error Code: " . $STATUS_CODE . " <br>MESSAGE: " . $response->ValidateMerchantResult->MESSAGE);
}

# Proceed as authentication is successful.
$STATUS_CODE = $response->ValidateMerchantResult->STATUS_CODE;
$PROCESS_ID = $response->ValidateMerchantResult->PROCESSID;

# Now Post values to the gateway page using HTML form
?>
<html>
<head>
</head>
<body>
<form action="<?php echo NPAY_GATEWAY_URL;?>" method="post" name="sendForm">
    Process ID: <input type="text" value="<?php echo $PROCESS_ID;?>" name="processID" /> <br />
    Merchant ID: <input type="text" value="<?php echo MERCHANT_ID?>" name="MerchantID" /> <br />
    Transaction ID: <input type="text" value="<?php echo $transaction_id?>" name="MerchantTxnID" /> <br />
    Amount: <input type="text" value="<?php echo $strAmount?>" name="PayAmount" /> <br />
    Merchant Username: <input type="text" value="<?php echo MERCHANT_USER_NAME?>" name="MerchantUsername" /> <br />
    Description: <input type="text" value="<?php echo $decription?>" name="Description" /> <br />
    <input type="submit" value="POST DATA" name="posting" />
</form>
    </body>
</html>