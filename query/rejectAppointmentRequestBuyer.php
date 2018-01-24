<?php
require_once("connectivity.php");
session_start();
	try
	{
	
		$q=mysql_query("select buyer_org_id from buyer_org_details where buyer_com_id=".$_SESSION['did']." AND one_day_buyer IN ('Y', 'y', 'T', 't', '1')");
		$pack=0;
		if(mysql_num_rows($q) > 0)
		{
			$pack = 'C';
		}
		
		$tq=mysql_query("select * from date_settings where settings_status='Y'");
		$on="";
		$off="";
		if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
		{
			$on = $rs['app_rejection_on'];
		}
		
		$op="";
	
	$qry="
			select dr.reject,
			sc.seller_com_id as scid,
			dr.appointment_order as oorder,
			sc.company_id as cid, sc.first_time_attending,
			sc.company_name as cname, c.country_name as cntName,
			dr.requested_delegate_id as drid
			from
			buyer_company bc,
			delegate_requests dr,
			seller_company sc
			left join countries c on c.country_id=sc.cnt_id where dr.request_status='Y' and dr.seller_com_id=sc.seller_com_id
			and dr.buyer_com_id=bc.buyer_com_id
			and dr.request_mode='S'
			and dr.buyer_com_id =".$_SESSION['did']."
			group by cid,oorder
			order by cname";
		/*$qry="
		select 
		dr.reject, sc.seller_com_id as scid, dr.appointment_order as oorder, sc.company_id as cid, sc.first_time_attending, sc.company_name as cname, c.country_name as cntName, dr.requested_delegate_id as drid 
		from 
		buyer_company bc, delegate_requests dr, seller_company sc 
		left join
		countries c on 
		c.country_id=sc.cnt_id
		where dr.request_status='Y' and dr.seller_com_id=sc.seller_com_id
		and dr.buyer_com_id=bc.buyer_com_id 
		and dr.request_mode='S' 
		and dr.buyer_com_id =".$_SESSION['did']."
		group by drid,oorder,scid order by cname";*/
		$cnt=0;
		$op.=  "<table class='table table-bordered table-hover table-striped tablesorter'><thead><tr><th>Reg No.&nbsp;&nbsp;<i class='fa fa-sort'></i></th><th>Organisation Name&nbsp;&nbsp;<i class='fa fa-sort'></i></th><th>Country&nbsp;&nbsp;<i class='fa fa-sort'></i></th><th style='text-align:center;'>Reject</th></tr></thead><tbody>";
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
						if($pack === 'C')
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fl=2&fk=rrs\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'>";
							if(($on == 'N') || ($on == '') || ($on == Null))
							{
									$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerrejbox('".$rs['scid']."','1','".$cnt."', this);\" checked disabled  />";
							}
							else
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerrejbox('".$rs['scid']."','1','".$cnt."', this);\" checked/>";
							}
							
							$op.="</td></tr>";
						}
						else
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fl=2&fk=rrs\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'>";
							if(($on == 'N') || ($on == '') || ($on == Null))
							{
									$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerrejbox('".$rs['scid']."','2','".$cnt."', this);\" checked disabled />";
							}
							else
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerrejbox('".$rs['scid']."','2','".$cnt."', this);\"  checked />";
							}
							$op.="</td></tr>";
						}
					}
					else
					{
						if($pack === 'C')
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fl=2&fk=rrs\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'>";
							if(($on == 'N') || ($on == '') || ($on == Null))
							{
									$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerrejbox('".$rs['scid']."','1','".$cnt."', this);\" disabled  />";
							}
							else
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerrejbox('".$rs['scid']."','1','".$cnt."', this);\" />";
							}
							$op.="</td></tr>";
						}
						else
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fl=2&fk=rrs\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'>";
							if(($on == 'N') || ($on == '') || ($on == Null))
							{
									$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerrejbox('".$rs['scid']."','2','".$cnt."', this);\" disabled  />";
							}
							else
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerrejbox('".$rs['scid']."','2','".$cnt."', this);\" />";
							}
							$op.="</td></tr>";
						}
					}
				}
				else
				{
					if($rs['reject'] == 'Y')
					{
						if($pack === 'C')
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fl=2&fk=rrs\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'>";
							if(($on == 'N') || ($on == '') || ($on == Null))
							{
									$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerrejbox('".$rs['scid']."','1','".$cnt."', this);\" checked disabled />";
							}
							else
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerrejbox('".$rs['scid']."','1','".$cnt."', this);\" checked/>";
							}
							$op.="</td></tr>";
						}
						else
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fl=2&fk=rrs\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'>";
							if(($on == 'N') || ($on == '') || ($on == Null))
							{
									$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerrejbox('".$rs['scid']."','2','".$cnt."', this);\" checked disabled  />";
							}
							else
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerrejbox('".$rs['scid']."','2','".$cnt."', this);\" checked/>";
							}
							$op.="</td></tr>";
						}
					}
					else
					{
						if($pack === 'C')
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fl=2&fk=rrs\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'>";
							if(($on == 'N') || ($on == '') || ($on == Null))
							{
									$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerrejbox('".$rs['scid']."','1','".$cnt."', this);\" disabled/>";
							}
							else
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerrejbox('".$rs['scid']."','1','".$cnt."', this);\" />";
							}
							$op.="</td></tr>";
						}
						else
						{
							$op.= "<tr><td>".$rs['cid']."</td><td><a href=\"sellerDetails.php?id=".$rs['scid']."&fl=2&fk=rrs\">".$rs['cname']."</a></td><td>".$rs['cntName']."</td><td style='text-align:center;'>";
							if(($on == 'N') || ($on == '') || ($on == Null))
							{
									$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerrejbox('".$rs['scid']."','2','".$cnt."', this);\" disabled  />";
							}
							else
							{
								$op.="<input type='checkbox' class='chk' name='chk".$cnt."' id='chk".$cnt."' onClick=\"buyerrejbox('".$rs['scid']."','2','".$cnt."', this);\" />";
							}
							$op.="</td></tr>";
						}
					}
				}
			}
		}
		/*$q=mysql_query("select count(seller_com_id) as cnt from delegate_requests where buyer_com_id ='".$_SESSION['did']."' and request_mode='S' and reject = 'Y'");*/
		
		$q1=mysql_query("select count(seller_com_id) as cnt from 
						(select distinct seller_com_id from 
						delegate_requests where buyer_com_id ='".$_SESSION['did']."'
						and request_mode='S'
						and reject = 'Y') al");
						

		$cntchk=mysql_result($q1,0);
		$op.="</tbody></table>";
		$op.= "<input type='hidden' id='hidcountchk' name='hidcountchk' value='".$cntchk."' /><center><a href='rejectAppointmentRequestSeller.php'>";
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