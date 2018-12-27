    <?php
	$code=rand(999,10000);
$authKey = "8209AfCU24hbd5b057d03";
$mobileNumber = '9179817828';
//$mobileNumber=ltrim($mobileNumber,"+");
$senderId = "Hopedin";
$message = urlencode("Hopedin Verification Code - ".$code);
$route =4;
$postData = array(    'authkey' => $authKey,    'mobiles' => $mobileNumber,    'message' => $message,    'sender' => $senderId,    'route' => $route,'country'=>91);
$url="http://bulksmsc.com/api/sendhttp.php";
$ch = curl_init();
curl_setopt_array($ch, array(    CURLOPT_URL => $url,    CURLOPT_RETURNTRANSFER => true,    CURLOPT_POST => true,    CURLOPT_POSTFIELDS => $postData));
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$output = curl_exec($ch);
if(curl_errno($ch)){    
echo 'error:' . curl_error($ch);
}
curl_close($ch);
print_r($output);
	die;
        $src = '<?xml version="1.0" encoding="UTF-8"?>
        <SMS>
            <operations>
            <operation>SEND</operation>
            </operations>
            <authentification>
            <username>eaglestar6115@gmail.com</username>
            <password>Eagle@112233</password>
            </authentification>
            <message>
            <sender>Hoedin</sender>
            <text>Test message [UTF-8]</text>
            </message>
            <numbers>
            <number messageID="msg11">919179817828</number>
            </numbers>
        </SMS>';
     
        $Curl = curl_init();
        $CurlOptions = array(
            CURLOPT_URL=>'http://api.atompark.com/members/sms/xml.php',
            CURLOPT_FOLLOWLOCATION=>false,
            CURLOPT_POST=>true,
            CURLOPT_HEADER=>false,
            CURLOPT_RETURNTRANSFER=>true,
            CURLOPT_CONNECTTIMEOUT=>15,
            CURLOPT_TIMEOUT=>100,
            CURLOPT_POSTFIELDS=>array('XML'=>$src),
        );
        curl_setopt_array($Curl, $CurlOptions);
        if(false === ($Result = curl_exec($Curl))) {
            throw new Exception('Http request failed');
        }
     
        curl_close($Curl);
     
        echo $Result;

die;
//Your authentication key
$authKey = "1220Alj1Sz0Zfkf567e98be";

//Multiple mobiles numbers separated by comma
$mobileNumber = "9179817828";

//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "ibitte";

//Your message to send, Add URL encoding here.
$message = urlencode("Test message");

//Define route 
$route = "default";
//Prepare you post parameters
$postData = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message,
    'sender' => $senderId,
    'route' => $route
);

//API URL
$url="http://bulksmsc.com/api/sendhttp.php";

// init the resource
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));


//Ignore SSL certificate verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


//get response
$output = curl_exec($ch);

//Print error if any
if(curl_errno($ch))
{
    echo 'error:' . curl_error($ch);
}

curl_close($ch);

echo $output;
?>

