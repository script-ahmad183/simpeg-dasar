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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "edit_usr")) {
  $updateSQL = sprintf("UPDATE user SET password=%s, nama=%s, `level`=%s WHERE username=%s",
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['username'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());

  $updateGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
 ?>
        <script>
			window.location.href='?page=user';
        </script>
        
    <?php
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "t_user")) {
  $insertSQL = sprintf("INSERT INTO `user` (username, password, nama, `level`) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['level'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  ?>
        <script>
			window.location.href='?page=user';
        </script>
        
    <?php
}

mysql_select_db($database_koneksi, $koneksi);
$query_usr = "SELECT * FROM `user` ORDER BY nama ASC";
$usr = mysql_query($query_usr, $koneksi) or die(mysql_error());
$row_usr = mysql_fetch_assoc($usr);
$totalRows_usr = mysql_num_rows($usr);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-12">
                <h1>
                  <small>Akun User</small>
                </h1>
              </div>
            </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-7">
            <!-- /.card -->
            <div class="card">
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table" style="width:100%">
                <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Level</th>
                      <th style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                   
                  <?php do { ?>
                  <tr>
                        <td><?php echo $i++; ?>.</td>
                        <td><?php echo $row_usr['nama']; ?></td>
                        <td><?php echo $row_usr['username']; ?></td>
                        <td><?php echo $row_usr['level']; ?></td>
                        <td>
                          <button class="badge bg-blue" data-toggle="modal" data-target="<?php echo "#edit-user".$row_usr['username']; ?>">edit</button>
                          <a rel="<?php echo $row_usr['username']; ?>" rel1="user" class="hapusUser">
                           <button class="badge bg-danger">Hapus</button >
                          </a>
                        </td>
                      </tr>
<div class="modal fade" id="<?php echo "edit-user".$row_usr['username']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="POST" action="<?php echo $editFormAction; ?>" name="edit_usr" autocomplete="off">
            <div class="form-group">
              <input type="hidden" name="id" class="form-control" id="id" readonly>
            </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" name="nama" value="<?php echo $row_usr['nama']; ?>" class="form-control" id="nama">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" name="username" value="<?php echo $row_usr['username']; ?>" class="form-control" id="username">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="password" name="password" value="<?php echo $row_usr['password']; ?>" class="form-control" id="password">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Level</label>
                <select  id="level" name="level" class="form-control" required>
                  <option value="<?php echo $row_usr['level']; ?>"><?php echo $row_usr['level']; ?></option>
                  <option value="Administrator">Administrator</option>
                  <option value="User">User</option>
                </select>
              </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          <input type="hidden" name="MM_update" value="edit_usr">
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->                      
                      
                      <?php } while ($row_usr = mysql_fetch_assoc($usr)); ?>
                </tbody>
                </table>
            </div>
            <!-- /.card-body -->
      </div>
    </div>
        <div class="col-md-5">
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
              <form role="form" method="POST" action="<?php echo $editFormAction; ?>" name="t_user" autocomplete="off">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="nama" class="form-control" id="exampleInputEmail1" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" name="username" class="form-control" id="exampleInputEmail1" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="text" name="password" class="form-control" id="exampleInputEmail1" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Level</label>
                        <select name="level" class="form-control" required>
                          <option value="">Pilih</option>
                          <option value="Administrator">Administrator</option>
                          <option value="User">User</option>
                        </select>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary float-right">Tambah</button>
                    </div>
                    <input type="hidden" name="MM_insert" value="t_user">
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
mysql_free_result($usr);
?>
