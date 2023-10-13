<?php 

class FILES {
    static function getFile($path){
        if (!file_exists($path)) {
            return false;
        }
        return file_get_contents($path);
    }

    static function putFile($path,$data){
        file_put_contents($path,$data);
    }
}


?>
