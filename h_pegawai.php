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

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
	$id = $_GET['id'];
	$d_gaji = mysql_query("DELETE FROM gaji WHERE id_pegawai='$id'");
	$d_prestasi = sprintf("DELETE FROM prestasi WHERE id_pegawai=%s",
                       GetSQLValueString($_GET['id'], "int"));
	$d_keluarga = sprintf("DELETE FROM keluarga WHERE id_pegawai=%s",
                       GetSQLValueString($_GET['id'], "int"));
	$d_pendidikan = sprintf("DELETE FROM pendidikan WHERE id_pegawai=%s",
                       GetSQLValueString($_GET['id'], "int"));
	$cek = mysql_query("SELECT * FROM pegawai WHERE id ='$id'");
	$row_cari = mysql_fetch_assoc($cek);
	if(file_exists($row_cari['foto'])){unlink ($row_cari['foto']);}		   				   
  $deleteSQL = sprintf("DELETE FROM pegawai WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result3 = mysql_query($d_prestasi, $koneksi) or die(mysql_error());
  $Result4 = mysql_query($d_keluarga, $koneksi) or die(mysql_error());
  $Result5 = mysql_query($d_pendidikan, $koneksi) or die(mysql_error());
  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());

  $deleteGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  ?>
        <script>
            window.location.href="index.php?page=pegawai";
        </script>
    <?php
}
?>
