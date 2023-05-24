<?php
# Grab POST variables
$transaction_id = $_REQUEST["MERCHANTTXNID"];
$GTWREFNO = $_REQUEST["GTWREFNO"];	// Reference no provided by gateway

# Query your database with $transaction_id

# Display/execute steps according to status.
?>