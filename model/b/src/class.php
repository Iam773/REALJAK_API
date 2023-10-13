<?php 

require_once "interface.php";
require_once "file.php";
final class DB_JSON extends FILES implements DB_INTERFACE{
    private static $_file;
    function __construct($filename){
        self::$_file = $filename;
    }

    static function createJsonFile(){
        if (file_exists(self::$_file)) {
            return false;
        }
        $data = array();
        self::putFile(self::$_file,json_encode($data));
        return true;
    }

    static function readJsonFile($table = null, $colum = null){
        $data = json_decode(self::getFile(self::$_file),true);
        if (is_null($table)) {
            return $data;
        }elseif(is_null($colum)){
            return $data[$table][$colum];
        }

        return false;
    }

    static function updateJsonFile($data){
        self::putFile(self::$_file,json_encode($data));
    }

    static function deleteJsonFile(){
        if (unlink(self::$_file)) {
            return true;
        }

        return false;
    }
}




?>
