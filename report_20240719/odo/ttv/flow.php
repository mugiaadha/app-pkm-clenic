
<!DOCTYPE html>
<html>
<head>
    <title>TTV</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- 
    <link rel="stylesheet" href="../css/w3.css"> -->
    <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../js/jquery-ui/jquery-ui.css">
     <link rel="shortcut icon" href="../favicon.ico" />
    <style>
    .w3-theme {color:#fff !important;background-color:#4CAF50 !important;}
    .w3-btn {background-color:#4CAF50 ;margin-bottom:4px;}
    .w3-code{border-left:4px solid #4CAF50}
    @media only screen and (max-width: 601px) {.w3-top{position:static;} #main{margin-top:0px !important}}


    .tbl th.header { 
        background-image: url(../js/table.sorter/themes/blue/bg.gif);
        cursor: pointer; 
        font-weight: bold; 
        background-repeat: no-repeat; 
        background-position: center left; 
        padding-left: 20px; 
        margin-left: -1px; 
    }

    .tbl th.headerSortUp { 
      background-image: url(../js/table.sorter/themes/blue/asc.gif);
      cursor: pointer; 
        font-weight: bold; 
        background-repeat: no-repeat; 
        background-position: center left; 
        padding-left: 20px; 
        margin-left: -1px; 

    } 
    .tbl th.headerSortDown { 
      background-image: url(../js/table.sorter/themes/blue/desc.gif);
      cursor: pointer; 
        font-weight: bold; 
        background-repeat: no-repeat; 
        background-position: center left; 
        padding-left: 20px; 
        margin-left: -1px; 
    } 
    .ui-datepicker {
        font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
        font-size: 80.5%;
    }
    .ui-tooltip-content {
        font-size: 80.5%;
    }

    .centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}


.container {
  position: relative;
  text-align: center;
  color: white;
}
input {
    background-color: transparent;
    border: 0px solid;
    height: 20px;
    width: 160px;
   
}

.hitam{
  color:black;
}
.sd{
  font-size: 17px;
}


/*td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}*/
.kontener{
  width: 100%;
  min-height: 100px;
}
.sticky-col {
    position: -webkit-sticky;
    position: sticky;
    background-color: white;
  }
  .first-col {
    min-width: 200px;
    left: 0px;
    z-index: 9;

  }
  .second-col {
    min-width: 150px;
    left: 300px;
    z-index: 9;
  } 
  .third-col {
    min-width: 150px;
    z-index: 9;
    left: 500px;
  }




#navbar {
  overflow: hidden;
  background-color: white;
}

#navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;

}




.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

.sticky + .content {
  padding-top: 60px;
}

    </style>
<script src="../js/jquery-1.12.2.min.js"></script>
  
<script src="../js/bootstrap.min.js"></script>
<link href="../css/bootstrap.min.css" rel="stylesheet"/>

<script src="../js/jquery-ui/jquery-ui.min.js"></script>
<script src="../js/perfect-scrollbar.min.js"></script>
<script src="../js/sweetalert2.min.js"></script>
<script src="../js/jquery.number.js"></script>
<script src="../js/table.sorter/jquery.tablesorter.js"></script>

  

</head>
</html>

<?php


include '../../config.php';
?>

  <div style="text-align: center;">
<h4>GRAFIK TANDA TANDA VITAL</h4>


</div>

<div style="text-align: left;">
<h4>RM.RI.5</h4>


</div>


<div class="kontener">

  
<!-- <table>
  <td class="sticky-col first-col">Pertama</td>
<td><div id="navbar">
  <svg height="40" width="1059" style="background: url(muntah.jpg) no-repeat 0 0;" >

</svg>

</div></td>
<td><div id="navbar">
  <svg height="40" width="1059" style="background: url(muntahc.jpg) no-repeat 0 0;" >

</svg>

</div></td>



</table>
 -->




<table>
  <td class="sticky-col first-col">Pertama</td>
<td>
<div id="navbar">
  <svg height="40" width="1059" style="background: url(muntah.jpg) no-repeat 0 0;" >

</svg>

</div>


  <svg height="531" width="1059" style="background: url(atass.jpg) no-repeat 0 0;" >

</svg>


</td>
<td>
<div id="navbar">
  <svg height="40" width="1059" style="background: url(muntahc.jpg) no-repeat 0 0;" >

</svg>

</div>
  <svg height="531" width="1059" style="background: url(atass.jpg) no-repeat 0 0;" >

</svg>
</td>



</table>
<table>
  <td class="sticky-col first-col">Pertama</td>
<td><svg height="531" width="1059" style="background: url(atass.jpg) no-repeat 0 0;" >

</svg></td>
<td><svg height="531" width="1059" style="background: url(atass.jpg) no-repeat 0 0;" >

</svg></td>



</table>
</div>









<br>
<br>




<div class="modal fade" id="propas" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     
                    <h5 class="modal-title">Tambah Program Pasien</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>





<div class="modal fade" id="tanggal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     
                    <h5 class="modal-title">Tanggal</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>



<div class="modal fade" id="suhu" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     
                    <h5 class="modal-title w3-pink">Input Tanda Vital</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>





  <script type="text/javascript">




</script>

<script type="text/javascript">
   $('#urine').keyup(function(){



    console.log('urine')




 });





</script>

<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>


 
    

     



</body>




</html>