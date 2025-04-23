<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';


 
                // Configurasi Koneksi ke database
              
                // menghilangkan spasi sebelah kiri dan kanan
                $keyword = trim($_GET['diagnosa']);
 $sts=$_GET['sts'];
                // memisahkan dan menghitung jumlah keyword
                $pisah_kata = explode(" ", $keyword);
                $jumlah_kata = (integer)count($pisah_kata);
                $jml_kata = $jumlah_kata - 1;
 
                // query untuk pencarian multiple keyword


                if($sts === '1'){
    $sql = "SELECT * FROM mdiagnosa WHERE ";
                for ($i=0; $i<=$jml_kata; $i++){
                    $sql .= "diagnosa LIKE '%$pisah_kata[$i]%'";  
                    if($i < $jml_kata){
                        $sql .= " OR ";
                    }
                }
				 $sql .= " ORDER BY diagnosa  asc limit 50";
                

                }elseif($sts === '3'){

    $sql = "SELECT * FROM mdiagnosa WHERE ";
                for ($i=0; $i<=$jml_kata; $i++){
                    $sql .= "kddiagnosa LIKE '%$pisah_kata[$i]%'";  
                    if($i < $jml_kata){
                        $sql .= " OR ";
                    }
                }
				 $sql .= " ORDER BY kddiagnosa  asc limit 50";

                }elseif($sts === '2'){

    $sql = "SELECT * FROM mdiagnosa WHERE ";
                for ($i=0; $i<=$jml_kata; $i++){
                    $sql .= "diagnosa LIKE '%$pisah_kata[$i]%' or freetext LIKE '%$pisah_kata[$i]%'";  
                    if($i < $jml_kata){
                        $sql .= " OR ";
                    }
                }
				 $sql .= " ORDER BY diagnosa  asc limit 50";
                


                }

            

                $arr=array();
                $hasil = $conn->query($sql);
 
                // Tampilkan ke dalam halaman web
        
          
                    while ($data = $hasil->fetch_array()) {

                        
                          $temp = array(
 "diagnosa" => $data['diagnosa'],
 "kdparent" => $data['kdparent'],
 "kddiagnosa" => $data['kddiagnosa'],
"freetext" => $data['freetext'],


                          );
                        // echo "- $data[diagnosa]<br>";

  array_push($arr, $temp);


                    }
                       
             


$datax = json_encode($arr);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $datax);

mysqli_close($conn);


?>