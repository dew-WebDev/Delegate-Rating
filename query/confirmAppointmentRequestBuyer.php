<?php
require_once("connectivity.php");
session_start();
	try
	{
	$op="";
	
		$qry="select dr.reject, dr.appointment_order as oorder, dr.requested_delegate_id as drid, sc.company_id as cid, sc.seller_com_id as scid, sc.first_time_attending, sc.company_name as cname, c.country_name as cntName from buyer_company bc, countries c, delegate_requests dr, seller_company sc where dr.request_status='Y' and dr.seller_com_id=sc.seller_com_id and dr.buyer_com_id=bc.buyer_com_id and dr.request_mode='B' and c.country_id=sc.cnt_id and dr.requested_delegate_id ='".$_SESSION['user_name']."' group by drid, oorder order by appointment_order";

		$cnt=0;
		$op.=  "<table class='table table-bordered table-hover table-striped tablesorter'><thead><tr><th>Priority</th><th>Reg No.</th><th>Organisation Name</th><th>Country</th></tr></thead><tbody>";
		$q=mysql_query($qry);
		if(mysql_num_rows($q)>0)
		{
			while($rs=mysql_fetch_array($q))
			{
				$cnt+=1;
				if($rs['first_time_attending'] == 1)
				{
					if($rs['reject'] == 'Y')
					{
						$op.=  "<tr><td style='text-align:center;'>".$rs['oorder']."</td><td>".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fl=2&fk=cars\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td></tr>";
					}
					else
					{
						$op.=  "<tr><td style='text-align:center;'>".$rs['oorder']."</td><td>".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fl=2&fk=cars\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td></tr>";
					}
				}
				else
				{
					if($rs['reject'] == 'Y')
					{
						$op.=  "<tr><td style='text-align:center;'>".$rs['oorder']."</td><td>".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fl=2&fk=cars\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td></tr>";
					}
					else
					{
						$op.=  "<tr><td style='text-align:center;'>".$rs['oorder']."</td><td>".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fl=2&fk=cars\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td></tr>";
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
