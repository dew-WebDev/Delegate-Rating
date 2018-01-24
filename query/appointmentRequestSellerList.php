<?php
require_once("connectivity.php");
session_start();
	try
	{
	
		$op="";
		$cntchk=0;
		
		$q=mysql_query("select buyer_org_id from buyer_org_details where buyer_com_id=".$_SESSION['did']." AND one_day_buyer IN ('Y', 'y', 'T', 't', '1')");

		$pack=0;
if(mysql_num_rows($q) > 0)
{
	$pack = 'C';
}
	
		$qry="select
		sc.seller_com_id as scid, sc.first_time_attending, sc.company_id as cid, sc.company_name as cname, c.country_name as cntName 
		from seller_company sc left join countries c on c.country_id=sc.cnt_id 
		left join seller_org_details sod on sc.seller_com_id = sod.seller_com_id 
		left join seller_missing_fields smf on sc.seller_com_id = smf.seller_com_id 
		where sc.seller_status = 'Y' 
		and (smf.seller_missing_fields_status is null or smf.seller_missing_fields_status='Y')
		and (sod.seller_org_status is null or sod.seller_org_status = 'Y') 
		and (sod.markForDelete is null or sod.markForDelete = '0')
		and (sod.pre_addendum is null || sod.pre_addendum = '0')
		and sc.company_name ".$_GET['svalue']."
		and sc.company_name like '%".$_GET['selcompany']."%'";

		$dqry="select request_id 
		from seller_company sc left join countries c on c.country_id=sc.cnt_id 
		left join seller_org_details sod on sc.seller_com_id = sod.seller_com_id 
		left join seller_missing_fields smf on sc.seller_com_id = smf.seller_com_id 
		where sc.seller_status = 'Y' 
		and (smf.seller_missing_fields_status is null or smf.seller_missing_fields_status='Y')
		and (sod.seller_org_status is null or sod.seller_org_status = 'Y') 
		and (sod.markForDelete is null or sod.markForDelete = '0')
		and (sod.pre_addendum is null || sod.pre_addendum = '0')
		and sc.company_name ".$_GET['svalue']."
		and sc.company_name like '%".$_GET['selcompany']."%'";
		
		if(isset($_GET['selcountry']) && $_GET['selcountry'] != 0)
		{
			$qry.=" and sc.cnt_id=".$_GET['selcountry'];
			$dqry.=" and sc.cnt_id=".$_GET['selcountry'];
		}
		if(isset($_GET['selseller']) && $_GET['selseller'] != 0)
		{
			if($_GET['selseller'] == 1)
			{
				$qry.=" and sc.first_time_attending=1";
				$dqry.=" and sc.first_time_attending=1";
			}
			else if($_GET['selseller'] == 2)
			{
				$qry.=" and sc.first_time_attending=0";
				$dqry.=" and sc.first_time_attending=0";
			}
		}
		
		if(isset($_GET['selselprofile']) && $_GET['selselprofile'] != 0)
		{
			$qry.=" and smf.servtype".$_GET['selselprofile']."= ".($_GET['selselprofile'] + 1);
			$dqry.=" and smf.servtype".$_GET['selselprofile']."= ".($_GET['selselprofile'] + 1);
		}
		
		$qry.=" order by sc.company_name";
		$dqry.=" order by sc.company_name";
		
		$cnt=0;
		$cntchk=0;
		
		$b=false;
		$q=mysql_query("select * from delegate_requests where requested_delegate_id ='".$_SESSION['user_name']."' and request_mode='B'");
		if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
		{
			$b=true;
		}
		
		$op.= "<table class='table table-bordered table-hover table-striped tablesorter'><thead><tr><th>Reg No.&nbsp;&nbsp;<i class='fa fa-sort'></i></th><th>Organisation Name&nbsp;&nbsp;<i class='fa fa-sort'></i></th><th>Country&nbsp;&nbsp;<i class='fa fa-sort'></i></th><th style='text-align:center;'>Appointment Request</th></tr></thead><tbody>";
		$q=mysql_query($qry);
		if(mysql_num_rows($q)>0)
		{
			while($rs=mysql_fetch_array($q))
			{
				$del=mysql_query("delete from temp_delegate_requests where request_mode='B' and seller_com_id=".$rs['scid']." and requested_delegate_id ='".$_SESSION['user_name']."' and request_id NOT IN (".$dqry.")");

				$del=mysql_query("delete from delegate_requests where request_mode='B' and seller_com_id=".$rs['scid']." and requested_delegate_id ='".$_SESSION['user_name']."' and request_id NOT IN (".$dqry.")");
				
				$cnt+=1;
				if($rs['first_time_attending'] == 1)
				{
					if($b)
					{
						$qry=mysql_query("select * from delegate_requests where request_mode='B' and seller_com_id=".$rs['scid']." and requested_delegate_id ='".$_SESSION['user_name']."'");
					}
					else
					{
						$qry=mysql_query("select * from temp_delegate_requests where request_mode='B' and seller_com_id=".$rs['scid']." and requested_delegate_id ='".$_SESSION['user_name']."'");
					}
					if(mysql_num_rows($qry) && $r=mysql_fetch_array($qry))
					{
						$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fk=appsl\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'><input checked type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"removebox('".$rs['scid']."','".$cnt."','S');\"/></th></tr>";
						$cntchk++;
					}
					else
					{
						if($pack === 'C')
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"#\" onclick=\"sellerchklink('sellerDetails.php?id=".$rs['scid']."&fk=appsl', '".$rs['scid']."','1','".$cnt."', this);\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'><input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerchkbox('".$rs['scid']."','1','".$cnt."', this);\"/></td></tr>";
						}
						else
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"#\" onclick=\"sellerchklink('sellerDetails.php?id=".$rs['scid']."&fk=appsl', '".$rs['scid']."','2','".$cnt."', this);\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'><input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerchkbox('".$rs['scid']."','2','".$cnt."', this);\"/></td></tr>";
						}
					}
				}
				else
				{
					if($b)
					{
						$qry=mysql_query("select * from delegate_requests where request_mode='B' and seller_com_id=".$rs['scid']." and requested_delegate_id ='".$_SESSION['user_name']."'");
					}
					else
					{
						$qry=mysql_query("select * from temp_delegate_requests where request_mode='B' and seller_com_id=".$rs['scid']." and requested_delegate_id ='".$_SESSION['user_name']."'");
					}
					if(mysql_num_rows($qry) && $r=mysql_fetch_array($qry))
					{
						$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fk=appsl\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'><input checked type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"removebox('".$rs['scid']."','".$cnt."','S');\"/></td></tr>";
						$cntchk++;
					}
					else
					{
						if($pack === 'C')
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"#\" onclick=\"sellerchklink('sellerDetails.php?id=".$rs['scid']."&fk=appsl', '".$rs['scid']."','1','".$cnt."', this);\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'><input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerchkbox('".$rs['scid']."','1','".$cnt."', this); \"/></td></tr>";				
						}
						else
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"#\" onclick=\"sellerchklink('sellerDetails.php?id=".$rs['scid']."&fk=appsl', '".$rs['scid']."','2','".$cnt."', this);\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'><input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerchkbox('".$rs['scid']."','2','".$cnt."', this); \"/></td></tr>";				
						}
					}
				}
			}
		}
		$op.= "</tbody></table><input type='hidden' id='hidcount' name='hidcount' value='".$cnt."' /><input type='hidden' id='hidcountchk' name='hidcountchk' value='".$cntchk."' />";
		echo $op;

	}
	catch(Exception $e)
	{
		echo $e;
	}

?>