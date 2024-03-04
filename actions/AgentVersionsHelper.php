<?php
class AgentVersionsHelper {
    public static function ExportToCsv($data): void{
        $array = json_decode($data, true);
        ob_clean();
        ob_start();
        $file = fopen('php://output', 'w');
        $headers = array_keys($array[0]);
        fputcsv($file, $headers);
        foreach($array as $row){
            fputcsv($file, $row);
        }
        fclose($file);
        $csv = ob_get_clean();
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');
        echo $csv;
        exit;
    }
    public static function ExportToJson($data): void{
        
        
        header('Content-Type: application/json; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.json');
        ob_clean();
        echo $data;


        exit;
        
    }
    public static function getDataFromApi(): array{
        $agent_versions_from_api = API::Item()->get([
            'filter' => [
                'key_' => ('agent.version' === '') ? null : 'agent.version'
            ],
            'output' => ['lastvalue', 'hostid', 'itemid', 'name'],
            'monitored' => true
        ]);
        $item_ids = [];
        $agent_versions = CArrayHelper::renameObjectsKeys($agent_versions_from_api, ['name' => 'itemname']);
        foreach ($agent_versions as $agent) {
            array_push($item_ids, $agent['itemid']);
        }
        $hosts = API::Host()->get([
            'itemids' => $item_ids,
            'output' => ['hostid', 'name']
        ]);
        $result = [];
        foreach ($hosts as $item1) {
            foreach ($agent_versions as $item2) {
                if ($item1['hostid'] == $item2['hostid'] && $item2['lastvalue'] != '') {
                    $result[] = array_merge($item1, $item2);
                }
            }
        }

        return $result;
    }
    public static function log_to_console($data) {
        $output = json_encode($data);
        echo "<script>console.log('{$output}' );</script>";
     }

}
?>