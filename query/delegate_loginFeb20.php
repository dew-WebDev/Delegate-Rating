<?php
require_once("connectivity.php");
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$myuname=$_POST['txtuname'];
	$mypword=$_POST['txtpword'];
			try
			{
				$i = mysql_query("select * from delegate_login where user_name='".$myuname."' and password=AES_ENCRYPT('".$mypword."','ALOGIC')");
				if(mysql_num_rows($i) > 0 && $ro = mysql_fetch_assoc($i))
				{
					if($ro['delegate_status'] == 'Y')
					{
						$_SESSION['user_name']=$ro['user_name'];
						$_SESSION['password']=$ro['password'];
						$_SESSION['mode']=$ro['delegate_mode'];

						if($ro['delegate_mode'] == 'S')
						{
							$_SESSION['did']=$ro['seller_com_id'];
							$qry=mysql_query("select * from seller_company where company_id='".$ro['user_name']."'");
							if((mysql_num_rows($qry)>0) && $r=mysql_fetch_array($qry))
							{
								$_SESSION['comname']=$r['company_id']." - ".$r['company_name'];

								$chk="";
								$q=mysql_query("select * from seller_missing_fields where seller_missing_fields_status='Y' and seller_com_id=".$r['seller_com_id']);
								if(mysql_num_rows($q)>0 && $rss=mysql_fetch_array($q))
								{
									$chk=$rss['pavillion_type'];
									$_SESSION['chk']= $rss['pavillion_type'];
								}
								if($chk == 3)
								{
									header("location:../business-calendarsellermicroenterprice.php");
								}
								else
								{
									header("location:../business-calendarseller.php");
								}
								
							}
						}
						else
						{
							$_SESSION['did']=$ro['buyer_com_id'];
							$qry=mysql_query("select * from buyer_company where company_id='".$ro['user_name']."'");
							if((mysql_num_rows($qry)>0) && $r=mysql_fetch_array($qry))
							{
								$_SESSION['comname']=$r['company_id']." - ".$r['company_name'];
$chk="";
								$q=mysql_query("select * from buyer_org_details where buyer_org_status='Y' and buyer_com_id=".$r['buyer_com_id']);
								if(mysql_num_rows($q)>0 && $rss=mysql_fetch_array($q))
								{
									$chk=$rss['one_day_buyer'];
									$_SESSION['chk']= $rss['one_day_buyer'];
								}
								if($chk == 'Y')
								{
									header("location:../business-calendarbuyeroneday.php");
								}
								else
								{
									header("location:../business-calendarbuyer.php");
								}
							}

						}
						
					}
					else
					{
					header("location:../delegate_login.php?mes=Your Account has been Deactivated");
					}
				}
				else
				{
					header("location:../delegate_login.php?mes=Invalid User Name or Password");
				}
				
			}catch(Exception $e)
			{
				header("location:../delegate_login.php?mes=Login Failed");
			}
}
?>

