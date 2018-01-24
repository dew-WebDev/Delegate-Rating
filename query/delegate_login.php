<?php
require_once("connectivity.php");
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$myuname=$_POST['txtuname'];
	$mypword=$_POST['txtpword'];
try
{
			$lq=mysql_query("select * from date_settings where settings_status='Y'");
			if(mysql_num_rows($lq) > 0 && $rs=mysql_fetch_array($lq))
			{
				$logon = $rs['delon'];
				
				if($logon == 'Y')
				{
							$i = mysql_query("select * from delegate_login where user_name='".$myuname."' and password=AES_ENCRYPT('".$mypword."','ALOGIC')");
							if(mysql_num_rows($i) > 0 && $ro = mysql_fetch_assoc($i))
							{
								if($ro['delegate_status'] == 'Y')
								{
									$_SESSION['user_name']=$ro['user_name'];
									$_SESSION['password']=$ro['password'];
									$_SESSION['mode']=$ro['delegate_mode'];

									if($ro['delegate_mode'] == 'S')
									{
										$_SESSION['did']=$ro['seller_com_id'];
										$_SESSION['msid']=$ro['mas_seller_id'];

										$qry=mysql_query("select * from seller_company where seller_com_id='".$ro['seller_com_id']."'");
										if((mysql_num_rows($qry)>0) && $r=mysql_fetch_array($qry))
										{
											$_SESSION['comname']=$_SESSION['user_name']." - ".$r['company_name'];
											
											$chk="";
											$q=mysql_query("select * from seller_missing_fields where seller_missing_fields_status='Y' and seller_com_id=".$r['seller_com_id']);
											if(mysql_num_rows($q)>0 && $rss=mysql_fetch_array($q))
											{
												$chk=$rss['pavillion_type'];
												$_SESSION['chk']= $rss['pavillion_type'];
												$_SESSION['fromEmail']=$rss['txtemail'];
											}
											if($chk == 3)
											{
													$tq=mysql_query("select * from date_settings where settings_status='Y'");
													if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
													{
														$allon = $rs['set2on'];
														if($allon == 'Y')
														{
															header("location:../sellerhome2.php");
														}
														else
														{
															header("location:../business-calendarsellermicroenterprice.php");
														}
													}	
											}
											else
											{
												$tq=mysql_query("select * from date_settings where settings_status='Y'");
													$on="";
													$off="";
													if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
													{
														$allon = $rs['set2on'];
														if($allon == 'Y')
														{
															header("location:../sellerhome2.php");
														}
														else
														{
															header("location:../business-calendarseller.php");
														}
													}	
											}
											
										}
									}
									else
									{
										$_SESSION['did']=$ro['buyer_com_id'];
										$_SESSION['mbid']=$ro['mas_buyer_id'];

										$qry=mysql_query("select * from buyer_company where buyer_com_id='".$ro['buyer_com_id']."'");
										if((mysql_num_rows($qry)>0) && $r=mysql_fetch_array($qry))
										{
											$_SESSION['comname']=$r['company_id']." - ".$r['company_name'];
			$chk="";
											$q=mysql_query("select * from buyer_org_details where buyer_org_status='Y' and buyer_com_id=".$r['buyer_com_id']);
											if(mysql_num_rows($q)>0 && $rss=mysql_fetch_array($q))
											{
												$chk=$rss['one_day_buyer'];
												$_SESSION['chk']= $rss['one_day_buyer'];
											}
											$q=mysql_query("select EMail_A as email from buyer_missing_fields where buyer_missing_fields_status='Y' and buyer_com_id=".$r['buyer_com_id']);
											if(mysql_num_rows($q)>0 && $rss=mysql_fetch_array($q))
											{
												$_SESSION['fromEmail']=$rss['email'];
											}
											if($chk == '1')
											{
												$tq=mysql_query("select * from date_settings where settings_status='Y'");
													$on="";
													$off="";
													if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
													{
														$allon = $rs['set2on'];
														if($allon == 'Y')
														{
															header("location:../buyerhome2.php");
														}
														else
														{
															header("location:../business-calendarbuyeroneday.php");
														}
													}	
											}
											else
											{
												$tq=mysql_query("select * from date_settings where settings_status='Y'");
													$on="";
													$off="";
													if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
													{
														$allon = $rs['set2on'];
														if($allon == 'Y')
														{
															header("location:../buyerhome2.php");
														}
														else
														{
															header("location:../business-calendarbuyer.php");
														}
													}
											}
										}

									}
									
								}
								else
								{
									header("location:../delegate_login.php?mes=Your Account has been Deactivated");
								}
							}
							else
							{								
								$masq=mysql_query("select AES_DECRYPT(masterpass,'ALOGIC') as masterpass from masterpass where masterpass_status='Y'");
								if(mysql_num_rows($masq) && $masv=mysql_fetch_array($masq))
								{											
									if($masv['masterpass'] == $mypword)
									{
										$_SESSION['mas_user_name'] = 'Y';
										$_SESSION['user_name']= $myuname;
										$i = mysql_query("select * from delegate_login where user_name='".$myuname."'");
										if(mysql_num_rows($i) > 0 && $ro = mysql_fetch_assoc($i))
										{
											if($ro['delegate_status'] == 'Y')
											{
												$_SESSION['user_name']=$ro['user_name'];
												$_SESSION['password']=$ro['password'];
												$_SESSION['mode']=$ro['delegate_mode'];

												if($ro['delegate_mode'] == 'S')
												{
													$_SESSION['did']=$ro['seller_com_id'];
													$_SESSION['msid']=$ro['mas_seller_id'];

													$qry=mysql_query("select * from seller_company where seller_com_id='".$ro['seller_com_id']."'");
													if((mysql_num_rows($qry)>0) && $r=mysql_fetch_array($qry))
													{
														$_SESSION['comname']=$_SESSION['user_name']." - ".$r['company_name'];
														
														$chk="";
														$q=mysql_query("select * from seller_missing_fields where seller_missing_fields_status='Y' and seller_com_id=".$r['seller_com_id']);
														if(mysql_num_rows($q)>0 && $rss=mysql_fetch_array($q))
														{
															$chk=$rss['pavillion_type'];
															$_SESSION['chk']= $rss['pavillion_type'];
															$_SESSION['fromEmail']=$rss['txtemail'];
														}
														if($chk == 3)
														{
																$tq=mysql_query("select * from date_settings where settings_status='Y'");
																if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
																{
																	$allon = $rs['set2on'];
																	if($allon == 'Y')
																	{
																		header("location:../sellerhome2.php");
																	}
																	else
																	{
																		header("location:../business-calendarsellermicroenterprice.php");
																	}
																}	
														}
														else
														{
															$tq=mysql_query("select * from date_settings where settings_status='Y'");
																$on="";
																$off="";
																if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
																{
																	$allon = $rs['set2on'];
																	if($allon == 'Y')
																	{
																		header("location:../sellerhome2.php");
																	}
																	else
																	{
																		header("location:../business-calendarseller.php");
																	}
																}	
														}
														
													}
												}
												else
												{
													$_SESSION['did']=$ro['buyer_com_id'];
													$_SESSION['mbid']=$ro['mas_buyer_id'];

													$qry=mysql_query("select * from buyer_company where buyer_com_id='".$ro['buyer_com_id']."'");
													if((mysql_num_rows($qry)>0) && $r=mysql_fetch_array($qry))
													{
														$_SESSION['comname']=$r['company_id']." - ".$r['company_name'];
						$chk="";
														$q=mysql_query("select * from buyer_org_details where buyer_org_status='Y' and buyer_com_id=".$r['buyer_com_id']);
														if(mysql_num_rows($q)>0 && $rss=mysql_fetch_array($q))
														{
															$chk=$rss['one_day_buyer'];
															$_SESSION['chk']= $rss['one_day_buyer'];
														}
														$q=mysql_query("select EMail_A as email from buyer_missing_fields where buyer_missing_fields_status='Y' and buyer_com_id=".$r['buyer_com_id']);
														if(mysql_num_rows($q)>0 && $rss=mysql_fetch_array($q))
														{
															$_SESSION['fromEmail']=$rss['email'];
														}
														if($chk == '1')
														{
															$tq=mysql_query("select * from date_settings where settings_status='Y'");
																$on="";
																$off="";
																if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
																{
																	$allon = $rs['set2on'];
																	if($allon == 'Y')
																	{
																		header("location:../buyerhome2.php");
																	}
																	else
																	{
																		header("location:../business-calendarbuyeroneday.php");
																	}
																}	
														}
														else
														{
															$tq=mysql_query("select * from date_settings where settings_status='Y'");
																$on="";
																$off="";
																if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
																{
																	$allon = $rs['set2on'];
																	if($allon == 'Y')
																	{
																		header("location:../buyerhome2.php");
																	}
																	else
																	{
																		header("location:../business-calendarbuyer.php");
																	}
																}
														}
													}

												}
												
											}
											else
											{
												header("location:../delegate_login.php?mes=Your Account has been Deactivated");
											}
										}
									}
									else
									{
										header("location:../delegate_login.php?mes=Invalid User Name or Password");
									}
												
								}
							}
				}	
				else if($logon == 'N')
				{
							$ki = mysql_query("select * from delegate_login where user_name='".$myuname."' and password=AES_ENCRYPT('".$mypword."','ALOGIC')");
							if(mysql_num_rows($ki) > 0 && $r1o = mysql_fetch_assoc($ki))
							{
								if($r1o['delegate_status'] == 'Y')
								{
									header("location:../delegate_login.php?mes=1");
								}
							}
							else
							{								
								$masq=mysql_query("select AES_DECRYPT(masterpass,'ALOGIC') as masterpass from masterpass where masterpass_status='Y'");
								if(mysql_num_rows($masq) && $masv=mysql_fetch_array($masq))
								{											
									if($masv['masterpass'] == $mypword)
									{
										$_SESSION['mas_user_name'] = 'Y';
										$_SESSION['user_name']= $myuname;
										$i = mysql_query("select * from delegate_login where user_name='".$myuname."'");
										if(mysql_num_rows($i) > 0 && $ro = mysql_fetch_assoc($i))
										{
											if($ro['delegate_status'] == 'Y')
											{
												$_SESSION['user_name']=$ro['user_name'];
												$_SESSION['password']=$ro['password'];
												$_SESSION['mode']=$ro['delegate_mode'];

												if($ro['delegate_mode'] == 'S')
												{
													$_SESSION['did']=$ro['seller_com_id'];
													$_SESSION['msid']=$ro['mas_seller_id'];

													$qry=mysql_query("select * from seller_company where seller_com_id='".$ro['seller_com_id']."'");
													if((mysql_num_rows($qry)>0) && $r=mysql_fetch_array($qry))
													{
														$_SESSION['comname']=$_SESSION['user_name']." - ".$r['company_name'];
														
														$chk="";
														$q=mysql_query("select * from seller_missing_fields where seller_missing_fields_status='Y' and seller_com_id=".$r['seller_com_id']);
														if(mysql_num_rows($q)>0 && $rss=mysql_fetch_array($q))
														{
															$chk=$rss['pavillion_type'];
															$_SESSION['chk']= $rss['pavillion_type'];
															$_SESSION['fromEmail']=$rss['txtemail'];
														}
														if($chk == 3)
														{
																$tq=mysql_query("select * from date_settings where settings_status='Y'");
																if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
																{
																	$allon = $rs['set2on'];
																	if($allon == 'Y')
																	{
																		header("location:../sellerhome2.php");
																	}
																	else
																	{
																		header("location:../business-calendarsellermicroenterprice.php");
																	}
																}	
														}
														else
														{
															$tq=mysql_query("select * from date_settings where settings_status='Y'");
																$on="";
																$off="";
																if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
																{
																	$allon = $rs['set2on'];
																	if($allon == 'Y')
																	{
																		header("location:../sellerhome2.php");
																	}
																	else
																	{
																		header("location:../business-calendarseller.php");
																	}
																}	
														}
														
													}
												}
												else
												{
													$_SESSION['did']=$ro['buyer_com_id'];
													$_SESSION['mbid']=$ro['mas_buyer_id'];

													$qry=mysql_query("select * from buyer_company where buyer_com_id='".$ro['buyer_com_id']."'");
													if((mysql_num_rows($qry)>0) && $r=mysql_fetch_array($qry))
													{
														$_SESSION['comname']=$r['company_id']." - ".$r['company_name'];
						$chk="";
														$q=mysql_query("select * from buyer_org_details where buyer_org_status='Y' and buyer_com_id=".$r['buyer_com_id']);
														if(mysql_num_rows($q)>0 && $rss=mysql_fetch_array($q))
														{
															$chk=$rss['one_day_buyer'];
															$_SESSION['chk']= $rss['one_day_buyer'];
														}
														$q=mysql_query("select EMail_A as email from buyer_missing_fields where buyer_missing_fields_status='Y' and buyer_com_id=".$r['buyer_com_id']);
														if(mysql_num_rows($q)>0 && $rss=mysql_fetch_array($q))
														{
															$_SESSION['fromEmail']=$rss['email'];
														}
														if($chk == '1')
														{
															$tq=mysql_query("select * from date_settings where settings_status='Y'");
																$on="";
																$off="";
																if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
																{
																	$allon = $rs['set2on'];
																	if($allon == 'Y')
																	{
																		header("location:../buyerhome2.php");
																	}
																	else
																	{
																		header("location:../business-calendarbuyeroneday.php");
																	}
																}	
														}
														else
														{
															$tq=mysql_query("select * from date_settings where settings_status='Y'");
																$on="";
																$off="";
																if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
																{
																	$allon = $rs['set2on'];
																	if($allon == 'Y')
																	{
																		header("location:../buyerhome2.php");
																	}
																	else
																	{
																		header("location:../business-calendarbuyer.php");
																	}
																}
														}
													}

												}
												
											}
											else
											{
												header("location:../delegate_login.php?mes=Your Account has been Deactivated");
											}
										}
									}
									else
									{
										header("location:../delegate_login.php?mes=1");
									}
												
								}
							}
				}
				else
				{								
								$masq=mysql_query("select AES_DECRYPT(masterpass,'ALOGIC') as masterpass from masterpass where masterpass_status='Y'");
								if(mysql_num_rows($masq) && $masv=mysql_fetch_array($masq))
								{											
									if($masv['masterpass'] == $mypword)
									{
										$_SESSION['mas_user_name'] = 'Y';
										$_SESSION['user_name']= $myuname;
										$i = mysql_query("select * from delegate_login where user_name='".$myuname."'");
										if(mysql_num_rows($i) > 0 && $ro = mysql_fetch_assoc($i))
										{
											if($ro['delegate_status'] == 'Y')
											{
												$_SESSION['user_name']=$ro['user_name'];
												$_SESSION['password']=$ro['password'];
												$_SESSION['mode']=$ro['delegate_mode'];

												if($ro['delegate_mode'] == 'S')
												{
													$_SESSION['did']=$ro['seller_com_id'];
													$_SESSION['msid']=$ro['mas_seller_id'];

													$qry=mysql_query("select * from seller_company where seller_com_id='".$ro['seller_com_id']."'");
													if((mysql_num_rows($qry)>0) && $r=mysql_fetch_array($qry))
													{
														$_SESSION['comname']=$_SESSION['user_name']." - ".$r['company_name'];
														
														$chk="";
														$q=mysql_query("select * from seller_missing_fields where seller_missing_fields_status='Y' and seller_com_id=".$r['seller_com_id']);
														if(mysql_num_rows($q)>0 && $rss=mysql_fetch_array($q))
														{
															$chk=$rss['pavillion_type'];
															$_SESSION['chk']= $rss['pavillion_type'];
															$_SESSION['fromEmail']=$rss['txtemail'];
														}
														if($chk == 3)
														{
																$tq=mysql_query("select * from date_settings where settings_status='Y'");
																if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
																{
																	$allon = $rs['set2on'];
																	if($allon == 'Y')
																	{
																		header("location:../sellerhome2.php");
																	}
																	else
																	{
																		header("location:../business-calendarsellermicroenterprice.php");
																	}
																}	
														}
														else
														{
															$tq=mysql_query("select * from date_settings where settings_status='Y'");
																$on="";
																$off="";
																if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
																{
																	$allon = $rs['set2on'];
																	if($allon == 'Y')
																	{
																		header("location:../sellerhome2.php");
																	}
																	else
																	{
																		header("location:../business-calendarseller.php");
																	}
																}	
														}
														
													}
												}
												else
												{
													$_SESSION['did']=$ro['buyer_com_id'];
													$_SESSION['mbid']=$ro['mas_buyer_id'];

													$qry=mysql_query("select * from buyer_company where buyer_com_id='".$ro['buyer_com_id']."'");
													if((mysql_num_rows($qry)>0) && $r=mysql_fetch_array($qry))
													{
														$_SESSION['comname']=$r['company_id']." - ".$r['company_name'];
						$chk="";
														$q=mysql_query("select * from buyer_org_details where buyer_org_status='Y' and buyer_com_id=".$r['buyer_com_id']);
														if(mysql_num_rows($q)>0 && $rss=mysql_fetch_array($q))
														{
															$chk=$rss['one_day_buyer'];
															$_SESSION['chk']= $rss['one_day_buyer'];
														}
														$q=mysql_query("select EMail_A as email from buyer_missing_fields where buyer_missing_fields_status='Y' and buyer_com_id=".$r['buyer_com_id']);
														if(mysql_num_rows($q)>0 && $rss=mysql_fetch_array($q))
														{
															$_SESSION['fromEmail']=$rss['email'];
														}
														if($chk == '1')
														{
															$tq=mysql_query("select * from date_settings where settings_status='Y'");
																$on="";
																$off="";
																if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
																{
																	$allon = $rs['set2on'];
																	if($allon == 'Y')
																	{
																		header("location:../buyerhome2.php");
																	}
																	else
																	{
																		header("location:../business-calendarbuyeroneday.php");
																	}
																}	
														}
														else
														{
															$tq=mysql_query("select * from date_settings where settings_status='Y'");
																$on="";
																$off="";
																if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
																{
																	$allon = $rs['set2on'];
																	if($allon == 'Y')
																	{
																		header("location:../buyerhome2.php");
																	}
																	else
																	{
																		header("location:../business-calendarbuyer.php");
																	}
																}
														}
													}

												}
												
											}
											else
											{
												header("location:../delegate_login.php?mes=Your Account has been Deactivated");
											}
										}
									}
									else
									{
										header("location:../delegate_login.php?mes=Invalid User Name or Password");
									}
												
								}
				}
			}
}			
			catch(Exception $e)
			{
				header("location:../delegate_login.php?mes=Login Failed");
			}
}
?>