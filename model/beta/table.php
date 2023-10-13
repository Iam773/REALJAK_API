 <?php 
// require "./Json.php";
// declare(strict_types=1); 

// namespace db;
use db\DB_JSON;
class Table extends DB_JSON {
    private $data;
    private $table;

    function __construct($data, $table) {
        $this->data = $data;
        $this->table = $table;
    }

    function Update($colum, $value) {
        $this->data[$this->table][$colum] = $value;
        self::saveFile($this->data);
        // return SUCCESS;
    }
}

 
 
 
 
 
 
 ?>
 
