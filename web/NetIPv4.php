<?php

namespace Web\App;

interface IAddressIPv4
{
    public function __construct(string $address);
    public function isValid(): bool;
    public function set(string $address): IAddressIPv4;
    public function getAsString(): string;
    public function getAsInt(): int;
    public function getAsBinaryString(): string;
    public function getOctet(int $number): int;
    public function getClass(): string;
    public function isPrivate(): bool;
}


class AddressIPv4 implements IAddressIPv4
{
    private $ip;
    private $subnet;

    private function prefixToNetmask($prefix)
    {
        $mask = ~((1 << (32 - $prefix)) - 1);
        return long2ip($mask);
    }

    private function getPrefix($address)
    {
        $parts = explode('/', $address);
        if (isset($parts[1])) {
            return (int)$parts[1];
        };

        return null;
    }

    public function __construct(string $address)
    {
        $parts = explode('/', $address);
        $this->ip = $parts[0];
        $this->prefix = isset($parts[1]) ? (int)$parts[1] : 32;
        $this->subnet = $this->prefixToNetmask($this->prefix);
    }

    public function isValid(): bool
    {
        return filter_var($this->ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }
    public function set(string $address): IAddressIPv4
    {
        $this->ip = $address;
        return $this;
    }

    public function  getClass(): string
    {
        $octet = $this->getOctet(1);

        if ($octet >= 1 && $octet <= 126) {
            return 'A';
        } elseif ($octet >= 128 && $octet <= 191) {
            return 'B';
        } elseif ($octet >= 192 && $octet <= 223) {
            return 'C';
        } elseif ($octet >= 224 && $octet <= 239) {
            return 'D';
        } elseif ($octet >= 240 && $octet <= 255) {
            return 'E';
        } else {
            return 'Unknown';
        }
    }

    public function  getOctet(int $number): int
    {
        $octetsParts = explode('.', $this->ip);
        if(isset($octetsParts[$number - 1])) {
            return (int)$octetsParts[$number - 1];
        };
        return 0;
    }

    public function getAsString():string
    {
        return $this->ip;
    }
    public function getPrefixAsString(): string
    {
        return $this->prefix;
    }

    public function getAsInt(): int
    {
        return ip2long($this->ip);
    }
    public function getAsBinaryString(): string
    {

        return decbin(ip2long($this->ip));
    }

    public  function  isPrivate(): bool
    {
        return filter_var($this->ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE) === false;
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


