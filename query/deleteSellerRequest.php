<?php
require_once("connectivity.php");
session_start();
	try
	{
		$qry=mysql_query("delete from temp_delegate_requests where request_mode='B' and buyer_com_id=".$_SESSION['did']." and seller_com_id=".$_GET['id']);

		$q=mysql_query("select count(request_id) as cnt from temp_delegate_requests where seller_com_id=".$_SESSION['did']." and request_mode='S'");
		$cntchk=mysql_result($q,0);
		
		if($_GET['mode']== 1)
		{
			echo $cntchk;
	//		header("location:../appointmentRequestSellerList.php?id=".$_GET['id']);
		}
		else if($_GET['mode'] == 2)
		{
			header("location:../viewAppointmentRequestSeller.php?id=".$_GET['id']);
		}
	}
	catch(Exception $e)
	{
		echo $e;
	}

?>
