<?php
//define('SITE_EMAIL', 'wolfgang.sladkowski@gmail.com');

	require_once('connectivity.php');
//	require_once('../mail/class.phpmailer.php');
	require_once("../PHPMailer/PHPMailerAutoload.php");
	function clean($string)
	{
	   /*$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.*/
	   return preg_replace('/[^A-Za-z0-9\-_\.]/', ' ', $string); // Removes special chars.
	}
	//10-Aug-16 Use PATA email
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
/* No need
	$edateo = mysql_query("select* from emaildate where emaildate_status = 'Y'");
	if(mysql_num_rows($edateo)>0)
	{
		if($edateoo=mysql_fetch_array($edateo))
		{
			$allemail=$edateoo['allemail'];
		}
	}
*/	
	$from=$_POST['txtmfrom'];
	$to=$_POST['txtmto'];
	//$to='alethiclogicemp@gmail.com';
	$subject=clean($_POST['txtmsubject']);
	$slot=$_POST['hidslot'];
	$mode=$_POST['hidmode'];
	$hidid=$_POST['hidid'];
	$message=clean($_POST['hidmsg']);
	$sname=$_POST['sname'];
	$person="";
	$msg ="";
	
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
	<div> Dear ".$tcomName.",</div>
	<br>
	<div>".$message."</div>
	<br><b>Please accept and confirm my appointment request by replying to this email directly.</b>
	<br><br>
	Regards,
	<br>".$sname."<br>
	".$_POST['hidcomname']."
	";

	$message = $msg;
	
// 10-Aug-16 send mail use PATA.org email server
    $xmail = new PHPMailer;

    $xmail->SMTPDebug = 0;  // For degun set = 5

    $xmail->isSMTP();
    $xmail->Host = $shost;
    $xmail->SMTPAuth = true;
    $xmail->Username = 'events@pataprodigy.org';
    $xmail->Password = $dpword;
	$xmail->SMTPSecure = 'ssl';
    $xmail->Port = $sport; // '587'

    $xmail->setFrom($duname, 'PATA Adventure Travel Mart');
    $xmail->addAddress($to, $tcomName);
    $xmail->addReplyTo($from, $sname);
	$xmail->addCC($femail, 'PATA Adventure Travel Mart');
	
    $xmail->isHTML(true);

    $xmail->Subject = $subject;
    $xmail->Body    = $message;

    if(!$xmail->send())
    {
        echo 'Mailer error: ' . $xmail->ErrorInfo;
    }	
	//echo $msg;
	if($mode == 'B')
	{
		header("location:../availableslotseller.php?slot=".$slot."&selcompany=".$_POST['hidcom']."&selcountryse=".$_POST['hidcon']);
	}
	else
	{
		header("location:../availableslotbuyer.php?slot=".$slot."&selcompany=".$_POST['hidcom']."&selcountryse=".$_POST['hidcon']);
	}

?>
