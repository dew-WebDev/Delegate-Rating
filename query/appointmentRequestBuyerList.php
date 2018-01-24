<?php
require_once("connectivity.php");
session_start();
	try
	{
	
		$op="";
		$cntchk=0;

		$q=mysql_query("select pavillion_type as ptype from seller_missing_fields where seller_missing_fields_status='Y' and seller_com_id=".$_SESSION['did']);
		$ptype=mysql_result($q,0);
		
		$qry="select 
		bc.buyer_com_id as bcid, bc.company_id as cid, bmf.FirstTimeBuyer, bc.company_name as cname, c.country_name as cntName 
		from buyer_company bc 
		left join buyer_missing_fields bmf on bc.buyer_com_id = bmf.buyer_com_id 
		left join countries c on c.country_id=bmf.CNT_ID 
		left join buyer_org_details bod on bc.buyer_com_id = bod.buyer_com_id 
		where bc.buyer_status = 'Y' 
		and (bmf.buyer_missing_fields_status is null or bmf.buyer_missing_fields_status='Y') 
		and (bod.buyer_org_status is null or bod.buyer_org_status = 'Y') 
		and (bod.mark_for_delete is null or bod.mark_for_delete = '0')
		and (bod.pre_addendum is null || bod.pre_addendum = '0')
		and bc.company_name ".$_GET['svalue']."
		and bc.company_name like '%".$_GET['selcompany']."%'";


		$dqry="select request_id 
		from buyer_company bc 
		left join buyer_missing_fields bmf on bc.buyer_com_id = bmf.buyer_com_id 
		left join countries c on c.country_id=bmf.CNT_ID 
		left join buyer_org_details bod on bc.buyer_com_id = bod.buyer_com_id 
		where bc.buyer_status = 'Y' 
		and (bmf.buyer_missing_fields_status is null or bmf.buyer_missing_fields_status='Y') 
		and (bod.buyer_org_status is null or bod.buyer_org_status = 'Y') 
		and (bod.mark_for_delete is null or bod.mark_for_delete = '0')
		and (bod.pre_addendum is null || bod.pre_addendum = '0')
		and bc.company_name ".$_GET['svalue']."
		and bc.company_name like '%".$_GET['selcompany']."%'";
		
		if(isset($_GET['selcountry']) && $_GET['selcountry'] != 0)
		{
			$qry.=" and bmf.CNT_ID=".$_GET['selcountry'];
			$dqry.=" and bmf.CNT_ID=".$_GET['selcountry'];
		}
		if(isset($_GET['selbuyer']) && $_GET['selbuyer'] != 0)
		{
			if($_GET['selbuyer'] == 1)
			{
				$qry.=" and bmf.FirstTimeBuyer=1";
				$dqry.=" and bmf.FirstTimeBuyer=1";
			}
			else if($_GET['selbuyer'] == 2)
			{
				$qry.=" and bmf.FirstTimeBuyer=0";
				$dqry.=" and bmf.FirstTimeBuyer=0";
			}
		}
		
		if(isset($_GET['selbuyprofile']) && $_GET['selbuyprofile'] != 0)
		{
			$qry.=" and bmf.busitype".$_GET['selbuyprofile']."= ".$_GET['selbuyprofile'];
			$dqry.=" and bmf.busitype".$_GET['selbuyprofile']."= ".$_GET['selbuyprofile'];
		}
		
		
		$qry.=" order by bc.company_name";
		$cnt=0;
		$cntchk=0;
		
		$b=false;
		$q=mysql_query("select * from delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='S'");
		if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
		{
			$b=true;
		}
				
		$op.= "<table class='table table-bordered table-hover table-striped tablesorter'><thead><tr><th>Reg No.&nbsp;&nbsp;<i class='fa fa-sort'></i></th><th>Organisation Name&nbsp;&nbsp;<i class='fa fa-sort'></i></th><th>Country&nbsp;&nbsp;<i class='fa fa-sort'></i></th><th>Appointment Request</th></tr></thead><tbody>";
		$q=mysql_query($qry);
		if(mysql_num_rows($q)>0)
		{
			
			while($rs=mysql_fetch_array($q))
			{
				$del=mysql_query("select * from temp_delegate_requests where request_mode='S' and buyer_com_id=".$rs['bcid']." and requested_delegate_id='".$_SESSION['user_name']."' and request_id NOT IN (".$dqry.")");
				$del=mysql_query("select * from delegate_requests where request_mode='S' and buyer_com_id=".$rs['bcid']." and requested_delegate_id='".$_SESSION['user_name']."' and request_id NOT IN (".$dqry.")");
				$cnt+=1;
				if($rs['FirstTimeBuyer'] == 1)
				{
					if($b)
					{
						$qry=mysql_query("select * from delegate_requests where request_mode='S' and buyer_com_id=".$rs['bcid']." and requested_delegate_id='".$_SESSION['user_name']."'");
					}
					else
					{
						$qry=mysql_query("select * from temp_delegate_requests where request_mode='S' and buyer_com_id=".$rs['bcid']." and requested_delegate_id='".$_SESSION['user_name']."'");
					}
					if(mysql_num_rows($qry) && $r=mysql_fetch_array($qry))
					{
						$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fk=appsl\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'><span id='href".$cnt."'><input checked type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"removebox('".$rs['bcid']."','".$cnt."','B');\"/></span></th></tr>";
						$cntchk++;
					}
					else
					{
						if($ptype == '3')
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"#\" onClick=\"buyerchklink('buyerDetails.php?id=".$rs['bcid']."&fk=appsl', '".$rs['bcid']."','1','".$cnt."', this);\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'><input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerchkbox('".$rs['bcid']."','1','".$cnt."', this);\"/></th></tr>";
						}
						else
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"#\" onClick=\"buyerchklink('buyerDetails.php?id=".$rs['bcid']."&fk=appsl', '".$rs['bcid']."','2','".$cnt."', this);\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'><input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerchkbox('".$rs['bcid']."','2','".$cnt."', this);\"/></th></tr>";
						}
					}
				}
				else
				{
					if($b)
					{
						$qry=mysql_query("select * from delegate_requests where request_mode='S' and buyer_com_id=".$rs['bcid']." and requested_delegate_id='".$_SESSION['user_name']."'");
					}
					else
					{
						$qry=mysql_query("select * from temp_delegate_requests where request_mode='S' and buyer_com_id=".$rs['bcid']." and requested_delegate_id='".$_SESSION['user_name']."'");
					}
					if(mysql_num_rows($qry) && $r=mysql_fetch_array($qry))
					{
						$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fk=appsl\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'><input checked type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"removebox('".$rs['bcid']."','".$cnt."','B');\"/></td></tr>";
						$cntchk++;
					}
					else
					{
						if($ptype == '3')
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"#\" onClick=\"buyerchklink('buyerDetails.php?id=".$rs['bcid']."&fk=appsl', '".$rs['bcid']."','1','".$cnt."', this);\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'><input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerchkbox('".$rs['bcid']."','1','".$cnt."', this);\"/></td></tr>";				
						}
						else
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"#\" onClick=\"buyerchklink('buyerDetails.php?id=".$rs['bcid']."&fk=appsl', '".$rs['bcid']."','2','".$cnt."', this);\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'><input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerchkbox('".$rs['bcid']."','2','".$cnt."', this);\"/></td></tr>";				
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
