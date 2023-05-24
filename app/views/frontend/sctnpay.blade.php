<!DOCTYPE html>
<html>
<head>
    <title>Mero Tour SCTnPay Form</title>
</head>
<body>
    <form   action="http://gateway.sandbox.npay.com.np/pay.aspx" method="post">
      Process ID: <input type="text" value="{{ $data['process_id'] }}" name="processID" /> <br />
      Merchant ID: <input type="text" value="{{ $data['merchant_id'] }}" name="MerchantID" /> <br />
      Transaction ID: <input type="text" value="{{ $data['transaction_id'] }}" name="MerchantTxnID" /> <br />
      Amount: <input type="text" value="{{ $data['amount'] }}" name="PayAmount" /> <br />
      Merchant Username: <input type="text" value="{{ $data['username'] }}" name="MerchantUsername" /> <br />
      Description: <input type="text" value="{{ $data['description'] }}" name="Description" /> <br />
      <input type="submit" value="Pay Sctnpay" name="sctnpay" />
    </form>

    <script type="text/javascript">
        document.getElementById("sctnpay").submit();
    </script>

</body>
</html>