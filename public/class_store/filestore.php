<?php

class Filestore {
    public $filename = '';

    function __construct($filename = '') {
        // Sets $this->filename
        $this->filename = $filename;
    }
    /**
     * Returns array of lines in $this->filename
     */
    function read_lines() {

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
    function write_lines($array) {
        $handle = fopen($this->filename, 'w');
        fwrite($handle, implode("\n", $array));
        fclose($handle);
    }
    /**
     * Reads contents of csv $this->filename, returns an array
     */
    public function read_csv() {
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
    function write_csv($array) {

        if (is_writable($this->filename)) {
            $handle = fopen($this->filename, 'w');
            foreach ($array as $fields) {
                fputcsv($handle, $fields);
            }
            fclose($handle);
        }
    }
}