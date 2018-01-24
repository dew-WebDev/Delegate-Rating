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
global $bcname;
global $bname;
global $bcomid;
global $bcountry;
global $ptm_year;

$pname="BUYER APPOINTMENT SCHEDULE";

$count=0;

$data="";
$bcid=$_GET['bcid'];

$qry ="select 
			seller_company.company_name as scname, 
			seller_company.cnt_id as scountry_id,
			seller_company.company_id as scomid, 
			mas_seller.fullname as sname, 
			boothNumber as bno, 
			buyer_company.company_name as bcname, 
			buyer_company.company_id as bcomid,
			buyer_company.cnt_id as bcountry_id,
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
			left join appointments on time_slots.time_slot_id = appointments.time_slot_id and appointments.buyer_com_id = ".$bcid."
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
					
					$descrip="";
					

					if($krows['scountry_id'] != '')
					{
						$q=mysql_query("select * from countries where country_id=".$krows['scountry_id']);
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
						if($krows['scomid'] != "")
						{
							$descrip="Reg No : ".$krows['scomid']."\n".$krows['scname'].", ".$cntry."\nBooth No : ".$krows['bno']."_".$krows['slottype'];
							$data.=$krows['time_slot_date']."^".$krows['time_slot_id_from']."^".$krows['time_slot_id_to']."^".$descrip."^".$arequest."_t^ _t|";
						}
						else
						{
							$data.=$krows['time_slot_date']."^".$krows['time_slot_id_from']."^".$krows['time_slot_id_to']."^ \n _t^ _t^ _t|";
						}
					}

				}
			}
			
			
			$c=0;
			$q=mysql_query("select bc.company_name, mb.fullname, bc.company_id, bc.cnt_id from buyer_company bc, mas_buyer mb where mb.mas_buyer_com_id=bc.buyer_com_id and mb.mas_buyer_status='Y' and bc.buyer_status='Y' and bc.buyer_com_id = ".$bcid);
			if(mysql_num_rows($q)>0)
			{
				while($r=mysql_fetch_array($q))
				{
					$c++;
					if($c == 1)
					{
						$bcname= $r['company_name'];
						$bname= $r['fullname'];
						$bcomid= $r['company_id'];
						$cntry="";
						$q1=mysql_query("select * from countries where country_id='".$r['cnt_id']."'"	);
						if(mysql_num_rows($q1)>0 && $r1=mysql_fetch_array($q1))
						{
							$bcountry=$r1['country_name'];
						}
					}
				}
			}
			
$data=substr($data,0,-1);
$rowdata = explode("|", $data);

$count1=0;
$data1="";

$qry ="
select * from
			(
			select 
			seller_company.seller_com_id as scid,
			seller_company.cnt_id as country_id,
			buyer_company.buyer_com_id as bcid,
			seller_company.company_id as cid,
			seller_company.create_date as registeration_date,
			delegate_login.mas_buyer_id as mbcid,
			mas_seller.mas_seller_id as mscid,
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
			inner join mas_seller on seller_company.seller_com_id = mas_seller.mas_seller_com_id
			inner join delegate_login on delegate_requests.requested_delegate_id = delegate_login.user_name
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join mas_buyer on mas_buyer.mas_buyer_com_id = delegate_login.buyer_com_id
			where request_mode = 'B'
			and 
			(mas_buyer.mas_buyer_com_id = ".$bcid.")
			and
			mas_seller.mas_seller_status = 'Y'
			and
			(mas_seller.title_name is not null and mas_seller.title_name <> 'None')
			and
			(mas_seller.name is not null and mas_seller.name <> '')
			and
			mas_seller.delegate = '1'
			and
			seller_org_status = 'Y'
			and
			exists
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
		
			union

			select 
			seller_company.seller_com_id as scid,
			seller_company.cnt_id as country_id,
			buyer_company.buyer_com_id as bcid,
			seller_company.company_id as cid,
			seller_company.create_date as registeration_date,
			delegate_login.mas_buyer_id as mbcid,
			mas_seller.mas_seller_id as mscid,
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
			inner join mas_seller on seller_company.seller_com_id = mas_seller.mas_seller_com_id
			inner join delegate_login on delegate_requests.requested_delegate_id = delegate_login.user_name
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join mas_buyer on mas_buyer.mas_buyer_com_id = delegate_login.buyer_com_id
			where request_mode = 'B'
			and 
			(mas_buyer.mas_buyer_com_id = ".$bcid.")
			and
			mas_seller.mas_seller_status = 'Y'
			and
			(mas_seller.title_name is not null and mas_seller.title_name <> 'None')
			and
			(mas_seller.name is not null and mas_seller.name <> '')
			and
			mas_seller.delegate = '1'
			and
			seller_org_status = 'Y'
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

			union

			select 

			seller_company.seller_com_id as scid,
			seller_company.cnt_id as country_id,
			buyer_company.buyer_com_id as bcid,
			seller_company.company_id as cid,
			seller_company.create_date as registeration_date,
			delegate_login.mas_buyer_id as mbcid,
			mas_seller.mas_seller_id as mscid,
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
			inner join seller_delegate_detail on delegate_requests.requested_delegate_id = seller_delegate_detail.username
			inner join delegate_login on delegate_requests.requested_delegate_id = delegate_login.user_name
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join mas_seller on delegate_login.mas_seller_id = mas_seller.mas_seller_id
			inner join buyer_missing_fields on buyer_company.buyer_com_id = buyer_missing_fields.buyer_com_id
			where request_mode = 'S'
			and 
			(mas_buyer.mas_buyer_com_id = ".$bcid.")
			and
			mas_buyer.mas_buyer_status = 'Y'
			and
			(mas_buyer.title_name is not null and mas_buyer.title_name <> 'None')
			and
			(mas_buyer.name is not null and mas_buyer.name <> '')
			and
			(buyer_missing_fields.prefix_A is not null and mas_buyer.title_name <> 'None')
			and
			mas_buyer.name = buyer_missing_fields.FirstName_A
			and
			seller_delegate_status = 'Y'
			and
			seller_org_status = 'Y'
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
			and
			(buyer_missing_fields.buyer_missing_fields_status is null or buyer_missing_fields.buyer_missing_fields_status = 'Y')
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
					$q=mysql_query("select * from countries where country_id=".$krows['country_id']);
					if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
					{
						$cntry=$r['country_name'];
					}
				
					$count1+=1;

					$data1.="Reg No : ".$krows['cid']."\nBooth No : ".$krows['bno']."\n".$krows['scname'].", ".$cntry."^".$krows['matching_condition']."^ |";

				//	$data1.=$krows['cid'].", ".$krows['scname'].",\n".$krows['sname'].", ".$cntry."^".$krows['matching_condition']."^ |";

				}
			}
$data1=substr($data1,0,-1);
$rowdata1 = explode("|", $data1);

$header = array("Date","Start Time","End Time","Details","Requested By","Signature");
$header1 = array("Unmatched Appointment List ","Requested By","Remark");

class PDF extends FPDF
{

// Page header
function Header()
{
$this->setleftmargin(20);

	if($this->PageNo() == 1) 
	{
		$pname = $GLOBALS['pname'];
		$bcname = $GLOBALS['bcname'];
		$bname = $GLOBALS['bname'];
		$bcomid = $GLOBALS['bcomid'];
		$bcountry = $GLOBALS['bcountry'];
		$ptm_year = $GLOBALS['ptm_year'];

		// Logo
		$this->Image('images/PDFLogo.jpg',10,10,50);
		// Arial bold 15
		$this->SetFont('Arial','B',12);
		// Move to the right
		$this->Cell(53);
		// Title
		$this->setXY(70,10);
		$this->Cell(50,0,'PATA ATRTCM '.$ptm_year,0,0,'L');

		$this->setXY(70,16);
		$this->Cell(50,0,$pname,0,0,'L');

		$this->setXY(70,22);
		$this->Cell(50,0,$bcname.", ".$bcountry,0,0,'L');

		$this->setXY(70,28);
		$this->Cell(50,0,$bname,0,0,'L');

		$this->setXY(70,34);
		$this->Cell(50,0,"Reg. No : ".$bcomid,0,0,'L');

		$this->SetFont('Times','B',12);
		$this->setXY(190,10);
		$this->Cell(30,0,$bcomid,0,0,'c');
				
		$this->SetFont('Arial','B',10);
		$this->setXY(10,45);
		$this->Cell(50,0,"Please note that it's compulsory for all buyers to fulfil 100% of the appointments on their business calendar",0,0,'L');
		$this->setXY(10,50);
		$this->Cell(50,0,"(Total 20 appointments including any EMPTY slots) with ATRTCM2018 Sellers' signatures on the respective",0,0,'L');
		$this->setXY(10,55);
		$this->Cell(50,0,"appointment slot for schedule in Apr 23 during 0930-1650.",0,0,'L');
		$this->setXY(10,63);
		$this->Cell(50,0,"          **** Please submit your appointment sheet at the buyer registration counter at the end of the event. ****",0,0,'L');
		$this->Ln(8);
	}
}

function BasicTable($header,$rowdata,$count)
{
    // Header

  $this->SetFont('Times','B',10);
$cc=0;
$viroj=0;
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
							if ($viroj == 6 or $viroj == 7)
							{
								//$this->SetTextColor(0,0,0);
								//$this->SetFillColor(255,255,255);
							}
							else
							{
								$this->SetFillColor(120,120,120);							
								$this->SetTextColor(255,255,255);							
							}
							
							$yBeforeCell = $this->GetY();
								
							if ($viroj == 6 or $viroj == 7)
							{	
								$this->MultiCell(23,7,$col[0],1,'L',true);  // draw cell border
							}
							else
							{
								$this->MultiCell(23,7,$col[0],0,'L',true);
							}
							$viroj +=1;	
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
						//	$this->MultiCell(60,8,$col[0],0);
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
				}
			}
			$this->Ln($maxY);
		}
		$y=$this->GetY();

		if($y<200)
		{
			$this->Image('images/report_question_all.png',20,$y+7,65);
		}
		else
		{
			$this->AddPage($this->CurOrientation);
			$this->Image('images/report_question_all.png',20,7,65);
		}
}


function BasicTable1($header,$rowdata,$count)
{
	$y=$this->getY();
	if($y>100)
	{
		$toty=$y-10;
	}
	else 
	{
	    $toty=$y+50;       // 16-Aug-16 viroj reduce the distance
	}
	if($toty<260)
	{
		$this->Ln($toty);
	}
	else
	{
		$this->AddPage($this->CurOrientation);
	}
    // Header

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
					$curH = $this->GetMultiCellHeight(120,5,$col,1);
					$maxY = ($maxY < $curH ? $curH : $maxY);
				}
				else if($cc == 2)
				{
					$curH = $this->GetMultiCellHeight(30,5,$col,1);
					$maxY = ($maxY < $curH ? $curH : $maxY);
				}
				else
				{
					$curH = $this->GetMultiCellHeight(30,5,$col,1);
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
					$this->MultiCell(120,5,$col,0);
							$y = $this->GetY();
							$this->SetXY($x + 120, $yBeforeCell);
							$x = $this->GetX();
				}
				else if($cc == 2)
				{
					$yBeforeCell = $this->GetY();
					$this->MultiCell(30,5,$col,0);
							$y = $this->GetY();
							$this->SetXY($x + 30, $yBeforeCell);
							$x = $this->GetX();
				}
				else
				{
					$yBeforeCell = $this->GetY();
					$this->MultiCell(30,5,$col,0);
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
	$bcomid = $GLOBALS['bcomid'];
    $this->Cell(0,10,$bcomid.' : Page '.$this->PageNo().'/{nb}',0,0,'C');
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
/*$pdf->AddPage();
$pdf->Image('images/report_questions.png',20,10,180);
$pdf->Ln(75);*/
$pdf->BasicTable1($header1,$rowdata1,$count1);
//$pdf->Output();
$pdf->Output("pdf/business_calendar_".$bcid.".pdf", "F");
header("Content-type:application/pdf;");
header("Content-Disposition:attachment;filename=business_calendar_".$bcid.".pdf");
readfile("pdf/business_calendar_".$bcid.".pdf");
?>
