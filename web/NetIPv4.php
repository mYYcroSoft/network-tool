<?php

namespace Web\App;
class IAddressIPv4
{
    private $ip;
    private $subnet;

    private function prefixToNetmask($prefix)
    {
        $mask = ~((1 << (32 - $prefix)) - 1);
        return long2ip($mask);
    }

    public function __construct($ip, $prefix)
    {
        $this->ip = $ip;
        $this->subnet = $this->prefixToNetmask($prefix);
    }

    public function isValidIp()
    {

        return filter_var($this->ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }

    public function getBroadcastAddress()
    {

        $ip = ip2long($this->ip);
        $netMask = ip2long($this->subnet);
        $broadcast = $ip | (~$netMask);

        return long2ip($broadcast);
    }

    public function getNetworkMask()
    {
        return $this->subnet;
    }

    public function getNetworkAddress()
    {
        $ip = ip2long($this->ip);
        $netMask = ip2long($this->subnet);
        $network = $ip & $netMask;

        return long2ip($network);
    }
}


