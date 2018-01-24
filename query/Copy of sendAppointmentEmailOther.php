<?php
define('SITE_EMAIL', 'wolfgang.sladkowski@gmail.com');

	require_once('connectivity.php');
	require_once('../mail/class.phpmailer.php');

	$from=$_POST['txtmfrom'];
	$to=$_POST['txtmto'];
	//$to='alethiclogicemp@gmail.com';
	$subject=$_POST['txtmsubject'];
	//$slot=$_POST['hidslot'];
	$mode=$_POST['hidmode'];
	$fk=$_POST['hidfk'];
	$url=$_POST['hidurl'];
	$hidid=$_POST['hidid'];
	$message=$_POST['hidmsg'];
	$person="";
	
		$tcomName="";
		$fcomName="";
		if($mode == 'B')
		{
			$qry=mysql_query("select * from buyer_company where buyer_status='Y' and buyer_com_id=".$hidid);
			if(mysql_num_rows($qry)>0 && $rs=mysql_fetch_array($qry))
			{
				$tcomName=$rs['company_name'];
			}
		}
		else
		{
			$qry=mysql_query("select * from seller_company where seller_status='Y' and seller_com_id=".$hidid);
			if(mysql_num_rows($qry)>0 && $rs=mysql_fetch_array($qry))
			{
				$tcomName=$rs['company_name'];
			}
		}

	
	$msg.="	
	<style>
	.title li
	{
		font-face:arial;
		font-size:10px;
		font-weight:bold;
		list-style:none;
	}
	.buyerheader li
	{
		font-face:arial;
		font-size:10px;
		list-style:none;
	}
	.buyerbody li
	{
		font-face:arial;
		font-size:10px;
		list-style:none;
	}
	.buyerfooter li
	{
		font-face:arial;
		font-size:10px;
		list-style:none;
	}
	div{
		font-face:arial;
		font-size:10px;
		font-size:10pt;
		list-style:none;	
	}
</style>
<br>
	<font face=\"Arial\" size=\"7\" style='font-size:10px; font-size:10pt'>
	<div id='header'> Dear ".$tcomName."
	</div>
	<br>
		<div>".$message."</div>
	</font>
	<h4>
	".$_POST['hidcomname']."
	</h4>
		";

	$message1 = $msg;
	/* To send HTML mail, you can set the Content-type header. */
	$headers1  = "MIME-Version: 1.0\r\n";
	$headers1 .= "Content-type: text/html; charset=iso-8859-1\r\n";
	/* additional headers */
	$headers1 .= "From: <".$from.">\r\n";
	/* and now mail it */
	mail($to, $subject, $msg, $headers1);



	if($mode == 'B')
	{

		if ($_GET['fk'] == 'abl')
		{
			header("location:../advanceBuyerList.php".$url);
		}
		else if ($_GET['fk'] == 'appsl')
		{
			header("location:../appointmentRequestBuyerList.php".$url);
		}
		else if ($_GET['fk'] == 'vappsl')
		{
			header("location:../viewAppointmentRequestBuyer.php".$url);
		}
		else if ($_GET['fk'] == 'cars')
		{
			header("location:../confirmAppointmentRequestBuyer.php".$url);
		}
		else if ($_GET['fk'] == 'rrs')
		{
			header("location:../rejectAppointmentRequestBuyer.php".$url);
		}
		else if ($_GET['fk'] == 'avsu')
		{
			header("location:../availableslotseller.php".$url);
		}
		else if ($_GET['fk'] == 'adbc')
		{
			header("location:../advanceBuyerCancellationList.php".$url);
		}
		else if ($_GET['fk'] == 'nbc')
		{
			header("location:../advanceNewBuyerList.php".$url);
		}
		else
		{
			header("location:../availableslotseller.php".$url);
		}


	}
	else
	{

		if ($fk == 'asl')
		{
			header("location:../advanceSellerList.php".$url);
		}
		else if ($fk == 'appsl')
		{
			header("location:../appointmentRequestSellerList.php".$url);
		}
		else if ($fk == 'vappsl')
		{
			header("location:../viewAppointmentRequestSeller.php".$url);
		}
		else if ($fk == 'cars')
		{
			header("location:../confirmAppointmentRequestSeller.php".$url);
		}
		else if ($fk == 'rrs')
		{
			header("location:../rejectAppointmentRequestSeller.php".$url);
		}
		else if ($fk == 'avbu')
		{
			header("location:../availableslotbuyer.php".$url);
		}
		else if ($fk == 'adsc')
		{
			header("location:../advanceSellerCancellationList.php".$url);
		}
		else if ($fk == 'nsc')
		{
			header("location:../advanceNewSellerList.php".$url);
		}
		else
		{
			header("location:../availableslotbuyer.php".$url);
		}	
	
	}

?>