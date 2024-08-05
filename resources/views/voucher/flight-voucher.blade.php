
<?php

$common=json_decode($siteData->common_data,true); 
$images=json_decode($siteData->images,true);

$site_logo=$images['logo'];
$phone=$common['contact1'];
$email=$common['email1'];
$website=$common['website'];
$company_address=$common['address1'];
$company_name=$siteData->website_name;

 $pnr=$bookingsData->pnr; 
 $BookingID=$bookingsData->order_id; //BookingID;  
 $booking_status=$bookingsData->booking_status; 
 $date=$bookingsData->created_at; 
  $back_img1='';   $QR_Img='';  $strip_color=''; $passengrr_phone=''; $passenger_email=''; $passenger_phone=''; $passenger_address=''; $passenger_city=''; $passenger_state=''; $passenger_city=''; $passenger_postalCode=''; $back_img2='';
  

											 	 $book_response=json_decode($bookingsData->book_response,true);

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
										<th align="left" style="border: 1px solid #e4e4e4;"><strong>PNR</strong></th>
										<th align="center" style="border: 1px solid #e4e4e4;"><strong>Booking/Ref ID</strong></th>
										<th align="right" style="border: 1px solid #e4e4e4;"><strong>Booking Date</strong></th>
									</tr>
									<tr> 
										<td align="left" style="border: 1px solid #e4e4e4;">
                                       <?php  echo $bookingsData->pnr; ?>
										</td>
										<td align="center" style="border: 1px solid #e4e4e4;">
											<?php echo $BookingID; ?>
										</td>
										<td align="right" style="border: 1px solid #e4e4e4;">
											<?php echo  $date; ?>
										</td>
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
										<th height="34" colspan="6" align="left" bgcolor="#f6f5f5" style="font-size: 14px; border: 1px solid #e4e4e4; color:#5e993d"><strong>PASSENGER(S) INFORMATION</strong></th>
									</tr>
									<tr align="left">
										<th width="20%" style="border: 1px solid #e4e4e4;"><strong>Ticket No.</strong></th>
										<th width="30%" style="border: 1px solid #e4e4e4;"><strong>Name</strong></th>
										<th width="16%" style="border: 1px solid #e4e4e4;"><strong>Gender</strong></th>
										<th width="18%" style="border: 1px solid #e4e4e4;"><strong>Date of Birth</strong></th>
                                        <th width="16%" style="border: 1px solid #e4e4e4;"><strong>Contact</strong></th> 
									</tr>
                                    	<?php 		
											$book_request=json_decode($bookingsData->book_request,true);
											$Passengers=$book_request['data']['passengers'];									  
											 for($i=0;$i<count($Passengers);$i++){
											 ?>
												<tr>
												<td style="border: 1px solid #e4e4e4;">
												    {{$BookingID}}
												</td>
												<td style="border: 1px solid #e4e4e4;">
													<?php echo $Passengers[$i]['title']; ?>
														<?php echo $Passengers[$i]['family_name']; ?>
												</td>
												<td style="border: 1px solid #e4e4e4;">
														<?php  echo $Passengers[$i]['gender']; ?>
												</td>
												<td style="border: 1px solid #e4e4e4;">
													<?php echo $Passengers[$i]['born_on']; ?>
												</td>
												<td style="border: 1px solid #e4e4e4;">
													<?php echo $Passengers[$i]["email"]; ?><br />
                                                    <?php echo $Passengers[$i]["phone_number"]; ?>
												</td>
											</tr>
											<?php } ?>
								</table>
							</td>
						</tr>
					</table>
                    <?php $FlightsSegment=json_decode($bookingsData->FlightsSegment,true); ?>
              		@foreach($FlightsSegment as $key=>$data)
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr> 
							<td>
								<table width="100%" cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td>
											<table width="100%" cellpadding="8" cellspacing="0" border="0">
												<tr>
													<th height="34" colspan="6" align="left" bgcolor="#f6f5f5" style="font-size: 14px; border: 1px solid #e4e4e4; color:#5e993d"><strong><?php echo $key; ?></strong></th>
												</tr>
											</table>
                                            <table width="100%" cellpadding="8" cellspacing="0" border="0">
												<tr height="34" style="color:#5e993d">
													<th width="14%" align="center" style="border: 1px solid #e4e4e4;"><strong>Airline</strong></th>
													<th width="16%" align="left" style="border: 1px solid #e4e4e4;"><strong>Baggage</strong></th>
													<th width="35%" align="left" style="border: 1px solid #e4e4e4;"><strong>From / Terminal</strong></th>
													<th width="35%" align="right" style="border: 1px solid #e4e4e4;"><strong>To / Terminal</strong></th>
												</tr>
                                           <?php for($a=0;$a<count($FlightsSegment[$key]);$a++){ $d=$FlightsSegment[$key][$a];
										   
										  // $baggage=$d['baggageDetails'][0];
										    ?> 
												<tr>
													<td align="center" style="border: 1px solid #e4e4e4;">
                              	<img src="https://res.cloudinary.com/wego/image/upload/c_fit,w_60,h_40/v20190802/flights/airlines_square/{{$d['operating_carrier']}}"  />
                                                        <br>{{$d['airline_name']}}
														<br>{{$d['operating_carrier']}}-{{$d['flight_no']}}
														<br>{{$d['duration']}} </td>
													<td style="border: 1px solid #e4e4e4;"> <br />
                                                       -
                                                    </td>
													<td style="border: 1px solid #e4e4e4;"><span><strong> 
                                                    {{$d['cityFrom']}} ({{$d['flyFrom']}})   <br />{{$d['FromAirportName']}} </strong>
											<br>@if(isset($d['destination_terminal'])) {{$d['OriginTerminal']}} @endif </span>
														<br><span style="line-height:18px">{{$d['departTime']}}</span>
														<br><span>{{$d['departDate']}}</span> </td>
													<td align="right" style="border: 1px solid #e4e4e4;"> <span><strong>
                                                    {{$d['cityTo']}} ({{$d['flyTo']}}) <br />{{$d['ToAirportName']}} </strong>
											<br> @if(isset($d['DestinationTerminal'])) {{$d['DestinationTerminal']}}  @endif </span>
														<br><span style="line-height:18px">{{$d['arrivelTime']}}</span>
														<br><span>{{$d['arrivelDate']}}</span> </td>
												</tr>
                                           <?php } ?>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
                    @endforeach
                    
                    <?php if(!isset($show_price)){ $show_price='No'; } if($show_price=='Yes'){ ?>
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td height="5" style="font-size:0">&nbsp;</td>
						</tr>
						<tr>
							<td>
								<table width="100%" cellspacing="0" cellpadding="10" border="0">
									<tr height="32" align="left">
										<th height="34" colspan="6" align="left" bgcolor="#f6f5f5" style="font-size: 14px; border: 1px solid #e4e4e4; color:#5e993d"><strong>FARE DETAILS</strong></th>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table width="100%" cellspacing="0" cellpadding="8" border="0">
									<tr>
										<th style="border: 1px solid #e4e4e4;">Ticket Fare</th>
										<td align="right" style="border: 1px solid #e4e4e4;"> <?php echo $bookingsData->currency; ?> <?php  echo $bookingsData->base_price; ?></td>
									</tr>
									<tr >
										<th style="border: 1px solid #e4e4e4;">Tax </th>
										<td align="right" style="border: 1px solid #e4e4e4;"> <?php echo $bookingsData->currency; ?> <?php  echo $bookingsData->prices-$bookingsData->base_price; ?></td>
									</tr>
									<tr>
										<th style="border: 1px solid #e4e4e4;"><strong>Total</strong></th>
										<td align="right" style="border: 1px solid #e4e4e4;"><strong><?php echo $bookingsData->currency; ?> <?php  echo $bookingsData->prices; ?></strong></td>
									</tr>                                                                        
								</table>
							</td>
						</tr>
						<tr>
							<td height="2" style="font-size:0">&nbsp;</td>
						</tr>
					</table>
					<?php } ?>
                    
      					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td height="3" style="font-size:0">&nbsp;</td>
						</tr>
						<tr>
							<td width="50%">
								<table width="100%" cellpadding="8" cellspacing="0" border="0">
									<tr>
										<th height="34" colspan="6" align="left" bgcolor="#f6f5f5" style="font-size: 14px; border: 1px solid #e4e4e4; color:#5e993d"><strong>PASSENGER CONTACT DETAILS</strong></th>
									</tr>
									<tr>
										<th align="left" width="22%" style="border: 1px solid #e4e4e4;"><strong>Email</strong></th>
										<td width="78%" style="border: 1px solid #e4e4e4;"><?php echo $Passengers[0]['email'];  ?></td>
									</tr>
									<tr>
										<th align="left" style="border: 1px solid #e4e4e4;"><strong>Contact</strong></th>
										<td style="border: 1px solid #e4e4e4;"><?php echo $Passengers[0]['phone_number']; ?></td>
									</tr>
									<tr>
										<th align="left" style="border: 1px solid #e4e4e4;"><strong>Address</strong></th>
									<td style="border: 1px solid #e4e4e4;"><?php echo $bookingsData->address; ?></td>
									</tr>
								</table>
							</td>
							<td width="50%">
								<table width="100%" cellpadding="8" cellspacing="0" border="0">
									<tr>
										<th height="34" colspan="6" align="left" bgcolor="#f6f5f5" style="font-size: 14px; border: 1px solid #e4e4e4; color:#5e993d"><strong>CUSTOMER CARE</strong></th>
									</tr>
									<tr>
										<th align="left" width="22%" style="border: 1px solid #e4e4e4;"><strong>Email</strong></th>
										<td width="78%" style="border: 1px solid #e4e4e4;"><?php echo $email; ?> </td>
									</tr>
									<tr>
										<th align="left" style="border: 1px solid #e4e4e4;"><strong>Contact</strong></th>
										<td style="border: 1px solid #e4e4e4;"><?php echo $phone; //echo $obj_customer["phone"]; ?></td>
									</tr>
									<tr>
										<th align="left" style="border: 1px solid #e4e4e4;"><strong>Website</strong></th>
										<td style="border: 1px solid #e4e4e4;"><?php echo $website; ?></td>
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
										<th align="left" height="34" bgcolor="#f6f5f5" style="font-size: 14px; border: 1px solid #e4e4e4; color: #5e993d;"><strong>IMPORTANT INFORMATION</strong></th>
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