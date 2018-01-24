<?php
require_once("connectivity.php");
session_start();
	try
	{
		$tq=mysql_query("select * from date_settings where settings_status='Y'");
		$on="";
		$off="";
		if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
		{
			$on = $rs['app_rejection_on'];
		}

		$q=mysql_query("select pavillion_type as ptype from seller_missing_fields where seller_missing_fields_status='Y' and seller_com_id=".$_SESSION['did']);
		$ptype=mysql_result($q,0);
		
		$op="";
	
		$qry="
		select
		dr.reject, bc.buyer_com_id as bcid, dr.appointment_order as oorder, bc.company_id as cid, bmf.FirstTimeBuyer, bmf.CompanyName as cname, c.country_name as cntName, dr.requested_delegate_id as drid 
		from 
		buyer_missing_fields bmf, buyer_company bc
		left join
		countries c on
		c.country_id=bc.CNT_ID
		, delegate_requests dr, seller_company sc 
		where dr.request_status='Y'
		and dr.seller_com_id=sc.seller_com_id
		and dr.buyer_com_id=bc.buyer_com_id
		and dr.request_mode='B'
		and bc.buyer_com_id = bmf.buyer_com_id
		and buyer_missing_fields_status = 'Y'
		and dr.seller_com_id =".$_SESSION['did']."
		group by cid,oorder
		order by cname";
		
		/*$qry="
		select
		dr.reject, bc.buyer_com_id as bcid, dr.appointment_order as oorder, bc.company_id as cid, bmf.FirstTimeBuyer, bmf.CompanyName as cname, c.country_name as cntName, dr.requested_delegate_id as drid 
		from 
		buyer_missing_fields bmf, buyer_company bc
		left join
		countries c on
		c.country_id=bc.CNT_ID
		, delegate_requests dr, seller_company sc 
		where dr.request_status='Y'
		and dr.seller_com_id=sc.seller_com_id
		and dr.buyer_com_id=bc.buyer_com_id
		and dr.request_mode='B'
		and bc.buyer_com_id = bmf.buyer_com_id
		and buyer_missing_fields_status = 'Y'
		and dr.seller_com_id =".$_SESSION['did']."
		group by drid, oorder order by cname
		";*/

		$cnt=0;
		$op.=  "<table class='table table-bordered table-hover table-striped tablesorter'><thead><tr><th>Reg No.&nbsp;&nbsp;<i class='fa fa-sort'></i></th><th>Organisation Name&nbsp;&nbsp;<i class='fa fa-sort'></i></th><th>Country&nbsp;&nbsp;<i class='fa fa-sort'></i></th><th style='text-align:center;'>Reject</th></tr></thead><tbody>";
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
						if($ptype == '3')
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fl=2&fk=rrs\">".$rs['cname']."</a><span id='ftimeid' class='ftimeclass'>&nbsp;&nbsp;&nbsp;First Time&nbsp;&nbsp;&nbsp;</span></td><td>".$rs['cntName']."</td><td style='text-align:center;'>";
							if(($on == 'N') || ($on == '') || ($on == Null))
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerrejbox('".$rs['bcid']."','1','".$cnt."', this);\" checked disabled />";
							}
							else
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerrejbox('".$rs['bcid']."','1','".$cnt."', this);\" checked/>";
							}
							$op.="</td></tr>";
						}
						else
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fl=2&fk=rrs\">".$rs['cname']."</a><span id='ftimeid' class='ftimeclass'>&nbsp;&nbsp;&nbsp;First Time&nbsp;&nbsp;&nbsp;</span></td><td>".$rs['cntName']."</td><td style='text-align:center;'>";
							if(($on == 'N') || ($on == '') || ($on == Null))
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerrejbox('".$rs['bcid']."','2','".$cnt."', this);\" checked disabled />";
							}
							else
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerrejbox('".$rs['bcid']."','2','".$cnt."', this);\" checked/>";
							}
							$op.="</td></tr>";
						}
					}
					else
					{
						if($ptype == '3')
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fl=2&fk=rrs\">".$rs['cname']."</a><span id='ftimeid' class='ftimeclass'>&nbsp;&nbsp;&nbsp;First Time&nbsp;&nbsp;&nbsp;</span></td><td>".$rs['cntName']."</td><td style='text-align:center;'>";
							if(($on == 'N') || ($on == '') || ($on == Null))
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerrejbox('".$rs['bcid']."','1','".$cnt."', this);\" disabled />";
							}
							else
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerrejbox('".$rs['bcid']."','1','".$cnt."', this);\"/>";
							}
							$op.="</td></tr>";
						}
						else
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fl=2&fk=rrs\">".$rs['cname']."</a><span id='ftimeid' class='ftimeclass'>&nbsp;&nbsp;&nbsp;First Time&nbsp;&nbsp;&nbsp;</span></td><td>".$rs['cntName']."</td><td style='text-align:center;'>";
							if(($on == 'N') || ($on == '') || ($on == Null))
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerrejbox('".$rs['bcid']."','2','".$cnt."', this);\" disabled />";
							}
							else
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerrejbox('".$rs['bcid']."','2','".$cnt."', this);\"/>";
							}
							$op.="</td></tr>";
						}
					}
				}
				else
				{
					if($rs['reject'] == 'Y')
					{
						if($ptype == '3')
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fl=2&fk=rrs\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'>";
							if(($on == 'N') || ($on == '') || ($on == Null))
							{
								$op.= "<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerrejbox('".$rs['bcid']."','1','".$cnt."', this);\" checked disabled />";
							}
							else
							{
								$op.= "<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerrejbox('".$rs['bcid']."','1','".$cnt."', this);\" checked />";
							}
							$op.="</td></tr>";
						}
						else
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fl=2&fk=rrs\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'>";
							if(($on == 'N') || ($on == '') || ($on == Null))
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerrejbox('".$rs['bcid']."','2','".$cnt."', this);\" checked disabled />";
							}
							else
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerrejbox('".$rs['bcid']."','2','".$cnt."', this);\" checked/>";
							}
							$op.="</td></tr>";
						}
					}
					else
					{
						if($ptype == '3')
						{

							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fl=2&fk=rrs\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'>";
							if(($on == 'N') || ($on == '') || ($on == Null))
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerrejbox('".$rs['bcid']."','1','".$cnt."', this);\" disabled />";
							}
							else
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerrejbox('".$rs['bcid']."','1','".$cnt."', this);\"/>";
							}
							$op.="</td></tr>";
						}
						else
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"buyerDetails.php?id=".$rs['bcid']."&fl=2&fk=rrs\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'>";
							if(($on == 'N') || ($on == '') || ($on == Null))
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerrejbox('".$rs['bcid']."','2','".$cnt."', this);\" disabled />";
							}
							else
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"sellerrejbox('".$rs['bcid']."','2','".$cnt."', this);\"/>";
							}
							$op.="</td></tr>";
						}
					}
				}
			}
		}
		/*$q=mysql_query("select count(buyer_com_id) as cnt from delegate_requests where seller_com_id ='".$_SESSION['did']."' and request_mode='B' and reject = 'Y'");*/
	
		$q1=mysql_query("select count(buyer_com_id) as cnt from 
					(select distinct buyer_com_id from 
					delegate_requests where buyer_com_id ='".$_SESSION['did']."'
					and request_mode='B'
					and reject = 'Y') al");
		$cntchk=mysql_result($q1,0);
		$op.="</tbody></table>";
		$op.= "<input type='hidden' id='hidcountchk' name='hidcountchk' value='".$cntchk."' /><center><a href='rejectAppointmentRequestBuyer.php'>";
			if(($on == 'N') || ($on == '') || ($on == Null))
			{
					$op.="&nbsp;";
			}
			else
			{
					$op.="<input type='button' class='btn btn-default' style='width:250px;' id='butsave' value='Save' />";
			}
				
				$op.="</a></center>";
		echo $op;
	}
	catch(Exception $e)
	{
		echo $e;
	}

?>