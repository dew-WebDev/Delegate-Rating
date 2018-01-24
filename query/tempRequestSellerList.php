<?php
require_once("connectivity.php");
session_start();
	try
	{
		$b=false;

		$q=mysql_query("select buyer_org_id from buyer_org_details where buyer_com_id=".$_SESSION['did']." AND one_day_buyer IN ('Y', 'y', 'T', 't', '1') and buyer_org_status = 'Y'");

		$pack=0;
if(mysql_num_rows($q) > 0)
{
	$pack = 'C';
}
		
		$q=mysql_query("select count(request_id) as cnt from temp_delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='B'");

		$cntchk=mysql_result($q,0);

		if($cntchk < 25 || ($pack !== 'C' && $cntchk < 25))  // Maximum Appointment Selections
		{
			$cntchk+=1;
		
			$qry=mysql_query("select * from temp_delegate_requests where request_mode='B' and requested_delegate_id='".$_SESSION['user_name']."' and seller_com_id=".$_GET['id']);
			if(mysql_num_rows($qry)>0 && $rs=mysql_fetch_array($qry))
			{
				$b=true;
			}
			if(!$b)
			{
				$qry=mysql_query("insert into temp_delegate_requests (buyer_com_id, seller_com_id, request_mode,appointment_order,requested_delegate_id) values (".$_SESSION['did'].", ".$_GET['id'].", 'B',".$cntchk.",'".$_SESSION['user_name']."')");
			}

			$q=mysql_query("select count(request_id) as cnt from temp_delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='B'");
			$cntchk=mysql_result($q,0);
		
			if (isset($_GET['chk']))
			{
				echo $cntchk;
			}
			else
			{
				header("location:../appointmentRequestSellerList.php?id=".$_GET['id']);
			}
		}
		else
		{
			header("location:../appointmentRequestSellerList.php?id=".$_GET['id']."&msg=max");
		}
	}
	catch(Exception $e)
	{
		echo $e;
	}

?>
