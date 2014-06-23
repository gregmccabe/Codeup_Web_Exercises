<?php

$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'greg', 'letmein');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";


$limitRecord = 4;
$pageNumber = 0;

$query = "SELECT * FROM national_parks LIMIT {$limitRecord} OFFSET {$pageNumber}";
$stmt = $dbc->query($query);

$parks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// var_dump($parks);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>national parks</title>
</head>
<body>
    <h1>National Parks</h1>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Location</th>
            <th>Date</th>
            <th>Acres</th>
        </tr>
         <? foreach ($parks as $park) : ?>
        <tr>
            <? foreach ($park as $key => $value) : ?>
            <td><?= htmlspecialchars(strip_tags($value)); ?></td>
            <? endforeach; ?>
        </tr>
            <? endforeach; ?>
    </table>
    <a href=>page forward</a>
    <a href=>page back</a>
</body>
</html>