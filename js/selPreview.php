
<div class="cfg-contactform" id="cfg-contactform-1">
		<div class="cfg-contactform-content">

			<div id='reg1'>
					<?php
require_once("query/connectivity.php");
?>
					<input type='hidden' id='hidsemail' name='hidsemail'
						value="<?php echo $_POST['txtemail'] ?>" />


				<div class="bg2">
					<div
						style="width: 913px; margin: 0px auto; background-image: url(images/bg5.gif); background-repeat: repeat-y;">
						<div style="margin: 15px 35px 0px 35px; margin-left: -40px;">
							<div style="margin: 15px 35px 0px 35px;">
								<div
									style="font-size: 16px; color: #32464E; font-weight: bold;">
									<h3>5. PREVIEW</h3>
								</div>
								<br />
								<br />
								<h4>
									<p style='color: red'>This is preview or summary page
										only, your registration is NOT complete yet. To complete your
										submission, please confirm all details then click Next button
										at the bottom of this page to go to Agreement page and click
										agree and then click Submit to complete your registration.</p>
								</h4>
								<br />
								<br /> <span><h3>
										<p>
											<b>SECTION A : SELLER ORGANISATION INFORMATION </b>
										</p>
									</h3>
								</span> <br>
								<table>
									<tr>
										<td style='width: 275px;'><strong>Country
												Pavilion</strong>
										</td>
										<td><?php
			if($_POST['pavillion_type'] == 0)
			{
				echo "General";
			}
			else if($_POST['pavillion_type'] == 1)
			{
				echo "Option A: ( NTOs are responsible for space fee and 1st seller delegate registration.)";
			}
			else if($_POST['pavillion_type'] == 2)
			{
				echo "Option B: ( NTOs are only responsible for space fee.) ";
			}
			else if($_POST['pavillion_type'] == 3)
			{
				echo " MicroEnterprise Package ";
			}
		?>
										</td>
									</tr>
									<tr>
										<td><strong>First time attending the PATA
												Travel Mart</strong>
										</td>
										<td><?php
		$b=false;
			if($_POST['FirstTimeAttending'] == 1)
			{
				echo "Yes";
				$b=true;
			}
			else
			{
				$b=false;
				echo "No";
			}
		?>
										</td>
									</tr>
									<?php
if(!$b)
{
	echo "<tr>
		<td><strong>Attended Year in PATA Adventure Travel Mart </strong></td>
		<td>";
	
			$yer="";
			
			$q=mysql_query("select * from assignment a,year_assignment ya where a.assignment_id=ya.assignment_id and a.seller_company_id=".$_POST['id']);
			if(mysql_num_rows($q)>0)
			{
				while($r=mysql_fetch_array($q))
				{
					$yer.=$r['selected_year'].", ";
				}
			}
			$yer=substr($yer,0,-2);
			echo $yer;
		echo "</td>
	</tr>";
}
?>
								</table>
								<table>
									<tr>
										<td style='width: 325px;'><strong>Membership</strong>
										</td>
										<td style='width: 225px;'><?php 
			$mid="";
			if($_POST['PATA_Member'] == 0)
			{
				echo "None";
			}
			else if($_POST['PATA_Member'] == 1)
			{
				echo "PATA Membership";
				$mid=$_POST['pata_member_no'];
			}
			else if($_POST['PATA_Member'] == 2)
			{
				echo "Chapter Membership";
				$mid=$_POST['chapter_member_no'];					
			}
		?>
										</td>
										<td style='width: 225px;'><strong>Membership ID</strong>
										</td>
										<td style='width: 250px;'><?php echo $mid; ?>
										</td>
									</tr>
									<?php
			if(isset($_POST['chapter_id']))
			{
				echo "<tr><td><strong>Selected Chapter:</strong></td><td colspan='3'>";
				if($_POST['chapter_id'] == 1)
				{
					echo "PATA Bali and Nusa Tenggara Chapter";
				}
				else if($_POST['chapter_id'] == 2)
				{
					echo "PATA Bangladesh Chapter";
				}
				else if($_POST['chapter_id'] == 3)
				{
					echo "PATA Bavaria Chapter";
				}
				else if($_POST['chapter_id'] == 4)
				{
					echo "PATA BeNeLux Chapter";
				}
				else if($_POST['chapter_id'] == 5)
				{
					echo "PATA Chinese Taipei Chapter";
				}else if($_POST['chapter_id'] == 6)
				{
					echo "PATA Denmark Chapter";
				}
				else if($_POST['chapter_id'] == 7)
				{
					echo "PATA Eastern Canada Chapter";
				}
				else if($_POST['chapter_id'] == 8)
				{
					echo "PATA Finland Chapter";
				}
				else if($_POST['chapter_id'] == 9)
				{
					echo "PATA Florida Chapter";
				}
				else if($_POST['chapter_id'] == 10)
				{
					echo "PATA France Chapter";
				}
				else if($_POST['chapter_id'] == 11)
				{
					echo "PATA Germany Chapter";
				}else if($_POST['chapter_id'] == 12)
				{
					echo "PATA Hawaii Chapter";
				}
				else if($_POST['chapter_id'] == 13)
				{
					echo "PATA Hawaii School of Travel Industry Management Satellite Chapter";
				}
				else if($_POST['chapter_id'] == 14)
				{
					echo "PATA Houston Chapter";
				}else if($_POST['chapter_id'] == 15)
				{
					echo "PATA India Chapter";
				}
				else if($_POST['chapter_id'] == 16)
				{
					echo "PATA Indonesia Chapter";
				}
				else if($_POST['chapter_id'] == 17)
				{
					echo "PATA Japan Chapter";
				}else if($_POST['chapter_id'] == 18)
				{
					echo "PATA Korea Chapter";
				}
				else if($_POST['chapter_id'] == 19)
				{
					echo "PATA Macau Chapter";
				}
				else if($_POST['chapter_id'] == 20)
				{
					echo "PATA Malaysia Chapter";
				}
				else if($_POST['chapter_id'] == 21)
				{
					echo "PATA Maldives Chapter";
				}
				else if($_POST['chapter_id'] == 22)
				{
					echo "PATA Micronesia Chapter";
				}else if($_POST['chapter_id'] == 23)
				{
					echo "PATA Midwest Chapter";
				}
				else if($_POST['chapter_id'] == 24)
				{
					echo "PATA Nepal Chapter";
				}
				else if($_POST['chapter_id'] == 25)
				{
					echo "PATA New England Chapter";
				}
				else if($_POST['chapter_id'] == 26)
				{
					echo "PATA New York Chapter";
				}
				else if($_POST['chapter_id'] == 27)
				{
					echo "PATA Northern California (NORCAL) Chapter";
				}
				else if($_POST['chapter_id'] == 28)
				{
					echo "PATA Norway Chapter";
				}else if($_POST['chapter_id'] == 29)
				{
					echo "PATA Orange County Chapter";
				}
				else if($_POST['chapter_id'] == 30)
				{
					echo "PATA Pakistan Chapter";
				}
				else if($_POST['chapter_id'] == 31)
				{
					echo "PATA Philippines Chapter";
				}else if($_POST['chapter_id'] == 32)
				{
					echo "PATA San Diego Chapter";
				}
				else if($_POST['chapter_id'] == 33)
				{
					echo "PATA San Jose Chapter";
				}
				else if($_POST['chapter_id'] == 34)
				{
					echo "PATA Singapore Chapter";
				}else if($_POST['chapter_id'] == 35)
				{
					echo "PATA Southern California (SOCAL) Chapter";
				}
				else if($_POST['chapter_id'] == 36)
				{
					echo "PATA Sri Lanka Chapter";
				}
				else if($_POST['chapter_id'] == 37)
				{
					echo "PATA Sweden Chapter";
				}else if($_POST['chapter_id'] == 38)
				{
					echo "PATA Thailand Chapter";
				}
				else if($_POST['chapter_id'] == 39)
				{
					echo "PATA United Kingdom Chapter";
				}
				else if($_POST['chapter_id'] == 40)
				{
					echo "PATA Vietnam Chapter";
				}
				
				echo "</td></tr>";
			}
		?>
								</table>
								<table>
									<tr>
										<td style='width: 375px;'><strong>Company Name</strong>
										</td>
										<td colspan='3'><?php echo $_POST['CompanyName']; 
		?></td>
									</tr>
									<tr>
										<td style='width: 250px;'><strong>Address</strong>
										</td>
										<td style='width: 265px;'><?php echo $_POST['ADDRESS_1']; 
		?>
										</td>
										<td style='width: 250px;'><strong>Country</strong>
										</td>
										<td style='width: 250px;'><?php 
			$qry1=mysql_query("select * from countries where country_status='Y' and country_id=".$_POST['CNT_ID']);
			if(mysql_num_rows($qry1)>0)
			{
				while($rs1=mysql_fetch_array($qry1))
				{
					echo $rs1['country_name'];
				}
			}
		?>
										</td>
									</tr>
									<tr>
										<td><strong>Postcode</strong>
										</td>
										<td><?php echo $_POST['POSTCODE']; 
		?></td>
										<td><strong>Tel</strong>
										</td>
										<td><?php echo $_POST['PHONE']; 
		?></td>
									</tr>
									<tr>
										<td><strong>Fax</strong>
										</td>
										<td><?php echo $_POST['FAX']; 
		?></td>
										<td><strong>Website</strong>
										</td>
										<td><?php echo $_POST['WEBSITE']; 
		?></td>
									</tr>
								</table>
								<table>
									<tr>
										<td><strong>Option Climate Fee</strong>
										</td>
										<td colspan='3'>&nbsp;&nbsp;&nbsp;&nbsp; <?php
			if($_POST['climate_fee'] == 1)
			{
				echo " US $30   < 3 Hours = short - haul ";
			}
			else if($_POST['climate_fee'] == 2)
			{
				echo " US $90   3-6 Hours = medium - haul ";
			}
			else if($_POST['climate_fee'] == 3)
			{
				echo " US $150 > 6 Hours = long-haul ";
			}
			else
			{
				echo "None";
			}
		?>
										</td>
									</tr>
								</table>
								<br>

								<h4>
									<b>SECTION B : REGISTRATION BREAKDOWN</b>
								</h4>
								<br />
								<br />

								<?php
echo "<input type='hidden' id='hidpavtype' name='hidpavtype' value='".$_POST['pavillion_type']."' /><input type='hidden' id='hidchkspace' name='hidchkspace' value='".$_POST['chkSpace']."' />";
if($_POST['pavillion_type'] == 0)
{
	if($_POST['chkSpace'] == "S")
	{
		?>
								<h4>
									<strong>BOOTH SPACE OPTION A: SHELL SCHEME PACKAGE</strong>
								</h4>
								<br />
								<br />

								<h4>
									<strong>Exhibiting Company: min. requirement one
											9sqm booth space</strong>
								</h4>
								<br />
								<br />


								<h4>
										<strong>Space with Shell Scheme plus one set of
											appointments with buyers per 9 sqm booth</strong>
								</h4>
								<br />
								<table>
									<tr>
										<td style='width: 900px;'>Required <?php echo $_POST['booth_space_A'];  ?>
											Booth(s)</td>
										<td style='width: 400px;'>US$ <input type='text'
											style='width: 100px;' name='space_price_a'
											id='space_price_a'
											value="<?php echo $_POST['space_price_a'];  ?>"
											onkeyup="price();" />
											<br>
										</td>
									</tr>
								</table>

								<h4>
									<strong>Space with Shell Scheme without appointments
											with buyers</strong>
								</h4>
								<br />
								<br />
								<table>
									<tr>
										<td style='width: 900px;'>Required <?php echo $_POST['booth_space_noapp_A'];  ?>
											Booth(s)</td>
										<td style='width: 400px;'>US$ <input type='text'
											style='width: 100px;' name='space_price_noapp_a'
											id='booth_space_noapp_A'
											value="<?php echo $_POST['space_price_noapp_a'];  ?>"
											onkeyup="price();" />
										</td>
									</tr>
								</table>
								<br />
								<h4>
									<b>Loyalty Discount <?php if($_POST['loyalty_discount_A'] == 0) { echo "None"; } ?>
									</b>
								</h4>
								<br />
								<br /> <input type='hidden' style='width: 100px;'
									name='hidDiscountA' id='hidDiscountA'
									value="<?php echo $_POST['loyalty_discount_A']; ?>" />
								<?php
				
					if($_POST['loyalty_discount_A'] == 5) 
					{ 
						echo "<table><tr><td style='width:565px;'><strong> 5% Loyalty Discount: On space cost only</strong></td><td style='width:100px;'>
						
						US$ <input type='text' style='width:100px;' name='hidLoyalty' disabled id='hidLoyalty' value = ".$_POST['discount5_a']." onkeyup=\"price();\"/></td></tr></table>
					<p> Applicable for participation from <strong> PTM05, PTM06, PTM07,
PTM08,PTM09,PTM10,PTM11,PTM12 (5 years continuously) </strong>and register before
March 31, 2017 </p>
							"; 
					}
					else if($_POST['loyalty_discount_A'] == 10) 
					{ 
						echo "<table><tr><td style='width:565px;'><strong> 10% Loyalty Discount: On space cost only</strong></td><td style='width:100px;'>US$ <input type='text' style='width:100px;' name='hidLoyalty' disabled id='hidLoyalty' value = ".$_POST['discount10_a']." onkeyup=\"price();\"/></td></tr></table>
							<p> Applicable for participation from <strong>PTM04, PTM05, PTM06, PTM07,
PTM08,PTM09,PTM10,PTM11,PTM12,PTM13 (10 years continuously) </strong>and register before
March 31, 2017 </p>
							"; 
					}
					else if($_POST['loyalty_discount_A'] == 15) 
					{ 
						echo "<table><tr><td style='width:565px;'><strong> 15% Loyalty Discount: On space cost only </strong></td><td style='width:100px;'>US$ <input type='text' style='width:100px;' name='hidLoyalty' disabled id='hidLoyalty' value = ".$_POST['discount15_a']." onkeyup=\"price();\"/></td></tr></table>
				<p> Applicable for participation from <strong>PTM03, PTM04, PTM05, PTM06, PTM07,
PTM08,PTM09,PTM10,PTM11,PTM12,PTM13 (11 years continuously) </strong>and register before
March 31, 2017 </p>
							"; 
					}
				?>
								<br />
								<table>
									<tr>
										<td style='width: 600px;'><strong>SUB TOTAL</strong>
										</td>
										<td style='width: 200px;'><span id='bst'><?php echo $_POST['before_total_a']; ?>
										</span>
										</td>
									</tr>
								</table>
								<h4>
									<b>COMPULSORY DELEGATE REGISTRATION</b>
								</h4>
								<br />
								<br />
								<table>
									<?php
				if($_POST['first_delegate_amt_A'] != NULL || $_POST['first_delegate_amt_A'] != "")
				{
			?>
									<tr>
										<td style='width: 600px;'><strong>First Seller
												Delegate</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_POST['first_delegate_amt_A']; ?>
											Person(s)</td>
										<td style='width: 300px;'>US$ <input type='text'
											style='width: 100px;' name='delegate1_fee_a'
											id='delegate1_fee_a'
											value="<?php echo $_POST['delegate1_fee_a']; ?>"
											onkeyup="price();" />
										</td>
									</tr>
									<?php
				}
				if($_POST['second_delegate_amt_A'] != NULL || $_POST['second_delegate_amt_A'] != "")
				{	
			?>
									<tr>
										<td style='width: 600px;'><strong>Second Seller
												Delegate</strong>&nbsp;&nbsp;<?php echo $_POST['second_delegate_amt_A']; ?>
											Person(s)</td>
										<td style='width: 300px;'>US$ <input type='text'
											style='width: 100px;' name='delegate2_fee_a'
											id='delegate2_fee_a'
											value="<?php echo $_POST['delegate2_fee_a']; ?>"
											onkeyup="price();" />
										</td>
									</tr>
									<?php
				}
				if($_POST['third_delegate_amt_A'] != NULL || $_POST['third_delegate_amt_A'] != "")
				{	
			?>
									<tr>
										<td style='width: 600px;'><strong>Third Seller
												Delegate</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_POST['third_delegate_amt_A']; ?>
											Person(s)</td>
										<td style='width: 300px;'>US$ <input type='text'
											style='width: 100px;' name='delegate3_fee_a'
											id='delegate3_fee_a'
											value="<?php echo $_POST['delegate3_fee_a']; ?>"
											onkeyup="price();" />
										</td>
									</tr>
									<?php
				}
			?>
								</table>
								<h4>
									<b>ADMINISTRATION FEES</b>
								</h4>
								<br />

								<h4>
									<b>Bank Fee</b>
								</h4>
								<br /> <input type='hidden'
									value="<?php echo $_POST['BankPayType_A']; ?>" id='BankPayType_A'
									name='BankPayType_A' />
								<table>
									<?php
					if($_POST['BankPayType_A'] == 1)
					{	
						echo "<tr><td style='width:600px;'>Per transaction for payment made by <strong>cheque / bank draft or wire transfer</strong> </td>
								<td style='width:300px;'>US$ <input type='text' style='width:100px;' name='hidbankfee' id='hidbankfee' value = ".$_POST['bankfee_amt_a']." onkeyup=\"price();\"/></td>
							</tr>";
					}
					else if($_POST['BankPayType_A'] == 2)
					{	
						echo "<tr><td style='width:600px;'> Per transaction for payment made by <strong>credit card</strong>: Visa add 3%  </td>
								<td style='width:300px;'>US$ <input type='text' style='width:100px;' name='hidbankfee' id='hidbankfee' value = ".$_POST['bankfee_amt_a2']." onkeyup=\"price();\"/></td>
							</tr>";
					}
					else if($_POST['BankPayType_A'] == 3)
					{	
						echo "<tr><td style='width:600px;'> Per transaction for payment made by <strong>credit card</strong>: others add 5% </td>
								<td style='width:300px;'>US$ <input type='text' style='width:100px;' name='hidbankfee' id='hidbankfee' value = ".$_POST['bankfee_amt_a3']." onkeyup=\"price();\"/></td>
							</tr>";
					}
				?>
								</table>
								<h4>
									<strong>SUB TOTAL</strong>
								</h4>
								<br />
								<h4>
									<strong>Late Fee</strong>
								</h4>
								<br />
								<h4>
									<p>(For registrations received after 30 June 2017)</p>
								</h4>
								<br />

								<table>
									<tr>
										<td style='width: 600px;'><strong>Per
												Registration <?php echo $_POST['late_fee_A']; ?>
										</strong>
										</td>
										<td style='width: 300px;'>US$ <input type='text'
											style='width: 100px;' name='latefee_price_a'
											id='latefee_price_a'
											value="<?php echo $_POST['latefee_price_a']; ?>"
											onkeyup="price();" />
										</td>
									</tr>
									<tr>
										<td style='width: 600px;'><strong>SUB TOTAL </strong>
										</td>
										<td style='width: 300px;'>US$ <span id='st'><?php echo $_POST['subtotal_pay_a']; ?>
										</span>
										</td>
									</tr>
									<tr>
										<td style='width: 600px;'><strong>Option
												Climate fee </strong>
										</td>
										<td style='width: 300px;'>US$ <input type='text'
											style='width: 100px;' name='climate_fee_value_a'
											id='climate_fee_value_a'
											value="<?php echo $_POST['climate_fee_value_a']; ?>"
											onkeyup="price();" />
										</td>
									</tr>
									<tr>
										<td style='width: 600px;'><strong>TOTAL AMOUNT
												PAYABLE </strong>
										</td>
										<td style='width: 300px;'>US$ <input type='hidden'
											id='tot_amt_a' name='tot_amt_a' /><span id='tap'><?php echo $_POST['total_amt_a']; ?>
										</span></td>
									</tr>
								</table>

								<h4>
									<strong>SECTION C : PAYMENT</strong>
								</h4>
								<br />
								<table>

									<tr>
										<td colspan='2'><?php 
				$pay="";
				if($_POST['paymentBy'] == 5)
				{
				$pay="By Cash ( No later than 30 June 2017) ";
				}
				else if($_POST['paymentBy'] == 1)
				{
				$pay="By Cheque";
				}
				else if($_POST['paymentBy'] == 2)
				{
				$pay="By Bank Draft ";
				}
				else if($_POST['paymentBy'] == 3)
				{
				$pay="By Bank Transfer (Please attach a copy of bank transfer details) ";
				}
				else if($_POST['paymentBy'] == 4)
				{
					$ctype="";
					if($_POST['CreditType'] == 1)
					{
						$ctype="Visa";
					}
					else if($_POST['CreditType'] == 2)
					{
						$ctype="Master Card";
					}
					else if($_POST['CreditType'] == 3)
					{
						$ctype="Diners Club";
					}
					else if($_POST['CreditType'] == 4)
					{
						$ctype="AMEX";
					}
				$pay="By Credit Card  : ".$ctype;
				}
			?>
											<?php echo $pay; ?>
										</td>
									</tr>
								</table>
								<?php
	}
	else if($_POST['chkSpace'] == "R")
	{
		?>
								<h4>
									<strong>BOOTH SPACE OPTION B: RAW SPACE</strong>
								</h4>
								<br />
								<h4>
									Exhibiting Company: min. requirement one 18 sqm booth
										space
								</h4>
								<br />
								<h4>
									Raw Space Only required : plus two sets of appointments
										with buyers per 18 sqm booth
								</h4>
								<br />
								<table>
									<tr>
										<td style='width: 400px;'>Required <?php echo $_POST['booth_space_B'];  ?>
											Booth(s)</td>
										<td style='width: 400px;'>US$ <input type='text'
											style='width: 100px;' name='space_price_b'
											id='space_price_b'
											value="<?php echo $_POST['space_price_b'];  ?>"
											onkeyup="price();" />
										</td>
									</tr>
								</table>
								<h4>
									Raw Space Only required : without appointments with
										buyers
								</h4>
								<br />
								<table>
									<tr>
										<td style='width: 400px;'>Required <?php echo $_POST['booth_space_noapp_B'];  ?>
											Booth(s)</td>
										<td style='width: 400px;'>US$ <input type='text'
											style='width: 100px;' name='space_price_noapp_b'
											id='space_price_noapp_b'
											value="<?php echo $_POST['space_price_noapp_b'];  ?>"
											onkeyup="price();" "/>
										</td>
									</tr>
								</table>
								<h4>
									Additional Raw Space required : (min. requirement 9
										sqm. Raw Space area plus one set of appointments with buyers)
								</h4>
								<br />
								<table>
									<tr>
										<td style='width: 400px;'>Required <?php echo $_POST['booth_space_add_B'];  ?>
											Booth(s)</td>
										<td style='width: 400px;'>US$ <input type='text'
											style='width: 100px;' name='space_price_add_b'
											id='space_price_add_b'
											value="<?php echo $_POST['space_price_add_b'];  ?>"
											onkeyup="price();" />
										</td>
									</tr>

								</table>
								<h4>
									Additional Raw Space required : (min. requirement 9
										sqm. Raw Space area without appointments with buyers)
								</h4>
								<br />
								<table>
									<tr>
										<td style='width: 400px;'>Required <?php echo $_POST['booth_space_add_noapp_B'];  ?>
											Booth(s)</td>
										<td style='width: 400px;'>US$ <input type='text'
											style='width: 100px;' name='space_price_addnoapp_b'
											id='space_price_addnoapp_b'
											value="<?php echo $_POST['space_price_addnoapp_b'];  ?>"
											onkeyup="price();" />
										</td>
									</tr>
								</table>
								<p>
									<b>Loyalty Discount <?php if($_POST['loyalty_discount_B'] == 0) { echo "None"; } ?>
									</b>
								</p>
								<input type='hidden' style='width: 100px;' name='hidDiscountB'
									id='hidDiscountB'
									value="<?php echo $_POST['loyalty_discount_B']; ?>" />

								<?php
					if($_POST['loyalty_discount_B'] == 5) 
					{ 
						echo "<table><tr><td style='width:565px;'><strong> 5% Loyalty Discount: On space cost only</strong></td><td style='width:185px;'>US$ <input type='text' style='width:100px;' name='hidLoyalty' disabled id='hidLoyalty' value = ".$_POST['discount5_b']." onkeyup=\"price();\"/></td></tr></table>
							<p> Applicable for participation from <strong> PTM05, PTM06, PTM07,
PTM08,PTM09,PTM10,PTM11,PTM12 (5 years continuously) </strong>and register before
March 31, 2017 </p>
							"; 
					}
					else if($_POST['loyalty_discount_B'] == 10) 
					{ 
						echo "<table><tr><td style='width:565px;'><strong>10% Loyalty Discount: On space cost only</strong></td><td style='width:185px;'>US$ <input type='text' style='width:100px;' name='hidLoyalty' disabled id='hidLoyalty' value = ".$_POST['discount10_b']." onkeyup=\"price();\"/></td></tr>
							<p> Applicable for participation from <strong>PTM04, PTM05, PTM06, PTM07,
PTM08,PTM09,PTM10,PTM11,PTM12,PTM13 (10 years continuously) </strong>and register before
March 31, 2017 </p>
							"; 
					}
					else if($_POST['loyalty_discount_B'] == 15) 
					{ 
						echo "<table><tr><td style='width:565px;'><strong>15% Loyalty Discount: On space cost only</strong></td><td style='width:185px;'>US$ <input type='text' style='width:100px;' name='hidLoyalty' disabled id='hidLoyalty' value = ".$_POST['discount15_b']." onkeyup=\"price();\"/></td></tr></table>
							<p> Applicable for participation from <strong>PTM03, PTM04, PTM05, PTM06, PTM07,
PTM08,PTM09,PTM10,PTM11,PTM12,PTM13 (11 years continuously) </strong>and register before
March 31, 2017 </p>
							"; 
					}
				?>
								<table>
									<tr>
										<td style='width: 600px;'><strong>SUB TOTAL</strong>
										</td>
										<td style='width: 200px;'><span id='bst'><?php echo $_POST['before_total_b']; ?>
										</span>
										</td>
									</tr>
								</table>
								<h4>
									<b>COMPULSORY DELEGATE REGISTRATION</b>
								</h4>
								<br />
								<br />
								<table>
									<?php
			if($_POST['first_delegate_amt_B'] !="" || $_POST['first_delegate_amt_B'] != NULL)
			{
			?>
									<tr>
										<td style='width: 600px;'><strong>First Seller
												Delegate</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_POST['first_delegate_amt_B']; ?>
											Person(s)</td>
										<td style='width: 300px;'>US$ <input type='text'
											style='width: 100px;' name='delegate1_fee_b'
											id='delegate1_fee_b'
											value="<?php echo $_POST['delegate1_fee_b']; ?>"
											onkeyup="price();" />
										</td>
									</tr>
									<?php
			}
			if($_POST['second_delegate_amt_B'] !="" || $_POST['second_delegate_amt_B'] != NULL)
			{
			?>
									<tr>
										<td style='width: 600px;'><strong>Second Seller
												Delegate</strong>&nbsp;&nbsp;<?php echo $_POST['second_delegate_amt_B']; ?>
											Person(s)</td>
										<td style='width: 300px;'>US$ <input type='text'
											style='width: 100px;' name='delegate2_fee_b'
											id='delegate2_fee_b'
											value="<?php echo $_POST['delegate2_fee_b']; ?>"
											onkeyup="price();" />
										</td>
									</tr>
									<?php
			}
			if($_POST['third_delegate_amt_B'] !="" || $_POST['third_delegate_amt_B'] != NULL)
			{
			?>
									<tr>
										<td style='width: 600px;'><strong>Third Seller
												Delegate</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_POST['third_delegate_amt_B']; ?>
											Person(s)</td>
										<td style='width: 300px;'>US$ <input type='text'
											style='width: 100px;' name='delegate3_fee_b'
											id='delegate3_fee_b'
											value="<?php echo $_POST['delegate3_fee_b']; ?>"
											onkeyup="price();" />
										</td>
									</tr>
									<?php
			}
			?>
								</table>
								<h4>
									<b>ADMINISTRATION FEES</b>
								</h4>
								<br />
								<h4>
									<b>Bank Fee</b>
								</h4>
								<br /> <input type='hidden'
									value="<?php echo $_POST['BankPayType_B']; ?>" id='BankPayType_B'
									name='BankPayType_B' />
								<table>
									<?php
					if($_POST['BankPayType_B'] == 1)
					{	
						echo "<tr><td style='width:600px;'>Per transaction for payment made by <strong>cheque / bank draft or wire transfer</strong> </td>
								<td style='width:300px;'>US$ <input type='text' style='width:100px;' name='hidbankfee' id='hidbankfee' value = ".$_POST['bankfee_amt_b']." onkeyup=\"price();\"/></td>
							</tr>";
					}
					else if($_POST['BankPayType_B'] == 2)
					{	
						echo "<tr><td style='width:600px;'> Per transaction for payment made by <strong>credit card</strong>: Visa add 3%  </td>
								<td style='width:300px;'>US$ <input type='text' style='width:100px;' name='hidbankfee' id='hidbankfee' value = ".$_POST['bankfee_amt_b2']." onkeyup=\"price();\"/></td>
							</tr>";
					}
					else if($_POST['BankPayType_B'] == 3)
					{	
						echo "<tr><td style='width:600px;'> Per transaction for payment made by <strong>credit card</strong>: others add 5% </td>
								<td style='width:300px;'>US$ <input type='text' style='width:100px;' name='hidbankfee' id='hidbankfee' value = ".$_POST['bankfee_amt_b3']." onkeyup=\"price();\"/></td>
							</tr>";
					}
				?>
								</table>
								<h4>
									<strong>SUB TOTAL</strong>
								</h4>
								<h4>
									<strong>Late Fee</strong>
								</h4>
								<h4>
									(For registrations received after 30 June 2017)
								</h4>

								<table>
									<tr>
										<td style='width: 600px;'><strong>Per
												Registration <?php echo $_POST['late_fee_B']; ?>
										</strong>
										</td>
										<td style='width: 300px;'>US$ <input type='text'
											style='width: 100px;' name='latefee_price_b'
											id='latefee_price_b'
											value="<?php echo $_POST['latefee_price_b']; ?>"
											onkeyup="price();" />
										</td>
									</tr>
									<tr>
										<td style='width: 600px;'><strong>SUB TOTAL </strong>
										</td>
										<td style='width: 300px;'>US$ <span id='st'><?php echo $_POST['subtotal_pay_b']; ?>
										</span>
										</td>
									</tr>
									<tr>
										<td style='width: 600px;'><strong>Option
												Climate fee </strong>
										</td>
										<td style='width: 300px;'>US$ <input type='text'
											style='width: 100px;' name='climate_fee_value_b'
											id='climate_fee_value_b'
											value="<?php echo $_POST['climate_fee_value_b']; ?>"
											onkeyup="price();" />
										</td>
									</tr>
									<tr>
										<td style='width: 600px;'><strong>TOTAL AMOUNT
												PAYABLE </strong>
										</td>
										<td style='width: 300px;'>US$ <input type='hidden'
											id='tot_amt_b' name='tot_amt_b' /><span id='tap'><?php echo $_POST['total_amt_b']; ?>
										</span>
										</td>
									</tr>

								</table>

								<h4>
									<font class="text_title">
										<strong>SECTION C : PAYMENT</strong>
									</font>
								</h4>
								<br />
								<table>
									<tr>
										<td colspan='2'><?php 
				$pay="";
				if($_POST['paymentBy'] == 5)
				{
				$pay="By Cash ( No later than 30 June 2017) ";
				}
				else if($_POST['paymentBy'] == 1)
				{
				$pay="By Cheque";
				}
				else if($_POST['paymentBy'] == 2)
				{
				$pay="By Bank Draft ";
				}
				else if($_POST['paymentBy'] == 3)
				{
				$pay="By Bank Transfer (Please attach a copy of bank transfer details) ";
				}
				else if($_POST['paymentBy'] == 4)
				{
					$ctype="";
					if($_POST['CreditType'] == 1)
					{
						$ctype="Visa";
					}
					else if($_POST['CreditType'] == 2)
					{
						$ctype="Master Card";
					}
					else if($_POST['CreditType'] == 3)
					{
						$ctype="Diners Club";
					}
					else if($_POST['CreditType'] == 4)
					{
						$ctype="AMEX";
					}
				$pay="By Credit Card  : ".$ctype;
				}
			?>
											<?php echo $pay; ?>
										</td>
									</tr>
								</table>
								<?php
	}
}
else
{
?>
								<h4>
										<b>COMPULSORY DELEGATE REGISTRATION</b>
								</h4>
								<br />
								<br />
								<table>
									<tr>
										<td style='width: 600px;'><strong>First Seller
												Delegate</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_POST['first_delegate_amt_C']; ?>
											Person(s)</td>
										<td style='width: 300px;'>US$ <input type='text'
											style='width: 100px;' name='delegate1_fee_c'
											id='delegate1_fee_c'
											value="<?php echo $_POST['delegate1_fee_c']; ?>"
											onkeyup="price();" />
										</td>
									</tr>
									<tr>
										<td style='width: 600px;'><strong>Second Seller
												Delegate</strong>&nbsp;&nbsp;<?php echo $_POST['second_delegate_amt_C']; ?>
											Person(s)</td>
										<td style='width: 300px;'>US$ <input type='text'
											style='width: 100px;' name='delegate2_fee_c'
											id='delegate2_fee_c'
											value="<?php echo $_POST['delegate2_fee_c']; ?>"
											onkeyup="price();" />
										</td>
									</tr>
									<tr>
										<td style='width: 600px;'><strong>Third Seller
												Delegate</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_POST['third_delegate_amt_C']; ?>
											Person(s)</td>
										<td style='width: 300px;'>US$ <input type='text'
											style='width: 100px;' name='delegate3_fee_c'
											id='delegate3_fee_c'
											value="<?php echo $_POST['delegate3_fee_c']; ?>"
											onkeyup="price();" />
										</td>
									</tr>
								</table>
								<h4>
										<b>ADMINISTRATION FEES</b>
									<br />
										<b>Bank Fee</b>
								</h4>
								<br /> <input type='hidden'
									value="<?php echo $_POST['BankPayType_C']; ?>" id='BankPayType_C'
									name='BankPayType_C' />
								<table>
									<?php
					if($_POST['BankPayType_C'] == 1)
					{	
						echo "<tr><td style='width:600px;'>Per transaction for payment made by <strong>cheque / bank draft or wire transfer</strong> </td>
								<td style='width:300px;'>US$ <input type='text' style='width:100px;' name='hidbankfee' id='hidbankfee' value = ".$_POST['bankfee_amt_c']." onkeyup=\"price();\"/></td>
							</tr>";
					}
					else if($_POST['BankPayType_C'] == 2)
					{	
						echo "<tr><td style='width:600px;'> Per transaction for payment made by <strong>credit card</strong>: Visa add 3%  </td>
								<td style='width:300px;'>US$ <input type='text' style='width:100px;' name='hidbankfee' id='hidbankfee' value = ".$_POST['bankfee_amt_c2']." onkeyup=\"price();\"/></td>
							</tr>";
					}
					else if($_POST['BankPayType_C'] == 3)
					{	
						echo "<tr><td style='width:600px;'> Per transaction for payment made by <strong>credit card</strong>: others add 5% </td>
								<td style='width:300px;'>US$ <input type='text' style='width:100px;' name='hidbankfee' id='hidbankfee' value = ".$_POST['bankfee_amt_c3']." onkeyup=\"price();\"/></td>
							</tr>";
					}
				?>

								</table>
								<h4>
										<strong>SUB TOTAL</strong>
								</h4>
								<br />
								<h4>
										<strong>Late Fee</strong>
								</h4>
								<br />
								<h4>
									(For registrations received after 30 June 2017)
								</h4>
								<br />
								<table>
									<tr>
										<td style='width: 600px;'><strong>Per
												Registration <?php echo $_POST['late_fee_C']; ?>
										</strong>
										</td>
										<td style='width: 300px;'>US$ <input type='text'
											style='width: 100px;' name='latefee_price_c'
											id='latefee_price_c'
											value="<?php echo $_POST['latefee_price_c']; ?>"
											onkeyup="price();" />
										</td>
									</tr>

									<tr>
										<td style='width: 600px;'><strong>SUB TOTAL </strong>
										</td>
										<td style='width: 300px;'>US$ <span id='st'><?php echo $_POST['subtotal_pay_c']; ?>
										</span>
										</td>
									</tr>

									<tr>
										<td style='width: 600px;'><strong>Option
												Climate fee </strong>
										</td>
										<td style='width: 300px;'>US$ <input type='text'
											style='width: 100px;' name='climate_fee_value_c'
											id='climate_fee_value_c'
											value="<?php echo $_POST['climate_fee_value_c']; ?>"
											onkeyup="price();" />
										</td>
									</tr>
									<tr>
										<td style='width: 600px;'><strong>TOTAL AMOUNT
												PAYABLE </strong>
										</td>
										<td style='width: 300px;'>US$ <input type='hidden'
											id='tot_amt_c' name='tot_amt_c' /><span id='tap'><?php echo $_POST['total_amt_c']; ?>
										</span>
										</td>
									</tr>
								</table>

								<h4>
									<p>
										<strong>SECTION C : PAYMENT</strong>
									</p>
								</h4>
								<br />
								<table>
									<tr>
										<td colspan='2'><?php 
				$pay="";
				if($_POST['paymentBy'] == 5)
				{
				$pay="By Cash ( No later than 30 June 2017) ";
				}
				else if($_POST['paymentBy'] == 1)
				{
				$pay="By Cheque";
				}
				else if($_POST['paymentBy'] == 2)
				{
				$pay="By Bank Draft ";
				}
				else if($_POST['paymentBy'] == 3)
				{
				$pay="By Bank Transfer (Please attach a copy of bank transfer details) ";
				}
				else if($_POST['paymentBy'] == 4)
				{
					$ctype="";
					if($_POST['CreditType'] == 1)
					{
						$ctype="Visa";
					}
					else if($_POST['CreditType'] == 2)
					{
						$ctype="Master Card";
					}
					else if($_POST['CreditType'] == 3)
					{
						$ctype="Diners Club";
					}
					else if($_POST['CreditType'] == 4)
					{
						$ctype="AMEX";
					}
				$pay="By Credit Card  : ".$ctype;
				}
			?>
											<?php echo $pay; ?>
										</td>
									</tr>
								</table>

								<?php
}
?>
								<h4>
										<strong>SECTION D : TRAVEL MARK E-DIRECTORY LISTING</strong>
								</h4>
								<br />
								<br />
								<h4>
										The Following details will be used as your
										organization's listing in the Travel Mart e-Directory. One
										listing will be provided per 9 sqm booth contracted
								</h4>
								<br /> <br>
								<table>
									<tr>
										<td style='width: 150px;'>Company Name</td>
										<td colspan='5'><?php echo $_POST['txtcname']; ?>
										</td>
									</tr>
									<tr>
										<td style='width: 150px;'>Address</td>
										<td colspan='5'><?php echo $_POST['txtadd']; ?>
										</td>
									</tr>
									<tr>
										<td style='width: 150px;'>Country</td>
										<td style='width: 200px;'><?php 
			$qry1a=mysql_query("select * from countries where country_status='Y' and country_id=".$_POST['CNT_ID']);
			if(mysql_num_rows($qry1a)>0)
			{
				while($rscon=mysql_fetch_array($qry1a))
				{
					echo $rscon['country_name'];
				}
			}
	?>
										</td>
										<td style='width: 150px;'>Postcode</td>
										<td style='width: 150px;' colspan='3'><?php echo $_POST['txtpcode']; ?>
										</td>
									</tr>
									<tr>
										<td style='width: 150px;'>Tel</td>
										<td style='width: 150px;'><?php echo $_POST['txttel']; ?>
										</td>
										<td style='width: 150px;'>Fax</td>
										<td style='width: 150px;'><?php echo $_POST['txtfax']; ?>
										</td>
										<td style='width: 75px;'>Email</td>
										<td style='width: 150px;'><?php echo $_POST['txtemail']; ?>
										</td>
									</tr>
									<tr>
										<td style='width: 200px;'>Website</td>
										<td colspan='5'><?php echo $_POST['txtwsite']; ?>
										</td>
									</tr>
								</table>

								<br>
								<h4>
										<strong>SECTION E : REGION YOU ARE OPERATING IN
											(INCLUDE THOSE OF BRANCH / SISTER COMPANY</strong>
								</h4>
								<br />
								<br />
								<table>
									<tr>
										<td><?php
$region="";
if(isset($_POST['chkausnewzea']))
{
	$region.="Australia and New Zealand, ";
}
if(isset($_POST['chkeurope']))
{
	$region.="Europe, ";
}
if(isset($_POST['chknamerica']))
{
	$region.="North America, ";
}
if(isset($_POST['chkneasia']))
{
	$region.="North East Asia, ";
}
if(isset($_POST['chkpisland']))
{
	$region.="Pacific Island, ";
}
if(isset($_POST['chksasia']))
{
	$region.="South Asia, ";
}
if(isset($_POST['chkseasia']))
{
	$region.="South East Asia, ";
}
if(isset($_POST['chkothers']))
{
	$region.="Others, ";
}
$region=substr($region,0,-2);
?>

											<?php echo $region; ?></td>
									</tr>
								</table>
								<h4>
									<br />
										<strong>SECTION F : NAME APPEAR ON BADGE INFORMATION</strong>
									<br />
									<br />
										<strong>Primary Seller Contact (This name will be
											listed as the main contact in the Advance Seller List)</strong>
								</h4>
								<br />
								<br />

								<h4>

										<b>1. Primary Seller Contact (This name will be listed as
											the main contact in the Advance Seller List)</b>
								</h4>
								<br />
								<br />
								<?php

		if($_POST['pavillion_type'] == 0)
		{
			if($_POST['chkSpace'] == "S")
			{
				$primaryTotA=($_POST['first_delegate_amt_A']);
				$primaryTotB=($_POST['second_delegate_amt_A']);
				$primaryTotC=($_POST['third_delegate_amt_A']);
			}
			else if($_POST['chkSpace'] == "R")
			{
				$primaryTotA=($_POST['first_delegate_amt_B']);
				$primaryTotB=($_POST['second_delegate_amt_B']);
				$primaryTotC=($_POST['third_delegate_amt_B']);
			}
		}
		else
		{
				$primaryTotA=($_POST['first_delegate_amt_C']);
				$primaryTotB=($_POST['second_delegate_amt_C']);
				$primaryTotC=($_POST['third_delegate_amt_C']);
		}

if($primaryTotA>0)
{
$cnt=0;
$q=mysql_query("select * from mas_seller where mas_seller_com_id=".$_POST['id']." and delegate='1'");
if(mysql_num_rows($q)>0)
{
	while($r1=mysql_fetch_array($q))
	{
	$cnt+=1;
		?>
								<table>
									<tr>
										<td colspan='4'>1. <?php echo $cnt ?>
										</td>
									</tr>
									<tr>
										<td style='width: 200px;'>Name</td>
										<td style='width: 300px;'><?php echo $r1['title_name'].", ".$r1['name']." ".$r1['middle_name']." ".$r1['family_name']; ?>
										</td>
										<td style='width: 200px;'>Job Title</td>
										<td style='width: 300px;'><?php echo $r1['position']; ?>
										</td>
									</tr>
									<tr>
										<td>Company Name</td>
										<td><?php echo $r1['org']; ?>
										</td>
										<td>PATA Membership</td>
										<td><?php 
		if(isset($r1['radpata']) == 'Yes')
		{
			echo "Yes";
		}
		else
		{
			echo "No";
		}
		?>
										</td>
									</tr>
									<tr>
										<td>Address</td>
										<td colspan='3'><?php echo $r1['address']; ?>
										</td>
									</tr>
									<tr>
										<td>Country</td>
										<td><?php 
			$qry2=mysql_query("select * from countries where country_status='Y' and country_id=".$r1['cnt_id']);
			if(mysql_num_rows($qry2)>0)
			{
				while($rscon2=mysql_fetch_array($qry2))
				{
					echo $rscon2['country_name'];
				}
			}
		?>
										</td>
										<td>Postcode</td>
										<td><?php echo $r1['post_code']; ?>
										</td>
									</tr>
									<tr>
										<td>Tel</td>
										<td><?php echo $r1['tel']; ?>
										</td>
										<td>FAX</td>
										<td><?php echo $r1['fax']; ?>
										</td>
									</tr>
									<tr>
										<td>Email</td>
										<td><?php echo $r1['email']; ?>
										</td>
										<td>Website</td>
										<td><?php echo $r1['website']; ?>
										</td>
									</tr>
								</table>
								<?php
	}
}
}
if($primaryTotB>0)
{
$cnt=0;
echo "
<br>
<span><h4><p><b>2. Secondary Seller Contact</b></p></h4><br/><br/>";
$q=mysql_query("select * from mas_seller where mas_seller_com_id=".$_POST['id']." and delegate='2'");
if(mysql_num_rows($q)>0)
{
	while($r1=mysql_fetch_array($q))
	{
	$cnt+=1;
		?>
								<table>
									<tr>
										<td colspan='4'>2. <?php echo $cnt ?>
										</td>
									</tr>
									<tr>
										<td style='width: 200px;'>Name</td>
										<td style='width: 300px;'><?php echo $r1['title_name'].", ".$r1['name']." ".$r1['middle_name']." ".$r1['family_name']; ?>
										</td>
										<td style='width: 200px;'>Job Title</td>
										<td style='width: 300px;'><?php echo $r1['position']; ?>
										</td>
									</tr>
									<tr>
										<td>Company Name</td>
										<td><?php echo $r1['org']; ?>
										</td>
										<td>PATA Membership</td>
										<td><?php 
		if(isset($r1['radpata']) == 'Yes')
		{
			echo "Yes";
		}
		else
		{
			echo "No";
		}
		?>
										</td>
									</tr>
									<tr>
										<td>Address</td>
										<td colspan='3'><?php echo $r1['address']; ?>
										</td>
									</tr>
									<tr>
										<td>Country</td>
										<td><?php 
			$qry2=mysql_query("select * from countries where country_status='Y' and country_id=".$r1['cnt_id']);
			if(mysql_num_rows($qry2)>0)
			{
				while($rscon2=mysql_fetch_array($qry2))
				{
					echo $rscon2['country_name'];
				}
			}
		?>
										</td>
										<td>Postcode</td>
										<td><?php echo $r1['post_code']; ?>
										</td>
									</tr>
									<tr>
										<td>Tel</td>
										<td><?php echo $r1['tel']; ?>
										</td>
										<td>FAX</td>
										<td><?php echo $r1['fax']; ?>
										</td>
									</tr>
									<tr>
										<td>Email</td>
										<td><?php echo $r1['email']; ?>
										</td>
										<td>Website</td>
										<td><?php echo $r1['website']; ?>
										</td>
									</tr>
								</table>
								<?php
	}
}
}
if($primaryTotC>0)
{
$cnt=0;
echo "
<br>
<span><h4><p><b>3. Third Seller Contact</b></p></h4><br/><br/>";
$q=mysql_query("select * from mas_seller where mas_seller_com_id=".$_POST['id']." and delegate='3'");
if(mysql_num_rows($q)>0)
{
	while($r1=mysql_fetch_array($q))
	{
	$cnt+=1;
		?>
								<table>
									<tr>
										<td colspan='4'>3. <?php echo $cnt ?>
										</td>
									</tr>
									<tr>
										<td style='width: 200px;'>Name</td>
										<td style='width: 300px;'><?php echo $r1['title_name'].", ".$r1['name']." ".$r1['middle_name']." ".$r1['family_name']; ?>
										</td>
										<td style='width: 200px;'>Job Title</td>
										<td style='width: 300px;'><?php echo $r1['position']; ?>
										</td>
									</tr>
									<tr>
										<td>Company Name</td>
										<td><?php echo $r1['org']; ?>
										</td>
										<td>PATA Membership</td>
										<td><?php 
		if(isset($r1['radpata']) == 'Yes')
		{
			echo "Yes";
		}
		else
		{
			echo "No";
		}
		?>
										</td>
									</tr>
									<tr>
										<td>Address</td>
										<td colspan='3'><?php echo $r1['address']; ?>
										</td>
									</tr>
									<tr>
										<td>Country</td>
										<td><?php 
			$qry2=mysql_query("select * from countries where country_status='Y' and country_id=".$r1['cnt_id']);
			if(mysql_num_rows($qry2)>0)
			{
				while($rscon2=mysql_fetch_array($qry2))
				{
					echo $rscon2['country_name'];
				}
			}
		?>
										</td>
										<td>Postcode</td>
										<td><?php echo $r1['post_code']; ?>
										</td>
									</tr>
									<tr>
										<td>Tel</td>
										<td><?php echo $r1['tel']; ?>
										</td>
										<td>FAX</td>
										<td><?php echo $r1['fax']; ?>
										</td>
									</tr>
									<tr>
										<td>Email</td>
										<td><?php echo $r1['email']; ?>
										</td>
										<td>Website</td>
										<td><?php echo $r1['website']; ?>
										</td>
									</tr>
								</table>
								<?php
	}
}
}
?>
								<br>
								<h4>
										<strong>G.SELLER QUESTIONNAIRE</strong>
									<br />
									<br />
										<strong>A. COMPANY'S BUSINESS PROFILE </strong>
								</h4>
								<br />
								<br />
								<table>
									<tr>
										<td><?php
$pro="";
if(isset($_POST['servtype1']))
{
	$pro.="Accommodation - Hotel Chains, ";
}
if(isset($_POST['servtype2']))
{
	$pro.="Accommodation - Independent Hotels, ";
}
if(isset($_POST['servtype3']))
{
	$pro.="Accommodation - Resorts, ";
}
if(isset($_POST['servtype4']))
{
	$pro.="Accommodation - Serviced Apartments, ";
}
if(isset($_POST['servtype5']))
{
	$pro.="Airlines, ";
}
if(isset($_POST['servtype6']))
{
	$pro.="National / Regional Tourism Organisations, ";
}
if(isset($_POST['servtype7']))
{
	$pro.="Inbound Tour Operators, ";
}
if(isset($_POST['servtype8']))
{
	$pro.="Professional Conference Organisers, ";
}
if(isset($_POST['servtype9']))
{
	$pro.="Destination Management Companies, ";
}
if(isset($_POST['servtype10']))
{
	$pro.="Day Cruise Operators, ";
}
if(isset($_POST['servtype11']))
{
	$pro.="Regional / International Cruise Operators, ";
}
if(isset($_POST['servtype12']))
{
	$pro.="Car Rental, ";
}
if(isset($_POST['servtype13']))
{
	$pro.="Adventure Tour Operators, ";
}
if(isset($_POST['servtype14']))
{
	$pro.="Dive Operators, ";
}
if(isset($_POST['servtype15']))
{
	$pro.="Attractions / Museums / Galleries, ";
}
if(isset($_POST['servtype16']))
{
	$pro.="Rail Travel, ";
}
if(isset($_POST['servtype17']))
{
	$pro.="Theme Parks, ";
}
if(isset($_POST['servtype18']))
{
	$pro.="Nature / National Parks, ";
}
if(isset($_POST['servtype19']))
{
	$pro.="Restaurants, ";
}
if(isset($_POST['servtype20']))
{
	$pro.="Travel Media, ";
}
if(isset($_POST['servtype21']))
{
	$pro.="Travel Technology Companies, ";
}
if(isset($_POST['servtype22']))
{
	$pro.="Travel Web Portal, ";
}
if(isset($_POST['servtype23']))
{
	$pro.="Meeting / Convention Venue, ";
}
if(isset($_POST['servtype24']))
{
	$pro.="Spas, ";
}
if(isset($_POST['servtype25']))
{
	$pro.="Golf Courses, ";
}
if(isset($_POST['servtype26']))
{
	$pro.="Sports / Special Events, ";
}
if(isset($_POST['servtype27']))
{
	$pro.=$_POST['otherservtype27'].", ";
}
$pro=substr($pro,0,-2);
?>
											<?php echo $pro; ?>
									</tr>
								</table>
								<br />
								<h4>
										<strong>B. YOU WISH TO SEEK NEW BUYERS FROM </strong>
									<br />
										<strong>Europe </strong>
								</h4>
								<br />
								<br />
								<table>
									<tr>
										<td><?php
$pro="";
if(isset($_POST['cntfrom1']))
{
	$pro.="Austria, ";
}
if(isset($_POST['cntfrom2']))
{
	$pro.="Belgium, ";
}
if(isset($_POST['cntfrom3']))
{
	$pro.="France, ";
}
if(isset($_POST['cntfrom4']))
{
	$pro.="Germany, ";
}
if(isset($_POST['cntfrom5']))
{
	$pro.="Italy, ";
}
if(isset($_POST['cntfrom6']))
{
	$pro.="Netherlands, The, ";
}
if(isset($_POST['cntfrom7']))
{
	$pro.="Portugal, ";
}
if(isset($_POST['cntfrom8']))
{
	$pro.="Russia, ";
}
if(isset($_POST['cntfrom9']))
{
	$pro.="Spain, ";
}
if(isset($_POST['cntfrom10']))
{
	$pro.="Switzerland, ";
}
if(isset($_POST['cntfrom11']))
{
	$pro.="United Kingdom, ";
}
if(isset($_POST['cntfrom12']))
{
	$pro.=$_POST['othercntfrom12'].", ";
}
$pro=substr($pro,0,-2);

?>
											<?php echo $pro; ?>
									</tr>
								</table>
								<br />
								<h4>
										<strong>Asia </strong>
								</h4>
								<br />
								<br />
								<table>
									<tr>
										<td><?php
$pro="";
if(isset($_POST['cntfrom13']))
{
	$pro.="Brunei, ";
}
if(isset($_POST['cntfrom14']))
{
	$pro.="Cambodia, ";
}
if(isset($_POST['cntfrom15']))
{
	$pro.="China (PRC), ";
}
if(isset($_POST['cntfrom16']))
{
	$pro.="Chinese Taipei, ";
}
if(isset($_POST['cntfrom17']))
{
	$pro.="Hong Kong SAR, ";
}
if(isset($_POST['cntfrom18']))
{
	$pro.="India, ";
}
if(isset($_POST['cntfrom19']))
{
	$pro.="Indonesia, ";
}
if(isset($_POST['cntfrom20']))
{
	$pro.="Japan, ";
}
if(isset($_POST['cntfrom21']))
{
	$pro.="Korea (ROK), ";
}
if(isset($_POST['cntfrom22']))
{
	$pro.="Malaysia, ";
}
if(isset($_POST['cntfrom23']))
{
	$pro.="Myanmar, ";
}
if(isset($_POST['cntfrom24']))
{
	$pro.="Pakistan, ";
}
if(isset($_POST['cntfrom25']))
{
	$pro.="Philippines, ";
}
if(isset($_POST['cntfrom26']))
{
	$pro.="Singapore, ";
}
if(isset($_POST['cntfrom27']))
{
	$pro.="Thailand, ";
}
if(isset($_POST['cntfrom28']))
{
	$pro.=$_POST['othercntfrom28'].", ";
}
$pro=substr($pro,0,-2);
?>
											<?php echo $pro; ?>
									</tr>
								</table>
								<br />
								<h4>
										<strong>America </strong>
								</h4>
								<table>
									<tr>
										<td><?php
$pro="";
if(isset($_POST['cntfrom29']))
{
	$pro.="Argentina, ";
}
if(isset($_POST['cntfrom30']))
{
	$pro.="Brazil, ";
}
if(isset($_POST['cntfrom31']))
{
	$pro.="Canada, ";
}
if(isset($_POST['cntfrom32']))
{
	$pro.="Mexico, ";
}
if(isset($_POST['cntfrom33']))
{
	$pro.="USA, ";
}
if(isset($_POST['cntfrom34']))
{
	$pro.=$_POST['othercntfrom34'].", ";
}
$pro=substr($pro,0,-2);
?>
											<br />
										<br />
										<?php echo $pro; ?>
									</tr>
								</table>
								<br />
								<h4>
										<strong>Pacific </strong>
								</h4>
								<table>
									<tr>
										<td><?php
$pro="";
if(isset($_POST['cntfrom35']))
{
	$pro.="Australia, ";
}
if(isset($_POST['cntfrom36']))
{
	$pro.="New Zealand, ";
}
if(isset($_POST['cntfrom37']))
{
	$pro.=$_POST['othercntfrom37'].", ";
}
$pro=substr($pro,0,-2);
?>
											<br />
										<br />
										<?php echo $pro; ?>
									</tr>
								</table>
								<br />
								<h4>
									<span>
											<strong>Middle East / Africa: </strong>
									</span>
								</h4>
								<table>
									<tr>
										<td><?php
$pro="";
if(isset($_POST['cntfrom38']))
{
	$pro.="Egypt, ";
}
if(isset($_POST['cntfrom39']))
{
	$pro.="Iran, ";
}
if(isset($_POST['cntfrom40']))
{
	$pro.="Israel, ";
}
if(isset($_POST['cntfrom41']))
{
	$pro.="Jordan, ";
}
if(isset($_POST['cntfrom42']))
{
	$pro.="Kuwait, ";
}
if(isset($_POST['cntfrom43']))
{
	$pro.="Saudi Arabia, ";
}
if(isset($_POST['cntfrom44']))
{
	$pro.="South Africa, ";
}
if(isset($_POST['cntfrom45']))
{
	$pro.="Turkey, ";
}
	if(isset($_POST['cntfrom46']))
{
	$pro.="United Arab Emirates, ";
}
if(isset($_POST['cntfrom47']))
{
	$pro.=$_POST['othercntfrom47'].", ";
}
$pro=substr($pro,0,-2);

?>
											<br />
										<br />
										<?php echo $pro; ?>
									</tr>
								</table>
								<br />
								<h4>
										<strong>C.COMPANY DESCRIPTION: </strong>
								</h4>
								<br />
								<br />
								<table>
									<tr>
										<td><?php echo $_POST['com_desc']; ?>
									</tr>
								</table>
								<br />
								<br />
								<h4>
									<strong>SECTION H. BUYER NOMINATION </strong>
								</h4>
								<br />
								<h4>
									<span><strong>Selected Buyer(s) </strong>
									</span>
								</h4>
								<br />

								<?php
		$q1=mysql_query("select * from seller_requests sr where mas_seller_com_id=".$_POST['id']);
		if(mysql_num_rows($q1)>0)
		{
			while($r1=mysql_fetch_array($q1))
			{
			echo "<br>
				<table>
					<tr>
						<td style='width:150px;'>Fullname</td>
						<td style='width:300px;'>".$r1['buyer_fullname']."</td>
						<td style='width:150px;'>Company Name</td>
						<td style='width:300px;'>".$r1['buyer_company_name']."</td>
					</tr>
					<tr>
						<td style='width:150px;'>Job Title</td>
						<td style='width:300px;'>".$r1['buyer_jobtitle']."</td>
						<td style='width:150px;'>Country</td>
						<td style='width:300px;'>";
						$qry6=mysql_query("select country_name as cname from countries where country_id = ".$r1['buyer_country']);
						if(mysql_num_rows($qry6)>0)
						{
							while($rs=mysql_fetch_array($qry6))
							{
								echo $_POST['cname'];
							}
						}
			echo "
						</td>
					</tr>
					<tr>
						<td style='width:150px;'>Email</td>
						<td style='width:300px;'>".$r1['buyer_email']."</td>
						<td style='width:150px;'>Website</td>
						<td style='width:300px;'>".$r1['website']."</td>
					</tr></table><br>
				";
			}
		}
?>

								<br>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	