<?php

class Export {
    public static function ExportToCsv($data): void{

        
        
        header('Content-Type: application/json; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.json');
        
        echo $data;
        exit;
        
    }

}
?>