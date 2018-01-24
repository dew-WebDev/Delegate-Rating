<?php
require_once("connectivity.php");
session_start();
	try
	{
		$q=mysql_query("select pavillion_type as ptype from seller_missing_fields where seller_missing_fields_status='Y' and seller_com_id=".$_SESSION['did']);
		$ptype=mysql_result($q,0);
		
		$q=mysql_query("select count(request_id) as cnt from delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='S'");
		$cntchk=mysql_result($q,0);
		
		if ($cntchk == 0)
		{
			$q=mysql_query("select count(request_id) as cnt from temp_delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='S'");
			$cntchk=mysql_result($q,0);
		}
		else
		{
			$cntchk = -1;
		}
	
		$op="";
	
		$qry="select 
		bc.buyer_com_id as bcid, bc.company_id as cid, bmf.FirstTimeBuyer, bc.company_name as cname, c.country_name as cntName 
		from buyer_company bc 
		inner join mas_buyer msb on bc.buyer_com_id = msb.mas_buyer_com_id and (msb.mas_buyer_status is null or msb.mas_buyer_status = 'Y') and (msb.title_name is not null and msb.title_name <> 'None')
		inner join buyer_delegate_detail bdd on msb.mas_buyer_id = bdd.mas_buyer_id and (bdd.buyer_delegate_status is null or bdd.buyer_delegate_status = 'Y')
		inner join buyer_missing_fields bmf on bc.buyer_com_id = bmf.buyer_com_id and (bmf.buyer_missing_fields_status is null or bmf.buyer_missing_fields_status='Y') 
		inner join countries c on c.country_id=bmf.CNT_ID 
		inner join buyer_org_details bod on bc.buyer_com_id = bod.buyer_com_id and (bod.buyer_org_status is null or bod.buyer_org_status = 'Y') and (bod.mark_for_delete is null or bod.mark_for_delete = '0') and (bod.pre_addendum = '1' or bdd.pre_addendum = '1')
		where bc.buyer_status = 'Y'
		and bc.company_name ".$_GET['svalue']."
		and bc.company_name like '%".$_GET['selcompany']."%' ";
		
		if(isset($_GET['selcountry']) && $_GET['selcountry'] != 0)
		{
			$qry.=" and bmf.CNT_ID=".$_GET['selcountry'];
		}
		if(isset($_GET['selbuyer']) && $_GET['selbuyer'] != 0)
		{
			if($_GET['selbuyer'] == 1)
			{
				$qry.=" and bmf.FirstTimeBuyer=1";
			}
			else if($_GET['selbuyer'] == 2)
			{
				$qry.=" and bmf.FirstTimeBuyer=0";
			}
		}

		if(isset($_GET['selbuyprofile']) && $_GET['selbuyprofile'] != 0)
		{
			$qry.=" and bmf.busitype".$_GET['selbuyprofile']."= ".$_GET['selbuyprofile'];
		}
		
		$qry.=" group by cid order by bc.company_name";
//echo $qry;
		$cnt=0;
		$op.= "<table class='table table-bordered table-hover table-striped tablesorter'>
				<thead>
					<tr>
						<th>Reg No.&nbsp;&nbsp;<i class='fa fa-sort'></i></th>
						<th>Organisation Name&nbsp;&nbsp;<i class='fa fa-sort'></i></th>
						<th>Country&nbsp;&nbsp;<i class='fa fa-sort'></i></th>
					</tr>
				</thead><tbody>";
		$q=mysql_query($qry);
		if(mysql_num_rows($q)>0)
		{
			while($rs=mysql_fetch_array($q))
			{
				$cnt+=1;
				if($rs['FirstTimeBuyer'] == 1)
				{
					if ($cntchk > -1)
					{
						if (($ptype == 3 && $cntchk < 20) || ($ptype != 3 && $cntchk < 40))
						{
							$op.= "<tr style='width:10%;'><td>".$rs['cid']."</td><td style='width:70%;'><a href=\"buyerDetails.php?id=".$rs['bcid']."&fk=adbc\">".$rs['cname']."</a><span id='ftimeid' class='ftimeclass'>&nbsp;&nbsp;&nbsp;First Time&nbsp;&nbsp;&nbsp;</span></td><td style='width:20%;'>".$rs['cntName']."</td></tr>";
						}
						else
						{
							$op.= "<tr style='width:10%;'><td>".$rs['cid']."</td><td style='width:70%;'><a href=\"buyerDetails.php?id=".$rs['bcid']."&fl=1&fk=adbc\">".$rs['cname']."</a><span id='ftimeid' class='ftimeclass'>&nbsp;&nbsp;&nbsp;First Time&nbsp;&nbsp;&nbsp;</span></td><td style='width:20%;'>".$rs['cntName']."</td></tr>";
						}
					}
					else
					{
						$op.= "<tr style='width:10%;'><td>".$rs['cid']."</td><td style='width:70%;'><a href=\"buyerDetails.php?id=".$rs['bcid']."&fl=2&fk=adbc\">".$rs['cname']."</a><span id='ftimeid' class='ftimeclass'>&nbsp;&nbsp;&nbsp;First Time&nbsp;&nbsp;&nbsp;</span></td><td style='width:20%;'>".$rs['cntName']."</td></tr>";
					}
				}
				else
				{
					if ($cntchk > -1)
					{
						if (($ptype == 3 && $cntchk < 20) || ($ptype != 3 && $cntchk < 40))
						{
							$op.= "<tr style='width:10%;'><td>".$rs['cid']."</td><td style='width:70%;'><a href=\"buyerDetails.php?id=".$rs['bcid']."&fk=adbc\">".$rs['cname']."</a></td><td style='width:20%;'>".$rs['cntName']."</td></tr>";
						}
						else
						{
							$op.= "<tr style='width:10%;'><td>".$rs['cid']."</td><td style='width:70%;'><a href=\"buyerDetails.php?id=".$rs['bcid']."&fl=1&fk=adbc\">".$rs['cname']."</a></td><td style='width:20%;'>".$rs['cntName']."</td></tr>";
						}
					}
					else
					{
						$op.= "<tr style='width:10%;'><td>".$rs['cid']."</td><td style='width:70%;'><a href=\"buyerDetails.php?id=".$rs['bcid']."&fl=2&fk=adbc\">".$rs['cname']."</a></td><td style='width:20%;'>".$rs['cntName']."</td></tr>";
					}
				}

			}
		}
		$op.= "</tbody></table><input type='hidden' id='hidcount' name='hidcount' value='".$cnt."' />";
		
		echo $op;
	}
	catch(Exception $e)
	{
		echo $e;
	}

?>