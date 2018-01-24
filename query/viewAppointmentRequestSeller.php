<?php
require_once("connectivity.php");
session_start();
	try
	{
	
		$q=mysql_query("select buyer_org_id from buyer_org_details where buyer_com_id=".$_SESSION['did']." and buyer_org_status = 'Y' and one_day_buyer = '1'");
		$ptype="";
		if (mysql_num_rows($q) > 0)
		{
			$ptype='3';
		}
	
		$op="";
	
		$b=false;
		$q=mysql_query("select * from delegate_requests where buyer_com_id=".$_SESSION['did']." and request_mode='B'");
		if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
		{
			$b=true;
		}
		if($b)
		{
			$b=false;
			$q=mysql_query("select * from delegate_requests where requested_delegate_id ='".$_SESSION['user_name']."' and request_mode='B'");
			if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
			{
				$b=true;
			}
			if($b)
			{
				$q=mysql_query("select count(request_id) as cnt from delegate_requests where requested_delegate_id ='".$_SESSION['user_name']."' and request_mode='B'");
				$cntchk=mysql_result($q,0);
			}
			else
			{
				$q=mysql_query("select count(request_id) as cnt from temp_delegate_requests where requested_delegate_id ='".$_SESSION['user_name']."' and request_mode='B'");
				$cntchk=mysql_result($q,0);
			}
		
			$qry="
			select  
			sc.seller_com_id as scid, sc.company_id as cid, smf.FirstTimeAttending,sc.company_name as cname, c.country_name as cntName, dr.buyer_com_id 
			from seller_company sc left join seller_org_details sod on sc.seller_com_id = sod.seller_com_id 
			left join seller_missing_fields smf on sc.seller_com_id = smf.seller_com_id 
			left join countries c on c.country_id=smf.CNT_ID 
			left join delegate_requests dr on dr.seller_com_id=sc.seller_com_id 
			where 
			dr.request_status='Y' 
			and (smf.seller_missing_fields_status is null or smf.seller_missing_fields_status='Y')
			and dr.request_mode='B' 
			and dr.requested_delegate_id ='".$_SESSION['user_name']."' 
			and (sod.seller_org_status is null or sod.seller_org_status = 'Y') 
			and (sod.markForDelete is null or sod.markForDelete = '0')
			and (sod.pre_addendum is null || sod.pre_addendum = '0')
			";
			
			$op="";
		
			$cnt=0;
			$op.= "<table class='table table-bordered table-hover table-striped tablesorter'><thead><tr><th style='text-align:center;'>Priority</th><th>Reg No.</th><th>Organisation Name</th><th>Country</th></tr></thead><tbody>";
			
			$q=mysql_query($qry);
			if(mysql_num_rows($q)>0)
			{
				while($rs=mysql_fetch_array($q))
				{
					$cnt+=1;
					if($rs['FirstTimeAttending'] == 1)
					{
						$op.= "<tr><td style='text-align:center;'>".$cnt."</td><td><input type='hidden' id='hidid".$cnt."' name='hidid".$cnt."' value='".$rs['scid']."' />".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fk=vappsl\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td></tr>";
					}
					else
					{
						$op.= "<tr><td style='text-align:center;'>".$cnt."</td><td><input type='hidden' id='hidid".$cnt."' name='hidid".$cnt."' value='".$rs['scid']."' />".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fk=vappsl\">".$rs['cname']."</a></td><td >".$rs['cntName']."</td></tr>";				
					}
				}
			}
			$op.= "</tbody></table><input type='hidden' id='hidcount' name='hidcount' value='".$cntchk."' />";
			
		}
		else
		{
			$b=false;
			$q=mysql_query("select * from delegate_requests where requested_delegate_id ='".$_SESSION['user_name']."' and request_mode='B'");
			if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
			{
				$b=true;
			}
			if($b)
			{
				$q=mysql_query("select count(request_id) as cnt from delegate_requests where requested_delegate_id ='".$_SESSION['user_name']."' and request_mode='B'");
				$cntchk=mysql_result($q,0);
			}
			else
			{
				$q=mysql_query("select count(request_id) as cnt from temp_delegate_requests where requested_delegate_id ='".$_SESSION['user_name']."' and request_mode='B'");
				$cntchk=mysql_result($q,0);
			}
		
			$qry="
			select  
			sc.seller_com_id as scid, sc.company_id as cid, smf.FirstTimeAttending,sc.company_name as cname, c.country_name as cntName, dr.buyer_com_id 
			from seller_company sc left join seller_org_details sod on sc.seller_com_id = sod.seller_com_id 
			left join seller_missing_fields smf on sc.seller_com_id = smf.seller_com_id 
			left join countries c on c.country_id=smf.CNT_ID 
			left join temp_delegate_requests dr on dr.seller_com_id=sc.seller_com_id 
			where 
			dr.request_status='Y' 
			and (smf.seller_missing_fields_status is null or smf.seller_missing_fields_status='Y')
			and dr.request_mode='B' 
			and dr.requested_delegate_id ='".$_SESSION['user_name']."' 
			and (sod.seller_org_status is null or sod.seller_org_status = 'Y') 
			and (sod.markForDelete is null or sod.markForDelete = '0')
			and (sod.pre_addendum is null || sod.pre_addendum = '0')
			";
			
			$op="";
		
			$cnt=0;
			$op.= "<table class='table table-bordered table-hover table-striped tablesorter'><thead><tr><th style='text-align:center;'>Priority</th><th>Reg No.</th><th>Organisation Name</th><th>Country</th><th style='text-align:center;'>Cancel</th><th style='text-align:center;'>Priority</th></tr></thead><tbody>";
			
			$q=mysql_query($qry);
			if(mysql_num_rows($q)>0)
			{
				while($rs=mysql_fetch_array($q))
				{
					$cnt+=1;
					$op.= "<tr id='did".$cnt."'><td style='text-align:center;'>".$cnt."</td><td><input type='hidden' id='hidid".$cnt."' name='hidid".$cnt."' value='".$rs['scid']."' />".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fk=vappsl\">".$rs['cname']."</a></td><td >".$rs['cntName']."</td><td style='text-align:center;'><a href='#' target='hidframe1' onClick='deleteRow(this)'><img src='images/trash.png' style='width:20px;height:20px;'></a></td><td style='text-align:center;'><a href='#' onclick='moveRow(this)'><i class='fa fa-arrow-up firstInList'></i></a><a href='#' onclick='moveRow(this)'><i class='fa fa-arrow-up'></i></a><a href='#'  onclick='moveRow(this)'><i class='fa fa-arrow-down'></i></a><a href='#' onclick='moveRow(this)'><i class='fa fa-arrow-down lastInList'></i></a></td></tr>";
/*					
					if($rs['FirstTimeAttending'] == 1)
					{
						$op.= "<tr id='did".$cnt."'><td style='text-align:center;'>".$cnt."</td><td><input type='hidden' id='hidid".$cnt."' name='hidid".$cnt."' value='".$rs['scid']."' />".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fk=vappsl\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'><a href='#' target='hidframe1' onClick='deleteRow(this)' ><img src='images/trash.png' style='width:20px;height:20px;'></a></td><td style='text-align:center;'><a href='#' onclick='moveRow(this)'><i class='fa fa-arrow-up firstInList'></i></a><a href='#' onclick='moveRow(this)'><i class='fa fa-arrow-up'></i></a><a href='#'  onclick='moveRow(this)'><i class='fa fa-arrow-down'></i></a><a href='#' onclick='moveRow(this)'><i class='fa fa-arrow-down lastInList'></i></a></td></tr>";			
					}
					else
					{
						$op.= "<tr id='did".$cnt."'><td style='text-align:center;'>".$cnt."</td><td><input type='hidden' id='hidid".$cnt."' name='hidid".$cnt."' value='".$rs['scid']."' />".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fk=vappsl\">".$rs['cname']."</a></td><td >".$rs['cntName']."</td><td style='text-align:center;'><a href='#' target='hidframe1' onClick='deleteRow(this)'><img src='images/trash.png' style='width:20px;height:20px;'></a></td><td style='text-align:center;'><a href='#' onclick='moveRow(this)'><i class='fa fa-arrow-up firstInList'></i></a><a href='#' onclick='moveRow(this)'><i class='fa fa-arrow-up'></i></a><a href='#'  onclick='moveRow(this)'><i class='fa fa-arrow-down'></i></a><a href='#' onclick='moveRow(this)'><i class='fa fa-arrow-down lastInList'></i></a></td></tr>";			
					}
*/					
				}
			}
			$op.= "</tbody></table><input type='hidden' id='hidcount' name='hidcount' value='".$cntchk."' />";
			
		}
		
		$op.="<input type='hidden' id='stype' name='stype' value='".$ptype."' />";

		echo $op;	
	}
	catch(Exception $e)
	{
		echo $e;
	}

?>