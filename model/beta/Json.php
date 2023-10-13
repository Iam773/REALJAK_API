<?php 

// require "./table.php";
namespace db;
use db\table;

define("FOUND",true);
define("NOT_FOUND",false);
define("SUCCESS",true);
define("ERROR",false);
class DB_JSON{
    
    private static $__file;
    const FOUND = true;
    const NOT_FOUND = false;
    const SUCCESS = true;
    const ERROR = false;

function __construct($filename){
    self::$__file = $filename;
    define("FILE",self::$__file);

    
}   
static function getTable($table) {
    // return new Table(json_decode(file_get_contents(FILE),true),$table);
}

static function createJsonFile() {
    if (!self::checkJsonFile()) {
        $data = [];
        $jsonData = json_encode($data);
    
        file_put_contents(FILE, $jsonData);
        return SUCCESS;
    } else {
        return ERROR;
    }
}

static function readJsonFile($table = null,$colum = null) {
    if (self::checkJsonFile()) {
        $jsonData = json_decode(file_get_contents(FILE),true);
        if (is_null($table)) {
            return $jsonData;
        }else if(is_null($colum)){
            return $jsonData[$table][$colum];
        }
        return ERROR;
    }

    return self::checkJsonFile();
}


static function deleteJsonFile() {
    if (file_exists(FILE)) {
        if (unlink(FILE)) {
            return SUCCESS;
        } else {
            return ERROR; 
        }
    } else {
        return NOT_FOUND;
    }
}

static function addTableData($table) {
    if (self::checkJsonFile()) {
        $data = json_decode(file_get_contents(FILE),true);
        // var_dump($data);
        if (isset($data[$table])) {
           return ERROR;
        }
        $data[$table] = [];
        file_put_contents(FILE,json_encode($data));
        return SUCCESS;
    }

    return self::checkJsonFile();
}


static function addColum($table, $key, $value) : bool {
    $data = self::checkTable($table);
    if ($data) {

        if (isset($data[$table][$key])) {
           return ERROR;
        }
       $data[$table][$key] = $value;
       
       file_put_contents(FILE,json_encode($data));

       return SUCCESS;
    }

    return self::checkTable($table);
}

static function checkTable($table) {
    if (self::checkJsonFile()) {
        $data = json_decode(file_get_contents(FILE),true);
        if (isset($data[$table])) {
            return $data;
         }
         return NOT_FOUND;
    }

    return self::checkJsonFile();
}

static function saveFile($data) {
    file_put_contents(FILE,json_encode($data));
}
static function checkJsonFile() : bool {
    return file_exists(FILE);
}


}


?>
