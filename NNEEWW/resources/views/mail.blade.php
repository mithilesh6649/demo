<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Appointment Reminder Email Template</title>
	<meta name="description" content="Appointment Reminder Email Template" />
</head>
<style>
	a:hover {
		text-decoration: underline !important;
	}
	@media only screen and (max-width: 480px) {
		.time_slot {
			min-width: 100% !important;
			box-sizing: border-box;
		}
	}
</style>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
	<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8" style="@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap'); font-family: 'Poppins', sans-serif;">
		<tr>
			<td>
				<table style="background-color: #f2f3f8; max-width: 670px; margin: 0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td style="height: 80px;">&nbsp;</td>
					</tr>
					<!-- Logo -->
					<tr>
						<td style="text-align: center;">
							<a href="https://rakeshmandal.com" title="logo" target="_blank">
								<img width="190" src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/logo-brand.png" title="logo" alt="logo" />
							</a>
							<p style="font-size: 30px; margin-bottom: 0;">Hello! <b>
								@if($details['form'] =='user_function')
								{{$details['UserName']}}
								@else
								 Dr. {{$details['NutritionistName'] }}
								@endif
							</b></p>
							<p style="color: #262f5f; margin-top: 0px; font-size: 16px; font-weight: 400;">Your Appointment has been scheduled !</p>
						</td>
					</tr>
					<tr>
						<td style="height: 20px;">&nbsp;</td>
					</tr>
					<!-- Email Content -->
					<tr>
						<td>
							<table width="95%"border="0"align="center"cellpadding="0"cellspacing="0"style="max-width: 670px; background: #fff; border-radius: 3px; -webkit-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06); -moz-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06); box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06); padding: 0 40px; "> <tr>
								<td style="height: 40px;">&nbsp;</td>
							</tr>
							<!-- Title -->
							<tr>
								<td style="padding: 0 15px; text-align: center;">
									<img width="200px" src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/booking_appointment.png" alt="" />
									<p style="color: #262f5f; font-size: 18px; margin: 0; line-height: 1.3;">
										Jon, we've got you<br />
										Confirmed for your appointment
									</p>
								</td>
							</tr>
							<!-- Details Table -->
							<tr>
								<td>
									<table cellpadding="0" cellspacing="0" style="width: 100%;">
										<tbody>
											<tr>
												<td style="height: 20px;">&nbsp;</td>
											</tr>
											<tr>
												<td align="center">
													<span class="time_slot" style="background: rgb(11 157 88 / 8%); padding: 15px 10px; border-radius: 7px; display: inline-block; min-width: 60%;">
														<h3 style="color: #262f5f; margin: 0;">
															 
															@if($details['form'] =='user_function')
														  Dr.	{{$details['NutritionistName']}}
															@else
															{{$details['UserName']}}
															@endif

														</h3>
														<p style="font-size: 18px; color: rgba(0, 0, 0, 0.3); margin: 5px 0;">
															<span style="font-weight: 600; color: #262f5f;">{{date('g:i A',strtotime($details['startTime']))}}</span> | <span style="font-weight: 600; color: #262f5f;"> {{date('g:i A',strtotime($details['endTime']))}} </span>
														</p>
														<p style="font-size: 16px; color: rgba(0, 0, 0, 0.5); margin: 0;">{{date('l, F j, Y', strtotime($details['appointmentTime']))}}</p>
													</span>
												</td>
											</tr>
											<tr>
												<td style="height: 20px;">&nbsp;</td>
											</tr>
											<tr>
												<td align="center" style="">
													<span style="font-weight: 600; margin-bottom: 10px; font-size: 18px; display: inline-block;">Zoom Link</span>
													<a
													style="color: #262f5f; margin-top: 0px; font-size: 14px; font-weight: 400; text-decoration: none; display: block;"
													href="{{$details['zoomLink']}}"
													>
												{{$details['zoomLink']}}
												</a>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td style="height: 40px;">&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="height: 20px;">&nbsp;</td>
			</tr>
			<tr>
				<td>
					<table width="95%"border="0"align="center"cellpadding="0"cellspacing="0"style="max-width: 670px; background: #fff; border-radius: 3px; text-align: center; -webkit-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06); -moz-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06); box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06); "> <tr>
						<td style="height: 40px;">&nbsp;</td>
					</tr>
					<tr>
						<td style="padding: 0 35px;">
							<h3 style="font-size: 32px; font-weight: 400; margin: 0;">Get the <b>Gena HealthX</b> App!</h3>
							<p style="font-size: 16px; color: #262f5f; margin: 0; line-height: 1.5; margin-bottom: 32px;">
								Get the most of Gena HealthX by installing the mobile app.<br />
								You can log in by using your existing email address and password
							</p>

							<p style="color: #262f5f; font-size: 18px; line-height: 20px; margin: 0; font-weight: 500;"></p>

							<a href="#" style="display: inline-block; text-decoration: none;">
								<img src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/google-play.png" alt="Google Play" height="50px" />
							</a>
							<a href="#" style="display: inline-block; text-decoration: none;">
								<img src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/apple-app.png" alt="Apple App" height="50px" />
							</a>
							<span style="display: block; vertical-align: middle; margin: 29px 0 20px; border-bottom: 1px solid #cecece; width: 100%;"></span>
							<p style="color: #262f5f; font-size: 13px; margin: 0;">If you have any questions, send us an email <a href="mailto:support@genahealthX.com" style="color: #262f5f;">support@genahealthX.com</a></p>
						</td>
					</tr>
					<tr>
						<td style="height: 20px;">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style="height: 20px;">&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align:center;">
				<a href="genahealthX.com" style="font-size:14px;text-decoration: none; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>genahealthX.com</strong> </a>
			</td>
		</tr>
		<tr>
			<td style="height:80px;">&nbsp;</td>
		</tr>
	</table>
</td>
</tr>
</table>
</body>
</html>