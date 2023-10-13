<?php 
interface DB_INTERFACE{
    static function createJsonFile();
    static function readJsonFile($table = null, $colum = null);
    static function updateJsonFile($data);
    static function deleteJsonFile();
}
?>
