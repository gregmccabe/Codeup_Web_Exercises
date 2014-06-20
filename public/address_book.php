<?php


require_once('class_store/filestore.php');


$storeData = new Filestore('address_book.csv');
$address_book = $storeData->read();

class UnexpectedTypeException extends Exception { }
try {
    if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) {
        foreach ($_POST as $key => $value) {
            if (strlen($value) >= 125) {
                throw new UnexpectedTypeException("input $key must be less than 125 characters");
            }
        }

        $new_address['name'] = $_POST['name'];
        $new_address['address'] = $_POST['address'];
        $new_address['city'] = $_POST['city'];
        $new_address['state'] = $_POST['state'];
        $new_address['zip'] = $_POST['zip'];
        $new_address['phone'] = $_POST['phone'];

        array_push($address_book, $new_address);
        $storeData->write($address_book);

    } else {

            $errorMessage = "";
            array_pop($_POST);

        foreach ($_POST as $key => $value) {
            if (empty($value)) {
                $errorMessage .= "<h3 style='color:red'>" . ucfirst($key) . " is required field!.</h3>";
            }
        }
    }

} catch(UnexpectedTypeException $e) {
    $msg = $e->getMessage() . PHP_EOL;
}
if (isset($_GET['removeIndex'])) {
    unset($address_book[$_GET['removeIndex']]);
    $storeData->write($address_book);
    header('Location: /address_book.php');
    exit;
}

if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0) {

    if ($_FILES['file1']["type"] != "text/csv") {
        echo "ERROR: file must be in text/csv!";
    } else {

        $upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
        $uploadFilename = basename($_FILES['file1']['name']);

        $saved_filename = $upload_dir . $uploadFilename;
        move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);

        $upload = new Filestore($saved_filename);
        $address_uploaded = $upload->read();
        $address_book = array_merge($address_book, $address_uploaded);
        $storeData->write($address_book);
    }
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
            <? if (!empty($msg)) : ?>
                <?=$msg; ?>
            <? endif; ?>
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
    <h3>Upload File</h3>

        <form method="POST" enctype="multipart/form-data" action="/address_book.php">
            <p>
                <label for="file1">File to upload: </label>
                <input type="file" id="file1" name="file1">
            </p>

            <p><input type="submit" value="Upload"></p>

        </form>

</body>
</html>