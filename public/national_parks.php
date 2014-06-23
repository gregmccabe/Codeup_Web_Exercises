<?php

$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'greg', 'letmein');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

function getOffset() {
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    return ($page - 1) * 4;
}

$limitRecord = 4;
$pageNumber = 0;
$offset = 0;

if (isset($_GET['page'])) {
    $pageNumber=$_GET['page'];
    $offset = $pageNumber * $limitRecord;

}

$query = "SELECT * FROM national_parks LIMIT {$limitRecord} OFFSET {$offset}";
$stmt = $dbc->query($query);
$parks = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $dbc->query("SELECT * FROM national_parks;")->fetchColumn();

$numPage = ceil($count / $limitRecord);

$nextPage = $pageNumber + 1;
$prevPage = $pageNumber - 1;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
    <meta charset="UTF-8">
    <title>national parks</title>
</head>
<body>
<div class="container">
    <h1 align="center">National Parks</h1>
        <table class="table table-striped"border="1">
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

    <ul class="pager">
        <? if ($pageNumber > 0) : ?>
          <li class="previous"><a href="national_parks.php?page=<?= $prevPage; ?>">&larr; Previous</a></li>
        <? endif ?>

        <? if ($pageNumber <= $numPage) : ?>
          <li class="next"><a href="national_parks.php?page=<?= $nextPage; ?>">Next &rarr;</a></li>
        <? endif ?>
    </ul>
</div>
</body>
</html


