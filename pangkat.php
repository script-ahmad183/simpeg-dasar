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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "t-pangkat")) {
  $insertSQL = sprintf("INSERT INTO pangkat (golongan, keterangan) VALUES (%s, %s)",
                       GetSQLValueString($_POST['golongan'], "text"),
                       GetSQLValueString($_POST['keterangan'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  ?>
        <script>
			window.location.href='?page=pangkat';
        </script>
        
    <?php
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "e-pangkat")) {
  $updateSQL = sprintf("UPDATE pangkat SET golongan=%s, keterangan=%s WHERE id=%s",
                       GetSQLValueString($_POST['golongan'], "text"),
                       GetSQLValueString($_POST['keterangan'], "text"),
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
			window.location.href='?page=pangkat';
        </script>
        
    <?php
}

mysql_select_db($database_koneksi, $koneksi);
$query_pangkat = "SELECT * FROM pangkat ORDER BY golongan ASC";
$pangkat = mysql_query($query_pangkat, $koneksi) or die(mysql_error());
$row_pangkat = mysql_fetch_assoc($pangkat);
$totalRows_pangkat = mysql_num_rows($pangkat);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>
                  <small>Pangkat</small>
                </h1>
              </div>
            </div>
          </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-6">
            <!-- /.card -->
            <div class="card">
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table" style="width:100%">
                <thead>
                    <tr>
                    <th style="width: 10px">#</th>
                    <th style="width: 20px">Golongan</th>
                    <th>Keterangan</th>
                    <th style="width: 30%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    
                    <?php do { ?>
                    <tr>
                        <td><?php echo $i++; ?>.</td>
                        <td><?php echo $row_pangkat['golongan']; ?></td>
                        <td><?php echo $row_pangkat['keterangan']; ?></td>
                        <td>
                          <button class="badge bg-blue" data-toggle="modal" data-target="<?php echo "#edit-pangkat".$row_pangkat['id']; ?>">edit</button>
                          <a rel="<?php echo $row_pangkat['id']; ?>" rel1="pangkat" class="hapusData">
                            <button class="badge bg-danger">Hapus</button >
                          </a>
                        </td>
                      </tr>

  <div class="modal fade" id="<?php echo "edit-pangkat".$row_pangkat['id']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="POST" action="<?php echo $editFormAction; ?>" name="e-pangkat" autocomplete="off">
            <div class="form-group">
              <input type="hidden" name="id" class="form-control" value="<?php echo $row_pangkat['id']; ?>" id="id" readonly>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Golongan</label>
              <input type="text" name="golongan" class="form-control" value="<?php echo $row_pangkat['golongan']; ?>" id="golongan">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Keterangan</label>
              <input type="text" name="keterangan" class="form-control" value="<?php echo $row_pangkat['keterangan']; ?>" id="keterangan">
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          <input type="hidden" name="MM_update" value="e-pangkat">
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
                      <?php } while ($row_pangkat = mysql_fetch_assoc($pangkat)); ?>
                </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-6">
            <!-- /.card -->
            <div class="card">
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table" style="width:100%">
                    <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Tambah Data</th>
                        <th style="width: 40px"></th>
                        </tr>
                    </thead>
                </table>
              <form role="form" method="POST" action="<?php echo $editFormAction; ?>" name="t-pangkat">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Golongan</label>
                        <input type="text" name="golongan" class="form-control" id="exampleInputEmail1">
                        <small><i>Cth : I/A, I/B, dll..</i></small>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" id="exampleInputEmail1">
                      </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary float-right">Tambah</button>
                    </div>
                    <input type="hidden" name="MM_insert" value="t-pangkat">
                </form>
            </div>
            <!-- /.card-body -->
            </div>
        </div>
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
mysql_free_result($pangkat);
?>
  