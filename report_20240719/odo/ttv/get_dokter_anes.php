<?php

if (!empty($_POST['is_ajax']) && !empty($_POST['q'])) 
{
	include '../../config.php';
	
	$keyword    = addslashes($_POST['q']);
	$query      = sqlsrv_query($conn,"SELECT TOP 10 FMDDOKTER_ID,FMDDOKTERN FROM DOKTER WHERE FMDSTATUS=0 AND FMDAHLI_ANESTESI=1 AND FMDDOKTERN LIKE '%$keyword%' ORDER BY FMDDOKTERN");
	while ($row = sqlsrv_fetch_array($query,2)) 
	{
		$output[] = ['USER_ID' => $row['FMDDOKTERN'], 'USER_NAME' => $row['FMDDOKTERN']];
	}

	echo json_encode($output);
}