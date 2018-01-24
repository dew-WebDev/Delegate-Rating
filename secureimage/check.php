<?php
session_start();
include_once 'securimage.php';
$securimage = new Securimage();
if ($securimage->check($_GET['code']) == false) 
{
	echo "1";
}
else
{
	echo "2";
}
?>
