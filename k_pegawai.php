<?php
require_once('Connections/koneksi.php');

$lk = mysql_query("SELECT * FROM pegawai where jenis_kelamin='Laki-Laki'");
$t_lk = mysql_num_rows($lk);
$pr = mysql_query("SELECT * FROM pegawai where jenis_kelamin='Perempuan'");
$t_pr = mysql_num_rows($pr);
$t_jk = $t_lk+$t_pr;

$sd = mysql_query("SELECT * FROM pegawai where pendidikan='SD'");
$t_sd = mysql_num_rows($sd);
$smp = mysql_query("SELECT * FROM pegawai where pendidikan='SMP'");
$t_smp = mysql_num_rows($smp);
$sma = mysql_query("SELECT * FROM pegawai where pendidikan='SMA'");
$t_sma = mysql_num_rows($sma);
$d1 = mysql_query("SELECT * FROM pegawai where pendidikan='D1'");
$t_d1 = mysql_num_rows($d1);
$d2 = mysql_query("SELECT * FROM pegawai where pendidikan='D2'");
$t_d2 = mysql_num_rows($d2);
$d3 = mysql_query("SELECT * FROM pegawai where pendidikan='D3'");
$t_d3 = mysql_num_rows($d3);
$d4s1 = mysql_query("SELECT * FROM pegawai where pendidikan='D4/S1'");
$t_d4s1 = mysql_num_rows($d4s1);
$s2 = mysql_query("SELECT * FROM pegawai where pendidikan='S2'");
$t_s2 = mysql_num_rows($s2);
$s3 = mysql_query("SELECT * FROM pegawai where pendidikan='S3'");
$t_s3 = mysql_num_rows($s3);
$t_pen = $t_sd+$t_smp+$t_sma+$t_d1+$t_d2+$t_d3+$t_d4s1+$t_s2+$t_s3;

$ia = mysql_query("SELECT * FROM pegawai where id_pangkat='1'");
$t_ia = mysql_num_rows($ia);
$ib = mysql_query("SELECT * FROM pegawai where id_pangkat='2'");
$t_ib = mysql_num_rows($ib);
$ic = mysql_query("SELECT * FROM pegawai where id_pangkat='3'");
$t_ic = mysql_num_rows($ic);
$id = mysql_query("SELECT * FROM pegawai where id_pangkat='4'");
$t_id = mysql_num_rows($id);
$iia = mysql_query("SELECT * FROM pegawai where id_pangkat='5'");
$t_iia = mysql_num_rows($iia);
$iib = mysql_query("SELECT * FROM pegawai where id_pangkat='6'");
$t_iib = mysql_num_rows($iib);
$iic = mysql_query("SELECT * FROM pegawai where id_pangkat='7'");
$t_iic = mysql_num_rows($iic);
$iid = mysql_query("SELECT * FROM pegawai where id_pangkat='8'");
$t_iid = mysql_num_rows($iid);
$iiia = mysql_query("SELECT * FROM pegawai where id_pangkat='9'");
$t_iiia = mysql_num_rows($iiia);
$iiib = mysql_query("SELECT * FROM pegawai where id_pangkat='10'");
$t_iiib = mysql_num_rows($iiib);
$iiic = mysql_query("SELECT * FROM pegawai where id_pangkat='11'");
$t_iiic = mysql_num_rows($iiic);
$iiid = mysql_query("SELECT * FROM pegawai where id_pangkat='12'");
$t_iiid = mysql_num_rows($iiid);
$ta = mysql_query("SELECT * FROM pegawai where id_pangkat='1'");
$t_ta = mysql_num_rows($ta);
$t_gol = $t_ia+$t_ib+$t_ic+$t_id+$t_iia+$t_iib+$t_iic+$t_iid+$t_iiia+$t_iiib+$t_iiic+$t_iiid+$t_ta;

$pns = mysql_query("SELECT * FROM pegawai where status_kepegawaian='PNS'");
$t_pns = mysql_num_rows($pns);
$ppnpn = mysql_query("SELECT * FROM pegawai where status_kepegawaian='PPNPN'");
$t_ppnpn = mysql_num_rows($ppnpn);
$honor = mysql_query("SELECT * FROM pegawai where status_kepegawaian='Honorer'");
$t_honor = mysql_num_rows($honor);
$t_stat = $t_pns+$t_ppnpn+$t_honor;
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>
                  <small>Report</small>
                </h1>
              </div>
            </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- /.card -->
            <div class="card">
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table" style="width:100%">
                    <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Keadaan Pegawai</th>
                        <th style="width: 10%">
                            <a href="ck_pegawai.php" target="_blank">
                                <button class="btn btn-success btn-xs" ><i class="fa fa-print" style="color:white"> &nbsp;Cetak</i> 
                            </a>
                        </th>
                        </tr>
                    </thead>
                </table>
              
                <div class="card-body">
                     <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2">#</th>
                                <th> Jumlah </th>
                                <th> Total </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th rowspan="3" valign="middle" width="15%">Jenis Kelamin</th>
                            </tr>
                            <tr>
                                <td>Laki-Laki</td>
                                <td> <?php echo $t_lk; ?> </td>
                                <td rowspan="2"><?php echo $t_jk; ?></td>
                            </tr>
                            <tr>
                                <td>Perempuan</td>
                                <td> <?php echo $t_pr; ?> </td>
                            </tr>
                            <tr>
                                <th rowspan="10" valign="middle" width="15%">Pendidikan</th>
                            </tr>
                            <tr>
                                <td>SD</td>
                                <td>  <?php echo $t_sd; ?> </td>
                                <td rowspan="9"> <?php echo $t_pen; ?> </td>
                            </tr>
                            <tr>
                                <td>SMP</td>
                                <td> <?php echo $t_smp; ?> </td>
                            </tr>
                            <tr>
                                <td>SMA</td>
                                <td> <?php echo $t_sma; ?> </td>
                            </tr>
                            <tr>
                                <td>D1</td>
                                <td> <?php echo $t_d1; ?> </td>
                            </tr>
                            <tr>
                                <td>D2</td>
                                <td><?php echo $t_d2; ?>  </td>
                            </tr>
                            <tr>
                                <td>D3</td>
                                <td> <?php echo $t_d3; ?>  </td>
                            </tr>
                            <tr>
                                <td>S1/D4</td>
                                <td> <?php echo $t_d4s1; ?>  </td>
                            </tr>
                            <tr>
                                <td>S2</td>
                                <td> <?php echo $t_s2; ?>  </td>
                            </tr>
                            <tr>
                                <td>S3</td>
                                <td> <?php echo $t_s3; ?> </td>
                            </tr>
                            <tr>
                                <th rowspan="14" valign="middle" width="15%">Golongan</th>
                            </tr>
                            <tr>
                                <td>I/A - Juru Muda</td>
                                <td> <?php echo $t_ia; ?> </td>
                                <td rowspan="13"> <?php echo $t_gol; ?> </td>
                            </tr>
                            <tr>
                                <td>I/B - Juru Muda Tk. 1</td>
                                <td><?php echo $t_ib; ?> </td>
                            </tr>
                            <tr>
                                <td>I/C - Juru</td>
                                <td> <?php echo $t_ic; ?> </td>
                            </tr>
                            <tr>
                                <td>I/D - Juru Tk. 1</td>
                                <td> <?php echo $t_id; ?> </td>
                            </tr>
                            <tr>
                                <td>II/A - Pengatur Muda</td>
                                <td> <?php echo $t_iia; ?> </td>
                            </tr>
                            <tr>
                                <td>II/B - Pengatur Muda Tk. 1</td>
                                <td> <?php echo $t_iib; ?> </td>
                            </tr>
                            <tr>
                                <td>II/C - Pengatur</td>
                                <td> <?php echo $t_iic; ?> </td>
                            </tr>
                            <tr>
                                <td>II/D - Pengatur Tk. 1</td>
                                <td> <?php echo $t_iid; ?> </td>
                            </tr>
                            <tr>
                                <td>III/A - Penata Muda</td>
                                <td> <?php echo $t_iiia; ?> </td>
                            </tr>
                            <tr>
                                <td>III/B - Penata Muda Tk. 1</td>
                                <td> <?php echo $t_iiib; ?> </td>
                            </tr>
                            <tr>
                                <td>III/C - Penata</td>
                                <td> <?php echo $t_iiid; ?> </td>
                            </tr>
                            <tr>
                                <td>III/D - Penata Tk. 1</td>
                                <td> <?php echo $t_iiid; ?> </td>
                            </tr>
                            <tr>
                                <td>Tidak Ada</td>
                                <td> <?php echo $t_ta; ?> </td>
                            </tr>
                            <tr>
                                <th rowspan="4" valign="middle" width="15%">Kepegawaian</th>
                            </tr>
                            <tr>
                                <td>PNS</td>
                                <td> <?php echo $t_pns; ?> </td>
                                <td rowspan="3"> <?php echo $t_stat; ?> </td>
                            </tr>
                            <tr>
                                <td>PPNPN</td>
                                <td> <?php echo $t_ppnpn; ?> </td>
                            </tr>
                            <tr>
                                <td>Honor</td>
                                <td> <?php echo $t_honor; ?> </td>
                            </tr>
                        </tbody>
                     </table>
                </div>
            <!-- /.card-body -->
            </div>
        </div>
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->