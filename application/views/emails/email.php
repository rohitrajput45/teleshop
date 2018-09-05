<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sandnsoil</title>
</head>
<body style="font-family: open sans; padding:0; margin:0;">
<table style="max-width: 750px; margin: 0px auto; width: 100% ! important;" width="100% !important" border="0" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td style="background: #f3f3f3;padding:15px;text-align: center;"><img style="max-width: 44%;width: 100%;padding: 10px;" src="<?php echo base_url().FRONT_THEME;?>images/logo.png">
            </td>
        </tr>

        <tr>
            <td style="text-align: center;background: #F3F3F3;padding: 0px 30px 30px 30px;">
                <table width="100%" border="0" cellpadding="30" cellspacing="0" bgcolor="#fff">
                    <tbody>
                        <tr>
                            <td>
                               <!--  <h3 style="color: 2c2929;margin: 0;text-transform: capitalize;font-size: 28px;font-weight: normal;font-family: 'Courgette', cursive; letter-spacing: -1px;"><img src="<?php echo base_url().FRONT_THEME;?>images/favicon.png"></h3> -->
                                <p style="color: #2c2929;font-size: 16px;line-height: 28px;font-weight: 600;"><?php echo !empty($title) ?$title:'TIle'; ?></p>
                                
                                <a href="<?php echo !empty($link) ? $link:'javascript:void(0);'; ?>" style="background: #199191; color: #fff;text-decoration: none; padding: 15px 5px;margin: 11px 0;
								display: inline-block;font-size: 19px;font-weight: 600;border-radius: 6px;width: 67%;"><?php echo !empty($message) ?$message:'msghgj'; ?></a>
								<p style="color: #C0262C;font-size: 16px;line-height: 28px;font-weight: 600;"></p>
                                <p style="border-top: 1px solid #d8d8d8;padding-top: 25px;margin-top: 20px; font-size: 17px;
								color: #232222;font-style: italic;margin-bottom: 11px;"><?php echo !empty($contant) ?$contant:'contantcontantcontantcontantcontant';?></p>
                                <p style="font-size: 17px;color: #232222;font-style: italic;margin-top: 0px;margin-bottom: 0;">- The Sand'n Soil Team</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        
    </tbody>
</table>
</body>
</html>
