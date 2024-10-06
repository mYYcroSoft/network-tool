<?php

require_once 'NetIPv4.php';
use Web\App\AddressIPv4;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = $_POST['address'];
    $net = new AddressIPv4($address);
    $results = [
        "IP" => $net->getAsString(),
        "Prefix" => $net->getPrefixAsString(),
        "IP validace" => $net->isValid() ? "Ano" : "Ne",
        "IP class" => $net->getClass(),
        "Octet" => $net->getOctet(2),
        "Net(str)" => $net->getAsString(),
        "Net(int)" => $net->getAsInt(),
        "Binary" => $net->getAsBinaryString(),
        "Private flag" => $net->isPrivate() ? "Ano" : "Ne",
        "Broadcast adresa" => $net->getBroadcastAddress(),
        "Síťová maska" => $net->getNetworkMask(),
        "Síťová adresa" => $net->getNetworkAddress(),
    ];
}

?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IP - Network tool</title>
</head>
<body>
<h1>IP:</h1>
<ul>
    <?php foreach ($results as $key => $value): ?>
        <li><?php echo htmlspecialchars($key) . ": " . htmlspecialchars($value); ?></li>
    <?php endforeach; ?>
</ul>
<a href="index.html">Zpět</a>
</body>
</html>

