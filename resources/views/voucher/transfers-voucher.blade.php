<?php
$common=json_decode($siteData->common_data,true); 

$images=json_decode($siteData->images,true);

$site_logo=$images['logo'];
$phone=$common['contact1'];
$email=$common['email1'];
$website=$common['website'];
$company_address=$common['address1'];
$company_name=$siteData->website_name;

 $itineraryId=$bookingsData->itineraryId; 
 $order_id=$bookingsData->order_id;  
 $BookingID=$bookingsData->order_id; 
 $booking_status=$bookingsData->booking_status; 
 $date=$bookingsData->date_time; 

$book_response=json_decode($bookingsData->response_xml,true);

$back_img1=''; $QR_Img=''; $strip_color=''; $passengrr_phone=''; $passenger_email=''; $passenger_phone=''; $passenger_address=''; $passenger_city=''; $passenger_state=''; $passenger_city=''; $passenger_postalCode=''; $back_img2='';

$passengers = json_decode($bookingsData->rest_data, true);

$Roomnamexml=''; $room_Descriptionsz=''; $boardName=''; $cancellationPolicies=''; $cancellationPolicy=''; $room_name=''; 

 ?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#fff">
	<tbody>
		<tr>
			<td>
				<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tr> 
							<td style="color: #000000" bgcolor="#FFFFFF" valign="middle">
								<table width="100%" cellspacing="0" cellpadding="0" border="0">
									<tr>
										<td width="30%">
											<table width="100%" cellspacing="0" cellpadding="5" border="0">
												<tr>
													<td align="left"><img height="80" width="150" src="https://dev.plistbooking.travel/<?php echo $site_logo; ?>"></td>
												</tr>
											</table>
										</td>
										<td width="70%">
											<table width="100%" cellspacing="0" cellpadding="3" border="0">
												<tr>
													<td style="font-size:0;" height="10">&nbsp;</td>
												</tr>
												<tr align="right">
													<td width="83%" align="right">
														<table width="100%" cellspacing="0" cellpadding="" border="0">
															<tr>
																<td style="font-size:0;" height="3">&nbsp;</td>
															</tr>
															<tr>
																<td height="8" align="right"><strong>Booking Status : </strong> <span style="color:#<?php if($booking_status=='Confirmed'){ echo "5e993d";}else{echo "990000";} ?>;"><strong><?php echo $booking_status;  ?></strong></span></td>
															</tr>  
															<tr>
																<td style="font-size:0;" height="3">&nbsp;</td>
															</tr>
															<tr> 
																<td align="right"><strong><?php echo $phone;  ?></strong>&nbsp; <img width="15" valign="middle" src="<?php echo $back_img1; ?>"></td>
															</tr>
															<tr> 
																<td align="right"><strong><?php echo $email; ?></strong>&nbsp; <img width="15" style="" valign="middle" src="<?php echo $back_img2; ?>"></td>
															</tr>
														</table>
													</td> 
													<td width="2%" style="font-size:0;">&nbsp;</td>
													<!--<td width="15%">
														<table width="100%" cellspacing="0" cellpadding="3" border="0">
															<tr>
																<td> <img src="<?php echo $QR_Img; ?>"></td>
															</tr>
														</table>
													 </td>-->
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				<table width="100%" cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td style="color: #000;">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr style="font-size:0;">
									<td bgcolor="#006" height="4">&nbsp;</td>
									<td bgcolor="#090" height="4">&nbsp;</td>
									<td bgcolor="#666" height="4">&nbsp;</td>
									<td bgcolor="#00F" height="4">&nbsp;</td>
									<td bgcolor="#C69" height="4">&nbsp;</td>
									<td bgcolor="#F00" height="4">&nbsp;</td>
									<td bgcolor="#699" height="4">&nbsp;</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<table width="100%" cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td>
							<table width="100%" cellspacing="0" border="0" cellpadding="8">
								<tr>
									<th align="left" style="border: 1px solid #e4e4e4;"><strong>Reference No</strong></th>
									<th align="center" style="border: 1px solid #e4e4e4;"><strong>Confirmation No</strong></th>
									<th align="right" style="border: 1px solid #e4e4e4;"><strong>Itinerary Id </strong></th>
								</tr>
								<tr>
									<td align="left" style="border: 1px solid #e4e4e4;"><?php echo $order_id; ?></td>
									<td align="center" style="border: 1px solid #e4e4e4;"><?php echo $BookingID; ?></td>
									<td align="right" style="border: 1px solid #e4e4e4;"><?php echo $itineraryId; ?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<table width="100%" cellpadding="10" cellspacing="0" border="0">
					<tr>
						<td bgcolor="#669933" valign="middle">
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td width="35%" align="left" style="color:#fff; line-height: 20px;">
								    <br> <span style="font-size:15px;"><strong>CHECK IN DATE</strong></span>
										<br> <span><?php  echo date('d F, Y (l)',strtotime($bookingsData->check_in));  ?></span> </td>
									<td width="30%" align="center">
										<table width="100%" cellpadding="0" cellspacing="0" border="0">
											<tr>
								<td align="center"><!--<img width="35" src="https://www.abengines.com/tools/TCPDF/examples/templates/images/htktimg01.png">--></td>
											</tr>
											<tr><td align="center" height="15" style="color: #fff;"> <strong> <?php echo ($bookingsData->adults+$bookingsData->children) ?> Guest(s)</strong> </td>
											</tr>
										
										</table>
									</td>
									<td width="35%" align="right" style="color:#fff; line-height: 20px;">
									  <br> <span style="font-size:15px;"><strong>CHECK OUT DATE</strong></span>
										<br> <span><?php echo date('d F, Y (l)',strtotime($bookingsData->check_out)); ?></span> </td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td>
							<table width="100%" cellpadding="8" cellspacing="0" border="0">
								<tr>
									<th height="34" colspan="6" align="left" bgcolor="#f6f5f5" style="font-size: 14px; border: 1px solid #e4e4e4; color:#5e993d"><strong>GUEST DETAILS</strong></th>
								</tr>
								<tr align="left">
									<th width="40%" style="border: 1px solid #e4e4e4;"><strong>Lead Guest Name</strong></th>
									<th width="30%" style="border: 1px solid #e4e4e4;"><strong>Email Id</strong></th>
									<th width="30%" style="border: 1px solid #e4e4e4;"><strong>Conatct</strong></th>
								</tr>
								<tr align="left">
									<td style="border: 1px solid #e4e4e4;"><?php echo $bookingsData->user_name; ?></td>
									<td style="border: 1px solid #e4e4e4;"><?php echo $bookingsData->user_email; ?></td>
									<td style="border: 1px solid #e4e4e4;"><?php echo $bookingsData->user_contactno; ?></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height="5" style="font-size:0">&nbsp;</td>
					</tr>
				</table>
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td style="border: 1px solid #e4e4e4;">
							<table width="100%" cellpadding="8" cellspacing="0" border="0">
								<tr>
									<th height="34" colspan="6" align="left" bgcolor="#f6f5f5" style="font-size: 14px; border: 1px solid #e4e4e4; color:#5e993d"><strong>TRANSFERS DETAILS</strong></th>
								</tr>
							</table>
							<table width="100%" cellpadding="10" cellspacing="0" border="0">
								<tr>
									<td width="25%"> <img src="<?php echo $bookingsData->hotel_img; ?>"> </td>
									<td width="57%">
										<table width="100%" cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td height="5" style="font-size:0">&nbsp;</td>
											</tr>
											<tr>
												<td style="color:#000;"><strong style="font-size:14px; color:#039;"><?php echo $bookingsData->hotelName.",".$bookingsData->hotelCity; ?></strong>
													<br> <span style="font-size:11px"><strong>(2- Star Property )</strong></span> </td>
											</tr>
											<tr>
												<td style="color:#000;"><strong>Address : </strong><?php echo $bookingsData->hotelAddress; ?> </td>
											</tr>
                                            <tr>
												<td style="color:#000;">&nbsp;</td>
											</tr>
                                            <tr>
												<td style="color:#390; font-size:16px"><strong>PAID : </strong>
                                                <?php echo $bookingsData->chargable_rate; ?>
                                                </td>
											</tr>
										</table>
									</td>
									<td width="18%" align="right"> <img src="img"> </td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td height="5" style="font-size:0">&nbsp;</td>
					</tr>
					<tr>
						<td>
							<table width="100%" cellpadding="8" cellspacing="0" border="0">
								<tr align="left" height="34" bgcolor="#f6f5f5">
									<th width="100%" style="font-size: 14px; border: 1px solid #e4e4e4; color:#5e993d"><strong>ROOM TYPE</strong></th>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td width="100%" style="color:#000">
							<table width="100%" cellpadding="10" cellspacing="0" border="0">
								<tr align="left">
									<td style="border: 1px solid #e4e4e4;"><strong><?php echo $room_name;  ?></strong> - <?php echo $boardName; ?> <br />
<br />
<?php echo $room_Descriptionsz; ?>
</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				
				<table width="100%" cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td height="5" style="font-size:0">&nbsp;</td>
					</tr>
					<tr>
						<td>
							<table width="100%" cellspacing="0" cellpadding="8" border="0">
								<tr align="left">
									<th height="34" bgcolor="#f6f5f5" style="font-size: 14px; border: 1px solid #e4e4e4; color: #5e993d;"><strong>CANCELLATION POLICY</strong></th>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table width="100%" cellspacing="0" cellpadding="8" border="0">
								<tr align="left">
									<th width="100%" style="border: 1px solid #e4e4e4;"><?php echo $cancellationPolicy; ?></th>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<table width="100%" cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td height="5" style="font-size:0">&nbsp;</td>
					</tr>
					<tr>
						<td>
							<table width="100%" cellspacing="0" cellpadding="8" border="0">
								<tr>
									<th align="left" height="34" bgcolor="#f6f5f5" style="font-size: 14px; border: 1px solid #e4e4e4; color: #5e993d;"><strong>BOOKING TERMS & CONDITIONS</strong></th>
								</tr>
							</table>
							<table width="100%" cellspacing="0" cellpadding="10" border="0">
								<tr>
									<td style="border: 1px solid #e4e4e4;">
										<?php echo $pageData->content; ?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="10" style="color:#000000 " bgcolor="#FFFFFF">
<tr>
					<td align="center">&nbsp;</td>
				</tr>
				<tr>
					<td align="center"><img src="https://dev.plistbooking.travel/<?php echo $site_logo; ?>" width="100" height="50" /></td>
				</tr>
				<tr>
					<td align="center"><strong style="font-size:14px; padding:20px;"><?php echo $company_name; ?></strong></td>
				</tr>
				<tr>
					<td align="center">
						<?php echo $company_address; ?>
							<br />
								<?php echo $phone; ?>,
                                <br />
											<?php echo $email;  ?>
												<br />
												<?php echo $website; ?>
					</td>
				</tr>
			</table>
