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
        $file = self::getFile(self::$_file);
        if (!$file) {
            return false;
        }
        $data = json_decode($file,true,JSON_UNESCAPED_UNICODE);
        if (is_null($table)) {
            return $data;
        }elseif(is_null($colum) || $colum == ''){
            if (!isset($data[$table])) {
                return false;
             }
            return $data[$table];
        }elseif(!is_null($table) && !is_null($colum)){
            if (!isset($data[$table][$colum])) {
               return false;
            }

            return $data[$table][$colum];
        }

        return false;
    }

    static function updateJsonFile($data){
        self::putFile(self::$_file,json_encode($data,JSON_UNESCAPED_UNICODE));
    }

    static function deleteJsonFile(){
        if (unlink(self::$_file)) {
            return true;
        }

        return false;
    }
}




?>
