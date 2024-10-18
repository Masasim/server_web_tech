<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Max26\ServLab1\Sorter; // Use correct casing here

$client = new Client();
$sorter = new Sorter(); // Instantiate with the correct class name

$res = $client->request("GET", "https://api.imgflip.com/get_memes");

$status = $res->getStatusCode();

if (200 == $status) {
    $rawMemes = $res->getBody();
    $decodedData = json_decode($rawMemes);

    if (!$decodedData->success || !isset($decodedData->data->memes)) {
        die("Data error");
    }

    $memes = $decodedData->data->memes;

    // Sorting memes by name
    $sortedMemes = $sorter->memesSort($memes);
} else {
    die("API request error");
}

?>

<html>
<body>
    <h1>Sorted Memes</h1>
    <ul>
    <?php foreach($sortedMemes as $meme): ?>
        <li>
            <p><strong>Name:</strong> <?= $meme->name; ?></p>
            <p><strong>ID:</strong> <?= $meme->id; ?></p>
            <p><strong>Width:</strong> <?= $meme->width; ?>px</p>
            <p><strong>Height:</strong> <?= $meme->height; ?>px</p>
            <p><strong>Box Count:</strong> <?= $meme->box_count; ?></p>
            <img src="<?= $meme->url; ?>" alt="<?= $meme->name; ?>" width="300">
        </li>
        <hr>
    <?php endforeach; ?>
    </ul>
</body>
</html>
