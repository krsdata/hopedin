<?php
//date_default_timezone_set('Asia/Kolkata');
define("DBHOST","localhost");
define("DBUSER","root");
define("DBPASS","Hope@123!");
define("DBNAME",'hopedin_site');
define("Semail",'otp@hopedin.com');
define("Spassword",'Otp@india123123');
define("Shost",'smtp.zoho.com');
class functions
{
	function __construct() {
        session_start();
        $this->conn=mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME) or die('not connected');
    }
    function query($sql)
    {
    	$run=mysqli_query($this->conn,$sql);
    	return $run;
    }
	function lastid()
	{
		$id=mysqli_insert_id($this->conn);
		return $id;
	}
    function checkemail($email)
    {
    	$email=trim($email);
    	$sel="select * from registration where email='$email'";
    	$run=$this->query($sel);
    	return $run;
    }
	function checkmobile($mobile)
    {
    	$mobile=trim($mobile);
    	$sel="select * from registration where mobile='$mobile'";
    	$run=$this->query($sel);
    	return $run;
    }
    function insert_data($table,$post)
    {
    	$sql="insert into $table set ";
    	foreach($post as $key=>$value)
    	{
    		$sql.=" `$key`='".htmlentities($value,ENT_QUOTES)."',";
    	}
    	$sql=rtrim($sql,",");
    	$run=$this->query($sql);
    	return $run;
    }
	function create_query($post)
    {
    	foreach($post as $key=>$value)
    	{
    		$sql.=" $key='".$value."',";
    	}
    	$sql=rtrim($sql,",");
    	return $sql;
    }
    function get_user()
    {
    	$sel="select * from registration where id='".$_SESSION['session_user_set']."'";
    	$run=$this->query($sel);
    	return $run;
    }
	function get_user_byId($id)
    {
    	$sel="select * from registration where id='$id'";
    	$run=$this->query($sel);
    	return $run;
    }
	function checkpin($pin,$email)
    {
    	$pin=trim($pin);
    	$sel="select * from registration where afp_pin='$pin' and email='$email'";
    	$run=$this->query($sel);
    	return $run;
    }
	function Check_friends_request($rid)
	{
		$sel="select * from friend_tbl where (requested_by='$rid' and requested_to='".$_SESSION['session_user_set']."') or (requested_to='$rid' and requested_by='".$_SESSION['session_user_set']."')";
    	$run=$this->query($sel);
    	return $run;
	}
	function Get_my_requests()
	{
		$sel="select friend_tbl.*,registration.fname,registration.lname,registration.profile from friend_tbl inner join registration on registration.id=CASE WHEN friend_tbl.requested_to='".$_SESSION['session_user_set']."' THEN friend_tbl.requested_by ELSE friend_tbl.requested_to END where friend_tbl.requested_to='".$_SESSION['session_user_set']."' and friend_tbl.status=0";
    	$run=$this->query($sel);
    	return $run;
	}
	
	function Get_my_friend_chat() 
	{
		
		$sel="select registration.id,registration.fname,registration.lname,registration.profile,registration.country,registration.gender,registration.age,chat_msg.chat_id ,chat_msg.cdate from (select * from chat_msg where '".$_SESSION['session_user_set']."' IN (sender,receiver) order by chat_id DESC LIMIT 0,1000) as chat_msg inner join registration on registration.id=CASE WHEN chat_msg.sender='".$_SESSION['session_user_set']."' THEN chat_msg.receiver ELSE chat_msg.sender END where '".$_SESSION['session_user_set']."' IN (chat_msg.sender,chat_msg.receiver) and chat_msg.groups='0' GROUP by registration.id order by chat_msg.chat_id DESC";
    	$run=$this->query($sel);
    	return $run;
	}
	function Get_my_friend_groups()
	{
		$sel="select chat_msg.* from (SELECT * FROM chat_msg where FIND_IN_SET(".$_SESSION['session_user_set'].", receiver) and groups!='0' ORDER BY chat_id DESC) as chat_msg where FIND_IN_SET(".$_SESSION['session_user_set'].", chat_msg.receiver) and  groups!='0' Group By chat_msg.group_id";
    	$run=$this->query($sel);
    	return $run;
	}
	function Get_my_friend_chat_groups($id)
	{
		$sel="select chat_msg.* from chat_msg where FIND_IN_SET(".$_SESSION['session_user_set'].", chat_msg.receiver) and  groups='1' and group_id='$id' ";
    	$run=$this->query($sel);
    	return $run;
	}
	
	function Get_my_friends() 
	{
		$sel="select registration.id,registration.fname,registration.lname,registration.profile,registration.country,registration.gender,registration.age from friend_tbl inner join registration on registration.id=CASE WHEN friend_tbl.requested_to='".$_SESSION['session_user_set']."' THEN friend_tbl.requested_by ELSE friend_tbl.requested_to END  where (friend_tbl.requested_to='".$_SESSION['session_user_set']."' or friend_tbl.requested_by='".$_SESSION['session_user_set']."') and friend_tbl.status=1  order by registration.fname ASC ";
		//$sel="select registration.id,registration.fname,registration.lname,registration.profile from friend_tbl inner join registration on registration.id=CASE WHEN friend_tbl.requested_to='".$_SESSION['session_user_set']."' THEN friend_tbl.requested_by ELSE friend_tbl.requested_to END where (friend_tbl.requested_to='".$_SESSION['session_user_set']."' or friend_tbl.requested_by='".$_SESSION['session_user_set']."') and friend_tbl.status=1";
    	$run=$this->query($sel);
    	return $run;
	}
	function get_user_chat($rid)
	{
		$sel="select chat_msg.*,registration.id,registration.fname,registration.lname,registration.profile from chat_msg inner join registration on registration.id=chat_msg.sender where ((chat_msg.sender='$rid' and chat_msg.receiver='".$_SESSION['session_user_set']."') or (chat_msg.receiver='$rid' and chat_msg.sender='".$_SESSION['session_user_set']."')) and chat_msg.groups='0' order by chat_msg.chat_id";
    	$run=$this->query($sel);
    	return $run;
	}
	function get_user_Group_chat($rid)
	{
		$sel="select chat_msg.*,registration.id,registration.fname,registration.lname,registration.profile from chat_msg inner join registration on registration.id=chat_msg.sender where chat_msg.group_id='$rid' and chat_msg.groups='2' order by chat_msg.chat_id";
    	$run=$this->query($sel);
    	return $run;
	}
	function Get_Mygroup_member($info)
	{
		$sel="select * from registration where id IN($info)";
    	$run=$this->query($sel);
    	return $run;
	}
	function Get_Mygroup_member_not($info)
	{
		$sel="select registration.id,registration.fname,registration.lname,registration.profile,registration.country,registration.gender,registration.age from friend_tbl inner join registration on registration.id=CASE WHEN friend_tbl.requested_to='".$_SESSION['session_user_set']."' THEN friend_tbl.requested_by ELSE friend_tbl.requested_to END  where (friend_tbl.requested_to='".$_SESSION['session_user_set']."' or friend_tbl.requested_by='".$_SESSION['session_user_set']."') and friend_tbl.status=1 and registration.id NOT IN($info) order by registration.fname ASC ";
    	$run=$this->query($sel);
    	return $run;
	}
	function humanTiming ($time)
	{
							//echo time();
							$time = strtotime(date('Y-m-d H:i:s')) - $time; // to get the time since that moment
							$time = ($time<1)? 1 : $time;
							$tokens = array (
								31536000 => 'year',
								2592000 => 'month',
								604800 => 'week',
								86400 => 'day',
								3600 => 'hour',
								60 => 'min',
								1 => 'sec'
							);

							foreach ($tokens as $unit => $text) {
								if ($time < $unit) continue;
								$numberOfUnits = floor($time / $unit);
								return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
							}

	}
	function set_zone()
	{
		$timezones = array(
		'Pacific/Midway'       => "(GMT-11:00) Midway Island",
		'US/Samoa'             => "(GMT-11:00) Samoa",
		'US/Hawaii'            => "(GMT-10:00) Hawaii",
		'US/Alaska'            => "(GMT-09:00) Alaska",
		'US/Pacific'           => "(GMT-08:00) Pacific Time (US &amp; Canada)",
		'America/Tijuana'      => "(GMT-08:00) Tijuana",
		'US/Arizona'           => "(GMT-07:00) Arizona",
		'US/Mountain'          => "(GMT-07:00) Mountain Time (US &amp; Canada)",
		'America/Chihuahua'    => "(GMT-07:00) Chihuahua",
		'America/Mazatlan'     => "(GMT-07:00) Mazatlan",
		'America/Mexico_City'  => "(GMT-06:00) Mexico City",
		'America/Monterrey'    => "(GMT-06:00) Monterrey",
		'Canada/Saskatchewan'  => "(GMT-06:00) Saskatchewan",
		'US/Central'           => "(GMT-06:00) Central Time (US &amp; Canada)",
		'US/Eastern'           => "(GMT-05:00) Eastern Time (US &amp; Canada)",
		'US/East-Indiana'      => "(GMT-05:00) Indiana (East)",
		'America/Bogota'       => "(GMT-05:00) Bogota",
		'America/Lima'         => "(GMT-05:00) Lima",
		'America/Caracas'      => "(GMT-04:30) Caracas",
		'Canada/Atlantic'      => "(GMT-04:00) Atlantic Time (Canada)",
		'America/La_Paz'       => "(GMT-04:00) La Paz",
		'America/Santiago'     => "(GMT-04:00) Santiago",
		'Canada/Newfoundland'  => "(GMT-03:30) Newfoundland",
		'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
		'Greenland'            => "(GMT-03:00) Greenland",
		'Atlantic/Stanley'     => "(GMT-02:00) Stanley",
		'Atlantic/Azores'      => "(GMT-01:00) Azores",
		'Atlantic/Cape_Verde'  => "(GMT-01:00) Cape Verde Is.",
		'Africa/Casablanca'    => "(GMT) Casablanca",
		'Europe/Dublin'        => "(GMT) Dublin",
		'Europe/Lisbon'        => "(GMT) Lisbon",
		'Europe/London'        => "(GMT) London",
		'Africa/Monrovia'      => "(GMT) Monrovia",
		'Europe/Amsterdam'     => "(GMT+01:00) Amsterdam",
		'Europe/Belgrade'      => "(GMT+01:00) Belgrade",
		'Europe/Berlin'        => "(GMT+01:00) Berlin",
		'Europe/Bratislava'    => "(GMT+01:00) Bratislava",
		'Europe/Brussels'      => "(GMT+01:00) Brussels",
		'Europe/Budapest'      => "(GMT+01:00) Budapest",
		'Europe/Copenhagen'    => "(GMT+01:00) Copenhagen",
		'Europe/Ljubljana'     => "(GMT+01:00) Ljubljana",
		'Europe/Madrid'        => "(GMT+01:00) Madrid",
		'Europe/Paris'         => "(GMT+01:00) Paris",
		'Europe/Prague'        => "(GMT+01:00) Prague",
		'Europe/Rome'          => "(GMT+01:00) Rome",
		'Europe/Sarajevo'      => "(GMT+01:00) Sarajevo",
		'Europe/Skopje'        => "(GMT+01:00) Skopje",
		'Europe/Stockholm'     => "(GMT+01:00) Stockholm",
		'Europe/Vienna'        => "(GMT+01:00) Vienna",
		'Europe/Warsaw'        => "(GMT+01:00) Warsaw",
		'Europe/Zagreb'        => "(GMT+01:00) Zagreb",
		'Europe/Athens'        => "(GMT+02:00) Athens",
		'Europe/Bucharest'     => "(GMT+02:00) Bucharest",
		'Africa/Cairo'         => "(GMT+02:00) Cairo",
		'Africa/Harare'        => "(GMT+02:00) Harare",
		'Europe/Helsinki'      => "(GMT+02:00) Helsinki",
		'Europe/Istanbul'      => "(GMT+02:00) Istanbul",
		'Asia/Jerusalem'       => "(GMT+02:00) Jerusalem",
		'Europe/Kiev'          => "(GMT+02:00) Kyiv",
		'Europe/Minsk'         => "(GMT+02:00) Minsk",
		'Europe/Riga'          => "(GMT+02:00) Riga",
		'Europe/Sofia'         => "(GMT+02:00) Sofia",
		'Europe/Tallinn'       => "(GMT+02:00) Tallinn",
		'Europe/Vilnius'       => "(GMT+02:00) Vilnius",
		'Asia/Baghdad'         => "(GMT+03:00) Baghdad",
		'Asia/Kuwait'          => "(GMT+03:00) Kuwait",
		'Africa/Nairobi'       => "(GMT+03:00) Nairobi",
		'Asia/Riyadh'          => "(GMT+03:00) Riyadh",
		'Europe/Moscow'        => "(GMT+03:00) Moscow",
		'Asia/Tehran'          => "(GMT+03:30) Tehran",
		'Asia/Baku'            => "(GMT+04:00) Baku",
		'Europe/Volgograd'     => "(GMT+04:00) Volgograd",
		'Asia/Muscat'          => "(GMT+04:00) Muscat",
		'Asia/Tbilisi'         => "(GMT+04:00) Tbilisi",
		'Asia/Yerevan'         => "(GMT+04:00) Yerevan",
		'Asia/Kabul'           => "(GMT+04:30) Kabul",
		'Asia/Karachi'         => "(GMT+05:00) Karachi",
		'Asia/Tashkent'        => "(GMT+05:00) Tashkent",
		'Asia/Kolkata'         => "(GMT+05:30) Kolkata",
		'Asia/Kathmandu'       => "(GMT+05:45) Kathmandu",
		'Asia/Yekaterinburg'   => "(GMT+06:00) Ekaterinburg",
		'Asia/Almaty'          => "(GMT+06:00) Almaty",
		'Asia/Dhaka'           => "(GMT+06:00) Dhaka",
		'Asia/Novosibirsk'     => "(GMT+07:00) Novosibirsk",
		'Asia/Bangkok'         => "(GMT+07:00) Bangkok",
		'Asia/Jakarta'         => "(GMT+07:00) Jakarta",
		'Asia/Krasnoyarsk'     => "(GMT+08:00) Krasnoyarsk",
		'Asia/Chongqing'       => "(GMT+08:00) Chongqing",
		'Asia/Hong_Kong'       => "(GMT+08:00) Hong Kong",
		'Asia/Kuala_Lumpur'    => "(GMT+08:00) Kuala Lumpur",
		'Australia/Perth'      => "(GMT+08:00) Perth",
		'Asia/Singapore'       => "(GMT+08:00) Singapore",
		'Asia/Taipei'          => "(GMT+08:00) Taipei",
		'Asia/Ulaanbaatar'     => "(GMT+08:00) Ulaan Bataar",
		'Asia/Urumqi'          => "(GMT+08:00) Urumqi",
		'Asia/Irkutsk'         => "(GMT+09:00) Irkutsk",
		'Asia/Seoul'           => "(GMT+09:00) Seoul",
		'Asia/Tokyo'           => "(GMT+09:00) Tokyo",
		'Australia/Adelaide'   => "(GMT+09:30) Adelaide",
		'Australia/Darwin'     => "(GMT+09:30) Darwin",
		'Asia/Yakutsk'         => "(GMT+10:00) Yakutsk",
		'Australia/Brisbane'   => "(GMT+10:00) Brisbane",
		'Australia/Canberra'   => "(GMT+10:00) Canberra",
		'Pacific/Guam'         => "(GMT+10:00) Guam",
		'Australia/Hobart'     => "(GMT+10:00) Hobart",
		'Australia/Melbourne'  => "(GMT+10:00) Melbourne",
		'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
		'Australia/Sydney'     => "(GMT+10:00) Sydney",
		'Asia/Vladivostok'     => "(GMT+11:00) Vladivostok",
		'Asia/Magadan'         => "(GMT+12:00) Magadan",
		'Pacific/Auckland'     => "(GMT+12:00) Auckland",
		'Pacific/Fiji'         => "(GMT+12:00) Fiji"
		);
		$clientsIpAddress = $_SERVER['REMOTE_ADDR'];
		$zone=file_get_contents('https://ipapi.co/'.$clientsIpAddress.'/timezone/');
		echo "df"; print_r($zone);
		if($zone)
		{
			 if($timezones[$zone]) 
			 {
				 $zone_time=trim(explode(" ",$timezones[$zone])[0],"(");
				 $zone_time=trim($zone_time,")");
				 $zone_time=explode("GMT",$zone_time);
				 $zone_time= $zone_time[1];
				 if(isset($_SESSION['session_user_set']))
				 {
					 $this->query("update registration set zone='".$zone_time."' where id=".$_SESSION['session_user_set']);
				 } 
			 }
		}    
	}
	function humanTiming1 ($time)           	 
	{
		$zone_time='';
		$data=$this->get_user();
		$row=mysqli_fetch_array($data);
		if($row['zone'])
		{
			$zone_time=$row['zone'];
		}
		
		
	
	if($zone_time)
	{
		 
			 //$zone_time=explode("GMT",$zone_time);
			 if($zone_time)
			 {
				 //$zone_time= $zone_time[1];    
				 $act=substr($zone_time,0,1);
				 $ex_time=substr($zone_time,1).":00";
				 $timeArr = array_reverse(explode(":", $ex_time));
				 $seconds = 0;
				 foreach ($timeArr as $key => $value)
				 {
					if ($key > 2) break;
					$seconds += pow(60, $key) * $value;
				 }
				 if($act=='+')
				 {
					 $time+=$seconds;
				 }
				 else
				 {
					 $time-=$seconds;
				 }
				 
			 }
		 
	}
	
							//echo time();
							$mtime=$time;
							$time = strtotime(date('Y-m-d H:i:s')) - $time; // to get the time since that moment
							$time = ($time<1)? 1 : $time;
							$tokens = array (
								31536000 => 'year',
								2592000 => 'month',
								604800 => 'week',
								86400 => 'day',
								3600 => 'hour',
								60 => 'min',
								1 => 'sec' 
							);      

							foreach ($tokens as $unit => $text) {
								if ($time < $unit) continue;
								$numberOfUnits = floor($time / $unit);
								if($text=='sec' || $text=='min' || $text=='hour')
								{
									return date('H:i',$mtime);
								}
								else     
								{
									return date('Y-m-d H:i',$mtime); 
								}
								return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
							}

}
	function Get_unread_msg($rid)
	{
		$sel="select * from chat_msg where chat_msg.sender='$rid' and chat_msg.receiver='".$_SESSION['session_user_set']."' and status=0";
    	$run=$this->query($sel);
    	return $run;
	}
	
	function Get_unread_msg_all()
	{
		$sel="select * from chat_msg where chat_msg.receiver='".$_SESSION['session_user_set']."' and status=0";
    	$run=$this->query($sel);
    	return $run;
	}
	function Get_my_requestsByid($id)
	{
		$sel="select registration.*,friend_tbl.status from friend_tbl inner join registration on registration.id=CASE WHEN friend_tbl.requested_to='".$_SESSION['session_user_set']."' THEN friend_tbl.requested_by ELSE friend_tbl.requested_to END where friend_tbl.id='".$id."' ";
    	$run=$this->query($sel);
    	return $run;
	}
	function get_notification()
	{
		$sel="select notification.*,registration.id as rid,registration.fname,registration.lname,registration.profile from notification inner join registration on registration.id=notification.user_id where notification.status='0' and notification.other_id='".$_SESSION['session_user_set']."' order by notification.id DESC";
    	$run=$this->query($sel);
    	return $run;
	}
	function check_blocked($to)
	{
		$sel="select * from block_user where block_by='".$_SESSION['session_user_set']."' and block_to='$to'";
    	$run=$this->query($sel);
    	return $run;
	}
	function check_blockedMine()
	{
		$sel="select * from block_user where block_by='".$_SESSION['session_user_set']."'";
    	$run=$this->query($sel);
    	return $run;
	}
	function check_blocked_other($to)
	{
		$sel="select * from block_user where block_by='$to' and block_to='".$_SESSION['session_user_set']."'";
    	$run=$this->query($sel);
    	return $run;
	}
	function send_msg($to,$body)
	{
		$id = "ACdd39cc38ae824a297d821b88ce003f21";
		$token = "5978262f75216da1f9947e93720b408f";
		$url = "https://api.twilio.com/2010-04-01/Accounts/$id/Messages.json";
		$from = "+19473334441";
		$to = "+".$to; // twilio trial verified number
		$body = $body;
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
		//print_r($y);
		curl_close($x);
	}
	function session_school($id)
	{
		$sel="select * from session_tbl where school_id='$id' order by id DESC";
    	$run=$this->query($sel);
    	return $run;
	}
	function Get_sessionByid($id)
	{
		$sel="select * from session_tbl where id='$id' order by id DESC";
    	$run=$this->query($sel);
    	return $run;
	}	
	function Get_countries()
	{
		$sel="select * from countries order by name ASC";
    	$run=$this->query($sel);
    	return $run;
	}
	function get_exam_detail($id)
	{
		$sel="select * from exam_create where id='$id'";
    	$run=$this->query($sel);
    	return $run;
	}
	function Get_all_exams()
	{
		$sel="select * from exam_create order by id DESC";
    	$run=$this->query($sel);
    	return $run;
	}
	function Get_questionsByExam($id)
	{
		$sel="select * from exam_questions where exam_id='$id' order by id ASC";
    	$run=$this->query($sel);
    	return $run;
	}
	
}
?>
