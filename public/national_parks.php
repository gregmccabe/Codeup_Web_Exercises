<?php

$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'greg', 'letmein');

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

if ($_POST) {
    if (!empty($_POST['name']) && !empty($_POST['location']) && !empty($_POST['date']) && !empty($_POST['acres']) && !empty($_POST['description'])) {

    $stmt = $dbc->prepare('INSERT INTO national_parks (name, location, date_established, area_in_acres, park_description) VALUES (:name, :location, :date_established, :acres, :park_description)');


        $stmt->bindValue(':name',  $_POST['name'],  PDO::PARAM_STR);
        $stmt->bindValue(':location', $_POST['location'], PDO::PARAM_STR);
        $stmt->bindValue(':date_established', $_POST['date'], PDO::PARAM_STR);
        $stmt->bindValue(':acres', $_POST['acres'], PDO::PARAM_STR);
        $stmt->bindValue(':park_description', $_POST['description'], PDO::PARAM_STR);

        $stmt->execute();
        // $dbc->lastInsertId();
    }
}

$query = "SELECT * FROM national_parks LIMIT :limitRecord OFFSET :offset";
$stmt = $dbc->prepare($query);
$stmt->bindValue(':limitRecord', $limitRecord, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$parks = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $dbc->query("SELECT * FROM national_parks;")->rowCount();

$numPage = floor($count / $limitRecord);

$nextPage = $pageNumber + 1;
$prevPage = $pageNumber - 1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<style>
    body {
        background-image: url('../img/badlands.jpg');
    }
</style>
<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
    <meta charset="UTF-8">
    <title>national parks</title>
</head>
<body>
<div class="container">
    <h1 align="center">National Parks</h1>
        <table class="table"border="1">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Location</th>
                <th>Date</th>
                <th>Acres</th>
                <th>Descrition</th>
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

        <? if ($pageNumber < $numPage) : ?>
          <li class="next"><a href="national_parks.php?page=<?= $nextPage; ?>">Next &rarr;</a></li>
        <? endif ?>
    </ul>
    <form method="POST">
  <fieldset>
    <legend>National Parks</legend>
        <p>
            <label for="name">Park Name</label>
        </p>
        <p>
            <input id="name" name="name" type="text" placeholder="Enter Name">
        </p>

        <p><label for="location">Location</label></p>
        <p>
            <input id="location" name="location" type="text" placeholder="Enter Location">
        </p>

        <p>
            <label for="date">Date</label>
        </p>
        <p>
            <input id="date" name="date" type="date" placeholder="Enter Date">
        </p>

        <p>
            <label for="acres">Park Acres</label>
        </p>
        <p>
            <input id="acres" name="acres" type="float" placeholder="Enter Acres">
        </p>

        <p>
            <label for="description">Park Discription</label>
        </p>
        <p>
            <textarea id="description" name="description" rows="6" cols="50" placeholder="Enter Description"></textarea>
        </p>
        <p>
            <button type="Submit" name="Submit" class="btn btn-info">Submit</button>
        </p>
  </fieldset>
</form>
</div>
</body>
</html


