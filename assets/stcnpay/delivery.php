<?php
# Merchant are requested to store following information securely
define("MERCHANT_ID","00");
define("MERCHANT_USER_NAME","username");
define("MERCHANT_PASSWORD","password");
define("SIGNATURE_PASSCODE","signid");
define("NPAY_SOAP_URL","http://gateway.sandbox.npay.com.np/websrv/Service.asmx?wsdl");

# Grab POST variables
$transaction_id = $_POST["MERCHANTTXNID"];
$GTWREFNO = $_POST["GTWREFNO"];	// Reference no provided by gateway


# Hash password with SHA256. Combination = MERCHANT_USER_NAME + MERCHANT_PASSWORD
$sha256Pwd = hash("sha256", MERCHANT_USER_NAME . MERCHANT_PASSWORD);

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
  "GTWREFNO" => $GTWREFNO,
);

# Merchant must send query to gateway SOAP to get STATUS against GTWREFNO for transaction verification
# Invoke webservice method with parameters, Function Name: CheckTransactionStatus 
$response = $client->__soapCall("CheckTransactionStatus", array($params));

# Print webservice response
// print_r($response);		// Uncomment to print

# if successfully query executed, STATUS_CODE is returned as 0 (ZERO) else validation error.
if($response->CheckTransactionStatusResponse->STATUS_CODE != "0")
{
	$STATUS_CODE = $response->CheckTransactionStatusResponse->STATUS_CODE;
	# Error occured while validating merchant. End process.
	die("Error occured while getting Transaction STATUS . <br> Error Code: " . $STATUS_CODE . " <br>MESSAGE: " . $response->CheckTransactionStatusResponse->MESSAGE);
}

# Proceed as query execution is successful.
$STATUS_CODE = $response->CheckTransactionStatusResponse->STATUS_CODE;
$TRANSACTION_STATUS = $response->CheckTransactionStatusResponse->TRANSACTION_STATUS;
$AMOUNT = $response->CheckTransactionStatusResponse->AMOUNT;
$MERCHANT_TRANSACTIONID = $response->CheckTransactionStatusResponse->MERCHANT_TRANSACTIONID;
$REMARKS = $response->CheckTransactionStatusResponse->REMARKS;
$GTWREFNO = $response->CheckTransactionStatusResponse->GTWREFNO;

# Check Transaction Status and proceed required steps
if(TRANSACTION_STATUS == "SUCCESS")
{
	// execute transaction success steps
}
else
{
	// execute transaction failure steps
}

# Print '0' (ZERO) value to let gateway know you have received Delivery status successfully.
echo "0";
end();
?>
