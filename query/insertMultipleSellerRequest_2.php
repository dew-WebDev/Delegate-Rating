<?php

$link = mysql_connect("localhost","mart_ptm","viroj$$11");
mysql_select_db("mart_ptm_2015", $link);

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
			
			mysql_query("delete from temp_delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='B'");
			
			for($i=1;$i<=$cnt;$i++)
			{
				if (isset($_POST['hidid'.$i]))
				{
					$qry=mysql_query("insert into temp_delegate_requests (buyer_com_id, seller_com_id, request_mode,appointment_order,requested_delegate_id) values (".$_SESSION['did'].", ".$_POST['hidid'.$i].", 'B', ".$i.",'".$_SESSION['user_name']."')");
				}
			}
			header("location:../viewAppointmentRequestSeller.php");
		}
		else if($_POST['hidmode'] == '2')
		{
			$cnt=$_POST['hidcount'];
			
			mysql_query("delete from temp_delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='B'");
			mysql_query("delete from delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='B'");
			
			for($i=1;$i<=$cnt;$i++)
			{
				if (isset($_POST['hidid'.$i]))
				{
					$qry=mysql_query("insert into delegate_requests (buyer_com_id, seller_com_id, request_mode,appointment_order,requested_delegate_id) values (".$_SESSION['did'].", ".$_POST['hidid'.$i].", 'B', ".$i.",'".$_SESSION['user_name']."')");
				}
			}


$bcid=$_SESSION['did'];
$cid=$_SESSION['comname'];
$EMail_A="";
$EMail_B="";


			$qry=mysql_query("select * from buyer_company where buyer_com_id=".$bcid);
			if(mysql_num_rows($qry)>0 && $rs=mysql_fetch_array($qry))
			{
				$EMail_A=$rs['EMail_A'];
				$EMail_B=$rs['EMail_B'];
			}

			if($EMail_A != '')
			{	
				sendmailAdmin($_POST['EMail_A'],$bcid,$cid, $_POST['Prefix_A'].". ".$_POST['FirstName_A']." ".$_POST['LastName_A'], $_POST['JobTitle_A']);
			}
			if($EMail_B != '')
			{	
				sendmailAdmin($_POST['EMail_B'],$bcid,$cid, $_POST['Prefix_B'].". ".$_POST['FirstName_B']." ".$_POST['LastName_B'], $_POST['JobTitle_B']);
			}	
		
			sendmailAdmin(SITE_EMAIL,$bcid,$cid, "", "");
			sendmailAdmin("PTM@pata.org",$bcid,$cid, "", "");
			//sendmailAdmin("alethiclogicemp@gmail.com",$bcid,$cid, "", "");
			sendmailAdmin($allemail,$bcid,$cid, "", "");

			header("location:../confirmAppointmentRequestSeller.php");
		}
	}
	catch(Exception $e)
	{
		echo $e;
	}


	function sendmailAdmin($to,$id,$comid,$fullname, $position)
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
			$qry=mysql_query("select * from buyer_company where buyer_com_id=".$id);
			if(mysql_num_rows($qry)>0 && $rs=mysql_fetch_array($qry))
			{
				$comName=$rs['company_name'];
			}
	
		$to1= SITE_EMAIL;
		$subject1 = "".$ptm_year." : Thank you for your submission of online request (".$comid.")";
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
		<div id='header'>";
		$qry=mysql_query("select * from buyer_missing_fields where buyer_com_id=".$id." and buyer_missing_fields_status = 'Y'");
		if(mysql_num_rows($qry)>0 && $rs=mysql_fetch_array($qry))
		{
			$msg.= "Dear ".str_replace("\\","",($fullname == "" ? $rs['Prefix_A'].". ".$rs['FirstName_A']." ".$rs['LastName_A'] : $fullname)).",<br>";	
		}
	$msg.="

		</div>
		<br>
			<div>
<p style='text-align:justify'>
Thank you very much for submitting your business appointment request.
This is an automatic generated acknowledgement of your submission.
Please note that you may access the same web page on July 28-31 with the same username and password to reject any unwanted requests and submit them to PATA for business matching.  Please understand that PATA will seek to match all appointments using a computerised software based on 3 criteria in order of: Mutual (Buyer & Seller) request, Buyer request and Seller request.<br>
Your PTM".$ptm_year." Business Calendar will be available on www.PATA.org/mart for you to view and download by August 22 (Friday).</p><br>
				Thank you.<br>
				PATA Events<br>
				Bangkok, Thailand
				</div>
		</font>
			";

		$message1 = $msg;
		/* To send HTML mail, you can set the Content-type header. */
		$headers1  = "MIME-Version: 1.0\r\n";
		$headers1 .= "Content-type: text/html; charset=iso-8859-1\r\n";
		/* additional headers */
		$headers1 .= "From: PATA Adventure Travel Mart <".$femail.">\r\n";

		/* and now mail it */

		mail($to, $subject1, $message1, $headers1);
	}

?>
