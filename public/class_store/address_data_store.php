<?php
class AddressDataStore {

    public $filename = '';
    public function __construct($filename = 'address_book.csv') {
        $this->filename = $filename;
    }

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

    public function write_address_book($BigArray) {

        if (is_writable($this->filename)) {
        $handle = fopen($this->filename, 'w');
        foreach ($BigArray as $fields) {
            fputcsv($handle, $fields);
        }
        fclose($handle);
        }

    }

}

?>