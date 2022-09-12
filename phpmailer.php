<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require phpmailer/vendor/autoload.php;
function sendmail($tomail, $totmailname , $subject, $message)
{
	$loginid 	= "universo@projectmailer.xyz";
	$password 	= "L68ICs3uFZLr";
	$smtpserver = "ded723.hostwindsdns.com";
	$smtpport 	= 25;
	$mailsender = $_SESSION[project_title];
	$companyname= $_SESSION[project_title];
	$facebook = "https://www.facebook.com/CollegeSocialNetwork";
	$twitter = "https://www.twitter.com/CollegeSocialNetwork";
	$youtube = "https://www.youtube.com/CollegeSocialNetwork";
	$linkedin = "https://www.linkedin.com/CollegeSocialNetwork";
	$companyaddress  = $_SESSION[project_title] . ", 9-57, Wadi-e-Hadees, Hyderabad-500005, India | Email us: CollegeSocialNetwork@gmail.com";
	$contactno = "+91-9550313048";
	$url = "www.CollegeSocialNetwork.in";
	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	// Load Composers autoloader

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try
	{
		//Server settings
		$mail->SMTPDebug = true; // SMTP::DEBUG_SERVER; // Enable verbose debug output
		$mail->isSMTP();          // Send using SMTP
		$mail->Host       = $smtpserver; // Set the SMTP server to send through
		$mail->SMTPAuth   = true;  // Enable SMTP authentication
		$mail->Username   = $loginid; // SMTP username
		$mail->Password   = $password;  // SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		$mail->Port       = $smtpport;
		// TCP port to connect to

		//Recipients
		$mail->setFrom($loginid, $mailsender);
		$mail->addAddress($tomail, $totmailname);     // Add a recipient
		$mail->addAddress($tomail);               // Name is optional
		$mail->addReplyTo($tomail, $totmailname);
		//$mail->addCC(cc@example.com);
		//$mail->addBCC(bcc@example.com);

		// Attachments
		// $mail->addAttachment(/var/tmp/file.tar.gz);         // Add attachments
		// $mail->addAttachment(/tmp/image.jpg, new.jpg);    // Optional name

		// Content
		$mail->isHTML(true);        // Set email format to HTML
		$mail->Subject = $subject;
	$mailmessage = "<body link=#00a5b5 vlink=#00a5b5 alink=#00a5b5><table class= main contenttable align=center style=font-weight: normal;border-collapse: collapse;border: 0;margin-left: auto;margin-right: auto;padding: 0;font-family: Arial, sans-serif;color: #555559;background-color: white;font-size: 16px;line-height: 26px;width: 600px;>		<tr>			<td class=border style=border-collapse: collapse;border: 1px solid #eeeff0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;>				<table style=font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;>					<tr>						<td colspan=4 valign=top class=image-section style=border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background-color: #fff;border-bottom: 4px solid #00a5b5>
	<center><a href=$url style=text-decoration: none;><H2>" . $companyname ."</H2></a></center>
	</td>					</tr>					<tr><td valign=top class=side title style=border-collapse: collapse;border: 0;margin: 0;padding: 20px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;vertical-align: top;background-color: white;border-top: none;><table style=font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;><tr><td class=head-title style=border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 28px;line-height: 34px;font-weight: bold; text-align: center;><div class=mktEditable id=main_title>$subject</div></td></tr><tr><td class=top-padding style=border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;></td></tr>";
	$mailmessage = $mailmessage . "<tr><td class=top-padding style=border-collapse: collapse;border: 0;margin: 0;padding: 15px 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 21px;><hr size=1 color=#eeeff0></td></tr><tr><td class=text style=border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;><div class=mktEditable id=main_text>". $message ."</div></td></tr></table>				</td>					</tr>					<tr>						<td style=padding:20px; font-family: Arial, sans-serif; -webkit-text-size-adjust: none; align=center>							<table>								<tr>									<td align=center style=font-family: Arial, sans-serif; -webkit-text-size-adjust: none; font-size: 16px;>										<a style=color: #00a5b5; href={{system.forwardToFriendLink}}>Note:</a>										<br/><span style=font-size:10px; font-family: Arial, sans-serif; -webkit-text-size-adjust: none; >This email has been sent to you, because you are a customer of ". $companyname ." </span>									</td>								</tr>							</table>						</td>					</tr>					<tr>						<td style=border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 24px; padding: 20px;>		</td>					</tr>	<tr>						<td valign=top align=center style=border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;>";
	if($facebook != "" && $twitter != "" && $youtube != "" && $linkedin != "" )
	{
	$mailmessage = $mailmessage . "<table style=font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;>								<tr>									<td align=center valign=middle class=social style=border-collapse: collapse;border: 0;margin: 0;padding: 10px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;text-align: center;>										<table style=font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;>											<tr>															
	<td style=border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;><a href=$facebook><img src=https://info.tenable.com/rs/tenable/images/facebook-teal.png></a></td>						
	<td style=border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;><a href=$twitter><img src=https://info.tenable.com/rs/tenable/images/twitter-teal.png></a></td>	
	<td style=border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;><a href=$youtube><img src=https://info.tenable.com/rs/tenable/images/youtube-teal.png></a></td>									<td style=border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;><a href=$linkedin><img src=https://info.tenable.com/rs/tenable/images/linkedin-teal.png></a></td>
	</tr>										</table>									</td>								</tr>							</table>";
	}
	$mailmessage = $mailmessage . "</td>					</tr>					<tr bgcolor=#fff style=border-top: 4px solid #00a5b5;>						<td valign=top class=footer style=border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background: #fff;text-align: center;>							<table style=font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;>								<tr>									<td class=inside-footer align=center valign=middle style=border-collapse: collapse;border: 0;margin: 0;padding: 20px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 12px;line-height: 16px;vertical-align: middle;text-align: center;width: 580px;><div id=address class=mktEditable><b>$companyname</b><br>$companyaddress<br>  
	$contactno<br><br>                      
	</div>									</td>								</tr>							</table>						</td>					</tr>				</table>			</td>		</tr>	</table>  </body>";		
		$mail->Body    = $mailmessage; //$message;
		$mail->AltBody = Mail Receieved;

		$mail->send();
			//echo Message has been sent;
	}
	catch (Exception $e) 
	{
		echo "Message could not be sent. Mailer Error: {
			$mail->ErrorInfo}";
	}
}
//sendmail("studentprojects.live@gmail.com", "Shiva prasad" , "My subject title", "My message");
?>