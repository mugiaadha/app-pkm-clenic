<!-- 
  <div class="container">
    <h1 class="title"></h1>
    <div class="d-flex justify-content-center mb-4 mt-5" id="display-antrian">
      <div class="card text-dark bg-light mb-3">
        <div class="card-header">
          <h1 style="text-align: center">ANTRIAN LOKET</h1>
        </div>
        <div class="card-body">
          <h1 class="nomor-antrian antrian-display">1</h1>
          <h2 style="text-align: center">2022-08-20</h2>
        </div>
        <div id="cetak-antrian" style="display: none;" class="cetak">
          <div style="width: 180px; font-family: Tahoma; margin-top: 10px; margin-right: 5px; margin-bottom: 100px; margin-left: 10px; font-size: 21px !important;">
            <div id="print_nomor_loket"></div>
            <div style="text-align: center">
              <p style="text-align: center">ANTRIAN<br>PENDAFTARAN</p>
              <h1 id="no-antrian" class="nomor-antrian" style="font-size: 3em;">1</h1>
              <p id="date">2022-08-20</p>
            </div>            
          </div>
        </div>
      </div>
    </div>    
    <div class="d-flex justify-content-center">
      <button id="tambah-antrian" type="button" class="btn btn-primary btn-lg" onclick="printDiv();">Ambil Nomor Antrian</button>
    </div>
  </div>

  <script src="recta.js"></script>
  <script>
    var targetUrl = "/tambah-antrian/{{ $kode }}"; 
    $(document).on('click', "#tambah-antrian", function(){
      printTiket(targetUrl);
    });

    function printTiket(target){
      $.ajax({
        type:'get',
        url:target,
        success: function(data) {
          $('.nomor-antrian').html(data);
        }
      });
    }

    var printer = new Recta('apbatech1234!!', '1811')

    function printDiv(){
     ;

      printer.open().then(function () {
        printer.align('center')
          .mode('A', false, true, true, false)
          .bold(true)
          .text('ANTRIAN')
          .text('PENDAFTARAN')
          .feed(3)
          .text('20')
          .feed(3)
          .text('2022-02-2023')
          .feed(6)
          .cut()
          .print()
      })
    }

  </script>
 -->
<!DOCTYPE html>
<html lang="en">
 <body onload="startgame();">
  

  </body>
    <!-- <button  onclick="onClick();">Ambil Nomor Antrian</button> -->

</html>

 <script src="recta.js"></script>


 <script type="text/javascript">
  // ...
  var printer = new Recta('5987678286', '1811')

  function onClick () {
    printer.open().then(function () {
      printer.align('center')
         .mode('A', false, true, true, false)
          .bold(true)
          .text('ANTRIAN')
          .text('PENDAFTARAN')
          .feed(3)
          .text('20')
          .feed(3)
          .text('2022-02-2023')
          .feed(6)
          .cut()
          .print()
    })
  }
  // ...
</script>
