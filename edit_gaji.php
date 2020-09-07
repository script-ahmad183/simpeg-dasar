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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "edit-gaji")) {
  $updateSQL = sprintf("UPDATE gaji SET id_pegawai=%s, gaji_pokok=%s, tunjangan_istri=%s, tunjangan_anak=%s, tunjangan_umum=%s, tunjangan_fungsional=%s, tunjangan_lainnya=%s, utang_kepada_negara=%s, iuran_wajib_pegawai=%s, pph21=%s, potongan_lainnya=%s WHERE id=%s",
                       GetSQLValueString($_POST['id_pegawai'], "text"),
                       GetSQLValueString($_POST['gaji_pokok'], "int"),
                       GetSQLValueString($_POST['tunjangan_istri'], "int"),
                       GetSQLValueString($_POST['tunjangan_anak'], "int"),
                       GetSQLValueString($_POST['tunjangan_umum'], "int"),
                       GetSQLValueString($_POST['tunjangan_fungsional'], "int"),
                       GetSQLValueString($_POST['tunjangan_lainnya'], "int"),
                       GetSQLValueString($_POST['utang_kepada_negara'], "int"),
                       GetSQLValueString($_POST['iuran_wajib_pegawai'], "int"),
                       GetSQLValueString($_POST['pph21'], "int"),
                       GetSQLValueString($_POST['potongan_lainnya'], "int"),
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

$colname_data = "-1";
if (isset($_GET['id'])) {
  $colname_data = $_GET['id'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_data = sprintf("SELECT * FROM gaji WHERE id_pegawai = %s", GetSQLValueString($colname_data, "text"));
$data = mysql_query($query_data, $koneksi) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = "-1";
if (isset($_GET['id'])) {
  $totalRows_data = $_GET['id'];
}
$colname_data = "-1";

mysql_select_db($database_koneksi, $koneksi);
$query_data = sprintf("SELECT pegawai.*,seksi.*,pangkat.* FROM pegawai inner join seksi on pegawai.id_seksi=seksi.id  inner join pangkat on pegawai.id_pangkat=pangkat.id WHERE pegawai.id = %s", GetSQLValueString($colname_data, "int"));
$data = mysql_query($query_data, $koneksi) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = "-1";
if (isset($_GET['id'])) {
  $totalRows_data = $_GET['id'];
}
$colname_data = "-1";

$colname_gaji = "-1";
if (isset($_GET['gaji'])) {
  $colname_gaji = $_GET['gaji'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_gaji = sprintf("SELECT * FROM gaji WHERE id = %s", GetSQLValueString($colname_gaji, "int"));
$gaji = mysql_query($query_gaji, $koneksi) or die(mysql_error());
$row_gaji = mysql_fetch_assoc($gaji);
$totalRows_gaji = mysql_num_rows($gaji);

$colname_data = "-1";
if (isset($_GET['id'])) {
  $colname_data = $_GET['id'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_data = sprintf("SELECT pegawai.*,seksi.*,pangkat.* FROM pegawai inner join seksi on pegawai.id_seksi=seksi.id  inner join pangkat on pegawai.id_pangkat=pangkat.id WHERE pegawai.id = %s", GetSQLValueString($colname_data, "int"));
$data = mysql_query($query_data, $koneksi) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil</h1>
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
                  <li class="nav-item"><a class="nav-link active" href="#gaji" data-toggle="tab"  style="font-size:12px"><i class="far fa-money-bill-alt"> &nbsp;</i> Gaji & Tunjangan</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="gaji" style="font-size:12px">
                    <b>Data Gaji </b><br><br>
                    
                    <form method="POST" action="<?php echo $editFormAction; ?>" name="edit-gaji">
                    <input type="hidden" id="id" name="id_pegawai" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="id" value="<?php echo $_GET['gaji']; ?>">
                    <table class="table table-bordered"  style="font-size:13px;" style="width:100%">
                      <tr>
                        <th colspan="2">Penghasilan</th>
                        <th colspan="2">Potongan</th>
                      </tr>
                      <tr>
                        <td>Gaji Pokok</td>
                        <td><input type="text" class="form-control" onkeypress="return hanyaAngka(event)" value="<?php echo $row_gaji['gaji_pokok']; ?>" name="gaji_pokok"></td>
                        <td>Iuran Wajib Pegawai</td>
                        <td><input type="text" class="form-control" onkeypress="return hanyaAngka(event)" value="<?php echo $row_gaji['iuran_wajib_pegawai']; ?>" name="iuran_wajib_pegawai"></td>
                      </tr>
                      <tr>
                        <td>Tunjangan Istri</td>
                        <td><input type="text" class="form-control" onkeypress="return hanyaAngka(event)" value="<?php echo $row_gaji['tunjangan_istri']; ?>" name="tunjangan_istri"></td>
                        <td>PPh Pasal 21</td>
                        <td><input type="text" class="form-control" onkeypress="return hanyaAngka(event)" value="<?php echo $row_gaji['pph21']; ?>" name="pph21"></td>
                      </tr>
                      <tr>
                        <td>Tunjangan Anak</td>
                        <td><input type="text" class="form-control" onkeypress="return hanyaAngka(event)" value="<?php echo $row_gaji['tunjangan_anak']; ?>" name="tunjangan_anak"></td>
                        <td>Utang Kepada Negara</td>
                        <td><input type="text" class="form-control" onkeypress="return hanyaAngka(event)" value="<?php echo $row_gaji['utang_kepada_negara']; ?>" name="utang_kepada_negara"></td>
                      </tr>
                      <tr>
                        <td>Tunjangan Umum</td>
                        <td><input type="text" class="form-control" onkeypress="return hanyaAngka(event)" value="<?php echo $row_gaji['tunjangan_umum']; ?>" name="tunjangan_umum"></td>
                        <td>Potongan Lainnya</td>
                        <td><input type="text" class="form-control" onkeypress="return hanyaAngka(event)" value="<?php echo $row_gaji['potongan_lainnya']; ?>" name="potongan_lainnya"></td>
                      </tr>
                      <tr>
                        <td>Tunjangan Fung/Struk</td>
                        <td><input type="text" class="form-control" onkeypress="return hanyaAngka(event)" value="<?php echo $row_gaji['tunjangan_fungsional']; ?>" name="tunjangan_fungsional"></td>
                        <td></td>
                        <td></td>
                      </tr>
                        <td>Tunjangan Lainnya</td>
                        <td><input type="text" class="form-control" onkeypress="return hanyaAngka(event)" value="<?php echo $row_gaji['tunjangan_lainnya']; ?>" name="tunjangan_lainnya"></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td colspan="4" align="center">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            &nbsp;&nbsp;
                            <button type="button" class="btn btn-secondary btn-sm">Batal</button>
                        </td>
                      </tr>
                      <input type="hidden" name="MM_update" value="edit-gaji">
</table>
                    </form>
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
  <!-- /.content-wrapper --
<?php
mysql_free_result($data);

mysql_free_result($gaji);
?>