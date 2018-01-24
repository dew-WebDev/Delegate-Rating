<?php
session_start();
require_once('connectivity.php');

try
{
	if($_POST['hidmode'] == 'S')
	{
	
		mysql_query("update seller_delegate_detail set extraInfo='".$_POST['etc_txteinfo']."', username='".$_POST['etc_txtuname']."', password=AES_ENCRYPT('".$_POST['etc_txtpword']."','ALOGIC'), pre_addendum='".$_POST['etc_selpreadd']."', onsite_addendum='".$_POST['etc_selonsiteadd']."', markForDelete='".$_POST['etc_selmdelete']."', lastModifiedBy='".$_SESSION['user_id']."' where mas_seller_id=".$_POST['hidid']);

		$b=false;
		$q=mysql_query("select * from delegate_login where seller_com_id=".$_POST['hidscid']." and delegate_mode='S'");
		if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
		{
			$b=true;
		}
		if($b)
		{
			mysql_query("update delegate_login set user_name='".$_POST['etc_txtuname']."', password=AES_ENCRYPT('".$_POST['etc_txtpword']."','ALOGIC') where seller_com_id=".$_POST['hidscid']." and delegate_mode='S'");
		}
		else
		{
			mysql_query("insert into delegate_login(seller_com_id, delegate_mode, user_name, password) values ('".$_POST['hidscid']."','S','".$_POST['etc_txtuname']."',AES_ENCRYPT('".$_POST['etc_txtpword']."','ALOGIC'))");
		}
		
		header("Location:../sellerDelegateListUpdate.php?id=".$_POST['hidid']);
	}
	else
	{
		$n=mysql_query("update buyer_delegate_detail set dear='".$_POST['etc_txtdear']."', extraInfo='".$_POST['etc_txteinfo']."', appointment='".$_POST['etc_txtappointment']."', username='".$_POST['etc_txtuname']."', password=AES_ENCRYPT('".$_POST['etc_txtpword']."','ALOGIC'), deptFort='".$_POST['etc_txtdpinfo']."', airFare='".$_POST['etc_txtafare']."', airFareCurrency= '".$_POST['etc_txtpcurrency']."', exchangeRate='".$_POST['etc_txterate']."', actual_reimp_amount='".$_POST['etc_txtaramount']."', maxAirReimpAmount='".$_POST['etc_txtmramount']."', fromFlight='".$_POST['etc_txtffrom']."', arrDate='".$_POST['etc_txtadate']."', deptFlight='".$_POST['etc_txtdflight']."', deptDate='".$_POST['etc_txtddate']."', hotelName='".$_POST['etc_txthname']."', hotelNote='".$_POST['etc_txthnote']."', hotelChkIn='".$_POST['etc_txtcidate']."', hotelChkOut='".$_POST['etc_txtcodate']."', pre_addendum='".$_POST['etc_txtpadd']."', onsite_addendum='".$_POST['etc_txtosadd']."', markForDelete='".$_POST['etc_txtdrecord']."', lastModifiedBy='".$_SESSION['user_id']."', modifiedDate=CURRENT_TIMESTAMP where mas_buyer_id=".$_POST['hidid']);
		
		$b=false;
		$q=mysql_query("select * from delegate_login where buyer_com_id=".$_POST['hidscid']." and delegate_mode='B'");
		if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
		{
			$b=true;
		}
		if($b)
		{
			mysql_query("update delegate_login set user_name='".$_POST['etc_txtuname']."', password=AES_ENCRYPT('".$_POST['etc_txtpword']."','ALOGIC') where buyer_com_id=".$_POST['hidscid']." and delegate_mode='B'");
		}
		else
		{
			mysql_query("insert into delegate_login(seller_com_id, delegate_mode, user_name, password) values ('".$_POST['hidscid']."','B','".$_POST['etc_txtuname']."',AES_ENCRYPT('".$_POST['etc_txtpword']."','ALOGIC'))");
		}

		header("Location:../buyerDelegateListUpdate.php?id=".$_POST['hidid']);
	}
}
catch(Exception $e)
{
	echo $e;
}
?>
