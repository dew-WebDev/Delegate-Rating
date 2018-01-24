<?php
ini_set('max_execution_time', 1800);
require_once("query/connectivity.php");
require('fpdf/fpdf-report.php');
$edateo = mysql_query("select* from emaildate where emaildate_status = 'Y'");
	if(mysql_num_rows($edateo)>0)
	{
		if($edateoo=mysql_fetch_array($edateo))
		{
			$bussinessconfirm_date=$edateoo['bussinessconfirm_date'];
			$ptm_year=$edateoo['ptm_year'];
		}
	}
global $pname;
global $scname;
global $sname;
global $scomid;
global $scountry;
global $username;
global $xValue;
global $tpage;
global $ptm_year;

$xValue=0;

$pname="SELLER APPOINTMENT SCHEDULE";

$count=0;

$data="";
$scid=$_GET['scid'];

$qry ="select 
			seller_company.company_name as scname, 
			seller_company.cnt_id as scountry_id,
			seller_company.company_id as scomid, 
			mas_seller.fullname as sname, 
			boothNumber as bno, 
			buyer_company.company_name as bcname, 
			buyer_company.cnt_id as bcountry_id,
			buyer_company.company_id as bcomid, 
			mas_buyer.fullname as bname, 
			date_format(time_slot_date,'%b- %d')  as time_slot_date, 
			time_slot_id_from, 
			time_slot_id_to, 
			type, 
			time_slots.time_slot_id, 
 			time_slots.slottype,
 			time_slots.venue,
			time_slots.time_slot_description, 
			mas_buyer.mas_buyer_id as bcid, 
			mas_seller.mas_seller_id as scid
			from 

			( select *, 'g' as slottype from time_slots_generic where time_slot_date > '".$bussinessconfirm_date."' union select *, 't' as slottype from time_slots ) time_slots  
			left join appointments on time_slots.time_slot_id = appointments.time_slot_id and appointments.mas_seller_com_id in (select mas_seller_id from seller_delegate_detail where username = '".$scid."')
			left join seller_company on appointments.seller_com_id = seller_company.seller_com_id
			left join buyer_company on appointments.buyer_com_id = buyer_company.buyer_com_id
			left join mas_seller on appointments.mas_seller_com_id = mas_seller.mas_seller_id
			left join mas_buyer on appointments.mas_buyer_com_id = mas_buyer.mas_buyer_id
			left join seller_org_details on appointments.seller_com_id = seller_org_details.seller_com_id and seller_org_details.seller_org_status = 'Y'
			order by time_slot_date, session, in_session";
			
			$k=mysql_query($qry);
				
			if(mysql_num_rows($k)>0)
			{
				while($krows=mysql_fetch_array($k))
				{
				
					$count+=1;
					
					$arequest="";
					if ($krows['type'] == 'P')
					{
						$arequest="MUTUAL";
					}
					else if($krows['type'] == 'S')
					{
						$arequest="SELLER";
					}
					else
					{
						$arequest="BUYER";
					}
					
					
					if ($krows['scname'] != '')
					{
						$scname= $krows['scname'];
					}
					
					if ($krows['sname'] != '')
					{
						$sname= $krows['sname'];
					}
					
					if ($krows['scomid'] != '')
					{
						$scomid= $krows['scomid'];
					}
					
					$descrip="";
					
					$cntry="";
					
					if($krows['scountry_id'] != '')
					{
						$q=mysql_query("select * from countries where country_id=".$krows['scountry_id']);
						if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
						{
							$scountry=$r['country_name'];
						}
					}
					if($krows['bcountry_id'] != '' )
					{
						$q=mysql_query("select * from countries where country_id=".$krows['bcountry_id']);
						if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
						{
							$cntry=$r['country_name'];
						}
					}

					if($krows['slottype'] == 'g')
					{
						if((strcmp($krows['time_slot_description'],"End of Day 1") == 0) || (strcmp($krows['time_slot_description'],"End of Business Session") == 0))
						{
							$data.=" _g^ _g^ _g^".$krows['time_slot_description']."_g^End_g^End_g|";
						}
						else
						{
							if(trim($krows['venue']) != "")
							{
								$strlength=strlen($krows['time_slot_description']." Venue : ".$krows['venue']);
								$str=" ";
								if($strlength <=48)
								{
									$str=" \n ";
								}
								else
								{
									for($h=0;$h<$strlength;$h++)
									{
										if($h % 49 == 0)
										{
											$str.="\n ";
										}
									}
								}
								$descrip = $krows['time_slot_description']."\nVenue : ".$krows['venue']."_".$krows['slottype']."^".$str."_g^".$str."_g|";
							}
							else
							{
								$strlength=strlen($krows['time_slot_description']);
								$str=" ";
								if($strlength <=48)
								{
									$str=" ";
								}
								else
								{
									for($h=0;$h<$strlength;$h++)
									{
										if($h % 49 == 0)
										{
											$str.="\n ";
										}
									}
								}
								$descrip = $krows['time_slot_description']."_".$krows['slottype']."^".$str."_g^".$str."_g|";
							}
							$data.=$krows['time_slot_date']."^".$krows['time_slot_id_from']."^".$krows['time_slot_id_to']."^".$descrip;
						}
					}
					else
					{
						if($krows['bcomid'] != "")
						{
							//$descrip="Reg No : ".$krows['bcomid']."\n".$krows['bcname'].", ".$cntry."\n".$krows['bname']."_".$krows['slottype']."\n Please rate: 1.Lowest  2.  3.  4.  5.Highest";
							$descrip="Reg No: ".$krows['bcomid']."\n".$krows['bcname'].", ".$cntry."\n".$krows['bname']."\nPlease rate buyer:  1.Lowest   2.   3.   4.   5.Highest"."_".$krows['slottype'];
							$data.=$krows['time_slot_date']."^".$krows['time_slot_id_from']."^".$krows['time_slot_id_to']."^".$descrip."^".$arequest."_t^ _t|";
						}
						else
						{
							$data.=$krows['time_slot_date']."^".$krows['time_slot_id_from']."^".$krows['time_slot_id_to']."^ \n _t^ _t^ _t|";
						}
					}
				}
			}
			
		
$data=substr($data,0,-1);
$rowdata = explode("|", $data);

$count1=0;
$data1="";



$qry ="select * from
			(
			select 
			seller_company.seller_com_id as scid,
			buyer_company.cnt_id as bcountry_id,
			buyer_company.buyer_com_id as bcid,
			buyer_company.company_id as cid,
			buyer_company.create_date as registeration_date,
			delegate_login.mas_seller_id as mscid,
			mas_buyer.mas_buyer_id as mbcid,
			seller_company.company_name as scname, 
			mas_seller.fullname as sname, 
			boothNumber as bno, 
			buyer_company.company_name as bcname, 
			mas_buyer.fullname as bname, 
			delegate_requests.appointment_order,
			'SELLER' as matching_condition
			from 
			seller_company 
			inner join delegate_requests on seller_company.seller_com_id = delegate_requests.seller_com_id
			inner join buyer_company on buyer_company.buyer_com_id = delegate_requests.buyer_com_id
			inner join mas_buyer on buyer_company.buyer_com_id = mas_buyer.mas_buyer_com_id
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join delegate_login on delegate_requests.requested_delegate_id = delegate_login.user_name
			inner join mas_seller on delegate_login.mas_seller_id = mas_seller.mas_seller_id
			where request_mode = 'S'
			and 
			delegate_login.mas_seller_id in (select mas_seller_id from seller_delegate_detail where username = '".$scid."')
			and
			mas_buyer.mas_buyer_status = 'Y'
			and
			exists
			(
			select 
			request_id
			from 
			seller_company sc
			inner join delegate_requests tdr on sc.seller_com_id = tdr.seller_com_id
			inner join buyer_company bc on bc.buyer_com_id = tdr.buyer_com_id
			where tdr.request_mode = 'B'
			and tdr.seller_com_id = seller_company.seller_com_id
			and tdr.buyer_com_id = buyer_company.buyer_com_id
			) 
			and
			not exists 
			(
			select time_slot_id from appointments where appointments.seller_com_id = seller_company.seller_com_id and appointments.buyer_com_id = buyer_company.buyer_com_id
			)

			union
			
			select 
			seller_company.seller_com_id as scid,
			buyer_company.cnt_id as bcountry_id,
			buyer_company.buyer_com_id as bcid,
			buyer_company.company_id as cid,
			buyer_company.create_date as registeration_date,
			delegate_login.mas_seller_id as mscid,
			mas_buyer.mas_buyer_id as mbcid,
			seller_company.company_name as scname, 
			mas_seller.fullname as sname, 
			boothNumber as bno, 
			buyer_company.company_name as bcname, 
			mas_buyer.fullname as bname, 
			delegate_requests.appointment_order,
			'SELLER' as matching_condition
			from 
			seller_company 
			inner join delegate_requests on seller_company.seller_com_id = delegate_requests.seller_com_id
			inner join buyer_company on buyer_company.buyer_com_id = delegate_requests.buyer_com_id
			inner join mas_buyer on buyer_company.buyer_com_id = mas_buyer.mas_buyer_com_id
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join delegate_login on delegate_requests.requested_delegate_id = delegate_login.user_name
			inner join mas_seller on delegate_login.mas_seller_id = mas_seller.mas_seller_id
			where request_mode = 'S'
			and 
			delegate_login.mas_seller_id in (select mas_seller_id from seller_delegate_detail where username = '".$scid."')
			and
			mas_buyer.mas_buyer_status = 'Y'
			and
			not exists
			(
			select 
			request_id
			from 
			seller_company sc
			inner join delegate_requests tdr on sc.seller_com_id = tdr.seller_com_id
			inner join buyer_company bc on bc.buyer_com_id = tdr.buyer_com_id
			where tdr.request_mode = 'B'
			and tdr.seller_com_id = seller_company.seller_com_id
			and tdr.buyer_com_id = buyer_company.buyer_com_id
			) 
			and
			not exists 
			(
			select time_slot_id from appointments where appointments.seller_com_id = seller_company.seller_com_id and appointments.buyer_com_id = buyer_company.buyer_com_id
			)

			union
			
			select 
			seller_company.seller_com_id as scid,
			buyer_company.cnt_id as bcountry_id,
			buyer_company.buyer_com_id as bcid,
			buyer_company.company_id as cid,
			buyer_company.create_date as registeration_date,
			mas_seller.mas_seller_id as mscid,
			mas_buyer.mas_buyer_id as mbcid,
			seller_company.company_name as scname, 
			mas_seller.fullname as sname, 
			boothNumber as bno, 
			buyer_company.company_name as bcname, 
			mas_buyer.fullname as bname, 
			delegate_requests.appointment_order,
			'BUYER' as matching_condition
			from 
			seller_company 
			inner join delegate_requests on seller_company.seller_com_id = delegate_requests.seller_com_id
			inner join buyer_company on buyer_company.buyer_com_id = delegate_requests.buyer_com_id
			inner join mas_buyer on buyer_company.buyer_com_id = mas_buyer.mas_buyer_com_id
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join mas_seller on seller_company.seller_com_id = mas_seller.mas_seller_com_id
			where request_mode = 'B'
			and 
			mas_seller.mas_seller_id in (select mas_seller_id from seller_delegate_detail where username = '".$scid."')
			and
			mas_buyer.mas_buyer_status = 'Y'
			and
			not exists
			(
			select 
			request_id
			from 
			seller_company sc
			inner join delegate_requests tdr on sc.seller_com_id = tdr.seller_com_id
			inner join buyer_company bc on bc.buyer_com_id = tdr.buyer_com_id
			where tdr.request_mode = 'S'
			and tdr.seller_com_id = seller_company.seller_com_id
			and tdr.buyer_com_id = buyer_company.buyer_com_id
			) 
			and
			not exists 
			(
			select time_slot_id from appointments where appointments.seller_com_id = seller_company.seller_com_id and appointments.buyer_com_id = buyer_company.buyer_com_id
			)
			)
			sel 
			group by scid, bcid
			order by registeration_date";
			
			$k=mysql_query($qry);
				
			if(mysql_num_rows($k)>0)
			{
				while($krows=mysql_fetch_array($k))
				{
				
					$cntry="";
					$q=mysql_query("select * from countries where country_id=".$krows['bcountry_id']);
					if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
					{
						$cntry=$r['country_name'];
					}
				
					$count1+=1;
					
					$data1.=$krows['cid'].", ".$krows['bcname'].",\n".$krows['bname'].", ".$cntry."^".$krows['matching_condition']."^ |";

				}
			}
			
			$q=mysql_query("select dl.username, sc.company_name, ms.fullname, sc.company_id, sc.cnt_id from seller_company sc, mas_seller ms, seller_delegate_detail dl where ms.mas_seller_com_id=sc.seller_com_id and ms.mas_seller_id=dl.mas_seller_id and ms.mas_seller_status='Y' and sc.seller_status='Y' and ms.delegate='1' and dl.username='".$scid."'");
			if(mysql_num_rows($q)>0)
			{
				while($r=mysql_fetch_array($q))
				{
					$scname= $r['company_name'];
					$sname= $r['fullname'];
					$scomid= $r['company_id'];
					$username= $r['username'];
					$cntry="";
					$q1=mysql_query("select * from countries where country_id='".$r['cnt_id']."'"	);
					if(mysql_num_rows($q1)>0 && $r1=mysql_fetch_array($q1))
					{
						$scountry=$r1['country_name'];
					}
				}
			}


$data1=substr($data1,0,-1);
$rowdata1 = explode("|", $data1);

$header = array("Date","Start Time","End Time","Details","Requested By","Signature");
$header1 = array("Unmatched Appointment List","Requested By","Remark");

class PDF extends FPDF
{

// Page header
function Header()
{
$this->setleftmargin(20);
$tpage = $GLOBALS['tpage'];
$tpage='{nb}';
	if($this->PageNo() == 1) 
	{

		$pname = $GLOBALS['pname'];
		$scname = $GLOBALS['scname'];
		$sname = $GLOBALS['sname'];
		$scomid = $GLOBALS['scomid'];
		$scountry = $GLOBALS['scountry'];
		$username = $GLOBALS['username'];
		$ptm_year = $GLOBALS['ptm_year'];
		
		// Logo
		$this->Image('images/PDFLogo.jpg',10,10,50);

		//$this->Image('images/PDFLogo.jpg',10,10,60,30,'PNG');

		// Arial bold 15
		$this->SetFont('Arial','B',12);
		// Move to the right
		$this->Cell(53);
		// Title
		$this->setXY(70,10);
		$this->Cell(50,0,'PATA Adventure Travel Conference and Mart '.$ptm_year,0,0,'L');

		$this->setXY(70,16);
		$this->Cell(50,0,$pname,0,0,'L');

		$this->setXY(70,22);
		$this->Cell(50,0,$scname.", ".$scountry,0,0,'L');

		$this->setXY(70,28);
		$this->Cell(50,0,$sname,0,0,'L');

		$this->setXY(70,34);
		$this->Cell(50,0,"Reg. No : ".$scomid,0,0,'L');

		$this->SetFont('Times','B',12);
		$this->setXY(180,10);
		$this->Cell(30,0,$username,0,0,'c');
		$this->Ln(35);
	}
}

function BasicTable($header,$rowdata,$count)
{

$xValue = $GLOBALS['xValue'];
    // Header

  $this->SetFont('Times','B',10);
$cc=0;

    foreach($header as $titledata)
	{
	$cc+=1;
		if($cc == 4)
		{
			$this->Cell(75,8,$titledata,1,0,'C');
		}
		else if($cc == 5 || $cc == 6)
		{
			$this->Cell(23,8,$titledata,1,0,'C');
		}
		else
		{
			$this->Cell(20,8,$titledata,1,0,'C');
		}
//        $this->Cell(60,8,$titledata,1,0,'C');
	}
    $this->Ln();
    // Data
  $this->SetFont('Times','',10);

		foreach ($rowdata as $row) 
		{		
		        $x = $this->GetX();
			$cols=explode("^", $row);
			$maxY=7;
			
			if($this->getY() > 280)
			{
			 	$this->AddPage($this->CurOrientation);
				$this->SetFont('Times','B',10);
$cc=0;
				foreach($header as $titledata)
				{
					$cc+=1;
					if($cc == 4)
					{
						$this->Cell(75,$maxY,$titledata,1,0,'C');
					}
					else if($cc == 5 || $cc == 6)
					{
						$this->Cell(23,$maxY,$titledata,1,0,'C');
					}
					else
					{
						$this->Cell(20,$maxY,$titledata,1,0,'C');
					}
					//$this->Cell(60,$maxY,$titledata,1,0,'C');
				}
				$this->Ln();
			  	$this->SetFont('Times','',10);
			}
$cc=0;
			foreach ($cols as $col) 
			{
				$cc+=1;
				if($cc == 4)
				{
					$col = explode("_", $col);
					if($col[1] == 'g')
					{
					    $this->SetFillColor(120,120,120);
						$curH = $this->GetMultiCellHeight(75,7,$col[0],1);
					}
					else
					{
						$curH = $this->GetMultiCellHeight(75,7,$col[0],1);
					}
					$maxY = ($maxY < $curH ? $curH : $maxY);
				}
				else if($cc == 5 || $cc == 6)
				{
					$curH = $this->GetMultiCellHeight(23,7,$col,1);
					$maxY = ($maxY < $curH ? $curH : $maxY);
				}
				else
				{
					$curH = $this->GetMultiCellHeight(20,7,$col,1);
					$maxY = ($maxY < $curH ? $curH : $maxY);
				}
			}
$cc=0;
			foreach ($cols as $col) 
			{
			$cc+=1;
				if($cc == 4)
				{
					$col = explode("_", $col);
					if($col[1] == 'g')
					{
					    $this->SetFillColor(120,120,120);
						$this->Cell(75,$maxY,"",1);
					}
					else
					{
						$this->Cell(75,$maxY,"",1);
					}
				}
				else if($cc == 5 || $cc == 6)
				{
					$col = explode("_", $col);
					if($col[1] == 'g')
					{
					    $this->SetFillColor(120,120,120);
						$this->Cell(23,$maxY,"",1);
					}
					else
					{
						$this->Cell(23,$maxY,"",1);
					}
				}
				else
				{
					$col = explode("_", $col);
					if($col[0] == 'g')
					{
					    $this->SetFillColor(120,120,120);
						$this->Cell(20,$maxY,"",1);
					}
					else
					{
						$this->Cell(20,$maxY,"",1);
					}
				}
				
			}

			$yBeforeCell = $this->GetY();
			$this->SetXY($x, $yBeforeCell);
$cc=0;
			foreach ($cols as $col) 
			{
			$this->SetTextColor(0,0,0);
			$cc+=1;
				if($cc == 4)
				{
					$col = explode("_", $col);
					if($col[1] == 'g')
					{
						if((strcmp($col[0],"End of Day 1") == 0) || (strcmp($col[0],"End of Business Session") == 0))
						{
							$this->SetFillColor(200,200,200);
								$yBeforeCell = $this->GetY();
								$this->MultiCell(75,7,$col[0],0,'C',true);
										$y = $this->GetY();
										$this->SetXY($x + 75, $yBeforeCell);
										$x = $this->GetX();
							$this->SetFillColor(255,255,255);
						}
						else
						{
					    $this->SetFillColor(120,120,120);
					    $this->SetTextColor(255,255,255);
							$yBeforeCell = $this->GetY();
							$this->MultiCell(75,7,$col[0],0,'L',true);
									$y = $this->GetY();
									$this->SetXY($x + 75, $yBeforeCell);
									$x = $this->GetX();
					    $this->SetTextColor(0,0,0);
					    $this->SetFillColor(255,255,255);
						}
					}
					else
					{
						$yBeforeCell = $this->GetY();
						$this->MultiCell(75,7,$col[0],0);
								$y = $this->GetY();
								$this->SetXY($x + 75, $yBeforeCell);
								$x = $this->GetX();
					}
				}
				else if($cc == 5 || $cc == 6)
				{
					$col = explode("_", $col);
					if($col[1] == 'g')
					{
						if((strcmp($col[0],"End") == 0) || (strcmp($col[0],"End") == 0))
						{
							$this->SetFillColor(200,200,200);
								$yBeforeCell = $this->GetY();
								$this->MultiCell(23,7," ",0,'C',true);
										$y = $this->GetY();
										$this->SetXY($x + 23, $yBeforeCell);
										$x = $this->GetX();
							$this->SetFillColor(255,255,255);
						}
						else
						{
							$this->SetFillColor(120,120,120);
							$this->SetTextColor(255,255,255);
								$yBeforeCell = $this->GetY();
								$this->MultiCell(23,7,$col[0],0,'L',true);
										$y = $this->GetY();
										$this->SetXY($x + 23, $yBeforeCell);
										$x = $this->GetX();
							$this->SetTextColor(0,0,0);
							$this->SetFillColor(255,255,255);
						}
					}
					else
					{

						$yBeforeCell = $this->GetY();
						if((strcmp($col[0],"MUTUAL") == 0) && $cc == 5 )
						{
							$this->SetTextColor(255,0,0);
							$this->MultiCell(23,7,$col[0],0);
						}
						else
						{
							$this->MultiCell(23,7,$col[0],0);
						}
						//	$this->MultiCell(60,7,$col[0],0);
							$y = $this->GetY();
							$this->SetXY($x + 23, $yBeforeCell);
							$x = $this->GetX();
					}
				}
				else
				{
				
					$col = explode("_", $col);
					if($col[0] == 'g')
					{
					    $this->SetFillColor(200,200,200);
							$yBeforeCell = $this->GetY();
							$this->MultiCell(20,7,$col[0],0,'C',true);
								$y = $this->GetY();
								$this->SetXY($x + 20, $yBeforeCell);
								$x = $this->GetX();
					    $this->SetFillColor(255,255,255);
					}
					else
					{
						$yBeforeCell = $this->GetY();
						$this->MultiCell(20,7,$col[0],0);
							$y = $this->GetY();
							$this->SetXY($x + 20, $yBeforeCell);
							$x = $this->GetX();
					}
					$xValue+=$x;
				}
			
	                    
			}
			$this->Ln($maxY);
		}
		$y=$this->GetY();
		
/* No more this part for seller 16-Aug-16
		if($y<200)
		{
			$this->Image('images/report_question_all.png',20,$y+7,65);
		}
		else
		{
			$this->AddPage($this->CurOrientation);
			$this->Image('images/report_question_all.png',20,7,65);
		}
*/
}

function BasicTable1($header,$rowdata,$count)
{

    // Header
	$y=$this->getY();
	$toty=$y+60; 	// viroj reduce the distance
	if($toty<260)
	{
		$this->Ln($toty);
	}
	else
	{
		$this->AddPage($this->CurOrientation);
	}
  $this->SetFont('Times','B',10);
$cc=0;

    foreach($header as $titledata)
	{
	$cc+=1;
		if($cc == 1)
		{
			$this->Cell(120,8,$titledata,1,0,'C');
		}
		else if($cc == 2)
		{
			$this->Cell(30,8,$titledata,1,0,'C');
		}
		else
		{
			$this->Cell(30,8,$titledata,1,0,'C');
		}
//        $this->Cell(60,8,$titledata,1,0,'C');
	}
    $this->Ln();
    // Data
  $this->SetFont('Times','',10);

		foreach ($rowdata as $row) 
		{		
		        $x = $this->GetX();
			$cols=explode("^", $row);
			$maxY=7;
			
			if($this->getY() > 280)
			{
			 	$this->AddPage($this->CurOrientation);
				$this->SetFont('Times','B',10);
$cc=0;
				foreach($header as $titledata)
				{
					$cc+=1;
					if($cc == 1)
					{
						$this->Cell(120,$maxY,$titledata,1,0,'C');
					}
					else if($cc == 2)
					{
						$this->Cell(30,$maxY,$titledata,1,0,'C');
					}
					else
					{
						$this->Cell(30,$maxY,$titledata,1,0,'C');
					}
					//$this->Cell(60,$maxY,$titledata,1,0,'C');
				}
				$this->Ln();
			  	$this->SetFont('Times','',10);
			}
$cc=0;
			foreach ($cols as $col) 
			{
				$cc+=1;
				if($cc == 1)
				{
					$curH = $this->GetMultiCellHeight(120,6,$col,1);
					$maxY = ($maxY < $curH ? $curH : $maxY);
				}
				else if($cc == 2)
				{
					$curH = $this->GetMultiCellHeight(30,6,$col,1);
					$maxY = ($maxY < $curH ? $curH : $maxY);
				}
				else
				{
					$curH = $this->GetMultiCellHeight(30,6,$col,1);
					$maxY = ($maxY < $curH ? $curH : $maxY);
				}
			}
$cc=0;
			foreach ($cols as $col) 
			{
			$cc+=1;
				if($cc == 1)
				{
					$this->Cell(120,$maxY,"",1);
				}
				else if($cc == 2)
				{
					$this->Cell(30,$maxY,"",1);
				}
				else
				{
					$this->Cell(30,$maxY,"",1);
				}
				
			}

			$yBeforeCell = $this->GetY();
			$this->SetXY($x, $yBeforeCell);
$cc=0;
			foreach ($cols as $col) 
			{
			
			$cc+=1;
				if($cc == 1)
				{
					$yBeforeCell = $this->GetY();
					$this->MultiCell(120,6,$col,0);
							$y = $this->GetY();
							$this->SetXY($x + 120, $yBeforeCell);
							$x = $this->GetX();
				}
				else if($cc == 2)
				{
					$yBeforeCell = $this->GetY();
					$this->MultiCell(30,6,$col,0);
							$y = $this->GetY();
							$this->SetXY($x + 30, $yBeforeCell);
							$x = $this->GetX();
				}
				else
				{
					$yBeforeCell = $this->GetY();
					$this->MultiCell(30,6,$col,0);
							$y = $this->GetY();
							$this->SetXY($x + 30, $yBeforeCell);
							$x = $this->GetX();
				}
			
	                    
			}
			$this->Ln($maxY);
		}

}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
	$username = $GLOBALS['username'];
    $this->Cell(0,10,$username.' : Page '.$this->PageNo().'/{nb}',0,0,'C');
}

function GetMultiCellHeight($w, $h, $txt, $border=null, $align='J') {
	// Calculate MultiCell with automatic or explicit line breaks height
	// $border is un-used, but I kept it in the parameters to keep the call
	//   to this function consistent with MultiCell()
	$cw = &$this->CurrentFont['cw'];
	if($w==0)
		$w = $this->w-$this->rMargin-$this->x;
	$wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
	$s = str_replace("\r",'',$txt);
	$nb = strlen($s);
	if($nb>0 && $s[$nb-1]=="\n")
		$nb--;
	$sep = -1;
	$i = 0;
	$j = 0;
	$l = 0;
	$ns = 0;
	$height = 0;
	while($i<$nb)
	{
		// Get next character
		$c = $s[$i];
		if($c=="\n")
		{
			// Explicit line break
			if($this->ws>0)
			{
				$this->ws = 0;
				$this->_out('0 Tw');
			}
			//Increase Height
			$height += $h;
			$i++;
			$sep = -1;
			$j = $i;
			$l = 0;
			$ns = 0;
			continue;
		}
		if($c==' ')
		{
			$sep = $i;
			$ls = $l;
			$ns++;
		}
		$l += $cw[$c];
		if($l>$wmax)
		{
			// Automatic line break
			if($sep==-1)
			{
				if($i==$j)
					$i++;
				if($this->ws>0)
				{
					$this->ws = 0;
					$this->_out('0 Tw');
				}
				//Increase Height
				$height += $h;
			}
			else
			{
				if($align=='J')
				{
					$this->ws = ($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
					$this->_out(sprintf('%.3F Tw',$this->ws*$this->k));
				}
				//Increase Height
				$height += $h;
				$i = $sep+1;
			}
			$sep = -1;
			$j = $i;
			$l = 0;
			$ns = 0;
		}
		else
			$i++;
	}
	// Last chunk
	if($this->ws>0)
	{
		$this->ws = 0;
		$this->_out('0 Tw');
	}
	//Increase Height
	$height += $h;

	return $height;
}

function _putpages()
{
    $nb = $this->page;
    if(!empty($this->AliasNbPages))
    {
        // Replace number of pages
        for($n=1;$n<=$nb;$n++)
        {
            if($this->compress)
                $this->pages[$n] = gzcompress(str_replace($this->AliasNbPages,$nb,gzuncompress($this->pages[$n])));
            else
                $this->pages[$n] = str_replace($this->AliasNbPages,$nb,$this->pages[$n]);
        }
    }
    if($this->DefOrientation=='P')
    {
        $wPt = $this->DefPageSize[0]*$this->k;
        $hPt = $this->DefPageSize[1]*$this->k;
    }
    else
    {
        $wPt = $this->DefPageSize[1]*$this->k;
        $hPt = $this->DefPageSize[0]*$this->k;
    }
    $filter = ($this->compress) ? '/Filter /FlateDecode ' : '';
    for($n=1;$n<=$nb;$n++)
    {
        // Page
        $this->_newobj();
        $this->_out('<</Type /Page');
        $this->_out('/Parent 1 0 R');
        if(isset($this->PageSizes[$n]))
            $this->_out(sprintf('/MediaBox [0 0 %.2F %.2F]',$this->PageSizes[$n][0],$this->PageSizes[$n][1]));
        $this->_out('/Resources 2 0 R');
        if(isset($this->PageLinks[$n]))
        {
            // Links
            $annots = '/Annots [';
            foreach($this->PageLinks[$n] as $pl)
            {
                $rect = sprintf('%.2F %.2F %.2F %.2F',$pl[0],$pl[1],$pl[0]+$pl[2],$pl[1]-$pl[3]);
                $annots .= '<</Type /Annot /Subtype /Link /Rect ['.$rect.'] /Border [0 0 0] ';
                if(is_string($pl[4]))
                    $annots .= '/A <</S /URI /URI '.$this->_textstring($pl[4]).'>>>>';
                else
                {
                    $l = $this->links[$pl[4]];
                    $h = isset($this->PageSizes[$l[0]]) ? $this->PageSizes[$l[0]][1] : $hPt;
                    $annots .= sprintf('/Dest [%d 0 R /XYZ 0 %.2F null]>>',1+2*$l[0],$h-$l[1]*$this->k);
                }
            }
            $this->_out($annots.']');
        }
        if($this->PDFVersion>'1.3')
            $this->_out('/Group <</Type /Group /S /Transparency /CS /DeviceRGB>>');
        $this->_out('/Contents '.($this->n+1).' 0 R>>');
        $this->_out('endobj');
        // Page content
        $p = $this->pages[$n];
        $this->_newobj();
        $this->_out('<<'.$filter.'/Length '.strlen($p).'>>');
        $this->_putstream($p);
        $this->_out('endobj');
    }
    // Pages root
    $this->offsets[1] = strlen($this->buffer);
    $this->_out('1 0 obj');
    $this->_out('<</Type /Pages');
    $kids = '/Kids [';
    for($i=0;$i<$nb;$i++)
        $kids .= (3+2*$i).' 0 R ';
    $this->_out($kids.']');
    $this->_out('/Count '.$nb);
    $this->_out(sprintf('/MediaBox [0 0 %.2F %.2F]',$wPt,$hPt));
    $this->_out('>>');
    $this->_out('endobj');
}

function _endpage()
{
    parent::_endpage();
    if($this->compress)
        $this->pages[$this->page] = gzcompress($this->pages[$this->page]);
}
}



$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->setleftmargin(20);
$pdf->SetFont('Times','',10);
$pdf->BasicTable($header,$rowdata,$count);
//$pdf->Ln(50);
/*echo  $xValue;
$yvalue=(($tpage * 280) - $xValue) + 80;*/
//$pdf->AddPage();
//$pdf->Image('images/report_questionb.png',20,10,180);
//$pdf->Ln(75);
$pdf->BasicTable1($header1,$rowdata1,$count1);
//$pdf->Output();
$pdf->Output("pdf/business_calendar_".$scid.".pdf", "F");
header("Content-type:application/pdf;");
header("Content-Disposition:attachment;filename=business_calendar_".$scid.".pdf");
readfile("pdf/business_calendar_".$scid.".pdf");
?>
