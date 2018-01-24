<?php
require_once("connectivity.php");
session_start();
	try
	{
		$q=mysql_query("select pavillion_type as ptype from seller_missing_fields where seller_com_id=".$_SESSION['did']." and seller_missing_fields_status = 'Y'");
		$ptype=mysql_result($q,0);
		

		$b=false;
		$q=mysql_query("select * from delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='S'");
		if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
		{
			$b=true;
		}
		if($b)
		{
			$qry="select 
			bc.buyer_com_id as bcid, bc.company_id as cid, bmf.firstTimeBuyer,bc.company_name as cname, c.country_name as cntName 
			from buyer_company bc left join buyer_org_details bod on bc.buyer_com_id = bod.buyer_com_id 
			left join buyer_missing_fields bmf on bc.buyer_com_id = bmf.buyer_com_id 
			left join countries c on c.country_id=bmf.CNT_ID 
			left join delegate_requests dr on dr.buyer_com_id=bc.buyer_com_id 
			where 
			dr.request_status='Y' 
			and (bmf.buyer_missing_fields_status is null or bmf.buyer_missing_fields_status='Y') 
			and dr.request_mode='S' 
			and dr.requested_delegate_id ='".$_SESSION['user_name']."' 
			and (bod.buyer_org_status is null or bod.buyer_org_status = 'Y') 
			and (bod.mark_for_delete is null or bod.mark_for_delete = '0') 
			and (bod.pre_addendum is null || bod.pre_addendum = '0')
			order by appointment_order";
			
			$op="";

			$cnt=0;
			$op.= "<table class='table table-bordered table-hover table-striped tablesorter'><thead><tr><th style='text-align:center;'>Priority</th><th>Reg No.</th><th>Organisation Name</th><th>Country</th></tr></thead><tbody>";
			$q=mysql_query($qry);
			if(mysql_num_rows($q)>0)
			{
				while($rs=mysql_fetch_array($q))
				{
					$cnt+=1;
					$op.= "<tr><td style='text-align:center;'>".$cnt."</td><td>".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fk=vappsl\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td></tr>";
/*			
					if($rs['FirstTimeBuyer'] == 1)
					{
						$op.= "<tr><td style='text-align:center;'>".$cnt."</td><td>".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fk=vappsl\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td></tr>";
					}
					else
					{
						$op.= "<tr><td style='text-align:center;'>".$cnt."</td><td>".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fk=vappsl\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td></tr>";				
					}
*/					
				}
			}
			
			$op.= "</tbody></table>";
			
		}
		else
		{
			$b=false;
			$q=mysql_query("select * from delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='S'");
			if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
			{
				$b=true;
			}
			if($b)
			{
				$q=mysql_query("select count(request_id) as cnt from delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='S'");
				$cntchk=mysql_result($q,0);
			}
			else
			{
				$q=mysql_query("select count(request_id) as cnt from temp_delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='S'");
				$cntchk=mysql_result($q,0);
			}
		
			$qry="select 
			bc.buyer_com_id as bcid, bc.company_id as cid, bmf.firstTimeBuyer,bc.company_name as cname, c.country_name as cntName 
			from buyer_company bc left join buyer_org_details bod on bc.buyer_com_id = bod.buyer_com_id 
			left join buyer_missing_fields bmf on bc.buyer_com_id = bmf.buyer_com_id 
			left join countries c on c.country_id=bmf.CNT_ID 
			left join temp_delegate_requests dr on dr.buyer_com_id=bc.buyer_com_id 
			where 
			dr.request_status='Y' 
			and (bmf.buyer_missing_fields_status is null or bmf.buyer_missing_fields_status='Y') 
			and dr.request_mode='S' 
			and dr.requested_delegate_id ='".$_SESSION['user_name']."' 
			and (bod.buyer_org_status is null or bod.buyer_org_status = 'Y') 
			and (bod.mark_for_delete is null or bod.mark_for_delete = '0') 
			and (bod.pre_addendum is null || bod.pre_addendum = '0')
			order by appointment_order";
			
			$op="";
		
			$cnt=0;
			$op.= "<table class='table table-bordered table-hover table-striped tablesorter'><thead><tr><th style='text-align:center;'>Priority</th><th>Reg No.</th><th>Organisation Name</th><th>Country</th><th style='text-align:center;'>Cancel</th><th style='text-align:center;'>Priority</th></tr></thead><tbody>";
			$q=mysql_query($qry);
			if(mysql_num_rows($q)>0)
			{
				while($rs=mysql_fetch_array($q))
				{
					$cnt+=1;
					if($rs['firstTimeBuyer'] == 1)
					{
						$op.= "<tr id='did".$cnt."'><td style='text-align:center;'>".$cnt."</td><td><input type='hidden' id='hidid".$cnt."' name='hidid".$cnt."' value='".$rs['bcid']."' />".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fk=vappsl\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'><a href='#' target='hidframe1' onClick='deleteRow(this)' ><img src='images/trash.png' style='width:20px;height:20px;'></a></td><td style='text-align:center;'><a href='#' onclick='moveRow(this)'><i class='fa fa-arrow-up firstInList'></i></a><a href='#' onclick='moveRow(this)'><i class='fa fa-arrow-up'></i></a><a href='#'  onclick='moveRow(this)'><i class='fa fa-arrow-down'></i></a><a href='#' onclick='moveRow(this)'><i class='fa fa-arrow-down lastInList'></i></a></td></tr>";
					}
					else
					{
						$op.= "<tr id='did".$cnt."'><td style='text-align:center;'>".$cnt."</td><td><input type='hidden' id='hidid".$cnt."' name='hidid".$cnt."' value='".$rs['bcid']."' />".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fk=vappsl\">".$rs['cname']."</a></td><td >".$rs['cntName']."</td><td style='text-align:center;'><a href='#' target='hidframe1' onClick='deleteRow(this)' ><img src='images/trash.png' style='width:20px;height:20px;'></a></td><td style='text-align:center;'><a href='#' onclick='moveRow(this)'><i class='fa fa-arrow-up firstInList'></i></a><a href='#' onclick='moveRow(this)'><i class='fa fa-arrow-up'></i></a><a href='#'  onclick='moveRow(this)'><i class='fa fa-arrow-down'></i></a><a href='#' onclick='moveRow(this)'><i class='fa fa-arrow-down lastInList'></i></a></td></tr>";				
					}
				}
			}
			$op.= "</tbody></table><input type='hidden' id='hidcount' name='hidcount' value='".$cntchk."' />";
			
		}

		$op.="<input type='hidden' id='btype' name='btype' value='".$ptype."' />";
		
		echo $op;
	}
	catch(Exception $e)
	{
		echo $e;
	}

?>
