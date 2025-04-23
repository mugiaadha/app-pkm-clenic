<html>
	<head>
		<script src="assets/jquery-2.1.3.js"></script>
		<script src="tableHeadFixer.js"></script>
		<link rel="stylesheet" href="assets/bootstrap-3.3.2/css/bootstrap.css">
		<style>
			#parent {
				height: 100%;
			}
			
			#fixTable {
				width: 1800px !important;
			}
		</style>

		<script>
			$(document).ready(function() {
				$("#fixTable").tableHeadFixer({"left" : 1}); 
			});
		</script>
	</head>

	<body>
	
		<div id="parent">


			<table id="fixTable" class="table">
				


				<thead >
					<tr style="border:1px solid grey;background-color: #eeeeee;">
						<th>PEMERIKSAAN</th>
					

					<?php
					
					$norm = $_GET['norm'];


					  include '../koneksi.php';


					   $query="SELECT  waktu,notrans FROM hasilabm WHERE norm='$norm' order by waktu asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                 
                     echo "<th style='font-weight:Bold'>".$row['waktu']."</th>";
                    
                  }                              





					   $queryl="SELECT  jeniskelamin FROM pasien WHERE norm='$norm'";
                    $resultl=mysqli_query($conn, $queryl);
                  while($rowl=mysqli_fetch_array($resultl,MYSQLI_ASSOC)) {
                 
                 	$jk = $rowl['jeniskelamin'];

                    
                  }                              



?>


					</tr>
				</thead>


				<tbody>


<?php






	   $queryx="SELECT distinct a.kdlab,b.nama,b.reflaki,b.refperempuan FROM hasillab a, teslab b WHERE a.kdlab = b.kdlab and a.norm='$norm' ORDER BY b.kdgolongan,b.nourut asc ";



                    $resultx=mysqli_query($conn, $queryx);
                  while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {
                  
                  if($jk === 'LAKI-LAKI'){
$jkx = $rowx['reflaki'];
}else{
$jkx = $rowx['refperempuan'];
}


                  		$nama = $rowx['nama'];
                  		$kdlab = $rowx['kdlab'];

?>
<tr>
						<td style="border:1px grey solid;background-color: #eeeeee;color:#01244a;font-weight: bold;"><?php echo $nama ?>
						<br>
						<span style="font-size: 12px;color:black;"><?php echo $jkx ?></span>
						 </td>

<?php 

					   $query="SELECT  waktu,notrans FROM hasilabm WHERE norm='$norm'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                 
                  	$waktu = $row['waktu'];
                  	$notrans = $row['notrans'];
                  	

                 ?>





                 <td style='font-size:12px;border: 1px solid grey;'>
                 	


<?php


	   $queryxx="SELECT a.*,b.nama,c.waktu  FROM 
hasillab a,
teslab b,
hasilabm c
 WHERE 
 a.kdlab = b.kdlab AND c.notrans =a.notrans and
 a.notrans='$notrans' AND c.waktu='$waktu' and a.kdlab='$kdlab' order by c.waktu asc";



                    $resultxx=mysqli_query($conn, $queryxx);
                  while($rowxx=mysqli_fetch_array($resultxx,MYSQLI_ASSOC)) {

$warna = $rowxx['warna'];
   if($warna == 'Merah'){
                   
                  	echo "<div style='color:#ff1313;font-size:16px;font-weight:Bold'>".$rowxx['hasil']."</div>"; 
              }else if($warna == 'Hitam'){
                   
					echo "<div style='font-size:16px;font-weight:Bold'>".$rowxx['hasil']."</div>";


              }else if($warna == 'Kuning'){
                echo "<div style='color:#fb8383;font-size:16px;font-weight:Bold'>".$rowxx['hasil']."</div>";
             }else if($warna == 'Merahl'){
                  		echo "<div style='color:#fb8383;font-size:16px;font-weight:Bold'>".$rowxx['hasil']."</div>";
                   
              }else{
                   
                  
			echo "<div style='font-size:16px;font-weight:Bold'>".$rowxx['hasil']."</div>";


                  
              }




                  

                  
				




                  }

						?> 







                 </td>

                 <?php
                     // echo "<td style='font-size:12px'>".$row['waktu']."</td>";
                    
                  }       


?>






					</tr>

<?php
                
                 
              
									}


                    
                  


                  
?>

					
				
					
				</tbody>



			</table>
		</div>
	</body>
</html>