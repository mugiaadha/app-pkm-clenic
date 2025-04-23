<?php
	include "sesi.php";
	
		try{
			if(isset($_POST["email"])){
				$email=htmlspecialchars(strtoupper($_POST["email"]));
				$rm=htmlspecialchars(strtoupper($_POST["rm"]));
				$tgll=htmlspecialchars(str_replace("'","''",$_POST["tgl"]));
				$tgl=date_create($tgll);
				$tgl=date_format($tgl,"Y-m-d");
				/*$nama=strtoupper($_GET[nama]);
				$alamat=strtoupper($_GET[alamat]);
				*/
				$kd_dokter=htmlspecialchars(strtoupper($_POST["kd_dokter"]));
				$kd_poli=htmlspecialchars(strtoupper($_POST["kd_poli"]));
				$vip=$_POST["vip"];
				$tgl_daftar=$_POST["tgl_daftar"];
				$geri=$_POST["geri"];
			}
			
			
			$tahun=substr($rm,0,2);
			$nomer=substr($rm,2,7);
		    $rm=$tahun." ".$nomer;
			if (empty($rm)){
				$pesan[]="Maaf No RM Masih Kosong !";
				echo json_encode($pesan);
				exit;
			}
			
			// $pesan= $email."/" . $rm."/".$tgl."/".$kd_dokter."/".$kd_poli."/".$vip."/".$tgl_daftar;

			// echo json_encode($pesan);
			// exit;



			include "koneksi.php";
			//-- cari pasien -------------
			$sql="";
			$sql="select namapasien,alamat from pasien 
				where kd_pasien='$rm' and convert(date,TGL_LAHIR)='$tgl'";
			$query=$db->prepare($sql);
			$query->execute();
			$b=$query->fetch();
			if(!$b){
				$pesan[]="Maaf No RM Atau Tgl Lahir tidak cocok !";
				echo json_encode($pesan);
				exit;
			}
			$nama=$b["namapasien"];
			$alamat=$b["alamat"];
			$query->closeCursor();


			//-------------------------------------------------------------
			$db->beginTransaction();
			$mows=date_create($sekarang);
			$format=date_format($mows,"H:i:s");
			$timer=date($format);
			$form_no=date_format($mows,"ymd");
			$mow=date_format($mows,"Y-m-d");
			
			/*------------------------  Cek hari  ------------------------

			------------------------------------------------------------*/

			if($vip==1 || $geri==1){

				//-------- cek 1 Hari ---------------------------------
				$tgl_lebi=date_format(date_add($mows,date_interval_create_from_date_string("+1 days")),"Y-m-d");
				$tgl_lebih=strtotime($tgl_lebi);
				//-----------------------------------------------------

				$tgl_daftar=date_create($tgl_daftar);
				$tgl_ajust=date_format($tgl_daftar,"Y-m-d");

				//---------- lebih dari 1 hari ------------------------------------
				if(strtotime($tgl_ajust) > $tgl_lebih){
					$db->rollback();
					$pesan[]="Maaf, Pendaftaran maximal 1 Hari sebelum, Pemeriksaan.!";
					echo json_encode($pesan);
					exit;
				}

				//---------- Kurang dari hari H ------------------------------------
				if(strtotime($tgl_ajust) < strtotime($mow)){
					$db->rollback();
					$pesan[]="Maaf, Tgl Pendaftaran yang di masukkan sudah berlalu.!";
					echo json_encode($pesan);
					exit;
				}


				$mow=$tgl_ajust;
				$form_no=date_format($tgl_daftar,"ymd");

			}

			
			$namahari=date('l',strtotime($mow));
			include "hari.php";
			
			//----------- Lihat jadwal ----------------------------------
			$sql="select top (1) $namahari as hari from jadwal_poli
					where  FMJKD_DOKTER='$kd_dokter' and
							FMJKD_KLINIK='$kd_poli' order by hari desc";
			$query=$db->prepare($sql);
			$query->execute();
			$b=$query->fetch();
			if($b){
					/*while (odbc_fetch_row($cari)) {
						$isi=odbc_result($cari,"hari");
						if (!empty($isi)){
							$masukan[]=$isi;  //masukkan ke array
							$jadwal=json_encode($masukan); // enkode ke json
						}
					}
					*/
					$jadwal=$b["hari"];
					//jika kosong	
					if(empty($jadwal)){
						$query->closeCursor();
						$db->rollback();
						$pesan[]="Maaf, dokter tidak praktek, Pilih Dokter yang lain.!";
						echo json_encode($pesan);
						exit;
					}
			}
			else {
				$query->closeCursor();
				$db->rollback();
				$pesan[]="Maaf, dokter tidak praktek, Pilih Dokter yang lain 2.!";
				echo json_encode($pesan);
				exit;
			}
			$query->closeCursor();
			/* -------------- Pecah sesi per sub kembali -----------------------------------
			*/
				$sesi1=substr($jadwal,0,13); 
				$awal=str_replace(" ","",substr($sesi1,0,5));
				$akhir=str_replace(" ","",substr($sesi1,7,6));
			
			/*elseif ($ketemu > 1) {
				$sesi1=substr($jadwal,2,13); 
				$sesi2=substr($jadwal,-15,13);
				$sub1=str_replace(" ","",substr($sesi1,0,5));
				$sub2=str_replace(" ","",substr($sesi1,7,6));
				$sub3=str_replace(" ","",substr($sesi2,0,5));
				$sub4=str_replace(" ","",substr($sesi2,7,6));
			} */
			$akhir=$akhir - 1;
			$akhir=$akhir.".00";
			/* 24-hour time to 12-hour time 
				$time_in_12_hour_format  = date("g:i a", strtotime("13:30"));

			// 12-hour time to 24-hour time 
				$time_in_24_hour_format  = date("H:i", strtotime("1:30 PM"));
			*/
			//Jam Terahir
			$akhir=date_create($akhir);
			$akhir=date_format($akhir,"H.i");
			
			//Jam Awal
			$awal="06.00";
			$awal=date_create($awal);
			$awal=date_format($awal,"H.i");
			
			// Jam Sekarang
			$jam=date_create($sekarang);
			$jam=date_format($jam,"H.i");

			//-----Jalur Khusus VIP----------------------------------------------
			$hari_ini=date_create($sekarang);
			$hari_ini=date_format($hari_ini,"Y-m-d");
			$hari_input=$mow;

			// $db->rollback();
			// $pesan[]="Hari ini : ".$hari_ini." | "."Hari Input :".$hari_input;
			// echo json_encode($pesan);
			// exit;

			if($hari_ini==$hari_input){

				//-------------------batas awal--------------------------------------
				if($awal > $jam) {
					$db->rollback();
					$pesan[]="Maaf, Pendaftaran belum di buka.!";
					echo json_encode($pesan);
					exit;
					
				} 
				//Batas akhir
				if($akhir < $jam) {
					$db->rollback();
					$pesan[]="Maaf, Pendaftaran sudah di tutup.!";
					echo json_encode($pesan);
					exit;
				} 

			}

			
			carinomer :
			//---------------------------------------------------------------------
			$sql="select KD_PASIEN from  ANTRIAN
					where KD_PASIEN='$rm' and
					KD_POLY='$kd_poli' and convert(date,TGL_PERIKSA)='$mow'";
			
			$query=$db->prepare($sql);
			$query->execute();
			$b=$query->fetch();
			if($b) {
				$query->closeCursor();
				$db->rollback();
				$pesan[]="Maaf, Anda Sudah mendaftar dalam poli yang sama.!";
				echo json_encode($pesan);
				exit();
			}
			$query->closeCursor();
			/*------------------------------------------------------------------------------------------------
			  cari Kode antrian dan kuota
			--------------------------------------------------------------------------------------------------*/
			$sql="Select  a.RUANGANTRI,d.FMDDOKTERN,a.RUANGPOLI,d.FMDKUOTA
				  from ANTRIMONITOR a,dokter d
				  where a.KDA_DOKTER=d.FMDDOKTER_ID and a.KDA_DOKTER='$kd_dokter'";
			$query=$db->prepare($sql);
			$query->execute();
			$b=$query->fetch();
			if(!$b) {
				$query->closeCursor();
				$db->rollback();
				$pesan[]="Maaf, Kode Antrian tidak di temukan.!";
				echo json_encode($pesan);
				exit();
			} 
			else {
				$antrian=$b["RUANGANTRI"];
				$nama_dok=$b["FMDDOKTERN"];
				$pol=$b["RUANGPOLI"];
				$kuota=$b["FMDKUOTA"];
				/*$_SESSION[dokter]=$kd_dokter;
				$_SESSION[nama_dok]=$nama_dok;
				$_SESSION[nama_poli]=$kd_poli;
				$_SESSION[ruang_poli]=$pol;
				*/
			}
			$query->closeCursor();
			/*------------------------------------------------------------------------------------------------
			  Cek Sisa Kouta
			
			$sql="Select count(kd_pasien) as status from antrian
				where  KD_POLY='$kd_poli' and convert(date,TGL_PERIKSA)='$mow'
				and KD_DOKTER='$kd_dokter' and  KD_ANTRI='$antrian'";
			$cek=odbc_exec($konek,$sql);
			if(!$cek){
				odbc_rollback($konek);
				Exit("Error Counter");
			}
				$data=odbc_result($cek,"status");
				if($data>=$kuota) {
					echo "<script>
					 alert('Maaf, kuota pendafaran Dokter $nama_dok sudah habis silahkan pilih dokter yang lain, Terima Kasih.');
					  window.location.href='poli.php';
					 </script>";
					exit();
				}
			--------------------------------------------------------------------------------------------------*/

			/*
				---cari data pasien---
			*/
			if($vip==0){
				//--------------- reguler---------------------------------------------
				$sql="select KD_PERUSAHAAN from pasien where kd_pasien='$rm'";
				$query=$db->prepare($sql);
				$query->execute();
				$b=$query->fetch();
				if (!$b) {
					$query->closeCursor();
					$db->rollback();
					$pesan[]="Maaf, Data Pasien tidak valid !.";
					echo json_encode($pesan);
					exit;
				}
				// Identitas Pasien
				$kd_cus=$b["KD_PERUSAHAAN"];
			}
			elseif($vip==1){
				//--------------executive / Tarif Umum----------------------------------------------
				$kd_cus="XXX846";

				// $tgl_daftar=date_create($tgl_daftar);
				// $tgl_ajust=date_format($tgl_daftar,"Y-m-d");
				// $mow=$tgl_ajust;
				// $form_no=date_format($tgl_daftar,"ymd");
			}
			
			$query->closeCursor();
			/*----------------------------------------------------------------------------------------------------------
				Cari Jenis Tarif
			----------------------------------------------------------------------------------------------------------*/
			$sql="select k.FMKJENIS_TARIP from  KELOMPOKCUSTOMER k, CUSTOMER c
				where  k.FMKCUST_ID=c.KELOMPOK_ID and c.CUSID='$kd_cus'";
			$query=$db->prepare($sql);
			$query->execute();
			$b=$query->fetch();
			if (!$b) {
				$query->closeCursor();
				$db->rollback();
				$pesan[]="Maaf, Jenis Tarif tidak ditemukan !.";
				echo json_encode($pesan);
				exit;
			}
			$jen_tarif=$b["FMKJENIS_TARIP"];
			$pasien=2;   // Pas Lama
			$asal_pas=4; //Online
			$query->closeCursor();
			/*-----------------------------------------------------------------------------------------------------------
			  Memberi No transaksi
			 ----------------------------------------------------------------------------------------------------------- 
			-----------------------------------------------------------------------------------------------------------*/
			$umum="PK001";
			$fisio= "PK020";
			$hd="PK32";
			$ozone="PK037";
			
			/*-----------------------------------------------------------------------------------------------------------
				Public Const KodeTrumum = "PK001"
				'2. UNIT GAWAT DARURAT
				Public Const KodeTrUGD = "PK011"
				'3. LABORAT
				Public Const KodeTrLaborat = "PK018"
				'4. RADIOLOGI
				Public Const KodeTrRadio = "PK019"
				'5. FISIOTHERAPI
				Public Const KodeTrFisio = "PK020"
				'6.KAMAR OPERASI
				Public Const KodeTrBedah = "PK002"
				'7.VK
				Public Const KodeTrVK = "PK028"
				'8.KLINIK CUANTIK CH-JESICA-WIJAYA?????
				Public Const KodeTrCD = "PK012"
				Public Const KodeTrHD = "PK32"
				Public Const KodeTROz = "PK037"
				Public Const KodeTrDalam = "PK003"
				
			  ElseIf Txtpoly.Text = MainProc.KodeTrFisio Then
					OpenAutoNumTransaksi5
					Jenistransaksi = MainProc.KodeTrFisio
				ElseIf Txtpoly.Text = MainProc.KodeTrHD Then
					OpenAutoNumTransaksi6
					Jenistransaksi = MainProc.KodeTrHD
				ElseIf Txtpoly.Text = MainProc.KodeTROz Then
					OpenAutoNumTransaksi7
					Jenistransaksi = MainProc.KodeTROz
				Else
					'----- poly
					OpenAutoNumTransaksi
					Jenistransaksi = MainProc.KodeTrumum
				End If
			
			//$kd="BRJ";$kd= "BPF";
			-----------------------------------------------------------------------------------------------------------*/
			//if(empty($tgl_apoit)) {
				//$no_tgl=date_create($sekarang);
				//$no_tgl=date_format($no_tgl,"ymd");
				$no_tgl=$form_no;
			/*}
			else {
				// ------------ apoitmen --------------------------------------------------------------------------------
				$tgl_apoit=date_create($tgl_apoit);
				$format=date_format($tgl_apoit,"Y-m-d H:i:s");
				$tgl_apoit=date($format);
				
				$no_tgl=date_create($tgl_apoit);
				$no_tgl=date_format($no_tgl,"ymd");
			}*/
			//------------------------------------------------------------------------------------------------------------
			
			
			if ($kd_poli==$fisio) {
				$nomer="BPF"."-".$jen_tarif.$no_tgl;
				$jenis="PK020";
			}
			elseif ($kd_poli==$hd) {
				$nomer="BHD"."-".$jen_tarif.$no_tgl;
				$jenis="PK32";
			}
			elseif ($kd_poli==$ozone) {
				$nomer="BOZ"."-".$jen_tarif.$no_tgl;
				$jenis="PK037";
			}
			else {
				$nomer="BRJ"."-".$jen_tarif.$no_tgl;
				$jenis="PK001";
			}

			// carinomer :
			// ---------------Cari Nomer------------------------------------------
			$sql="Select top(1)FTNO_TRANSAKSI from TRANSAKSIPASIEN where left(FTNO_TRANSAKSI,12)='$nomer' ORDER BY FTNO_TRANSAKSI desc";
			$query=$db->prepare($sql);
			$query->execute();
			$b=$query->fetch();
			$urut=$b["FTNO_TRANSAKSI"];
			if ($b) {
				//ambil data
				$awal=substr($urut,13,3);
				$awal=$awal + 1;
				//Hitung jumlah karakter
				$urut=strlen($awal);
				if($urut==1) {
					$jum='00';
				}
				elseif($urut==2) {
					$jum='0';
				}
				elseif($urut==3) {
					$jum='';
				}
				$no_trans=$nomer."-".$jum.$awal;
			}
			else {
				$no_trans=$nomer."-"."001";
			}
			
			$query->closeCursor();
			// Masukkan data ke kunjungan pasien   / ( ambil jam )
			try{
				$sql = " insert into KUNJUNGANPASIEN 
						(KPKD_PASIEN,KPKD_POLY,KPTGL_PERIKSA,KPKD_DOKTER,KD_CUSTOMER,KPJAM_MASUK,KPBARU,KPASALPASIEN,
						KPJENISTRANSAKSI,KPNO_TRANSAKSI)
						values
						(:rm,:kd_poli, :tgl_p,:kd_dokter,:kd_cus,:jam_masuk,:pasien,:asal_pas,:jenis,:no_trans)";
					
				$query=$db->prepare($sql);

				
				$data=array(
							':rm'=>$rm,
							':kd_poli'=>$kd_poli,
							':tgl_p'=>$mow,
							':kd_dokter'=>$kd_dokter,
							':kd_cus'=>$kd_cus,
							':jam_masuk'=>$timer,
							':pasien'=>$pasien,
							':asal_pas'=>$asal_pas,
							':jenis'=>$jenis,
							':no_trans'=>$no_trans
							);
				$query->execute($data);
			}
			catch(PDOException $e){
				goto carinomer;
				// try{
				// 	$awal =$awal +1;
				// 	$urut=strlen($awal);
				// 	if($urut==1) {
				// 		$jum='00';
				// 	}
				// 	elseif($urut==2) {
				// 		$jum='0';
				// 	}
				// 	elseif($urut==3) {
				// 		$jum='';
				// 	}
				// 	// $no_trans=$nomer."-".$jum.$awal;
				// 	$no_trans=$nomer."-".$jum.$awal;
				// 	$sql = "insert into KUNJUNGANPASIEN 
				// 			(KPKD_PASIEN,KPKD_POLY,KPTGL_PERIKSA,KPKD_DOKTER,KD_CUSTOMER,KPJAM_MASUK,KPBARU,KPASALPASIEN,
				// 			KPJENISTRANSAKSI,KPNO_TRANSAKSI)
				// 			values
				// 			(:rm,:kd_poli, :tgl_p,:kd_dokter,:kd_cus,:jam_masuk,:pasien,:asal_pas,:jenis,:no_trans)";
						
				// 	$query=$db->prepare($sql);
				// 	$data=array(
				// 				':rm'=>$rm,
				// 				':kd_poli'=>$kd_poli,
				// 				':tgl_p'=>$mow,
				// 				':kd_dokter'=>$kd_dokter,
				// 				':kd_cus'=>$kd_cus,
				// 				':jam_masuk'=>$timer,
				// 				':pasien'=>$pasien,
				// 				':asal_pas'=>$asal_pas,
				// 				':jenis'=>$jenis,
				// 				':no_trans'=>$no_trans
				// 				);
				// 	$query->execute($data);
				// }
				// catch(PDOException $e){
				// 		$db->rollback();
				// 		$db=null;
				// 		echo json_encode($e->getMessage());
				// 		exit;
				// }
			}
				
				$query->closeCursor();

			//--------------------------------------------------------------------

			/*
					0 = telp
					1 = anjungna
					2 = online
				*/
			//Masukkan data ke Transaksi pasien
				$sql = " insert into TRANSAKSIPASIEN 
						(FTKD_PASIEN,FTKD_UNIT,FTTGL_TRANSAKSI,FTNO_TRANSAKSI,USERRS,UPDATERS,STS,VIP) 
						values
						(:rm,:kd_poli,:tgl_p,:no_trans,:user,:update,:sts,:vip)";


				$query=$db->prepare($sql);
				
					$data=array(
							':rm'=>$rm,
							':kd_poli'=>$kd_poli,
							':tgl_p'=>$mow,
							':no_trans'=>$no_trans,
							':user'=>"Online",
							':update'=>$sekarang,
							':sts'=>'2',
							':vip'=>$vip
							);
					
				// 	echo json_encode($data);
				// $db->rollback();
				// exit;
				
				$query->execute($data);
				$query->closeCursor();


			/*------------------------------------------------------------------------------------------------
			  cari no urut
			--------------------------------------------------------------------------------------------------*/
			
		
			$sql="select top(1) NO_URUT from ANTRIAN
					where
					KD_ANTRI='$antrian' and
					convert(date,TGL_PERIKSA)='$mow' and
					KD_POLY='$kd_poli' and
					KD_DOKTER='$kd_dokter' order by NO_URUT desc";
			
			$query=$db->prepare($sql);
			$query->execute();
			$b=$query->fetch();
			//------------------------cari no awal Dokter---------------------------------
			$sql="";
			$sql="select FMDNO_ANTRIAN from Dokter
				where FMDDOKTER_ID='$kd_dokter'";
			$query=$db->prepare($sql);
			$query->execute();
			$c=$query->fetch();
			$no_awal=$c["FMDNO_ANTRIAN"];
			//------------- cek no awal tidak 0 -----------------------------
			if($no_awal==0) {
				$query->closeCursor();
				$db->rollback();
				$pesan[]="Maaf, Settingan No Start Antrian Dokter $nama_dok Tidak boleh 0, Terima Kasih.";
				echo json_encode($pesan);
				exit();
			}
				//----------------------------------------------------------------
			if($b){
				$no=$b["NO_URUT"];
				if($no>=$kuota){
					$query->closeCursor();

					//---------- Cek Pembatalan------------------------'
					$sql="";
					$sql="select top(1) no_urut from antrian_batal where tgl_periksa='".$mow."' and
						sts=0 and kd_poly='".$kd_poli."' and
						kd_dokter='".$kd_dokter."' order by no_urut asc";
					$query=$db->prepare($sql);
					$query->execute();
					$h=$query->fetch();
					if($h){
						$no_urut=$h["no_urut"];
						$query->closeCursor();
						//---------- Update Antrian Batal---------------------------------
						$sql="";
						$sql="update antrian_batal set
							sts=1 where tgl_periksa='".$mow."' and
							kd_poly='".$kd_poli."' and
							kd_dokter='".$kd_dokter."' and no_urut='".$no_urut."'";
						$query=$db->prepare($sql);
						$query->execute();
						goto lanjut;

					}
					else{
						$db->rollback();
						//--------- Masukkan Log--------------------------------------
						$sql="select kd_pasien from antrian_tolak where 
								kd_poly='".$kd_poli."' and kd_pasien='".$rm."' and 
								kd_dokter='".$kd_dokter."' and convert(date,tgl_periksa)='".$mow."'";


						$query=$db->prepare($sql);
						$query->execute();
						$c=$query->fetch();
						if(!$c){
							$sql="insert into antrian_tolak
								(KD_PASIEN, KD_POLY, KD_DOKTER, TGL_PERIKSA, STS, VIP) values
								('".$rm."','".$kd_poli."','".$kd_dokter."','".$sekarang."','"."2"."','".$vip."')";

							$query=$db->prepare($sql);
							$query->execute();
						}
						$query->closeCursor();

						$pesan[]="Maaf, kuota pendafaran Dokter $nama_dok sudah habis silahkan pilih dokter yang lain, Terima Kasih.";
						echo json_encode($pesan);
						exit();
					}
				}
				
				// --------Khusus Online-----------------------------------------
				if($no_awal > $no) { 
					   $no_urut=$no_awal;   // NOmer Kurang dari nomer awal   
				}
				else {
							
							/*------------ No Exclusive loncat-------------------------------------
							$ex=8;
							$ex2=16;
							if(($no+1 ==$ex) or($no+1 ==$ex2)) {
								$no_urut=$no + 2 ;
							}			
							else {
								$no_urut=$no + 1 ;
							}
							----------------------------------------------------------------*/
					$no_urut=$no + 1 ;			
				}
			}
			else {
				// dimulai dari angka 6
				$no_urut=$no_awal;
			}	
			$query->closeCursor();	
			//----------------------------------------------------------------------------------------
			//--------------Cek no_antrian------------------------------------------------------------
			$sql="select NO_URUT from ANTRIAN where 
					KD_ANTRI='$antrian' and
					convert(date,TGL_PERIKSA)='$mow' and
					KD_POLY='$kd_poli' and
					KD_DOKTER='$kd_dokter' and NO_URUT='".$no_urut."' order by NO_URUT desc";
			$query=$db->prepare($sql);
			$query->execute();
			$d=$query->fetch();
			if($d){
				$no_urut=$no_urut+1;
			}
			$query->closeCursor();

			//----------------------------------------------------------------------------------------
			/*------------------  Simpan Antrian telp------------------------------
			----------------------------------------------------------------------*/
	lanjut :
			$status="ANTRI";
			
			$sql = "insert into ANTRIAN
					  (NO_URUT,KD_ANTRI,kd_PASIEN,Tgl_periksa,JAM_daftar,TGLLAHIR,NM_DOKTER,NO_transaksi,KD_POLY,KD_DOKTER,PANGGIL_KE,STATUS_ANTRI,NM_PASIEN,STS,TGL_APOITMEN,USR_EMAIL,VIP,GERI)
					   Values
					  (:no,:antri,:rm,:tgl_p,:jam_daftar,:tgl_lahir,:nama_dok,:no_trans,:kd_poli,:kd_dokter,:panggil,:status,:nama_pas,:sts,:tgl_appoit,:email,:vip,:geri)";
			$query=$db->prepare($sql);
			$data=array(
								':no'=>$no_urut,
								':antri'=>$antrian,
								':rm'=>$rm,
								':tgl_p'=>$mow,
								':jam_daftar'=>$sekarang,
								':tgl_lahir'=>$tgl,
								':nama_dok'=>$nama_dok,
								':no_trans'=>$no_trans,
								':kd_poli'=>$kd_poli,
								':kd_dokter'=>$kd_dokter,
								':panggil'=>'0',
								':status'=>$status,
								':nama_pas'=>$nama,
								':sts'=>'2',
								':tgl_appoit'=>$tgl_apoit,
								':email'=>$email,
								':vip'=>$vip,
								':geri'=>$geri
							);
				
				//----------------------------------------------------------------------
				$query->execute($data);
				$query->closeCursor();
				//-----------------------------------------------------------------------------------------------------------------
				
			
			$db->commit();
			$db=null;
			$pesan[]=array(
							' ok '=>"Pendaftaran Berhasil !"
							);
			
			echo json_encode($pesan);
			
		}
		catch(PDOException $e){
			$db->rollback();
			$db=null;
			echo json_encode($e->getMessage());
			//
			
		}
	?>
