<?php

class AddressDataStore {

    public $filename = 'address_book.csv';

    public function read_address_book() {
    $entries = [];
    $handle = fopen($this->filename, 'r');

    while(!feof($handle)) {
      $row = fgetcsv($handle);
      if (is_array($row)) {
          $entries[] = $row;
        }

    }

    fclose($handle);
    return $entries;
}

    function write_address_book($BigArray) {

        if (is_writable($this->filename)) {
        $handle = fopen($this->filename, 'w');
        foreach ($BigArray as $fields) {
            fputcsv($handle, $fields);
        }
        fclose($handle);
        }

    }

}

$storeData = new AddressDataStore;
$address_book = $storeData->read_address_book();


if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) {

    $new_address['name'] = $_POST['name'];
    $new_address['address'] = $_POST['address'];
    $new_address['city'] = $_POST['city'];
    $new_address['state'] = $_POST['state'];
    $new_address['zip'] = $_POST['zip'];
    $new_address['phone'] = $_POST['phone'];


    array_push($address_book, $new_address);
    $storeData->write_address_book($address_book);


} else {

        $errorMessage = "";
        array_pop($_POST);

    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errorMessage .= "<h3 style='color:red'>" . ucfirst($key) . " is required field!.</h3>";
        }
    }

}

if (isset($_GET['removeIndex'])) {
    unset($address_book[$_GET['removeIndex']]);
    $storeData->write_address_book($address_book);
    header('Location: /address_book.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>address_book.php</title>
</head>
<body>
    <h2>Address book:</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zip</th>
            <th>Phone</th>
            <th>Delete</th>
        </tr>
        <? foreach ($address_book as $key => $fields) : ?>
        <tr>
            <? foreach ($fields as $value) : ?>
            <td><?= htmlspecialchars(strip_tags($value)); ?></td>
            <? endforeach; ?>
            <td><a href="address_book.php?removeIndex=<?= $key?>">Delete Contact</a></td>
        </tr>
            <? endforeach; ?>
    </table>
        <? if (!empty($errorMessage)) {
            echo $errorMessage;
        }
        ?>

    <form method="POST">
        <h3>Contact</h3>
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