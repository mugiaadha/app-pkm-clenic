






<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$sql = 'select kdtarifm as id, nama as name, nama as text, parent as parent_id from tarif';
$result = mysqli_query($conn, $sql);

$tree_data = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach($tree_data as $k => &$v){
    $tmp_data[$v['id']] = &$v;
}

foreach($tree_data as $k => &$v){
    if($v['parent_id'] && isset($tmp_data[$v['parent_id']])){
        $tmp_data[$v['parent_id']]['nodes'][] = &$v;
    }
}

foreach($tree_data as $k => &$v){
    if($v['parent_id'] && isset($tmp_data[$v['parent_id']])){
        unset($tree_data[$k]);
    }
}

echo json_encode($tree_data);

mysqli_close($conn);


?>