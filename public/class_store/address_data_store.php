<?php

require_once 'filestore.php';
class AddressDataStore extends Filestore {

    public $filename = '';

    public function __construct($filename = 'address_book.csv') {
        $this->filename = $filename;
    }
}

?>