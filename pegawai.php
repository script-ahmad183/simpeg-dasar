<?php require_once('Connections/koneksi.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "register-diri")) {
	if(!empty($_FILES['foto']['name'])){
		$ukuran=$_FILES['foto']['size'];
		$file_tmp=$_FILES['foto']['tmp_name'];
		$folder='dist/img/';
		$nama1=$_POST['nama'];
		$extension = strtolower(end(explode('.', $_FILES['foto']['name'])));
		$direktori=$folder.$nama1.'.'.$extension;
		$upload=$_FILES['foto'];
		move_uploaded_file($upload['tmp_name'],"dist/img/".$nama1.'.'.$extension);
		$file=$upload['name'];
	}else {
		$direktori ="Gambar Tidak Tersedia";}
		 $insertSQL1 = sprintf("INSERT INTO pegawai (nama, nip, tpt_lhr, tgl_lhr, jenis_kelamin, gol_darah, agama, status_pernikahan, no_telp, alamat, pendidikan, status_kepegawaian, id_seksi, id_pangkat, jabatan, foto) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['nip'], "text"),
                       GetSQLValueString($_POST['tpt_lhr'], "text"),
                       GetSQLValueString($_POST['tgl_lhr'], "date"),
                       GetSQLValueString($_POST['jenis_kelamin'], "text"),
                       GetSQLValueString($_POST['gol_darah'], "text"),
                       GetSQLValueString($_POST['agama'], "text"),
                       GetSQLValueString($_POST['status_pernikahan'], "text"),
                       GetSQLValueString($_POST['no_telp'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['pendidikan'], "text"),
                       GetSQLValueString($_POST['status_kepegawaian'], "text"),
                       GetSQLValueString($_POST['id_seksi'], "int"),
                       GetSQLValueString($_POST['id_pangkat'], "int"),
                       GetSQLValueString($_POST['jabatan'], "text"),
                       GetSQLValueString($direktori, "text"));

	
  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL1, $koneksi) or die(mysql_error());
  
  $cek = "SELECT * FROM pegawai ORDER BY id DESC LIMIT 1";
	$pegawai = mysql_query($cek, $koneksi) or die(mysql_error());
	$row_id = mysql_fetch_assoc($pegawai);
	$idp = $row_id['id'];
	
  $insertSQL = sprintf("INSERT INTO gaji (id_pegawai, gaji_pokok, tunjangan_istri, tunjangan_anak, tunjangan_umum, tunjangan_fungsional, tunjangan_lainnya, utang_kepada_negara, iuran_wajib_pegawai, pph21, potongan_lainnya) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
  						GetSQLValueString($idp, "int"),
                       GetSQLValueString($_POST['gaji_pokok'], "int"),
                       GetSQLValueString($_POST['tunjangan_istri'], "int"),
                       GetSQLValueString($_POST['tunjangan_anak'], "int"),
                       GetSQLValueString($_POST['tunjangan_umum'], "int"),
                       GetSQLValueString($_POST['tunjangan_fungsional'], "int"),
                       GetSQLValueString($_POST['tunjangan_lainnya'], "int"),
                       GetSQLValueString($_POST['utang_kepada_negara'], "int"),
                       GetSQLValueString($_POST['iuran_wajib_pegawai'], "int"),
                       GetSQLValueString($_POST['pph21'], "int"),
                       GetSQLValueString($_POST['potongan_lainnya'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result2 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
  $insertGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  ?>
        <script>
            alert("Data berhasil ditambah");
        </script>
        <meta http-equiv="refresh" content="0";url="index.php?page=pegawai" />
    <?php


}

mysql_select_db($database_koneksi, $koneksi);
$query_pegawai = "SELECT pegawai.*,seksi.nama_seksi FROM pegawai inner join seksi on pegawai.id_seksi=seksi.id ORDER BY nama ASC";
$pegawai = mysql_query($query_pegawai, $koneksi) or die(mysql_error());
$row_pegawai = mysql_fetch_assoc($pegawai);
$totalRows_pegawai = mysql_num_rows($pegawai);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-12">
                <h1>
                  <small>Pegawai</small>
				  <?php if($row_login['level']=="Administrator"){?>
                    <button class="btn btn-xs btn-success float-right" data-toggle="modal" data-target="#tambah-pegawai">tambah</button>
                   	<?php }?>
                </h1>
              </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead style="font-size:12px">
                  <tr>
                    <th style="width:5%">#</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Seksi</th>
                    <th>Jabatan</th>
                    <?php if($row_login['level']=="Administrator"){?>
                    <th style="width:11%">Aksi</th>
                    <?php }?>
                  </tr>
                  </thead>
                  <?php if($totalRows_pegawai>0){?>
                  <tbody style="font-size:12px">
                    <?php $i=1;?>
                    <?php do { ?>
                    <tr>
                      <td><?php echo $i++; ?></td>
                       <td>
					   	<a href="?page=detail&id=<?php echo $row_pegawai['id']; ?>">
					  		<?php echo $row_pegawai['nama']; ?>
                        </a>
                      </td>
                      <td><?php echo $row_pegawai['nip']; ?></td>
                      <td><?php echo $row_pegawai['nama_seksi']; ?></td>
                      <td> <?php echo $row_pegawai['jabatan']; ?></td>
                        <?php if($row_login['level']=="Administrator"){?>
                      <td>
                         <a rel="<?php echo $row_pegawai['id']; ?>" rel1="pegawai" class="hapusData">
                            <button class="btn btn-danger btn-xs">Hapus</button >
                        </a>
                      </td>
                      <?php } ?>
                    </tr>
                      <?php } while ($row_pegawai = mysql_fetch_assoc($pegawai)); ?>
                     </tbody>
                    <?php } ?>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
  </section>
      <!-- /.content -->
    </div>
    
<div class="modal fade" id="tambah-pegawai" style="font-size:12px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Pegawai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form role="form" method="POST" action="<?php echo $editFormAction; ?>" name="register-diri" autocomplete="off" enctype="multipart/form-data">
<input name="gaji_pokok" type="hidden" value="0" />
<input name="tunjangan_istri" type="hidden" value="0" />
<input name="tunjangan_anak" type="hidden" value="0" />
<input name="tunjangan_umum" type="hidden" value="0" />
<input name="tunjangan_fungsional" type="hidden" value="0" />
<input name="tunjangan_lainnya" type="hidden" value="0" />
<input name="utang_kepada_negara" type="hidden" value="0" />
<input name="iuran_wajib_pegawai" type="hidden" value="0" />
<input name="pph21" type="hidden" value="0" />
<input name="potongan_lainnya" type="hidden" value="0" />
                          <div class="form-group">
                            <label for="exampleInputEmail1">NIP</label>
                            <input type="text" class="form-control" name="nip" onkeypress="return hanyaAngka(event)" required>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" name="nama" required>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tpt_lhr" required>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lhr" required>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Jenis Kelamin</label>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio1" name="jenis_kelamin" value="Laki-Laki" required>
                                <label for="customRadio1" class="custom-control-label">Laki-Laki</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio2" name="jenis_kelamin" value="Perempuan" required>
                                <label for="customRadio2" class="custom-control-label">Perempuan</label>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Golongan Darah</label>
                            <input type="text" class="form-control" name="gol_darah" onkeyup="this.value = this.value.toUpperCase();" required>
                          </div>
                          <div class="form-group">
                            <label>Agama</label>
                            <select class="custom-select" name="agama" required>
                              <option value="">Pilih</option>
                              <option value="Islam">Islam</option>
                              <option value="Protestan">Protestan</option>
                              <option value="Katholik">Katholik</option>
                              <option value="Hindu">Hindu</option>
                              <option value="Buddha">Buddha</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Pendidikan</label>
                            <select class="custom-select" name="pendidikan" required>
                              <option value="">Pilih</option>
                              <option value="SD">SD</option>
                              <option value="SMP">SMP</option>
                              <option value="SMA">SMA</option>
                              <option value="D1">D1</option>
                              <option value="D2">D2</option>
                              <option value="D3">D3</option>
                              <option value="D4/S1">D4/S1</option>
                              <option value="S2">S2</option>
                              <option value="S3">S3</option>
                              </select>
                          </div>
                          <div class="form-group">
                            <label>Status</label>
                            <select class="custom-select" name="status_pernikahan" required>
                              <option value="">Pilih</option>
                              <option value="Belum Menikah">Belum Menikah</option>
                              <option value="Menikah">Menikah</option>
                              <option value="Janda">Janda</option>
                              <option value="Duda">Duda</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Telepon</label>
                            <input type="text" class="form-control"  onkeypress="return hanyaAngka(event)" name="no_telp" required>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Alamat</label>
                            <textarea class="form-control" name="alamat" required></textarea>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Status Kepegawaian</label>
                            <select class="custom-select" name="status_kepegawaian" required>
                                <option value="">Pilih</option>
                              <option value="PNS">PNS</option>
                              <option value="PPNPN">PPNPN</option>
                              <option value="Honorer">Honorer</option>
                              </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Seksi</label>
                            <select class="custom-select" name="id_seksi" required>
                              <option value="">Pilih</option>
                              <?php
do {  
?>
                              <option value="<?php echo $row_seksi['id']?>"><?php echo $row_seksi['nama_seksi']?></option>
                              <?php
} while ($row_seksi = mysql_fetch_assoc($seksi));
  $rows = mysql_num_rows($seksi);
  if($rows > 0) {
      mysql_data_seek($seksi, 0);
	  $row_seksi = mysql_fetch_assoc($seksi);
  }
?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Pangkat Golongan</label>
                            <select class="custom-select" name="id_pangkat" required>
                              <option value="">Pilih</option>
                              <?php
do {  
?>
                              <option value="<?php echo $row_pangkat['id']?>"><?php echo $row_pangkat['golongan']?>-<?php echo $row_pangkat['keterangan']?></option>
                              <?php
} while ($row_pangkat = mysql_fetch_assoc($pangkat));
  $rows = mysql_num_rows($pangkat);
  if($rows > 0) {
      mysql_data_seek($pangkat, 0);
	  $row_pangkat = mysql_fetch_assoc($pangkat);
  }
?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Jabatan</label>
                            <select class="custom-select" name="jabatan" required>
                              <option value="">Pilih</option>
                              <option value="Kepala Kantor">Kepala Kantor</option>
                              <option value="Kepala Seksi">Kepala Seksi</option>
                              <option value="CSO">CSO</option>
                              <option value="FO">FO</option>
                              <option value="Staff">Staff</option>
                              </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputFile">Foto</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="form-control" name="foto" accept="image/*" id="exampleInputFile">
                              </div>
                            </div>
                          </div>
                        </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Selanjutnya</button>
                </div>
                <input type="hidden" name="MM_insert" value="register-diri">
              </form>
      </div>
    </div>
      <!-- /.modal-content -->
</div>
    <!-- /.modal-dialog -->
<form name="gaji" method="post" action="">

</form>
<?php
mysql_free_result($pegawai);
?>
