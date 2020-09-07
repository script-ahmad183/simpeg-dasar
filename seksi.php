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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "t-seksi")) {
  $insertSQL = sprintf("INSERT INTO seksi (nama_seksi) VALUES (%s)",
                       GetSQLValueString($_POST['nama_seksi'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  ?>
        <script>
			window.location.href='?page=seksi';
        </script>
        
    <?php
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "e-seksi")) {
  $updateSQL = sprintf("UPDATE seksi SET nama_seksi=%s WHERE id=%s",
                       GetSQLValueString($_POST['nama_seksi'], "text"),
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
			window.location.href='?page=seksi';
        </script>
        
    <?php
}

mysql_select_db($database_koneksi, $koneksi);
$query_seksi = "SELECT * FROM seksi";
$seksi = mysql_query($query_seksi, $koneksi) or die(mysql_error());
$row_seksi = mysql_fetch_assoc($seksi);
$totalRows_seksi = mysql_num_rows($seksi);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>
                  <small>Seksi</small>
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
                    <th>Nama Seksi</th>
                    <th style="width: 30%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    <?php do { ?>
                    <tr>
                        <td><?php echo $i++; ?>.</td>
                        <td><?php echo $row_seksi['nama_seksi']; ?></td>
                        <td>
                          <button class="badge bg-blue" data-toggle="modal" data-target="<?php echo "#edit-seksi".$row_seksi['id']; ?>">edit</button>
                          <a rel="<?php echo $row_seksi['id']; ?>" rel1="seksi" class="hapusData">
                           <button class="badge bg-danger">Hapus</button >
                          </a>
                        </td>
                      </tr>

  <div class="modal fade" id="<?php echo "edit-seksi".$row_seksi['id']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="POST" action="<?php echo $editFormAction; ?>" name="e-seksi" autocomplete="off">
            
            <div class="form-group">
              <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $row_seksi['id']; ?>" readonly>
            </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Seksi</label>
                <input type="text" name="nama_seksi" class="form-control" value="<?php echo $row_seksi['nama_seksi']; ?>" id="nama">
              </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          <input type="hidden" name="MM_update" value="e-seksi">
          </form>
      </div>
    </div>
      <!-- /.modal-content -->
  </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->



                      <?php } while ($row_seksi = mysql_fetch_assoc($seksi)); ?>
                
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
              <form role="form" method="POST" action="<?php echo $editFormAction; ?>" name="t-seksi">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nama Seksi</label>
                        <input type="text" name="nama_seksi" class="form-control" id="exampleInputEmail1">
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary float-right">Tambah</button>
                    </div>
                    <input type="hidden" name="MM_insert" value="t-seksi">
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

  <div class="modal fade" id="edit-seksi">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="{{('/edit-seksi')}}" autocomplete="off">

            @csrf
            <div class="form-group">
              <input type="hidden" name="id" class="form-control" id="id" readonly>
            </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Seksi</label>
                <input type="text" name="nama_seksi" class="form-control" id="nama">
              </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
      </div>
    </div>
      <!-- /.modal-content -->
  </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php
mysql_free_result($seksi);
?>
  