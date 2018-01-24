<?php
require_once('query/connectivity.php');
session_start();
	if(session_destroy())
	{
		header("location:delegate_login.php?mes=");
	}
?>
