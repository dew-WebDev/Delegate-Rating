<?php
//define('SITE_EMAIL', 'wolfgang.sladkowski@gmail.com');

	require_once('connectivity.php');
	require_once('../mail/class.phpmailer.php');
	function clean($string)
	{
	   //$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	   return preg_replace('/[^A-Za-z0-9\-_\.]/', ' ', $string); // Removes special chars.
	}
	$edateo = mysql_query("select* from emaildate where emaildate_status = 'Y'");
	if(mysql_num_rows($edateo)>0)
	{
		if($edateoo=mysql_fetch_array($edateo))
		{
			$allemail=$edateoo['allemail'];
		}
	}
	$from=$_POST['txtmfrom'];
	$to=$_POST['txtmto'];
	//$to='alethiclogicemp@gmail.com';
	$subject=clean($_POST['txtmsubject']);
	//$slot=$_POST['hidslot'];
	$mode=$_POST['hidmode'];
	$fk=$_POST['hidfk'];
	$url=$_POST['hidurl'];
	$hidid=$_POST['hidid'];
	$message=clean($_POST['hidmsg']);
	$sname=$_POST['sname'];
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
	<div id='header'> Dear ".$tcomName.",
	</div>
	<br>
	<div>".$message."</div>
	</b><br><b>Please confirm this appointment request by return email.</b>
	</font>
	<br><br>
	Regards,
	<h4>
	".$sname."<br>
	".$_POST['hidcomname']."
	</h4>";

	$message1 = $msg;
	/* To send HTML mail, you can set the Content-type header. */
	$headers1  = "MIME-Version: 1.0\r\n";
	$headers1 .= "Content-type: text/html; charset=iso-8859-1\r\n";
	/* additional headers */
	$headers1 .= "From: <".$from.">\r\n";
	/* and now mail it */
	mail($to, $subject, $msg, $headers1);
	mail("PTM@pata.org", $subject, $msg, $headers1);
	//mail("alethiclogicemp@gmail.com", $subject, $msg, $headers1);
	mail($allemail, $subject, $msg, $headers1);

	//echo $message1;
	if($mode == 'B')
	{
			header("location:../buyerDetails.php".$url);
	}
	else
	{
			header("location:../sellerDetails.php".$url);			
	}

?>
