<?php
// connect to the database
$dsn = 'mysql:host=localhost;dbname=clenic';
$username = 'root';
$password = '';
$pdo = new PDO($dsn, $username, $password);

// query the database for the tree data
$stmt = $pdo->prepare('SELECT id, parent_id, name FROM tree ORDER BY parent_id, id');
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// convert the flat data into a hierarchical structure
$tree = [];
foreach ($rows as $row) {
  $id = $row['id'];
  $parent_id = $row['parent_id'];
  $name = $row['name'];
  $node = ['id' => $id, 'name' => $name];




  if ($parent_id == NULL) {
    $tree[] = &$node;
  } else {

    $parent = &$tree[$parent_id - 1];
    if (!isset($parent['children'])) {
      $parent['children'] = [];
    }
    $parent['children'][] = &$node;
  }
}

// output the tree data as JSON
header('Content-Type: application/json');
echo json_encode($tree);
?>