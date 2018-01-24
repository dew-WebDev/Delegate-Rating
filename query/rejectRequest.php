<?php
require_once("connectivity.php");
session_start();
	try
	{
		if($_GET['mode'] == 1)
		{
			mysql_query("update delegate_requests set reject='Y' where request_mode='S' and buyer_com_id=".$_SESSION['did']." and seller_com_id=".$_GET['id']);
			
			$q=mysql_query("select count(seller_com_id) as cnt from delegate_requests where buyer_com_id ='".$_SESSION['did']."' and request_mode='S' and reject = 'Y'");
			$cntchk=mysql_result($q,0);
			
			echo $cntchk;
			//header("location:../rejectAppointmentRequestSeller.php");
		}
		else if($_GET['mode'] == 2)
		{
			mysql_query("update delegate_requests set reject='Y' where request_mode='B' and seller_com_id=".$_SESSION['did']." and buyer_com_id=".$_GET['id']);
			
			$q=mysql_query("select count(buyer_com_id) as cnt from delegate_requests where seller_com_id ='".$_SESSION['did']."' and request_mode='B' and reject = 'Y'");
			$cntchk=mysql_result($q,0);
			
			echo $cntchk;
			//header("location:../rejectAppointmentRequestBuyer.php");
		}
	}
	catch(Exception $e)
	{
		echo $e;
	}

?>