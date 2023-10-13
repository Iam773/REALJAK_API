<?php 
if (isset($_GET["cmd"])) {
    $start_time = microtime(true);

    include_once "./model/a/app.php";

    list($cmd, $value) = explode("::" , $_GET["cmd"]);
    $position = strpos($value, "!");
    if ($position !== false) {
        $value = substr($value, 0, $position);
        $file = "/$value.json";
    }else{
        $file = "/$value.json";
    }
    $path = __DIR__ . "/database" . $file;
    new DB_JSON($path);
    switch ($cmd) {
        case 'create':

            if (DB_JSON::createJsonFile()) {
                $arg = [
                    "status" => "success"
                ];
            }else{
                $arg = [
                    "status" => "error"
                ];
            }
        break;

        case 'read':
            list($key, $table, $colum) = explode("!" , $_GET["cmd"]) + [null, null, null];
            $read = DB_JSON::readJsonFile($table,$colum);
           if ($read) {
            $arg = [
                "status" => "success",
                "data" => $read
            ];
           }else{
            $arg = [
                "status" => "error"
            ];
           }
        break;

        case 'update':
            list($key, $table, $colum, $val) = explode("!" , $_GET["cmd"]) + [null, null, null, null];
            DB_JSON::updateJsonFile(Update(DB_JSON::readJsonFile(),$table,$colum,$val));
            $data = DB_JSON::readJsonFile();
            echo $data["db"]["test"];
        break;
        
    }
    $end_time = microtime(true);
    $execution_time = ($end_time - $start_time);
    $arg["process"] = $execution_time;
    $arg["by"] = "MODEL " . __MODEL . " - v." . __VERSION;
    echo json_encode($arg);
    // $ar = [
    //     "db" => "asas"
    // ];
    // echo urlencode(json_encode($ar));

}

function Update($data, $table, $colum, $val) {
    if (isset($data[$table])) {
        if (isset($data[$table][$colum])) {
            $data[$table][$colum] = $val;
            return $data;
        } else {
            $data[$table][$colum] = [];
            return Update($data, $table, $colum, $val);
        }
    } else {
        $data[$table] = [];
        return Update($data, $table, $colum, $val);
    }
}

// echo "<br><br>เวลาประมวลผล: " . $execution_time . " วินาที";


?>
