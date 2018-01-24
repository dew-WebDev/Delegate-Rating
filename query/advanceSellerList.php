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
		
		$q=mysql_query("select count(request_id) as cnt from delegate_requests where requested_delegate_id ='".$_SESSION['user_name']."' and request_mode='B'");

		$cntchk=mysql_result($q,0);

		if ($cntchk == 0)
		{
			$q=mysql_query("select count(request_id) as cnt from temp_delegate_requests where requested_delegate_id ='".$_SESSION['user_name']."' and request_mode='B'");

			$cntchk=mysql_result($q,0);
		}
		else
		{
			$cntchk = -1;
		}

		$op="";
		
		$qry="select 
		sc.seller_com_id as scid, sc.first_time_attending, sc.company_id as cid, sc.company_name as cname, c.country_name as cntName 
		from seller_company sc left join seller_org_details sod on sc.seller_com_id = sod.seller_com_id 
		left join seller_missing_fields smf on sc.seller_com_id = smf.seller_com_id 
		left join countries c on c.country_id=sc.cnt_id 
		where sc.seller_status = 'Y' 
		and (smf.seller_missing_fields_status is null or smf.seller_missing_fields_status='Y') 
		and (sod.seller_org_status is null or sod.seller_org_status = 'Y') 
		and (sod.markForDelete is null or sod.markForDelete = '0') 
		and (sod.pre_addendum is null || sod.pre_addendum = '0')
		and sc.company_name ".$_GET['svalue']."
		and sc.company_name like '%".$_GET['selcompany']."%'";
		
		if(isset($_GET['selcountry']) && $_GET['selcountry'] != 0)
		{
			$qry.=" and sc.cnt_id IN (".$_GET['selcountry'].")";
		}
		if(isset($_GET['selseller']) && $_GET['selseller'] != 0)
		{
			if($_GET['selseller'] == 1)
			{
				$qry.=" and sc.first_time_attending=1";
			}
			else if($_GET['selseller'] == 2)
			{
				$qry.=" and sc.first_time_attending=0";
			}
		}
		
		if(isset($_GET['selselprofile']) && $_GET['selselprofile'] != 0)
		{
			$listarrayprofile = explode(",", $_GET['selselprofile']);
			$qryselselprofile = "";
			for ($index = 1; $index <= 26; $index++){
	            if($qryselselprofile === ""){
					if (in_array(str_pad($index, 2, '0', STR_PAD_LEFT),$listarrayprofile)){
		                $qryselselprofile.=" and (smf.servtype".$index."= ".($index + 1);
		            }
				}else{
					if (in_array(str_pad($index, 2, '0', STR_PAD_LEFT),$listarrayprofile)){
		                $qryselselprofile.="  or smf.servtype".$index."= ".($index + 1);
		            }
				}
	        }

	        if (in_array('00', $listarrayprofile)){
	        	if($qryselselprofile === ""){
	        		$qryselselprofile.=" and smf.servtype27='28' ";
	        	}else{
	        		$qryselselprofile.=" or smf.servtype27='28' ";
	        	}
	            
	        }
	        $qryselselprofile = $qryselselprofile." )";
			$qry.=$qryselselprofile;
		}


		$qry.=" order by sc.company_name";
		

		$op.= "<table class='table table-bordered table-hover table-striped tablesorter'>
				<thead>
					<tr>
						<th>Reg No.&nbsp;<i class='fa fa-sort'></i></th>
						<th>Organisation Name&nbsp;&nbsp;<i class='fa fa-sort'></i></th>
						<th>Country&nbsp;&nbsp;<i class='fa fa-sort'></i></th>
					</tr>
				</thead><tbody>";
		$cnt=0;
		$q=mysql_query($qry);
		if(mysql_num_rows($q)>0)
		{
			while($rs=mysql_fetch_array($q))
			{
				$cnt+=1;
				if($rs['first_time_attending'] == 1)
				{
					if ($cntchk > -1)
					{
						if (($pack == 'C' && $cntchk < 25) || ($pack != 'C' && $cntchk < 25))  // Maximum Appointment Selections
						{
							$op.= "<tr style='width:10%;'><td>".$rs['cid']."</td><td style='width:70%;'><a href=\"sellerDetails.php?id=".$rs['scid']."&fk=asl\">".$rs['cname']."</a></td><td style='width:20%;'>".$rs['cntName']."</td></tr>";
						}
						else
						{
							$op.= "<tr style='width:10%;'><td>".$rs['cid']."</td><td style='width:70%;'><a href=\"sellerDetails.php?id=".$rs['scid']."&fl=1&fk=asl\">".$rs['cname']."</a></td><td style='width:20%;'>".$rs['cntName']."</td></tr>";
						}
					}
					else
					{
						$op.= "<tr style='width:10%;'><td>".$rs['cid']."</td><td style='width:70%;'><a href=\"sellerDetails.php?id=".$rs['scid']."&fl=2&fk=asl\">".$rs['cname']."</a><td style='width:20%;'>".$rs['cntName']."</td></tr>";
					}
				}
				else
				{
					if ($cntchk > -1)
					{
						if (($pack == 'C' && $cntchk < 20) || ($pack != 'C' && $cntchk < 40))
						{
							$op.= "<tr style='width:10%;'><td>".$rs['cid']."</td><td style='width:70%;'><a href=\"sellerDetails.php?id=".$rs['scid']."&fk=asl\">".$rs['cname']."</a></td><td style='width:20%;'>".$rs['cntName']."</td></tr>";
						}
						else
						{
							$op.= "<tr style='width:10%;'><td>".$rs['cid']."</td><td style='width:70%;'><a href=\"sellerDetails.php?id=".$rs['scid']."&fl=1&fk=asl\">".$rs['cname']."</a></td><td style='width:20%;'>".$rs['cntName']."</td></tr>";
						}
					}
					else
					{
						$op.= "<tr style='width:10%;'><td>".$rs['cid']."</td><td style='width:70%;'><a href=\"sellerDetails.php?id=".$rs['scid']."&fl=2&fk=asl\">".$rs['cname']."</a></td><td style='width:20%;'>".$rs['cntName']."</td></tr>";
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