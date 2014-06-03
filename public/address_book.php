<?php

$contacts = [
    ['The White House', '1600 Pennsylvania Avenue NW', 'Washington', 'DC', '20500'],
    ['Marvel Comics', 'P.O. Box 1527', 'Long Island City', 'NY', '11101'],
    ['LucasArts', 'P.O. Box 29901', 'San Francisco', 'CA', '94129-0901']
];
$new_address = [];
$filename = "address_book.csv";

function write_csv($BigArray, $filename) {
    if (is_writable($filename)) {
        $handle = fopen($filename, 'w');
        foreach ($BigArray as $fields) {
            fputcsv($handle, $fields);
        }
        fclose($handle);
    }

}


if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) {

    $new_address['name'] = $_POST['name'];
    $new_address['address'] = $_POST['address'];
    $new_address['city'] = $_POST['city'];
    $new_address['state'] = $_POST['state'];
    $new_address['zip'] = $_POST['zip'];
    $new_address['phone'] = $_POST['phone'];

    array_push($contacts, $new_address);
    write_csv($contacts, $filename);

} else {

    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            echo "<h1>" . ucfirst($key) . " is empty.</h1>";
        }
    }

}

?>


<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h1>Contact List:</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zip</th>
            <th>Phone</th>
        </tr>
        <? foreach ($contacts as $fields) : ?>
        <tr>
            <? foreach ($fields as $value) : ?>
                <td><?= $value; ?></td>
            <? endforeach; ?>
        </tr>
            <? endforeach; ?>
    </table>

    <form method="POST">
        <h3>Address Book</h3>
        <p>
            <label for="Name">Name</label>
            <input id="Name" name="name" type="text" placeholder="Enter full Name">
        </p>
        <p>
            <label for="address">Address</label>
            <input id="address" name="address" type="text" placeholder="Address">
        </p>
        <p>
            <label for="City">City</label>
            <input id="City" name="city" type="text" placeholder="City">
        </p>
        <p>
            <label for="State">State</label>
            <input id="State" name="state" type="text" placeholder="State">
        </p>
        <p>
            <label for="Zip Code">Zip Code</label>
            <input id="Zip Code" name="zip" type="text" placeholder="Zip">
        </p>
        <p>
            <label for="Phone Number">Phone Number</label>
            <input id="Phone Number" name="phone" type="text" placeholder="Phone Number">
        </p>
        <p>
            <button type="Submit">Submit</button>
        </p>


    </form>

</body>
</html>