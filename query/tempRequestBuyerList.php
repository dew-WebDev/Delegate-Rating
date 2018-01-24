<?php
require_once("connectivity.php");
session_start();
	try
	{
		$b=false;

		$q=mysql_query("select pavillion_type as ptype from seller_missing_fields where seller_com_id=".$_SESSION['did']." and seller_missing_fields_status = 'Y'");
		$ptype=mysql_result($q,0);
		
		$q=mysql_query("select count(request_id) as cnt from temp_delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='S'");
		$cntchk=mysql_result($q,0);

		if($cntchk < 25 || ($ptype !== '3' && $cntchk < 25))  // Maximum Appointment Selections
		{
			$cntchk+=1;
		
			$qry=mysql_query("select * from temp_delegate_requests where request_mode='S' and requested_delegate_id='".$_SESSION['user_name']."' and buyer_com_id=".$_GET['id']);
			if(mysql_num_rows($qry)>0 && $rs=mysql_fetch_array($qry))
			{
				$b=true;
			}
			
			if(!$b)
			{
				$qry=mysql_query("insert into temp_delegate_requests (seller_com_id, buyer_com_id, request_mode,appointment_order,requested_delegate_id) values (".$_SESSION['did'].", ".$_GET['id'].", 'S',".$cntchk.",'".$_SESSION['user_name']."')");
			}

			$q=mysql_query("select count(request_id) as cnt from temp_delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='S'");
			$cntchk=mysql_result($q,0);
		

			if (isset($_GET['chk']))
			{
				echo $cntchk;
			}
			else
			{
				header("location:../appointmentRequestBuyerList.php?id=".$_GET['id']);
			}
		}
		else
		{
				header("location:../appointmentRequestBuyerList.php?id=".$_GET['id']."&msg=max");
		}
	}
	catch(Exception $e)
	{
		echo $e;
	}

?>
