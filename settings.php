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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
	if($_POST['password_baru']==$_POST['crf_password_baru']){
		
  $updateSQL = sprintf("UPDATE `user` SET password=%s WHERE username=%s",
                       GetSQLValueString($_POST['password_baru'], "text"),
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
            alert("Sukses, Password telah diubah!");
			window.location.href="?page=settings";
        </script>
        <meta http-equiv="refresh" content="0" />
    <?php
	}else{
		?>
        <script>
            alert("Gagal, Password konfirmasi tidak sama!");
			window.location.href="?page=settings";
        </script>
        <meta http-equiv="refresh" content="0" />
    <?php
	}
}
?>  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>
                  <small>Settings</small>
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
                        <th>Ganti Password</th>
                        <th style="width: 40px"></th>
                        </tr>
                    </thead>
                </table>
              <form name="form" role="form" method="POST" action="<?php echo $editFormAction; ?>">
                <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Password Baru</label>
                        <input type="hidden" name="username" value="<?php echo $row_login['username']; ?>" class="form-control" id="exampleInputEmail1">
                        <input type="password" name="password_baru" class="form-control" id="exampleInputEmail1">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Konfirmasi Password Baru</label>
                        <input type="password" name="crf_password_baru" class="form-control" id="exampleInputEmail1">
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </div>
                    <input type="hidden" name="MM_update" value="form">
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