<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Email</title>
</head>
<body style="font-family: 'Lato', sans-serif; padding:0; margin:0;">
<table style="max-width: 750px; margin: 0px auto; width: 100% ! important; background: #F3F3F3; padding: 0px 30px 30px 30px;" width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td style="background:#fdfdfd; padding:15px; text-align: center;"><img style="max-width: 230px; width: 100%;" src="<?php echo $base_url;?>logo.png"></td>
	</tr>
	<tr>
		<td style="text-align: center; background:#0073B7;">
		<table width="100%" border="0" cellpadding="30" cellspacing="0">
			<tr>
			<td>
				<h2 style="color: #fff; margin: 0 0 5px; text-transform: capitalize; font-size: 35px; font-weight: normal; font-family: 'Courgette', cursive;">Welcome to  <span style="color: #fff;">Sand'n Soil</span></h2>
				<h3 style="color: #fff; font-size: 22px; font-weight: normal; margin: 12px 0 0;"><?php echo !empty($title) ?$title:''; ?></h3>
			
			</td>
			</tr>
		</table>
		</td>
		
	</tr>

	<tr>
		<td align="center" style="text-align: center; background:#F3F3F3;">
			<table width="100%" border="0" cellpadding="20" cellspacing="0">
				<tr>
					<td style="text-align: left; ">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<h3 style="color: #333; font-size: 22px; font-weight: normal; margin: 12px 0 0;"><?php echo !empty($title) ?$title:''; ?></h3>
<!--
									<p style="color: #636469; font-size: 16px; line-height: 28px;">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
-->
								</td>
							</tr>
						</table>	
					</td>
				</tr>
			</table>	
		</td>
	</tr>
	<tr>
		<td style="text-align: center; border-bottom:5px solid #0073B7;">
			<table width="100%" border="0" cellpadding="30" cellspacing="0" bgcolor="#fff">
				<tr>
					<td>
					   
					    <p style="border-top: 1px solid #d8d8d8;padding-top: 25px;margin-top: 20px; font-size: 17px;
						color: #232222;font-style: italic;margin-bottom: 11px;"><?php echo !empty($contant) ?$contant:'';?>
						</p>
						 <a href="<?php echo !empty($link) ? $link:'javascript:void(0);'; ?>" style="background: #199191; color: #fff;text-decoration: none; padding: 15px 5px;margin: 11px 0;
						display: inline-block;font-size: 19px;font-weight: 600;border-radius: 6px;width: 67%;">Click here</a>
					    <p style="font-size: 17px;color: #232222;font-style: italic;margin-top: 0px;margin-bottom: 0;">-The Sand'n Soil Team</p>
					</td>
				</tr>
				<tr>
					<td>
						<div>
							<img style="max-width: 100px; width: 100%; margin-bottom:6px;" src="<?php echo $base_url;?>favicon.png">
						</div>
						<p style="color: #636469; font-size: 16px; line-height: 28px;">
						<?php echo !empty($message)?$message:''; ?>
						</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
