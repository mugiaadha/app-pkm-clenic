<?php
$values = [14,18,4,19,23,34,16,25,5,20,13,20,16];



$xOrigin = 90;   // Position of the start (left) of the X axis
$yOrigin = 100;  // Position of the start (bottom) of the Y axis
$xScale = 20;    // Scale for the X axis
$yScale = 2.5;   // Scale for the Y axis

// Get the max value in the $values array so we know how tall to make the Y axis
$yMax = max($values);

?><svg viewBox="0 0 500 100" style="width: 710px;height: 300px">

  <g transform="translate(<?=$xOrigin?>, <?=$yOrigin?>)" fill="none" stroke="grey">
    <line id="xaxis" x1="0" y1="0" x2="<?= $xScale*(count($values)-1) ?>" y2="0" />
    <line id="yaxis" x1="0" y1="0" x2="0" y2="<?= -$yScale*$yMax ?>" />

    <polyline
      stroke="rgb(125, 207, 108)"
      stroke-width="4"
      points="<?php

        // Loop through all the entries in the $values array
        // Echo "x,y" coordinates to the page to fill in the
        // points attribute of the <polyline> element.
        for ($i = 0; $i < count($values); $i++) {
          // If this is not the first x,y pair, then output a
          // comma to separate one x,y pair from the next
          if ($i != 0)
            echo ", ";
          // Output a single x,y pair.  Each x and y values are
          // multiplied by a scale factor. $yScale is negative because
          // in an SVG y coordinates increase down the page, but we want larger
          // Y to go up the page.
          echo ($i * $xScale) . "," . ($values[$i] * -$yScale);
        }

      ?>"/>
  </g>

</svg>


<!-- <?php
include '../../config.php';
$sqlds = "SELECT x,notrans FROM  ERMVKPTD where  notrans='BV-20-02-0090' group by x,notrans";
                                      $stmtds = sqlsrv_query( $conn, $sqlds );
                                     

                                      while( $rowds = sqlsrv_fetch_array( $stmtds, SQLSRV_FETCH_ASSOC) ) {




?>
<p>sadasd</p>

<?php } ?>
 -->

    <?php
include '../../config.php';
$sql = "SELECT * FROM  ERMVKPJUDUL where  notrans='RBI-20-03-106'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count <= 0){

echo "000";

}else if ($row_count > 0){
while( $rowjudul = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

$tuban=$rowjudul['ketubanpecah'];

echo $tuban;

}
// echo "11";
}


// if ($row_count === false)
//    echo "Error in retrieveing row count.";
// else
//    echo $row_count;


// $sqljudul = "SELECT * FROM  ERMVKPJUDUL where  notrans='RBI-20-03-106'";
//  $stmtjudul = sqlsrv_query( $conn, $sqljudul );
//  $row_count = sqlsrv_num_rows( $stmtjudul );
   
// if ($row_count === false)
//    echo "Error in retrieveing row count.";
// else
//    echo $row_count;
// while( $rowjudul = sqlsrv_fetch_array( $stmtjudul, SQLSRV_FETCH_ASSOC) ) {


 
// $tuban=$rowjudul['ketubanpecah'];
// $msj = $rowjudul['mulessejak'];
// $msktgl = $rowjudul['tanggal'];





// }
        ?>