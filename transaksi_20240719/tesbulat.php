<?php



// $totalharga = 14807.5;
// $totalharga=ceil($totalharga);

//                             if (substr($totalharga,-2)>49){
//                                 $total_harga=round($totalharga,-2);
//                             } else {
//                                 $total_harga=round($totalharga,-2)+1000;
//                             } 
                             
//                             echo number_format($total_harga,2,',','.');




$totalharga = 23521;
$totalharga=ceil($totalharga);

                            if (substr($totalharga,-1)>49){
                                $total_harga=round($totalharga,-1);
                            } else {
                                $total_harga=round($totalharga,-1)+1000;
                            } 
                             
                            echo number_format($total_harga,2,',','.');


?>