<!--
This PHP script outputs the cryptographic hash of a password using SHA512.
Originally created by Ron Coleman.
Revision history:
Who	Date		Comment
RC	11-Nov-13	Created.
-->
<?php
$passw = 'gaze11e' ;

$passw_hashed = hash('sha512', $passw);

echo strtoupper($passw_hashed) . '<BR>' ;

echo 'Length = ' . strlen($passw_hashed) . '<BR>' ;
?>