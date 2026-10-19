<?php	
			$to='amarmitta@gmail.com';
			
				$subject='Request Form for Balappa Kona';
 			
				
				$message ="<html><body><table align='center' boarder='1' cellpadding='5' cellspacing='2'  style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;font-weight:bold;background-color:#CCCCFF;color:#000000;;border:double'>";
				
				 $message .= "<tr><td align='left'><b> Name  </b></td><td>:</td><td>".$_POST['name']."</td></tr>";
				 
				 $message .= "<tr><td align='left'><b>Email </b></td><td>:</td><td>".$_POST['email']."</td></tr>";
				 
				 $message .= "<tr><td align='left'><b>Phone  </b></td><td>:</td><td>".$_POST['phone']."</td></tr>";
				 
				 $message .= "<tr><td align='left'><b>Address </b></td><td>:</td><td>".$_POST['address']."</td></tr>";
				 
				 $message .= "<tr><td align='left'><b>Comments </b></td><td>:</td><td>".$_POST['comments']."</td></tr>";
				 
				
				
				$message .="</table></body></html>";
				
				
 				/*to avoid spam mails in contact form*/
				// Select if you want to check form for standard spam text
  				$SpamCheck = "Y"; // Y or N
  				$SpamReplaceText = "*content removed*";
				// Error message prited if spam form attack found
				$SpamErrorMessage = "<p align=\"center\"><font color=\"red\">Malicious code content detected.
									</font><br><b>Your IP Number of <b>".getenv("REMOTE_ADDR")."</b> has been logged.</b></p>";
				$name = $_POST['name']; 
  				$email = $_POST['email']; 
  				$msg = $_POST['comments'];
			if ($SpamCheck == "Y") {		   
				// Check for Website URL's in the form input boxes as if we block website URLs from the form,
				// then this will stop the spammers wastignt ime sending emails
				if (preg_match("/http/i", "$name")) {echo "$SpamErrorMessage"; exit();} 
				if (preg_match("/http/i", "$email")) {echo "$SpamErrorMessage"; exit();} 
				if (preg_match("/http/i", "$msg")) {echo "$SpamErrorMessage"; exit();} 

				// Patterm match search to strip out the invalid charcaters, this prevents the mail injection spammer 
				$pattern = '/(;|\||`|>|<|&|^|"|'."\n|\r|'".'|{|}|[|]|\)|\()/i'; // build the pattern match string 
	                            
  				$name = preg_replace($pattern, "", $name); 
			  	$email = preg_replace($pattern, "", $email); 
  				$msg = preg_replace($pattern, "", $msg); 

				// Check for the injected headers from the spammer attempt 
				// This will replace the injection attempt text with the string you have set in the above config section
	  			$find = array("/bcc\:/i","/Content\-Type\:/i","/cc\:/i","/to\:/i"); 
  				$email = preg_replace($find, "$SpamReplaceText", $email); 
  				$name = preg_replace($find, "$SpamReplaceText", $name); 
  				$msg = preg_replace($find, "$SpamReplaceText", $msg); 
  
				// Check to see if the fields contain any content we want to ban
 				if(stristr($name, $SpamReplaceText) !== FALSE) {echo "$SpamErrorMessage"; exit();} 
 				if(stristr($msg, $SpamReplaceText) !== FALSE) {echo "$SpamErrorMessage"; exit();} 
 
 				// Do a check on the send email and subject text
				 if(stristr($to, $SpamReplaceText) !== FALSE) {echo "$SpamErrorMessage"; exit();} 
				 if(stristr($subject, $SpamReplaceText) !== FALSE) {echo "$SpamErrorMessage"; exit();} 
			}
				/*End*/
 	
                 $headers = "From: $_POST[email]"."\r\n";

                  $headers .= 'Bcc: ravik@briofactors.com'."\r\n";

                    $headers .='Content-type: text/html; charset=iso-8859-1; format=flowed\n';

                    $headers .="MIME-Version: 1.0\n";

                    $headers .="Content-Transfer-Encoding: 8bit\n";

                    $headers .="X-Mailer: PHP\n";			

if(mail($to, $subject, $message, $headers))
{
	header("location:thanks.html");
}
?>