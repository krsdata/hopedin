<?php
die;
$id = "ACdd39cc38ae824a297d821b88ce003f21";
$token = "5978262f75216da1f9947e93720b408f";
$url = "https://api.twilio.com/2010-04-01/Accounts/$id/Messages.json";
$from = "+19473334441";
$to = "+918959728411"; // twilio trial verified number
$body = "using twilio rest api from Fedrick";
$data = array (
    'From' => $from,
    'To' => $to,
    'Body' => $body,
);
$post = http_build_query($data);
$x = curl_init($url );
curl_setopt($x, CURLOPT_POST, true);
curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
curl_setopt($x, CURLOPT_POSTFIELDS, $post);
$y = curl_exec($x);
curl_close($x);
var_dump($y);
die;
require 'phpmailer/PHPMailerAutoload.php';
$mail=new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 4;
$mail->Host = 'smtp.zoho.com';
$mail->Port = 587;
$mail->SMTPAuth = true; 
$mail->SMTPSecure = 'tls';
$mail->Username = 'otp@hopedin.com'; // GMAIL username
$mail->Password = 'India@123123123'; // GMAIL password
$mail->SetFrom("otp@hopedin.com", "Govinda");
$mail->AddAddress('infodeveloper10@gmail.com');
$mail->isHTML(true);
$mail->Subject = "My Subject";
$mail->Body = "My mail come";
try{
    $mail->Send();
    echo "Success!";
} catch(Exception $e){
    //Something went bad
    echo "Fail - " . $mail->ErrorInfo;
}
die;

$to = "govindasajnani1508@gmail.com";
				$from = "govindasajnani1508@gmail.com";
				$headers ="From: $from\n";
				$headers .= "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
				$subject ="ASP Reset Code!";
				$msg = 'bghhggh';
		if(mail($to,$subject,$msg,$headers))
		{
			echo "yes";
		}
		else { echo "not"; }
die;
error_reporting(1);
$params = array(
  'api_key'=>'944a4c9d',
  'api_secret'=>'GVW8g4dvgpqvrY0u',
  'to'=>'9179817828',
  'from'=>'NEXMO',
  'text'=>'Hello from Nexmo'
  
);
echo $postData = http_build_query($params);
$ch = curl_init();
curl_setopt_array($ch, array(    CURLOPT_URL => 'https://rest.nexmo.com/sms/json',    CURLOPT_RETURNTRANSFER => true,    CURLOPT_POST => true,    CURLOPT_POSTFIELDS => $postData));
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$output = curl_exec($ch);
if(curl_errno($ch)){    
echo 'error:' . curl_error($ch);
}
print_r($output);
curl_close($ch);
?>
