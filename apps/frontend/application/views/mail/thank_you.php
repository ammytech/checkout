<?php 
$name = (!empty($name) ? $name : 'user');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order Placed : Checkout</title>
</head>

<body>

	<table width="640px" border="0" cellpadding="0" cellspacing="0" style="outline:none;margin:0 auto;padding:0px;640px;">
    	
        <!--mailer salutation table row -->
        <tr style="outline:none;margin:0;padding:0px;border:none;">
        	<td style="outline:none;margin:0;padding:10px 30px 0 30px;border:none;text-align:center;font-family:Tahoma, Geneva, sans-serif;font-size:18px;color:#46c474;line-height:50px;">
            	Hi <strong> <?php echo $name?>!</strong>
            </td>
        </tr>
        <!--mailer salutation table row -->
        <!--mailer message table row -->
        <tr style="outline:none;margin:0;padding:0px;border:none;">
        	<td style="outline:none;margin:0;padding:10px 30px 20px 30px;border:none;text-align:left;font-family:Tahoma, Geneva, sans-serif;font-size:14px;color:#333333;line-height:25px;">
            	Greetings from Checkout! 
            	<br />Congratulations! Your order has been received successfully. 
            	
            </td>
        </tr>
        <!--mailer message table row -->
       
        <!--mailer table row -->
        <tr style="outline:none;margin:0;padding:0px;border:none;">
        	<td style="outline:none;margin:0;padding:0px 30px;border:none;text-align:center;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="outline:none;margin:0;padding:0px;box-shadow:0px 25px 24px -24px #ccc;-webkit-box-shadow:0px 25px 24px -24px #ccc;-moz-box-shadow:0px 25px 24px -24px #ccc;">
                	<tr style="outline:none;margin:0;padding:0px;border:none;">
                        <td style="outline:none;margin:0;padding:20px 0px;border:none;text-align:center;">
                        	<div style="outline:none;margin:0;padding:0px;border:none;font-family:Tahoma, Geneva, sans-serif;font-size:14px;color:#666666;line-height:20px;">Thanks,</div>
                <div style="outline:none;margin:0;padding:0px;border:none;font-family:Tahoma, Geneva, sans-serif;font-size:14px;color:#333333;line-height:20px;"><strong>Checkout </strong> Team</div>
                        </td>
                    </tr>
                </table>
            </td>
       	</tr>
      
    </table>

</body>
</html>
