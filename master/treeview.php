<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$query = "
 SELECT * FROM tarif where kdcabang='003'";
$result = mysqli_query($conn, $query);
//$output = array();
while($row = mysqli_fetch_array($result))
{
     $sub_data["label"] = $row["nama"];
      $sub_data["data"] = $row["nama"];
 $sub_data["id"] = $row["kdtarifm"];
   $sub_data["expandedIcon"] ="pi pi-folder-open";
     $sub_data["collapsedIcon"]= "pi pi-folder";
 $sub_data["parent_id"] = $row["parent"];
 $data[] = $sub_data;
}
foreach($data as $key => &$value)
{
 $output[$value["id"]] = &$value;
}
foreach($data as $key => &$value)
{
 if($value["parent_id"] && isset($output[$value["parent_id"]]))
 {
  $output[$value["parent_id"]]["children"][] = &$value;
 }
}
foreach($data as $key => &$value)
{
 if($value["parent_id"] && isset($output[$value["parent_id"]]))
 {
  unset($data[$key]);
 }
}
echo json_encode($data);





?>