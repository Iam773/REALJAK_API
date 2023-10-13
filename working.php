<?php

include_once "./model/a/app.php";

// echo $data;
$file = "/data.json";
$path = __DIR__ . "/database" . $file;

// echo $path;
new DB_JSON($path);

DB_JSON::createJsonFile();
$data = [
    "db" => [
        "a" => "b"
    ] 
    ];
DB_JSON::updateJsonFile($data);
var_dump(DB_JSON::readJsonFile());



echo "<br><br><br>MODEL " . __MODEL . " - v." . __VERSION;
// DB_JSON::deleteJsonFile();
?>
