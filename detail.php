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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "edit-prestasi")) {
  $updateSQL = sprintf("UPDATE prestasi SET id_pegawai=%s, nama_prestasi=%s, tgl_perolehan=%s, pemberi_prestasi=%s WHERE id=%s",
                       GetSQLValueString($_POST['id_pegawai'], "text"),
                       GetSQLValueString($_POST['nama_prestasi'], "text"),
                       GetSQLValueString($_POST['tgl_perolehan'], "date"),
                       GetSQLValueString($_POST['pemberi_prestasi'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());

  $updateGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  ?>
        <script>
			window.history.back(-2);
        </script>
         <meta http-equiv="refresh" content="0" />
 <?php
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "t_prestasi")) {
  $insertSQL = sprintf("INSERT INTO prestasi (id_pegawai, nama_prestasi, tgl_perolehan, pemberi_prestasi) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_pegawai'], "text"),
                       GetSQLValueString($_POST['nama_prestasi'], "text"),
                       GetSQLValueString($_POST['tgl_perolehan'], "date"),
                       GetSQLValueString($_POST['pemberi_prestasi'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
 ?>
        <script>
			window.history.back(-2);
        </script>
         <meta http-equiv="refresh" content="0" />
 <?php
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "edit-pendidikan")) {
  $updateSQL = sprintf("UPDATE pendidikan SET id_pegawai=%s, tingkatan_pendidikan=%s, nama_sekolah=%s, tahun_masuk=%s, tahun_lulus=%s, no_ijazah=%s WHERE id=%s",
                       GetSQLValueString($_POST['id_pegawai'], "text"),
                       GetSQLValueString($_POST['tingkat_pendidikan'], "text"),
                       GetSQLValueString($_POST['nama_sekolah'], "text"),
                       GetSQLValueString($_POST['tahun_masuk'], "text"),
                       GetSQLValueString($_POST['tahun_lulus'], "text"),
                       GetSQLValueString($_POST['no_ijazah'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());

  $updateGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  ?>
        <script>
			window.history.back(-2);
        </script>
         <meta http-equiv="refresh" content="0" />
 <?php
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "t_pendidikan")) {
  $insertSQL = sprintf("INSERT INTO pendidikan (id_pegawai, tingkatan_pendidikan, nama_sekolah, tahun_masuk, tahun_lulus, no_ijazah) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_pegawai'], "text"),
                       GetSQLValueString($_POST['tingkat_pendidikan'], "text"),
                       GetSQLValueString($_POST['nama_sekolah'], "text"),
                       GetSQLValueString($_POST['tahun_masuk'], "text"),
                       GetSQLValueString($_POST['tahun_lulus'], "text"),
                       GetSQLValueString($_POST['no_ijazah'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  ?>
        <script>
			window.history.back(-2);
        </script>
         <meta http-equiv="refresh" content="0" />
        
 <?php
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "edit_keluarga")) {
  $updateSQL = sprintf("UPDATE keluarga SET id_pegawai=%s, nama_keluarga=%s, tpt_lhr_keluarga=%s, tgl_lhr_keluarga=%s, alamat_keluarga=%s, pendidikan_keluarga=%s, pekerjaan_keluarga=%s, status_hubungan_keluarga=%s WHERE id=%s",
                       GetSQLValueString($_POST['id_pegawai'], "text"),
                       GetSQLValueString($_POST['nama_keluarga'], "text"),
                       GetSQLValueString($_POST['tpt_lhr_keluarga'], "text"),
                       GetSQLValueString($_POST['tgl_lhr_keluarga'], "date"),
                       GetSQLValueString($_POST['alamat_keluarga'], "text"),
                       GetSQLValueString($_POST['pendidikan_keluarga'], "text"),
                       GetSQLValueString($_POST['pekerjaan_keluarga'], "text"),
                       GetSQLValueString($_POST['status_hubungan'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());

  $updateGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  ?>
        <script>
			window.history.back(-2);
        </script>
         <meta http-equiv="refresh" content="0" />
        
 <?php
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "t_keluarga")) {
  $insertSQL = sprintf("INSERT INTO keluarga (id_pegawai, nama_keluarga, tpt_lhr_keluarga, tgl_lhr_keluarga, alamat_keluarga, pendidikan_keluarga, pekerjaan_keluarga, status_hubungan_keluarga) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_pegawai'], "text"),
                       GetSQLValueString($_POST['nama_keluarga'], "text"),
                       GetSQLValueString($_POST['tpt_lhr_keluarga'], "text"),
                       GetSQLValueString($_POST['tgl_lhr_keluarga'], "date"),
                       GetSQLValueString($_POST['alamat_keluarga'], "text"),
                       GetSQLValueString($_POST['pendidikan_keluarga'], "text"),
                       GetSQLValueString($_POST['pekerjaan_keluarga'], "text"),
                       GetSQLValueString($_POST['status_hubungan'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
 ?>
        <script>
			window.history.back(-2);
        </script>
         <meta http-equiv="refresh" content="0" />
        
 <?php
}

$colname_data = "-1";
if (isset($_GET['id'])) {
  $colname_data = $_GET['id'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_data = sprintf("SELECT pegawai.*,seksi.*,pangkat.* FROM pegawai inner join seksi on pegawai.id_seksi=seksi.id  inner join pangkat on pegawai.id_pangkat=pangkat.id WHERE pegawai.id = %s", GetSQLValueString($colname_data, "int"));
$data = mysql_query($query_data, $koneksi) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

$colname_keluarga = "-1";
if (isset($_GET['id'])) {
  $colname_keluarga = $_GET['id'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_keluarga = sprintf("SELECT * FROM keluarga WHERE id_pegawai = %s", GetSQLValueString($colname_keluarga, "text"));
$keluarga = mysql_query($query_keluarga, $koneksi) or die(mysql_error());
$row_keluarga = mysql_fetch_assoc($keluarga);
$totalRows_keluarga = mysql_num_rows($keluarga);

$colname_pendidikan = "-1";
if (isset($_GET['id'])) {
  $colname_pendidikan = $_GET['id'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_pendidikan = sprintf("SELECT * FROM pendidikan WHERE id_pegawai = %s", GetSQLValueString($colname_pendidikan, "text"));
$pendidikan = mysql_query($query_pendidikan, $koneksi) or die(mysql_error());
$row_pendidikan = mysql_fetch_assoc($pendidikan);
$totalRows_pendidikan = mysql_num_rows($pendidikan);

$colname_gaji = "-1";
if (isset($_GET['id'])) {
  $colname_gaji = $_GET['id'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_gaji = sprintf("SELECT * FROM gaji WHERE id_pegawai = %s", GetSQLValueString($colname_gaji, "text"));
$gaji = mysql_query($query_gaji, $koneksi) or die(mysql_error());
$row_gaji = mysql_fetch_assoc($gaji);
$totalRows_gaji = mysql_num_rows($gaji);

$colname_prestasi = "-1";
if (isset($_GET['id'])) {
  $colname_prestasi = $_GET['id'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_prestasi = sprintf("SELECT * FROM prestasi WHERE id_pegawai = %s", GetSQLValueString($colname_prestasi, "text"));
$prestasi = mysql_query($query_prestasi, $koneksi) or die(mysql_error());
$row_prestasi = mysql_fetch_assoc($prestasi);
$totalRows_prestasi = mysql_num_rows($prestasi);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil Pegawai</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img"
                       src="<?php echo $row_data['foto']; ?>"
                       alt="User profile picture" >
                </div>

                <h3 class="profile-username text-center"><?php echo $row_data['nama']; ?></h3>
                <p class="text-muted text-center"><?php echo $row_data['nip']; ?></p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Golongan</b> <a class="float-right"><?php echo $row_data['golongan']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Pangkat</b> <a class="float-right"><?php echo $row_data['keterangan']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Seksi</b> <a class="float-right"><?php echo $row_data['nama_seksi']; ?></a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#profil" data-toggle="tab" style="font-size:12px"><i class="far fa-id-card"> &nbsp;</i> Profil</a></li>
                  <li class="nav-item"><a class="nav-link" href="#keluarga" data-toggle="tab"  style="font-size:12px"><i class="fas fa-user-friends"> &nbsp;</i> Keluarga</a></li>
                  <li class="nav-item"><a class="nav-link" href="#pendidikan" data-toggle="tab"  style="font-size:12px"><i class="fas fa-user-graduate"> &nbsp;</i> Pendidikan</a></li>
                  <li class="nav-item"><a class="nav-link" href="#gaji" data-toggle="tab"  style="font-size:12px"><i class="far fa-money-bill-alt"> &nbsp;</i> Gaji & Tunjangan</a></li>
                  <li class="nav-item"><a class="nav-link" href="#prestasi" data-toggle="tab"  style="font-size:12px"><i class="fas fa-award"> &nbsp;</i> Prestasi</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="profil" style="font-size:12px">
                    <b>Data Pribadi</b> 
                    <?php if($row_login['level']=="Administrator"){?>
                      <a href="?page=edit_profil&id=<?php echo $_GET['id']; ?>">
                      <button class="badge bg-success">Edit Data</button>
                      </a>
                      <?php }?>
                    <table style="width:100%"; align="center" cellpadding="6">
                      <tr>
                        <td align="right" style="width:35%"><b>Nama Lengkap</b></td>
                        <th style="width:5%"></th>
                        <td><?php echo $row_data['nama']; ?></td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>NIP</b></td>
                        <th style="width:5%"></th>
                        <td><?php echo $row_data['nip']; ?></td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Jenis Kelamin</b></td>
                        <th style="width:5%"></th>
                        <td><?php echo $row_data['jenis_kelamin']; ?></td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Tempat, Tanggal Lahir</b></td>
                        <th style="width:5%"></th>
                        <td><?php echo $row_data['tpt_lhr']; ?>, <?php echo $row_data['tgl_lhr']; ?></td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Agama</b></td>
                        <th style="width:5%"></th>
                        <td><?php echo $row_data['agama']; ?></td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Telepon</b></td>
                        <th style="width:5%"></th>
                        <td><?php echo $row_data['no_telp']; ?></td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Golongan Darah</b></td>
                        <th style="width:5%"></th>
                        <td><?php echo $row_data['gol_darah']; ?></td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Status Pernikahan</b></td>
                        <th style="width:5%"></th>
                        <td><?php echo $row_data['status_pernikahan']; ?></td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Alamat</b></td>
                        <th style="width:5%"></th>
                        <td><?php echo $row_data['alamat']; ?></td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Status Kepegawaian</b></td>
                        <th style="width:5%"></th>
                        <td><?php echo $row_data['status_kepegawaian']; ?></td>
                      </tr>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="keluarga" style="font-size:12px">
                    <b>Data Keluarga </b> 
                     <?php if($row_login['level']=="Administrator"){?>
                    <button class="badge bg-success" data-toggle="modal" data-target="#tambah-keluarga">tambah</button>
                   	<?php }?>
                    <br><br>
                  <table class="table table-bordered" style="width:100%">
                      <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Tempat, Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Pendidikan</th>
                        <th>Pekerjaan</th>
                        <th>Status Hubungan</th>
                        <?php if($row_login['level']=="Administrator"){?>
                        <th style="width:13%">Aksi</th>
                        <?php } ?>
                      </tr>
                      <?php $i=1;?>
                      <?php if($totalRows_keluarga>0){?>
                      <?php  do { ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row_keluarga['nama_keluarga']; ?></td>
                        <td><?php echo $row_keluarga['tpt_lhr_keluarga']; ?>, <?php echo $row_keluarga['tgl_lhr_keluarga']; ?></td>
                        <td><?php echo $row_keluarga['alamat_keluarga']; ?></td>
                        <td><?php echo $row_keluarga['pendidikan_keluarga']; ?></td>
                        <td><?php echo $row_keluarga['pekerjaan_keluarga']; ?></td>
                        <td><?php echo $row_keluarga['status_hubungan_keluarga']; ?></td>
                        <?php if($row_login['level']=="Administrator"){?>
                        <th><button class="badge bg-blue" data-toggle="modal" data-target="<?php echo "#edit-keluarga".$row_keluarga['id']; ?>">edit</button>
                            <a rel="<?php echo $row_keluarga['id']; ?>" rel1="keluarga" class="hapusData">
                            <button class="badge bg-red">hapus</button></a>
                        </th>
                        <?php } ?>
                        
                      </tr>
  <div class="modal fade" id="<?php echo "edit-keluarga".$row_keluarga['id']; ?>" style="font-size:12px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Keluarga</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="POST" action="<?php echo $editFormAction; ?>" name="edit_keluarga" autocomplete="off">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" name="nama_keluarga" value="<?php echo $row_keluarga['nama_keluarga']; ?>" class="form-control" >
              <input type="hidden" name="id" value="<?php echo $row_keluarga['id']; ?>" class="form-control" >
              <input type="hidden" name="id_pegawai" value="<?php echo $row_keluarga['id_pegawai']; ?>" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tempat Lahir</label>
                <input type="text" name="tpt_lhr_keluarga" value="<?php echo $row_keluarga['tpt_lhr_keluarga']; ?>" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Lahir</label>
                <input type="date" name="tgl_lhr_keluarga" value="<?php echo $row_keluarga['tgl_lhr_keluarga']; ?>" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <input type="text" name="alamat_keluarga" value="<?php echo $row_keluarga['alamat_keluarga']; ?>" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Pendidikan Terakhir</label>
                  <select name="pendidikan_keluarga" class="form-control" required>
                    <option value="<?php echo $row_keluarga['pendidikan_keluarga']; ?>" selected><?php echo $row_keluarga['pendidikan_keluarga']; ?></option>
                    <option value="Tidak Ada">Tidak Ada</option>
                    <option value="TK">TK</option>
                    <option value="SD">SD</option>
                    <option value="SLTP">SLTP</option>
                    <option value="SLTA">SLTA</option>
                    <option value="D1">D1</option>
                    <option value="D2">D2</option>
                    <option value="D3">D3</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                  </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Pekerjaan</label>
                <input type="text" name="pekerjaan_keluarga" value="<?php echo $row_keluarga['pekerjaan_keluarga']; ?>" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Status Hubungan</label>
                  <select name="status_hubungan" class="form-control" required>
                    <option value="<?php echo $row_keluarga['status_hubungan_keluarga']; ?>" selected><?php echo $row_keluarga['status_hubungan_keluarga']; ?></option>
                    <option value="Ayah">Ayah</option>
                    <option value="Ibu">Ibu</option>
                    <option value="Istri">Istri</option>
                    <option value="Suami">Suami</option>
                    <option value="Anak">Anak</option>
                  </select>
              </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
          <input type="hidden" name="MM_update" value="edit_keluarga">
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
   <?php } while ($row_keluarga = mysql_fetch_assoc($keluarga)); } ?>
                  </table>
                </div>
                  <div class="tab-pane" id="pendidikan" style="font-size:12px">
                    <b>Data Pendidikan </b>
                    <?php if($row_login['level']=="Administrator"){?>
                    <button class="badge bg-success" data-toggle="modal" data-target="#tambah-pendidikan">tambah</button>
                    <?php } ?>
                    <br><br>
                    <table class="table table-bordered" style="width:100%">
                      <tr>
                        <th>#</th>
                        <th>Tingkatan</th>
                        <th>Nama Sekolah</th>
                        <th>Tahun Masuk</th>
                        <th>Tahun Lulus</th>
                        <th>No. Ijazah</th>
                        <?php if($row_login['level']=="Administrator"){?>
                        <th style="width:13%">Aksi</th>
                        <?php } ?>
                      </tr>
                      <?php $i=1; ?>
                      <?php if($totalRows_pendidikan>0){?>
                     	<?php do { ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row_pendidikan['tingkatan_pendidikan']; ?></td>
                        <td><?php echo $row_pendidikan['nama_sekolah']; ?></td>
                        <td><?php echo $row_pendidikan['tahun_masuk']; ?></td>
                        <td><?php echo $row_pendidikan['tahun_lulus']; ?></td>
                        <td><?php echo $row_pendidikan['no_ijazah']; ?></td>
                        <?php if($row_login['level']=="Administrator"){?>
                        <th>
                          <button class="badge bg-blue" data-toggle="modal" data-target="<?php echo "#edit-pendidikan".$row_pendidikan['id']; ?>">edit</button>
                          <a rel="<?php echo $row_pendidikan['id']; ?>" rel1="pendidikan" class="hapusData">
                          <button class="badge bg-red">hapus</button></th></a>
                        <?php } ?>
                      </tr>
  <div class="modal fade" id="<?php echo "edit-pendidikan".$row_pendidikan['id']; ?>" style="font-size:12px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Pendidikan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="POST" action="<?php echo $editFormAction; ?>" name="edit-pendidikan" autocomplete="off">
              <div class="form-group">
                <label for="exampleInputEmail1">Tingkat Pendidikan</label>
                <input type="text" name="tingkat_pendidikan" value="<?php echo $row_pendidikan['tingkatan_pendidikan']; ?>" class="form-control" >
                <input type="hidden" name="id" value="<?php echo $row_pendidikan['id']; ?>" class="form-control" >
                <input type="hidden" name="id_pegawai" value="<?php echo $_GET['id']; ?>" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Sekolah</label>
                <input type="text" name="nama_sekolah" value="<?php echo $row_pendidikan['nama_sekolah']; ?>" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tahun Masuk</label>
                <input type="text" name="tahun_masuk" value="<?php echo $row_pendidikan['tahun_masuk']; ?>" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tahun Lulus</label>
                <input type="text" name="tahun_lulus" value="<?php echo $row_pendidikan['tahun_lulus']; ?>" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">No. Ijazah</label>
                <input type="text" name="no_ijazah" value="<?php echo $row_pendidikan['no_ijazah']; ?>" class="form-control" >
              </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
          <input type="hidden" name="MM_update" value="edit-pendidikan">
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php } while ($row_pendidikan = mysql_fetch_assoc($pendidikan)); } ?>
                    </table>
              </div>
                  <div class="tab-pane" id="gaji" style="font-size:12px">
                    <b>Data Gaji </b>
                    <?php if($row_login['level']=="Administrator"){?>
                    <a href="?page=edit_gaji&id=<?php echo $_GET['id']; ?>&gaji=<?php echo $row_gaji['id'];?>">
                    <button class="badge bg-success">Edit Data</button>
                    </a>
                    <?php } ?><br><br>
                    <br><br>
                    <table class="table table-bordered" style="width:100%">
                      <tr>
                        <th colspan="2">Penghasilan</th>
                        <th colspan="2">Potongan</th>
                      </tr>
                      <tr>
                        <td>Gaji Pokok</td>
                        <td><?php echo number_format($row_gaji['gaji_pokok']); ?></td>
                        <td>Iuran Wajib Pegawai</td>
                        <td><?php echo number_format($row_gaji['iuran_wajib_pegawai']); ?></td>
                      </tr>
                      <tr>
                        <td>Tunjangan Istri</td>
                        <td><?php echo number_format($row_gaji['tunjangan_istri']); ?></td>
                        <td>PPh Pasal 21</td>
                        <td><?php echo number_format($row_gaji['pph21']); ?></td>
                      </tr>
                      <tr>
                        <td>Tunjangan Anak</td>
                        <td><?php echo number_format($row_gaji['tunjangan_anak']); ?></td>
                        <td>Potongan Lainnya</td>
                        <td><?php echo number_format($row_gaji['potongan_lainnya']); ?></td>
                      </tr>
                      <tr>
                        <td>Tunjangan Umum</td>
                        <td><?php echo number_format($row_gaji['tunjangan_umum']); ?></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Tunjangan Fung/Struk</td>
                        <td><?php echo number_format($row_gaji['tunjangan_fungsional']); ?></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Tunjangan Lainnya</td>
                        <td><?php echo number_format($row_gaji['tunjangan_lainnya']); ?></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Utang Kepada Negara</td>
                        <td><?php echo number_format($row_gaji['utang_kepada_negara']); ?></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td><b>Jumlah Kotor</b></td>
                        <td><b>
                        <?php
							$jlh_kotor = $row_gaji['tunjangan_lainnya']+$row_gaji['tunjangan_fungsional']+$row_gaji['tunjangan_umum']+$row_gaji['tunjangan_anak']+$row_gaji['tunjangan_istri']+$row_gaji['gaji_pokok'];
							echo number_format($jlh_kotor);
						 ?>
                        </b></td>
                        <td><b>Jumlah Potongan</b></td>
                        <td><b>
                        <?php
							$jlh_potongan = $row_gaji['potongan_lainnya']+$row_gaji['utang_kepada_negara']+$row_gaji['pph21']+$row_gaji['iuran_wajib_pegawai'];
							echo number_format($jlh_potongan);
						 ?>
                        </b></td>
                      </tr>
                      <tr>
                        <td><b></b></td>
                        <td><b></b></td>
                        <td><b>Jumlah Bersih</b></td>
                        <td><b><?php $jlh_bersih = $jlh_kotor-$jlh_potongan;echo number_format($jlh_bersih);?></b></td>
                      </tr>
                    </table>
                  </div>
                  <div class="tab-pane" id="prestasi" style="font-size:12px">
                    <b>Data Prestasi </b>
                    <?php if($row_login['level']=="Administrator"){?>
                    <button class="badge bg-success" data-toggle="modal" data-target="#tambah-prestasi">tambah</button>
                    <?php }?>
                    <br><br>
                    <table class="table table-bordered" style="width:100%">
                      <tr>
                        <th>#</th>
                        <th>Keterangan Prestasi</th>
                        <th>Tanggal Perolehan</th>
                        <th>Pemberi Prestasi</th>
                        <?php if($row_login['level']=="Administrator"){?>
                        <th style="width:13%">Aksi</th>
                        <?php }?>
                      </tr>
                      <?php $i=1; ?>
                      <?php if($totalRows_prestasi>0){?>
                      <?php do { ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row_prestasi['nama_prestasi']; ?></td>
                        <td><?php echo $row_prestasi['tgl_perolehan']; ?></td>
                        <td><?php echo $row_prestasi['pemberi_prestasi']; ?></td>
                        <th>
                        <?php if($row_login['level']=="Administrator"){?>
                          <button class="badge bg-blue" data-toggle="modal" data-target="<?php echo "#edit-prestasi".$row_prestasi['id']; ?>">edit</button>
                          <a rel="<?php echo $row_prestasi['id']; ?>" rel1="prestasi" class="hapusData">
                          <button class="badge bg-red">hapus</button></th></a>
                        </th>
                        <?php } ?>
                      </tr>
  <div class="modal fade" id="<?php echo "edit-prestasi".$row_prestasi['id']; ?>" style="font-size:12px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Prestasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="POST" action="<?php echo $editFormAction; ?>" name="edit-prestasi" autocomplete="off">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Prestasi</label>
                <input type="text" name="nama_prestasi" value="<?php echo $row_prestasi['nama_prestasi']; ?>" class="form-control" >
                <input type="hidden" name="id" value="<?php echo $row_prestasi['id']; ?>" class="form-control" >
                <input type="hidden" name="id_pegawai" value="<?php echo $_GET['id']; ?>" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Perolehan</label>
                <input type="date" name="tgl_perolehan" value="<?php echo $row_prestasi['tgl_perolehan']; ?>" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Pemberi Prestasi</label>
                <input type="text" name="pemberi_prestasi" value="<?php echo $row_prestasi['pemberi_prestasi']; ?>" class="form-control" >
              </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
          <input type="hidden" name="MM_update" value="edit-prestasi">
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <?php } while ($row_prestasi = mysql_fetch_assoc($prestasi)); }?>
                    </table>
            </div>
          </div>
                <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
            <!-- /.nav-tabs-custom -->
</div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="modal fade" id="tambah-keluarga" style="font-size:12px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Keluarga</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form role="form" method="POST" action="<?php echo $editFormAction; ?>" name="t_keluarga" autocomplete="off">
          <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" name="nama_keluarga" class="form-control" >
          </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tempat Lahir</label>
                <input type="text" name="tpt_lhr_keluarga" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Lahir</label>
                <input type="date" name="tgl_lhr_keluarga" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <input type="text" name="alamat_keluarga" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Pendidikan Terakhir</label>
                  <select name="pendidikan_keluarga" class="form-control" required>
                    <option value="">Pilih</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                    <option value="TK">TK</option>
                    <option value="SD">SD</option>
                    <option value="SLTP">SLTP</option>
                    <option value="SLTA">SLTA</option>
                    <option value="D1">D1</option>
                    <option value="D2">D2</option>
                    <option value="D3">D3</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                  </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Pekerjaan</label>
                <input type="text" name="pekerjaan_keluarga" class="form-control" >
                <input type="hidden" name="id_pegawai" value="<?php echo $_GET['id']; ?>" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Status Hubungan</label>
                  <select name="status_hubungan" class="form-control" required>
                    <option value="">Pilih</option>
                    <option value="Ayah">Ayah</option>
                    <option value="Ibu">Ibu</option>
                    <option value="Istri">Istri</option>
                    <option value="Suami">Suami</option>
                    <option value="Anak">Anak</option>
                  </select>
              </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
          <input type="hidden" name="MM_insert" value="t_keluarga">
        </form>
      </div>
    </div>
      <!-- /.modal-content -->
</div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="tambah-pendidikan" style="font-size:12px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Pendidikan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form role="form" method="POST" action="<?php echo $editFormAction; ?>" name="t_pendidikan" autocomplete="off">
          <div class="form-group">
                <label for="exampleInputEmail1">Tingkat Pendidikan</label>
                  <select name="tingkat_pendidikan" class="form-control" required>
                    <option value="">Pilih</option>
                    <option value="SD">SD</option>
                    <option value="SLTP">SLTP</option>
                    <option value="SLTA">SLTA</option>
                    <option value="D1">D1</option>
                    <option value="D2">D2</option>
                    <option value="D3">D3</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
          </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Sekolah</label>
                <input type="text" class="form-control" name="nama_sekolah" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tahun Masuk</label>
                <input type="text" name="tahun_masuk" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tahun Lulus</label>
                <input type="text" name="tahun_lulus" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">No. Ijazah</label>
                <input type="text" name="no_ijazah" class="form-control" >
                <input type="hidden" name="id_pegawai" value="<?php echo $_GET['id']; ?>" class="form-control" >
              </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
          <input type="hidden" name="MM_insert" value="t_pendidikan">
        </form>
      </div>
    </div>
      <!-- /.modal-content -->
</div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


<div class="modal fade" id="tambah-prestasi" style="font-size:12px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Prestasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form role="form" method="POST" action="<?php echo $editFormAction; ?>" name="t_prestasi" autocomplete="off">
          <div class="form-group">
                <label for="exampleInputEmail1">Nama Prestasi</label>
                <input type="text" class="form-control" name="nama_prestasi" required>
          </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Perolehan</label>
                <input type="date" name="tgl_perolehan" class="form-control" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Pemberi Prestasi</label>
                <input type="text" name="pemberi_prestasi" class="form-control" >
                <input type="hidden" name="id_pegawai" value="<?php echo $_GET['id']; ?>" class="form-control" >
              </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
          <input type="hidden" name="MM_insert" value="t_prestasi">
        </form>
      </div>
    </div>
      <!-- /.modal-content -->
</div>
    <!-- /.modal-dialog -->
  </div>
<?php
mysql_free_result($data);

mysql_free_result($keluarga);

mysql_free_result($pendidikan);

mysql_free_result($gaji);

mysql_free_result($prestasi);
?>
