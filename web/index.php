<?php

require_once 'NetIPv4.php';
use Web\App\IAddressIPv4;

$net = new IAddressIPv4('192.168.100.200', 16);
echo "IP je platná: " . ($net->isValidIp() ? "Ano" : "Ne") . "<br>";
echo "Broadcast adresa: " . $net->getBroadcastAddress() . "<br>";
echo "Síťová maska: " . $net->getNetworkMask() . "<br>";
echo "Síťová adresa: " . $net->getNetworkAddress() . "<br>";
