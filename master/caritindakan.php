<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';


 
                // Configurasi Koneksi ke database
              
                // menghilangkan spasi sebelah kiri dan kanan
                $keyword = trim($_GET['tindakan']);
 $sts=$_GET['sts'];
                // memisahkan dan menghitung jumlah keyword
                $pisah_kata = explode(" ", $keyword);
                $jumlah_kata = (integer)count($pisah_kata);
                $jml_kata = $jumlah_kata - 1;
 
                // query untuk pencarian multiple keyword


                if($sts === '1'){
    $sql = "SELECT * FROM mtindakan WHERE ";
                for ($i=0; $i<=$jml_kata; $i++){
                    $sql .= "tindakan LIKE '%$pisah_kata[$i]%'";  
                    if($i < $jml_kata){
                        $sql .= " OR ";
                    }
                }
				 $sql .= " ORDER BY tindakan  asc limit 50";
                

                }elseif($sts === '3'){

    $sql = "SELECT * FROM mtindakan WHERE ";
                for ($i=0; $i<=$jml_kata; $i++){
                    $sql .= "kdtindakan LIKE '%$pisah_kata[$i]%'";  
                    if($i < $jml_kata){
                        $sql .= " OR ";
                    }
                }
				 $sql .= " ORDER BY kdtindakan  asc limit 50";

                }elseif($sts === '2'){

    $sql = "SELECT * FROM mtindakan WHERE ";
                for ($i=0; $i<=$jml_kata; $i++){
                    $sql .= "tindakan LIKE '%$pisah_kata[$i]%' ";  
                    if($i < $jml_kata){
                        $sql .= " OR ";
                    }
                }
				 $sql .= " ORDER BY tindakan  asc limit 50";
                


                }

            

                $arr=array();
                $hasil = $conn->query($sql);
 
                // Tampilkan ke dalam halaman web
        
          
                    while ($data = $hasil->fetch_array()) {

                        
                          $temp = array(
 "kdtindakan" => $data['kdtindakan'],
 "tindakan" => $data['tindakan'],



                          );
                        // echo "- $data[diagnosa]<br>";

  array_push($arr, $temp);


                    }
                       
             


$datax = json_encode($arr);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $datax);

mysqli_close($conn);


?>