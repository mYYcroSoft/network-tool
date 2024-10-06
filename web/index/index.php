<?php

require_once 'NetIPv4.php';
use Web\App\AddressIPv4;

$net = new AddressIPv4('192.168.100.200/16');
echo "IP validace: " . ($net->isValid() ? "Ano" : "Ne")  . "<br>";
echo "Třída: " . ($net->getClass()) . "<br>";
echo "Octet: " . ($net->getOctet(2)) . "<br>";
echo "Net(str): " . ($net->getAsString()) . "<br>";
echo "Net(int): " . ($net->getAsInt()) . "<br>";
echo "Binary: " . ($net->getAsBinaryString()) . "<br>";
echo "Private flag: " . ($net->isPrivate()) . "<br>";

echo "Broadcast adresa: " . $net->getBroadcastAddress() . "<br>";
echo "Síťová maska: " . $net->getNetworkMask() . "<br>";
echo "Síťová adresa: " . $net->getNetworkAddress() . "<br>";
