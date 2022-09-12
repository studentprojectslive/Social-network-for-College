<?php
session_start();
$otp = rand(100001,999999);
$cstname = $_GET[cstname];
$emailid = $_GET[emailid];
include("phpmailer.php");
$msg = "Hello $cstname, <br><br>
Welcome to ALUMNI TRACKING SYSTEM,<br><br>
Your One-Time-Password (OTP) for Online Auction Registration.<br>
<br>
Your OTP Code is : $otp
<br>
<hr>
<b>Do not share your OTP with anyone.</b>";
sendmail($emailid, $cstname , "OTP for Account Verification", $msg);
echo $otp;
?>