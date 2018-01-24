<?php

$link = mysql_connect("localhost","virojm","dujagenat");
mysql_select_db("zadmin_atcm2017", $link);

require_once('../mail/class.phpmailer.php');
require_once("connectivity.php");

session_start();

$edateo = mysql_query("select* from emaildate where emaildate_status = 'Y'");
	if(mysql_num_rows($edateo)>0)
	{
		if($edateoo=mysql_fetch_array($edateo))
		{
			$bussinessconfirm_date=$edateoo['bussinessconfirm_date'];
			$allemail=$edateoo['allemail'];
			$alldate=$edateoo['alldate'];
			$count_end_date=$edateoo['count_end_date'];
			$bussinessconfirm_date=$edateoo['bussinessconfirm_date'];
			$ptmday4=$edateoo['ptmday4'];
			$advance_buyer_list=$edateoo['advance_buyer_list'];
			$rejection_app_date=$edateoo['rejection_app_date'];
			$preadd_list=$edateoo['preadd_list'];
			$ptm_year=$edateoo['ptm_year'];
			$copy_right_year=$edateoo['copy_right_year'];

		}
	}
			
	try
	{
		if($_POST['hidmode'] == '1')
		{
			$cnt=$_POST['hidcount'];
			
			mysql_query("delete from temp_delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='S'");
			
			for($i=1;$i<=$cnt;$i++)
			{
				if (isset($_POST['hidid'.$i]))
				{
					$qry=mysql_query("insert into temp_delegate_requests (seller_com_id, buyer_com_id, request_mode,appointment_order,requested_delegate_id) values (".$_SESSION['did'].", ".$_POST['hidid'.$i].", 'S', ".$i.",'".$_SESSION['user_name']."')");
				}
			}
			header("location:../viewAppointmentRequestBuyer.php");
		}
		else if($_POST['hidmode'] == '2')
		{
			$cnt=$_POST['hidcount'];
			
			mysql_query("delete from temp_delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='S'");
			mysql_query("delete from delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='S'");
			
			for($i=1;$i<=$cnt;$i++)
			{
				if (isset($_POST['hidid'.$i]))
				{
					$qry=mysql_query("insert into delegate_requests (seller_com_id, buyer_com_id, request_mode,appointment_order,requested_delegate_id) values (".$_SESSION['did'].", ".$_POST['hidid'.$i].", 'S', ".$i.",'".$_SESSION['user_name']."')");
				}
			}

$scid=$_SESSION['did'];
$cid=$_SESSION['comname'];
$msid=$_SESSION['msid'];

$txtemail="";
			// Viroj - wrong database table
			//$qry=mysql_query("select * from seller_company where seller_com_id=".$scid);
			//if(mysql_num_rows($qry)>0 && $rs=mysql_fetch_array($qry))
			//{
			//	$txtemail=$rs['txtemail'];
			//}

			$qry=mysql_query("select * from mas_seller where mas_seller_id=".$scid);
			if(mysql_num_rows($qry)>0 && $rs=mysql_fetch_array($qry))
			{
				$txtemail=$rs['email'];
			}
			
			sendmailAdmin($txtemail,$scid,$cid, "", "", "", "", "", $msid);
			
			//sendmailAdmin(SITE_EMAIL,$scid,$cid, "", "", "", "", "", $msid);			
			//sendmailAdmin("alethiclogicemp@gmail.com",$scid,$cid, "", "", "", "", "", $msid);
			
			//sendmailAdmin("PTM@pata.org",$scid,$cid, "", "", "", "", "", $msid);
			
			sendmailAdmin($allemail,$scid,$cid, "", "", "", "", "", $msid);

			header("location:../confirmAppointmentRequestBuyer.php");
		}
		
		

	}
	catch(Exception $e)
	{
		echo $e;
	}



	function sendmailAdmin($to,$id,$comid,$fullname, $position, $org, $address, $CNT_ID, $msid)
	{
		$dsubject="";
		$femail="";
		$qry=mysql_query("select * from emailsettings");
		if(mysql_num_rows($qry)>0)
		{	
			while($rs=mysql_fetch_array($qry))
			{
				$shost=$rs['smtp_host'];
				$sport=$rs['smtp_port'];
				$duname=$rs['default_username'];
				$dpword=$rs['default_password'];
				$dsubject = $rs['default_subject'];
				$femail=$rs['from_email'];
			}
		}
			$comName="";
			$qry=mysql_query("select * from seller_company where seller_com_id=".$id);
			if(mysql_num_rows($qry)>0 && $rs=mysql_fetch_array($qry))
			{
				$comName=$rs['company_name'];
			}
	
		$to1= SITE_EMAIL; 
		//$subject1 = "PTM".$ptm_year." : Thank you for your submission of online request (".$comid.")";
		$subject1 = "ACTM2017: Thank you for your submission of online request (".$comid.")";
		//echo $subject1;
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
	<br><br>
		<font face=\"Arial\" size=\"7\" style='font-size:10px; font-size:10pt'>
			<div id='header'>
			";
	
				$qry=mysql_query("select * from seller_missing_fields where seller_com_id=".$id);
				if(mysql_num_rows($qry)>0 && $rs=mysql_fetch_array($qry))
				{
					$qry1=mysql_query("select * from mas_seller where delegate='1' and mas_seller_id=".$msid." and mas_seller_status = 'Y'");
					if(mysql_num_rows($qry1)>0 && $rs1=mysql_fetch_array($qry1))
					{
						$msg.= "Dear ".str_replace("\\","",($fullname == "" ? $rs1['fullname'] : $fullname)).",<br>";
					}
				}

	$msg.="		
		</div>
				<div>
<p style='text-align:justify'>
Thank you very much for submitting your business appointment request.
This is an automatic generated acknowledgement of your submission.
Please note that you may access the same web page on July 27-30 with the same username and password to reject any unwanted requests and submit them to PATA for business matching.  Please understand that PATA will seek to match all appointments using a computerised software based on 3 criteria in order of: Mutual (Buyer & Seller) request, Buyer request and Seller request.<br>
Your PTM".$ptm_year." Business Calendar will be available on www.PATA.org/mart for you to view and download by August 17 (Monday).</p><br>
				Thank you.<br>
				PATA Events<br>
				Bangkok, Thailand
				</div>
		</font>
				";
				
			//	echo $msg;

		$message1 = $msg;
		$headers1  = "MIME-Version: 1.0\r\n";
		$headers1 .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers1 .= "From: PATA Adventure Travel Mart <".$femail.">\r\n";

		mail($to, $subject1, $message1, $headers1);
	}

?>
