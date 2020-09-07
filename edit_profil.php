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

$colname_data = "-1";
if (isset($_GET['id'])) {
  $colname_data = $_GET['id'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_data = sprintf("SELECT pegawai.*,seksi.*,pangkat.* FROM pegawai inner join seksi on pegawai.id_seksi=seksi.id  inner join pangkat on pegawai.id_pangkat=pangkat.id WHERE pegawai.id = %s", GetSQLValueString($colname_data, "int"));
$data = mysql_query($query_data, $koneksi) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "edit-profil")) {
	$id=$_POST['id'];
	
	if(!empty($_FILES['foto']['name'])){
		$ukuran=$_FILES['foto']['size'];
		$file_tmp=$_FILES['foto']['tmp_name'];
		$folder='dist/img/';
		$nama1=$row_data['nama'];
		$extension = strtolower(end(explode('.', $_FILES['foto']['name'])));
		$direktori=$folder.$nama1.'.'.$extension;
		$upload=$_FILES['foto'];
		move_uploaded_file($upload['tmp_name'],"dist/img/".$nama1.'.'.$extension);
		$file=$upload['name'];
		$fotolama = $_POST['foto_awal'];
			if(file_exists($fotolama)){unlink ($fotolama);}
			$SQL = "UPDATE pegawai SET foto = '$direktori' WHERE id = '$id'";
			$exe = mysql_query($SQL, $koneksi) or die(mysql_error());
		}
	
  $updateSQL = sprintf("UPDATE pegawai SET nama=%s, nip=%s, tpt_lhr=%s, tgl_lhr=%s, jenis_kelamin=%s, gol_darah=%s, agama=%s, status_pernikahan=%s, no_telp=%s, alamat=%s, status_kepegawaian=%s, id_seksi=%s, id_pangkat=%s, jabatan=%s WHERE id=%s",
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
                       GetSQLValueString($_POST['status_kepegawaian'], "text"),
                       GetSQLValueString($_POST['id_seksi'], "int"),
                       GetSQLValueString($_POST['id_pangkat'], "int"),
                       GetSQLValueString($_POST['jabatan'], "text"),
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
			function getUrlVars() {
				 var vars = {};
				 var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
					  vars[key] = decodeURIComponent(value);
				 });
				 return vars;
			}
			
			var urlParams = getUrlVars();
			window.location.href='?page=detail&id='+urlParams.id;
        </script>
        
    <?php
}


?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Profil</h1>
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
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo $row_data['foto']; ?>"
                       alt="User profile picture">
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
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="profil">
                      <form method="POST" action="<?php echo $editFormAction; ?>" name="edit-profil" enctype="multipart/form-data">
                    <table style="width:100%; font-size:13px;" align="center" cellpadding="6">
                      <tr>
                        <td align="right" style="width:35%"><b>Nama Lengkap</b></td>
                        <th style="width:5%"></th>
                        <td>
                        <input class="form-control" type="text" name="nama" value="<?php echo $row_data['nama']; ?>" required>
                        <input class="form-control" type="hidden" name="id" value="<?php echo $_GET['id']; ?>" required></td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>NIP</b></td>
                        <th style="width:5%"></th>
                        <td><input class="form-control" type="text" name="nip" value="<?php echo $row_data['nip']; ?>" required></td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Jenis Kelamin</b></td>
                        <th style="width:5%"></th>
                        <td>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio1" name="jenis_kelamin" value="Laki-Laki" <?php if($row_data['jenis_kelamin']=='Laki-Laki'){echo "checked";} ?> required>
                                <label for="customRadio1" class="custom-control-label">Laki-Laki</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio2" name="jenis_kelamin" value="Perempuan" <?php if($row_data['jenis_kelamin']=='Perempuan'){echo "checked";} ?> required>
                                <label for="customRadio2" class="custom-control-label">Perempuan</label>
                            </div> 
                        </td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Tempat Lahir</b></td>
                        <th style="width:5%"></th>
                        <td><input class="form-control" type="text" name="tpt_lhr" value="<?php echo $row_data['tpt_lhr']; ?>" required></td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Tanggal Lahir</b></td>
                        <th style="width:5%"></th>
                        <td><input class="form-control" type="date" name="tgl_lhr" value="<?php echo $row_data['tgl_lhr']; ?>" required></td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Agama</b></td>
                        <th style="width:5%"></th>
                        <td>
                            <select class="custom-select" name="agama" required>
                                <option value="<?php echo $row_data['agama']; ?>"><?php echo $row_data['agama']; ?></option>
                                <option value="Islam">Islam</option>
                                <option value="Protestan">Protestan</option>
                                <option value="Katholik">Katholik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                            </select>    
                        </td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Telepon</b></td>
                        <th style="width:5%"></th>
                        <td><input class="form-control" type="text" name="no_telp" value="<?php echo $row_data['no_telp']; ?>" required></td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Golongan Darah</b></td>
                        <th style="width:5%"></th>
                        <td><input class="form-control" name="gol_darah" type="text" value="<?php echo $row_data['gol_darah']; ?>" required></td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Status Pernikahan</b></td>
                        <th style="width:5%"></th>
                        <td>
                            <select class="custom-select" name="status_pernikahan" required>
                                <option value="<?php echo $row_data['status_pernikahan']; ?>"><?php echo $row_data['status_pernikahan']; ?></option>
                                <option value="Belum Menikah">Belum Menikah</option>
                                <option value="Menikah">Menikah</option>
                                <option value="Janda">Janda</option>
                                <option value="Duda">Duda</option>
                            </select>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Alamat</b></td>
                        <th style="width:5%"></th>
                        <td><input class="form-control" type="text" name="alamat" value="<?php echo $row_data['alamat']; ?>" required></td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Status Kepegawaian</b></td>
                        <th style="width:5%"></th>
                        <td>
                            <select class="custom-select" name="status_kepegawaian" required>
                            <option value="<?php echo $row_data['status_kepegawaian']; ?>"><?php echo $row_data['status_kepegawaian']; ?></option>
                              <option value="PNS">PNS</option>
                              <option value="PPNPN">PPNPN</option>
                              <option value="Honorer">Honorer</option>
                            </select>    
                        </td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Jabatan</b></td>
                        <th style="width:5%"></th>
                        <td>
                            <select class="custom-select" name="jabatan" required>
                            <option value="<?php echo $row_data['jabatan']; ?>" selected><?php echo $row_data['jabatan']; ?></option>
                              <option value="Kepala Kantor">Kepala Kantor</option>
                              <option value="Kepala Seksi">Kepala Seksi</option>
                              <option value="Staff Pelaksana">Staff</option>
                              <option value="Staff Pelaksana">FO</option>
                              <option value="Staff Pelaksana">CSO</option>
                              
                            </select>  
                        </td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Seksi</b></td>
                        <th style="width:5%"></th>
                        <td>
                            <select class="custom-select" name="id_seksi" required>
                            <option value="<?php echo $row_data['id_seksi']; ?>"><?php echo $row_data['nama_seksi']; ?></option>
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
                        </td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Golongan/Pangkat</b></td>
                        <th style="width:5%"></th>
                        <td>
                            <select class="custom-select" name="id_pangkat" required>
                            <option selected value="<?php echo $row_data['id_pangkat']; ?>"><?php echo $row_data['golongan']; ?> / <?php echo $row_data['keterangan']; ?> </option>
                              <?php
do {  
?>
                              <option value="<?php echo $row_pangkat['id']?>"><?php echo $row_pangkat['golongan']?> / <?php echo $row_pangkat['keterangan']; ?></option>
                              <?php
} while ($row_pangkat = mysql_fetch_assoc($pangkat));
  $rows = mysql_num_rows($pangkat);
  if($rows > 0) {
      mysql_data_seek($pangkat, 0);
	  $row_pangkat = mysql_fetch_assoc($pangkat);
  }
?>
                            </select>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" style="width:35%"><b>Foto</b></td>
                        <th style="width:5%"></th>
                        <td>
                            <input type="file" class="form-control" name="foto" id="exampleInputFile">
                            <input type="hidden" class="form-control" name="foto_awal" value="<?php echo $row_data['foto']; ?>" id="exampleInputFile">
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <th style="width:5%"></th>
                        <td>
                            <button type="submit" name="simpan" class="btn btn-primary ">Simpan</button>
                            
                        </td>
                      </tr>
                      <input type="hidden" name="MM_update" value="edit-profil">
                    </form>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                  
                </div>




<!-- /.tab-content -->
              </div><!-- /.card-body -->
<?php
mysql_free_result($data);
?>
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
