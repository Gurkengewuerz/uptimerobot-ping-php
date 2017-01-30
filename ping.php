<?php
// List from https://uptimerobot.com/inc/files/ips/IPv4.txt
$wildcard = array(
	"69.162.124.226",
	"69.162.124.227",
	"69.162.124.228",
	"69.162.124.229",
	"69.162.124.230",
	"69.162.124.231",
	"69.162.124.232",
	"69.162.124.233",
	"69.162.124.234",
	"69.162.124.235",
	"69.162.124.236",
	"69.162.124.237",
	"69.162.124.238",
	"63.143.42.242",
	"63.143.42.243",
	"63.143.42.244",
	"63.143.42.245",
	"63.143.42.246",
	"63.143.42.247",
	"63.143.42.248",
	"63.143.42.249",
	"63.143.42.250",
	"63.143.42.251",
	"63.143.42.252",
	"46.137.190.132",
	"122.248.234.23",
	"188.226.183.141",
	"178.62.52.237",
	"54.79.28.129",
	"54.94.142.218",
	"104.131.107.63",
	"54.67.10.127",
	"54.64.67.106",
	"159.203.30.41",
	"46.101.250.135"
);

function ping($host, $port, $timeout) { 
  $tB = microtime(true); 
  $fP = fSockOpen($host, $port, $errno, $errstr, $timeout); 
  if (!$fP) { return "down"; } 
  $tA = microtime(true); 
  return round((($tA - $tB) * 1000), 0)." ms"; 
}

function inNetwork($givenIP, $networkIP, $netmask)
{
    return ((ip2long($givenIP) & ip2long($networkIP)) == ip2long($network));
}

if (!in_array($_SERVER['REMOTE_ADDR'], $wildcard)){
	exit("Not a valid Remote " . $_SERVER['REMOTE_ADDR'] . "!");
}

$address = $_GET["address"];
if (!isset($_GET["address"]) || empty($_GET["address"])){
	exit("Address not set!");
}

$timeout = 2;
if (isset($_GET["timeout"]) && !empty($_GET["timeout"])){
	$timeout = $_GET["timeout"];
}

$port = 80;
if (isset($_GET["port"]) && !empty($_GET["port"])){
	$port = $_GET["port"];
}


$inRange = inNetwork($address, "192.168.1.0", "255.255.255.0"); // Set Subnet which is accessable
if ($inRange) {
	exit("Not a local Address!!!!");
}

echo ping($address, $port, $timeout);