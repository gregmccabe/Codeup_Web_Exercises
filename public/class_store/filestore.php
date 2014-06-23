<?php


class Filestore {

    public $filename = '';
    protected $is_csv = FALSE;

    function __construct($filename = '') {
        // Sets $this->filename
        $this->filename = $filename;
        // Add a property to your Filestore class that is a boolean named $is_csv. Update the constructor to set this value to TRUE or FALSE based on the file's extension.
        $this->is_csv = substr($filename, -3) == 'csv';
    }
    /**
     * Returns array of lines in $this->filename
     */
    private function read_lines() {

        $handle = fopen($this->filename, "r");
        if(filesize($this->filename) > 0) {
            $contents = trim(fread($handle, filesize($this->filename))); //     contents = string
            $contents_array = explode("\n", $contents);

        } else {
            $contents_array = array();
        }

        fclose($handle);
        return $contents_array;
        }
    /**
     * Writes each element in $array to a new line in $this->filename
     */
    private function write_lines($array) {
        $handle = fopen($this->filename, 'w');
        fwrite($handle, implode("\n", $array));
        fclose($handle);
    }
    /**
     * Reads contents of csv $this->filename, returns an array
     */
    private function read_csv() {
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
    /**
     * Writes contents of $array to csv $this->filename
     */
    private function write_csv($array) {

        if (is_writable($this->filename)) {
            $handle = fopen($this->filename, 'w');
            foreach ($array as $fields) {
                fputcsv($handle, $fields);
            }
            fclose($handle);

        }
    }

    public function read() {

        if ($this->is_csv) {
            return $this->read_csv();

        } else{
            return $this->read_lines();
        }

    }

    public function write($array) {

        if ($this->is_csv) {
            $this->write_csv($array);

        } else {
             $this->write_lines($array);
        }

    }

}