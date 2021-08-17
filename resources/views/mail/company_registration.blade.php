<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Survey App</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0; background: #cccccc; font-family: arial; ">
    <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
        <tr>
            <td style="padding: 10px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
					
					<tr>
                        <td align="center" bgcolor="#efefef" style="padding: 15px 0 15px 0; color: #153643; font-size: 12px;">
                        	Does this email not look right? Try 
						<a href='{{ url("/") }}/company/verify/?token={{$token}}' style="text-decoration: underline; color:#0b5578 ">View in browser</a>
                          
                        </td>
                    </tr>
                    <tr>
                        <td align="center" bgcolor="#fff" style="padding: 30px 0 20px 0; color: #153643; font-size: 28px; font-weight: bold;  ">
                        	
                            
                             {{-- <img src="{{ $message->embed('theme/assets/images/cybexo_logo.png')}}"> --}}

                          
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#fff" style="padding: 0px 25px 0px 25px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
								
							 
								
								<tr>
                                    <td style="padding: 0px 0 10px 0; font-weight: bold; color:#153643;">
                                        Hi, {{$name}}

                                    </td>
                                </tr>
                                 
                                <tr>
                                    <td style="padding: 0px 0 10px 0; color: #153643;   font-size: 14px; line-height: 20px;">
                                        Thank you for signup as Company in Survay App.
                                         Click the URL below to activate your account and set  password.
                                         
                                         If the above URL does not work try copying and pasting it into your browser. If you still  have problem. Please feel free to contact us.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        
                                        <tr style="  box-sizing: border-box; font-size: 14px; margin: 0;">
                                <td class="content-block" itemprop="handler" itemscope
                                itemtype="http://schema.org/HttpActionHandler"
                                style="  box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 10 30px;"
                                valign="top"> 
                                    
                                     <a href='{{ url("/") }}/company/verify/?token={{$token}}'>{{ url("/") }}/company/verify/?token={{$token}}</a> 

                       

                        
                        
                                </td>
                        </tr>    
                                    </td>

 


 
                                </tr>
                                <tr>
                                    <td style="padding: 0px 0 10px 0; color: #153643;   font-size: 14px; line-height: 20px;">
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0px 0 10px 0; color: #153643;   font-size: 14px; line-height: 20px;">
                                        Regards,<br>
                                        cybexo
                                    </td>
                                </tr>
								
								 
								
								<tr>
                                    <td style="padding: 50px 0 50px 0; color: #153643;   font-size: 14px; line-height: 20px;">
                                        If you need help visit the <a href="{{ env('APP_URL') }}" style="color: #3297cf;">Help</a> page or <a style="color: #3297cf;" href="{{ env('APP_URL') }}">contact us.</a>

                                    </td>
                                </tr>
								
								 
                            </table>
                        </td>
                    </tr>
                    <tr>

                        <td bgcolor="#0b5578" style="padding: 30px 30px 30px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #ffffff;   font-size: 12px; margin-left: 17px; " width="50%">
                                          Copyright © <?php echo date("Y"); ?> {{ config('app.name') }}. All rights reserved.<br/>
                                    </td>
                                    <td align="right" width="25%">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="font-family: Arial, sans-serif; font-size: 12px;  ">
                                				<a href="https://twitter.com/cybexo"><i class="fab fa-twitter-square"></i></a>
                                                   
                                                </td>
                                                <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                                <td style="  font-size: 10px;  ">
                                                    <a href="https://www.facebook.com/Cybexo/"><i class="fab fa-facebook"></i></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>