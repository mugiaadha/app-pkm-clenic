<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$status=$_GET['status'];
$kdcabang=$_GET['kdcabang'];
$kdtarif=$_GET['kdtarif'];



$query = "SELECT * FROM tarifdetail WHERE statust='$status' AND kdcabang='$kdcabang' and kdtarifmasli='$kdtarif' and harga <= 0  ORDER BY kdtarifm,kdtarif,nama asc";
$result = mysqli_query($conn, $query);
//$output = array();
while($row = mysqli_fetch_array($result))
{
     $sub_data["label"] = $row["nama"];
      $sub_data["data"] = $row["nama"];
 $sub_data["key"] = $row["kdtarif"];
  $sub_data["harga"] = $row["harga"];
    $sub_data["statust"] = $row["statust"];

   $sub_data["expandedIcon"] ="pi pi-folder-open";
     $sub_data["collapsedIcon"]= "pi pi-folder";
 $sub_data["parent_id"] = $row["kdtarifm"];
 $data[] = $sub_data;
}


foreach($data as $key => &$value)
{
 $output[$value["key"]] = &$value;
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