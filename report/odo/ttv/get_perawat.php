<?php

if (!empty($_POST['is_ajax']) && !empty($_POST['q'])) 
{
	include '../../config.php';
	
	$keyword    = addslashes($_POST['q']);
	$query      = sqlsrv_query($conn,"SELECT TOP 10 FMPPERAWAT_ID,FMPPERAWATN FROM PERAWAT WHERE FMPSTATUS = 0 AND FMPPERAWATN LIKE '%$keyword%' ORDER BY FMPPERAWATN");
	while ($row = sqlsrv_fetch_array($query,2)) 
	{
		$output[] = ['USER_ID' => $row['FMPPERAWATN'], 'USER_NAME' => $row['FMPPERAWATN']];
	}

	echo json_encode($output);
}