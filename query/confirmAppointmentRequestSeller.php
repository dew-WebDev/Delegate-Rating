<?php
require_once("connectivity.php");
session_start();
	try
	{
		$op="";
	
		$qry="select dr.reject, dr.appointment_order as oorder, dr.requested_delegate_id as drid, bc.buyer_com_id as bcid, bc.company_id as cid, bmf.FirstTimeBuyer, bmf.CompanyName as cname, c.country_name as cntName from buyer_missing_fields bmf, buyer_company bc, countries c, delegate_requests dr, seller_company sc where bmf.buyer_missing_fields_status='Y' and dr.request_status='Y' and dr.seller_com_id=sc.seller_com_id and dr.buyer_com_id=bc.buyer_com_id and dr.request_mode='S' and bc.buyer_com_id = bmf.buyer_com_id and c.country_id=bmf.CNT_ID and dr.requested_delegate_id ='".$_SESSION['user_name']."' group by drid, oorder order by appointment_order";

		
		$cnt=0;
		$op.=  "<table class='table table-bordered table-hover table-striped tablesorter'><thead><tr><th>Priority</th><th>Reg No.</th><th>Organisation Name</th><th>Country</th></tr></thead><tbody>";
		$q=mysql_query($qry);
		if(mysql_num_rows($q)>0)
		{
			while($rs=mysql_fetch_array($q))
			{
				$cnt+=1;
				if($rs['FirstTimeBuyer'] == 1)
				{
					if($rs['reject'] == 'Y')
					{
						$op.=  "<tr><td style='text-align:center;'>".$rs['oorder']."</td><td>".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fl=2&fk=cars\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td></tr>";
					}
					else
					{
						$op.=  "<tr><td style='text-align:center;'>".$rs['oorder']."</td><td>".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fl=2&fk=cars\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td></tr>";
					}
				}
				else
				{
					if($rs['reject'] == 'Y')
					{
						$op.=  "<tr><td style='text-align:center;'>".$rs['oorder']."</td><td>".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fl=2&fk=cars\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td></tr>";		
					}
					else
					{
						$op.=  "<tr><td style='text-align:center;'>".$rs['oorder']."</td><td>".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fl=2&fk=cars\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td></tr>";		
					}
				}
			}
		}
		
		$op.=  "</tbody></table>";
		echo $op;	
	}
	catch(Exception $e)
	{
		echo $e;
	}

?>
