# There are three sample files
1. dopayment.php
2. delivery.php
3. response.php

1. dopayment.php
This file executes following steps:
- Authenticate merchant via web service
- Post transaction details to gateway payment page

2. delivery.php
This file executes following steps:
- Grab POST values POSTED by gateway 
- Check transaction status against Gateway Reference No. (GTWREFNO)
- Execute steps according to transaction status

3. response.php
This is the url where gateway will redirect after executing transaction. 
Following steps should be performed:
- Grab POST values POSTED by gateway
- Query your database against your transaction ID
- Execute steps according to transaction status


	