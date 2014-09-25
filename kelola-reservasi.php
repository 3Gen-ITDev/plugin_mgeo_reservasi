<?php
/*  Plugin Name: Reservasi Pengunjung
  Plugin URI: http://3Gen-ITDev.com
  Description: Plugin untuk kelola reservasi pengunjung yang hendak berkunjung ke Museum Geologi Bandung. Plugin ini  dikembangkan oleh 3Gen-ITDev.

  Version: 1.0
	Author: 3Gen-ITDev
	Author URI: http://3gen-itdev.com
	License: GPL2  - most WordPress plugins are released under GPL2 license terms
*/

// RESERVASI = 0
// TERIMA = 1
// TOLAK = 2

if ( !function_exists( 'add_action' ) ) {
    echo "Konten terproteksi!";
}else{
    function reservasiHeader(){
       echo "<div class=\"wrap\">
             <div id=\"icon-users\" class=\"icon32\"><br></div>";
    }

    function reservasiTitle($title){
       echo "<h2>$title</h2>";
    }
    
    function pengumumanTitle($title){
       $uri_tambah_pengumuman = add_query_arg(array('page'=>'kelola_pengumuman','aksi'=>'tambah','id_pengumuman'=>'none'));
       echo "<h2>$title<a href=\"$uri_tambah_pengumuman\" class=\"add-new-h2\">Tambah Pengumuman</a></h2>";
    }
    
    function setSubJudul($judul){
        echo "<br><font style=\"font-size:16px;line-height:200%;\"> - $judul</font><hr />";
    }
    
    function bukaKoneksi(){
        mysql_connect('#######','#######','#######')or die(mysql_error());
    	mysql_select_db("wp_museum")or die(mysql_error());
    }
    
    function tutupKoneksi(){
        mysql_close();
    }

    function reservasiFooter(){
       echo "</div>";
    }
    
    function tampilNotifikasi($notifikasi){
    	echo "<div class=\"update-nag\" style=\"font-size:14px\">$notifikasi</div>";
    }

    function tampilReservasiUmumUnconfirmed(){
    	bukaKoneksi();
    	$b = mysql_query("select * from wp_reservasi_umum where status='0' order by nama") or die(mysql_error());
    	if(mysql_num_rows($b)==0){
    	   echo "<div class=\"update-nag\">Tidak ada data reservasi dari kategori Reservasi Umum</div>";
    	}else{
	   echo "<table class=\"wp-list-table widefat fixed users\">
	   	    <thead>
	                <tr>
	                    <th width=\"25\">No</th>
                            <th>Nama Pendaftar</th>
                            <th>Alamat</th>
                            <th>Tanggal Mendaftar</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Waktu Kunjungan</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>";
              $x = 1;
              while($h=mysql_fetch_array($b)){
              	  $jam = $h[waktu_jam];
              	  $menit = $h[waktu_menit];
                  if(strlen($h[waktu_jam])==1){
                     $jam = "0".$h[waktu_jam];
                  }
                  if(strlen($h[waktu_menit])==1){
                     $menit = "0".$h[waktu_menit];
                  }
                  $jam = $jam.":".$menit;
                  $uri_terima_reservasi = add_query_arg(array('page'=>'kategori_umum','aksi'=>'terima','no_reservasi'=>$h[0]));
                  $uri_tolak_reservasi = add_query_arg(array('page'=>'kategori_umum','aksi'=>'tolak','no_reservasi'=>$h[0]));
                  $uri_lihat_detail = add_query_arg(array('page'=>'kategori_umum','aksi'=>'detail','no_reservasi'=>$h[0]));
                  echo "<tr>";
                      echo "<td>$x</td>";
                      echo "<td>$h[nama]</td>";
                      echo "<td>$h[alamat]</td>";
                      echo "<td>$h[tgl_daftar]</td>";
                      echo "<td>$h[waktu_tanggal] $h[waktu_bulan] $h[waktu_tahun]</td>";
                      echo "<td>$jam</td>";
                      echo "<td>$h[jumlah_personil]</td>";
                      echo "<td>
                      	      <a href=\"$uri_terima_reservasi\">Terima</a> | 
                      	      <a href=\"$uri_tolak_reservasi\">Tolak</a> | 
                      	      <a href=\"$uri_lihat_detail\">Detail</a>  
                      	    </td>";
                  echo "</tr>";
                  $x++;
              }
              echo "</tbody>";
              echo "<tfoot>
                       <tr><td colspan=\"8\" align=\"center\"></td></tr>
                    </tfoot>";
           echo "</table>";
        }
    	tutupKoneksi();
    }
    
    function tampilReservasiKhususUnconfirmed(){
    	bukaKoneksi();
    	$b = mysql_query("select * from wp_reservasi_khusus where status='0' order by nama") or die(mysql_error());
    	if(mysql_num_rows($b)==0){
    	   echo "<div class=\"update-nag\">Tidak ada data reservasi dari kategori Reservasi Khusus</div>";
    	}else{
	   echo "<table class=\"wp-list-table widefat fixed users\">
	   	    <thead>
	                <tr>
	                    <th width=\"25\">No</th>
                            <th>Nama Pendaftar</th>
                            <th>Alamat</th>
                            <th>Tanggal Mendaftar</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Waktu Kunjungan</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>";
              $x = 1;
              while($h=mysql_fetch_array($b)){
              	  $jam = $h[waktu_jam];
              	  $menit = $h[waktu_menit];
                  if(strlen($h[waktu_jam])==1){
                     $jam = "0".$h[waktu_jam];
                  }
                  if(strlen($h[waktu_menit])==1){
                     $menit = "0".$h[waktu_menit];
                  }
                  $jam = $jam.":".$menit;
                  $uri_terima_reservasi = add_query_arg(array('page'=>'kategori_khusus','aksi'=>'terima','no_reservasi'=>$h[0]));
                  $uri_tolak_reservasi = add_query_arg(array('page'=>'kategori_khusus','aksi'=>'tolak','no_reservasi'=>$h[0]));
                  $uri_lihat_detail = add_query_arg(array('page'=>'kategori_khusus','aksi'=>'detail','no_reservasi'=>$h[0]));
                  echo "<tr>";
                      echo "<td>$x</td>";
                      echo "<td>$h[nama]</td>";
                      echo "<td>$h[provinsi] - $h[benua]</td>";
                      echo "<td>$h[tgl_daftar]</td>";
                      echo "<td>$h[waktu_tanggal] $h[waktu_bulan] $h[waktu_tahun]</td>";
                      echo "<td>$jam</td>";
                      echo "<td>$h[jumlah_personil]</td>";
                      echo "<td>
                      	      <a href=\"$uri_terima_reservasi\">Terima</a> | 
                      	      <a href=\"$uri_tolak_reservasi\">Tolak</a> | 
                      	      <a href=\"$uri_lihat_detail\">Detail</a>  
                      	    </td>";
                  echo "</tr>";
                  $x++;
              }
              echo "</tbody>";
              echo "<tfoot>
                       <tr><td colspan=\"8\" align=\"center\"></td></tr>
                    </tfoot>";
           echo "</table>";
        }
    	tutupKoneksi();
    }
    
    
    function tampilReservasiPelajarUnconfirmed(){
    	bukaKoneksi();
    	$b = mysql_query("select * from wp_reservasi_pelajar where status='0' order by nama") or die(mysql_error());
    	if(mysql_num_rows($b)==0){
    	   echo "<div class=\"update-nag\">Tidak ada data reservasi dari kategori Reservasi Pelajar</div>";
    	}else{
	   echo "<table class=\"wp-list-table widefat fixed users\">
	   	    <thead>
	                <tr>
	                    <th width=\"25\">No</th>
                            <th>Nama Pendaftar</th>
                            <th>Alamat</th>
                            <th>Tanggal Mendaftar</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Waktu Kunjungan</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>";
              $x = 1;
              while($h=mysql_fetch_array($b)){
              	  $jam = $h[waktu_jam];
              	  $menit = $h[waktu_menit];
                  if(strlen($h[waktu_jam])==1){
                     $jam = "0".$h[waktu_jam];
                  }
                  if(strlen($h[waktu_menit])==1){
                     $menit = "0".$h[waktu_menit];
                  }
                  $jam = $jam.":".$menit;
                  $uri_terima_reservasi = add_query_arg(array('page'=>'kategori_pelajar','aksi'=>'terima','no_reservasi'=>$h[0]));
                  $uri_tolak_reservasi = add_query_arg(array('page'=>'kategori_pelajar','aksi'=>'tolak','no_reservasi'=>$h[0]));
                  $uri_lihat_detail = add_query_arg(array('page'=>'kategori_pelajar','aksi'=>'detail','no_reservasi'=>$h[0]));
                  echo "<tr>";
                      echo "<td>$x</td>";
                      echo "<td>$h[nama]</td>";
                      echo "<td>$h[alamat]</td>";
                      echo "<td>$h[tgl_daftar]</td>";
                      echo "<td>$h[waktu_tanggal] $h[waktu_bulan] $h[waktu_tahun]</td>";
                      echo "<td>$jam</td>";
                      echo "<td>$h[jumlah_personil]</td>";
                      echo "<td>
                      	      <a href=\"$uri_terima_reservasi\">Terima</a> | 
                      	      <a href=\"$uri_tolak_reservasi\">Tolak</a> | 
                      	      <a href=\"$uri_lihat_detail\">Detail</a>  
                      	    </td>";
                  echo "</tr>";
                  $x++;
              }
              echo "</tbody>";
              echo "<tfoot>
                       <tr><td colspan=\"8\" align=\"center\"></td></tr>
                    </tfoot>";
           echo "</table>";
        }
    	tutupKoneksi();
    }
    
    function tampilReservasiAsingUnconfirmed(){
    	bukaKoneksi();
    	$b = mysql_query("select * from wp_reservasi_asing where status='0' order by nama") or die(mysql_error());
    	if(mysql_num_rows($b)==0){
    	   echo "<div class=\"update-nag\">Tidak ada data reservasi dari kategori Reservasi Asing</div>";
    	}else{
	   echo "<table class=\"wp-list-table widefat fixed users\">
	   	    <thead>
	                <tr>
	                    <th width=\"25\">No</th>
                            <th>Nama Pendaftar</th>
                            <th>Alamat</th>
                            <th>Tanggal Mendaftar</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Waktu Kunjungan</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>";
              $x = 1;
              while($h=mysql_fetch_array($b)){
              	  $jam = $h[waktu_jam];
              	  $menit = $h[waktu_menit];
                  if(strlen($h[waktu_jam])==1){
                     $jam = "0".$h[waktu_jam];
                  }
                  if(strlen($h[waktu_menit])==1){
                     $menit = "0".$h[waktu_menit];
                  }
                  $jam = $jam.":".$menit;
                  $uri_terima_reservasi = add_query_arg(array('page'=>'kategori_asing','aksi'=>'terima','no_reservasi'=>$h[0]));
                  $uri_tolak_reservasi = add_query_arg(array('page'=>'kategori_asing','aksi'=>'tolak','no_reservasi'=>$h[0]));
                  $uri_lihat_detail = add_query_arg(array('page'=>'kategori_asing','aksi'=>'detail','no_reservasi'=>$h[0]));
                  echo "<tr>";
                      echo "<td>$x</td>";
                      echo "<td>$h[nama]</td>";
                      echo "<td>$h[benua]</td>";
                      echo "<td>$h[tgl_daftar]</td>";
                      echo "<td>$h[waktu_tanggal] $h[waktu_bulan] $h[waktu_tahun]</td>";
                      echo "<td>$jam</td>";
                      echo "<td>$h[jumlah_personil]</td>";
                      echo "<td>
                      	      <a href=\"$uri_terima_reservasi\">Terima</a> | 
                      	      <a href=\"$uri_tolak_reservasi\">Tolak</a> | 
                      	      <a href=\"$uri_lihat_detail\">Detail</a>  
                      	    </td>";
                  echo "</tr>";
                  $x++;
              }
              echo "</tbody>";
              echo "<tfoot>
                       <tr><td colspan=\"8\" align=\"center\"></td></tr>
                    </tfoot>";
           echo "</table>";
        }
    	tutupKoneksi();
    }
    
    function reservasiTerima($table,$no_reservasi){
    	bukaKoneksi();
    	$nama_tabel = "wp_reservasi_".$table;
    	$e = mysql_query("update $nama_tabel set status='1' where no_reservasi='$no_reservasi'");
    	if($e){
    	   return true;
    	}else{
    	   return false;
    	}
    	tutupKoneksi();
    }
    
    function reservasiTolak($table,$no_reservasi){
    	bukaKoneksi();
    	$nama_tabel = "wp_reservasi_".$table;
    	$e = mysql_query("update $nama_tabel set status='2' where no_reservasi='$no_reservasi'");
    	if($e){
    	   return true;
    	}else{
    	   return false;
    	}
    	tutupKoneksi();
    }

    function lihatDetailUmum($no_reservasi){
        bukaKoneksi();
        $e = mysql_query("select * from wp_reservasi_umum where no_reservasi='$no_reservasi'");
        $h = mysql_fetch_array($e);
        
        $uri_terima_reservasi = add_query_arg(array('page'=>'kategori_umum','aksi'=>'terima','no_reservasi'=>$h[0]));
        $uri_tolak_reservasi = add_query_arg(array('page'=>'kategori_umum','aksi'=>'tolak','no_reservasi'=>$h[0]));
        $uri_kembali = add_query_arg(array('page'=>'kategori_umum','aksi'=>'init','no_reservasi'=>$h[0]));
        
        $jam = $h[waktu_jam];
        $menit = $h[waktu_menit];
        if(strlen($h[waktu_jam])==1){
           $jam = "0".$h[waktu_jam];
        }
        if(strlen($h[waktu_menit])==1){
           $menit = "0".$h[waktu_menit];
        }
        $jam = $jam.":".$menit;
        
        echo "
        <table class=\"wp-list-table widefat fixed users\">
            <thead>
            <tr>
                <th align=\"center\">Detail Reservasi - $h[0]</td>
            </tr>
            </thead> 
            <tbody>
            <tr>
                <td align=center>
	            <table width=\"100%\" style=\"line-spacing:200%;\">    
	            <tr>
	                <td width=\"180\">No.Reservasi</td>
	                <td width=\"15\">:</td>
	                <td>$h[0]</td>
	            </tr>
	            <tr>
	                <td>Harga Tiket</td>
	                <td>:</td>
	                <td>$h[1]</td>
	            </tr>
		    <tr>
	                <td>Waktu Kunjungan</td>
	                <td>:</td>
	                <td>$h[2] $h[3] $h[4] Pukul $jam</td>
	            </tr>	
	            <tr>
	                <td>Nama</td>
	                <td>:</td>
	                <td>$h[7]</td>
	            </tr>
	            <tr>
	                <td>Alamat</td>
	                <td>:</td>
	                <td>$h[8]</td>
	            </tr>
	            <tr>
	                <td>Provinsi</td>
	                <td>:</td>
	                <td>$h[9]</td>
	            </tr>
	            <tr>
	                <td>No.Kontak</td>
	                <td>:</td>
	                <td>$h[10]</td>
	            </tr>
	            <tr>
	                <td>Warga Negara</td>
	                <td>:</td>
	                <td>$h[11]</td>
	            </tr>
	            <tr>
	                <td>Pekerjaan</td>
	                <td>:</td>
	                <td>$h[12]</td>
	            </tr>
	            <tr>
	                <td>Jumlah Personil Kunjungan</td>
	                <td>:</td>
	                <td>$h[13]</td>
	            </tr>
	            </table>
                </td> 
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td align=\"center\">
                    <a href=\"$uri_terima_reservasi\">Terima</a> | 
                    <a href=\"$uri_tolak_reservasi\">Tolak</a> | 
                    <a href=\"$uri_kembali\">Kembali ke Tabel</a> 
                </td>
            </tr>
            </tfoot>
        </table>";
        tutupKoneksi();
    }

    function lihatDetailKhusus($no_reservasi){
        bukaKoneksi();
        $e = mysql_query("select * from wp_reservasi_khusus where no_reservasi='$no_reservasi'");
        $h = mysql_fetch_array($e);
        
        $uri_terima_reservasi = add_query_arg(array('page'=>'kategori_khusus','aksi'=>'terima','no_reservasi'=>$h[0]));
        $uri_tolak_reservasi = add_query_arg(array('page'=>'kategori_khusus','aksi'=>'tolak','no_reservasi'=>$h[0]));
        $uri_kembali = add_query_arg(array('page'=>'kategori_khusus','aksi'=>'init','no_reservasi'=>$h[0]));
        
        $jam = $h[waktu_jam];
        $menit = $h[waktu_menit];
        if(strlen($h[waktu_jam])==1){
           $jam = "0".$h[waktu_jam];
        }
        if(strlen($h[waktu_menit])==1){
           $menit = "0".$h[waktu_menit];
        }
        $jam = $jam.":".$menit;
        
        echo "
        <table class=\"wp-list-table widefat fixed users\">
            <thead>
            <tr>
                <th align=\"center\">Detail Reservasi - $h[0]</td>
            </tr>
            </thead> 
            <tbody>
            <tr>
                <td align=center>
	            <table width=\"100%\" style=\"line-spacing:200%;\">    
	            <tr>
	                <td width=\"180\">No.Reservasi</td>
	                <td width=\"15\">:</td>
	                <td>$h[0]</td>
	            </tr>
	            <tr>
	                <td>Harga Tiket</td>
	                <td>:</td>
	                <td>$h[1]</td>
	            </tr>
		    <tr>
	                <td>Waktu Kunjungan</td>
	                <td>:</td>
	                <td>$h[2] $h[3] $h[4] Pukul $jam</td>
	            </tr>	
	            <tr>
	                <td>Nama</td>
	                <td>:</td>
	                <td>$h[7]</td>
	            </tr>
	            <tr>
	                <td>Provinsi - Benua</td>
	                <td>:</td>
	                <td>$h[8] - $h[9]</td>
	            </tr>
	            <tr>
	                <td>No.Kontak</td>
	                <td>:</td>
	                <td>$h[10]</td>
	            </tr>
	            <tr>
	                <td>Warga Negara</td>
	                <td>:</td>
	                <td>$h[11]</td>
	            </tr>
	            <tr>
	                <td>Pekerjaan</td>
	                <td>:</td>
	                <td>$h[12]</td>
	            </tr>
	            <tr>
	                <td>Jumlah Personil Kunjungan</td>
	                <td>:</td>
	                <td>$h[13]</td>
	            </tr>
	            </table>
                </td> 
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td align=\"center\">
                    <a href=\"$uri_terima_reservasi\">Terima</a> | 
                    <a href=\"$uri_tolak_reservasi\">Tolak</a> | 
                    <a href=\"$uri_kembali\">Kembali ke Tabel</a> 
                </td>
            </tr>
            </tfoot>
        </table>";
        tutupKoneksi();
    }
     
    function lihatDetailPelajar($no_reservasi){
        bukaKoneksi();
        $e = mysql_query("select * from wp_reservasi_pelajar where no_reservasi='$no_reservasi'");
        $h = mysql_fetch_array($e);
        
        $uri_terima_reservasi = add_query_arg(array('page'=>'kategori_pelajar','aksi'=>'terima','no_reservasi'=>$h[0]));
        $uri_tolak_reservasi = add_query_arg(array('page'=>'kategori_pelajar','aksi'=>'tolak','no_reservasi'=>$h[0]));
        $uri_kembali = add_query_arg(array('page'=>'kategori_pelajar','aksi'=>'init','no_reservasi'=>$h[0]));
        
        $jam = $h[waktu_jam];
        $menit = $h[waktu_menit];
        if(strlen($h[waktu_jam])==1){
           $jam = "0".$h[waktu_jam];
        }
        if(strlen($h[waktu_menit])==1){
           $menit = "0".$h[waktu_menit];
        }
        $jam = $jam.":".$menit;
        
        echo "
        <table class=\"wp-list-table widefat fixed users\">
            <thead>
            <tr>
                <th align=\"center\">Detail Reservasi - $h[0]</td>
            </tr>
            </thead> 
            <tbody>
            <tr>
                <td align=center>
	            <table width=\"100%\" style=\"line-spacing:200%;\">    
	            <tr>
	                <td width=\"180\">No.Reservasi</td>
	                <td width=\"15\">:</td>
	                <td>$h[0]</td>
	            </tr>
	            <tr>
	                <td>Harga Tiket</td>
	                <td>:</td>
	                <td>$h[1]</td>
	            </tr>
                    <tr>
	                <td>Sub Kategori</td>
	                <td>:</td>
	                <td>$h[2]</td>
	            </tr>
		    <tr>
	                <td>Waktu Kunjungan</td>
	                <td>:</td>
	                <td>$h[3] $h[4] $h[5] Pukul $jam</td>
	            </tr>	
	            <tr>
	                <td>Nama</td>
	                <td>:</td>
	                <td>$h[8]</td>
	            </tr>
	            <tr>
	                <td>Alamat</td>
	                <td>:</td>
	                <td>$h[9]</td>
	            </tr>
	            <tr>
	                <td>Provinsi</td>
	                <td>:</td>
	                <td>$h[10]</td>
	            </tr>
	            <tr>
	                <td>No.Kontak</td>
	                <td>:</td>
	                <td>$h[11]</td>
	            </tr>
	            <tr>
	                <td>Warga Negara</td>
	                <td>:</td>
	                <td>$h[12]</td>
	            </tr>
	            <tr>
	                <td>Pekerjaan</td>
	                <td>:</td>
	                <td>$h[13]</td>
	            </tr>
	            <tr>
	                <td>Jumlah Personil Kunjungan</td>
	                <td>:</td>
	                <td>$h[14]</td>
	            </tr>
	            </table>
                </td> 
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td align=\"center\">
                    <a href=\"$uri_terima_reservasi\">Terima</a> | 
                    <a href=\"$uri_tolak_reservasi\">Tolak</a> | 
                    <a href=\"$uri_kembali\">Kembali ke Tabel</a> 
                </td>
            </tr>
            </tfoot>
        </table>";
        tutupKoneksi();
    }
     
    function lihatDetailAsing($no_reservasi){
        bukaKoneksi();
        $e = mysql_query("select * from wp_reservasi_asing where no_reservasi='$no_reservasi'");
        $h = mysql_fetch_array($e);
        
        $uri_terima_reservasi = add_query_arg(array('page'=>'kategori_asing','aksi'=>'terima','no_reservasi'=>$h[0]));
        $uri_tolak_reservasi = add_query_arg(array('page'=>'kategori_asing','aksi'=>'tolak','no_reservasi'=>$h[0]));
        $uri_kembali = add_query_arg(array('page'=>'kategori_asing','aksi'=>'init','no_reservasi'=>$h[0]));
        
        $jam = $h[waktu_jam];
        $menit = $h[waktu_menit];
        if(strlen($h[waktu_jam])==1){
           $jam = "0".$h[waktu_jam];
        }
        if(strlen($h[waktu_menit])==1){
           $menit = "0".$h[waktu_menit];
        }
        $jam = $jam.":".$menit;
        
        echo "
        <table class=\"wp-list-table widefat fixed users\">
            <thead>
            <tr>
                <th align=\"center\">Detail Reservasi - $h[0]</th>
            </tr>
            </thead> 
            <tbody>
            <tr>
                <td align=center>
	            <table width=\"100%\" style=\"line-spacing:200%;\">    
	            <tr>
	                <td width=\"180\">No.Reservasi</td>
	                <td width=\"15\">:</td>
	                <td>$h[0]</td>
	            </tr>
	            <tr>
	                <td>Harga Tiket</td>
	                <td>:</td>
	                <td>$h[1]</td>
	            </tr>
		    <tr>
	                <td>Waktu Kunjungan</td>
	                <td>:</td>
	                <td>$h[2] $h[3] $h[4] Pukul $jam</td>
	            </tr>	
	            <tr>
	                <td>Nama</td>
	                <td>:</td>
	                <td>$h[7]</td>
	            </tr>
	            <tr>
	                <td>Benua</td>
	                <td>:</td>
	                <td>$h[8]</td>
	            </tr>
	            <tr>
	                <td>No.Kontak</td>
	                <td>:</td>
	                <td>$h[9]</td>
	            </tr>
	            <tr>
	                <td>Warga Negara</td>
	                <td>:</td>
	                <td>$h[10]</td>
	            </tr>
	            <tr>
	                <td>Pekerjaan</td>
	                <td>:</td>
	                <td>$h[11]</td>
	            </tr>
	            <tr>
	                <td>Jumlah Personil Kunjungan</td>
	                <td>:</td>
	                <td>$h[12]</td>
	            </tr>
	            </table>
                </td> 
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td align=\"center\">
                    <a href=\"$uri_terima_reservasi\">Terima</a> | 
                    <a href=\"$uri_tolak_reservasi\">Tolak</a> | 
                    <a href=\"$uri_kembali\">Kembali ke Tabel</a> 
                </td>
            </tr>
            </tfoot>
        </table>";
        tutupKoneksi();
    }
    
    //-------------------------------------------//--------------------------------------------
    function tampilFormReportInit(){
    $uri_result_report = add_query_arg(array('page'=>'report','aksi'=>'result'));
    echo "<form action=\"$uri_result_report\" method=\"post\">";
    echo "<table>
              <tr>
                  <td>Pilih Jenis Reservasi</td>
                  <td>:</td>
                  <td>
                      <select name=\"jenis\">
                          <option value=\"all\">Seluruh Reservasi</option>
                          <option value=\"umum\">Reservasi Umum</option>
                          <option value=\"khusus\">Reservasi Khusus</option>
                          <option value=\"pelajar\">Reservasi Pelajar</option>
                          <option value=\"asing\">Reservasi Asing</option>
                      </select>
                  </td>
                  <td>Bulan</td>
                  <td>:</td>
                  <td>
                      <select name=\"bulan\">
                            <option value=\"Januari\">Januari</option>
                            <option value=\"Februari\">Februari</option>
                            <option value=\"Maret\">Maret</option>
                            <option value=\"April\">April</option>
                            <option value=\"Mei\">Mei</option>
                            <option value=\"Juni\">Juni</option>
                            <option value=\"Juli\">Juli</option>
                            <option value=\"Agustus\">Agustus</option>
                            <option value=\"September\">September</option>
                            <option value=\"Oktober\">Oktober</option>
                            <option value=\"November\">November</option>
                            <option value=\"Desember\">Desember</option>
                      </select>
                  </td>
                  <td>Tahun</td>
                  <td>:</td>
                  <td>
                      <select name=\"tahun\">
                            <option value=\"2014\">2014</option>
                            <option value=\"2015\">2015</option>
                            <option value=\"2016\">2016</option>
                            <option value=\"2017\">2017</option>
                            <option value=\"2018\">2018</option>
                            <option value=\"2019\">2019</option>
                            <option value=\"2020\">2020</option>
                            <option value=\"2021\">2021</option>
                      </select>
                  </td>
                  <td><input type=\"submit\" value=\"Tampilkan Report\"></td>
              </tr>
          </table>";
    echo "</form>";
    }
    //-------------------------------------------//--------------------------------------------


    function tampilResultReport($jenis,$bulan,$tahun){
        bukaKoneksi();
        if($jenis=="all"){
            $q_u = mysql_query("select * from wp_reservasi_umum where waktu_bulan='$bulan' and waktu_tahun='$tahun' and status='1'");
            $q_k = mysql_query("select * from wp_reservasi_khusus where waktu_bulan='$bulan' and waktu_tahun='$tahun' and status='1'");
            $q_p = mysql_query("select * from wp_reservasi_pelajar where waktu_bulan='$bulan' and waktu_tahun='$tahun' and status='1'");
            $q_a = mysql_query("select * from wp_reservasi_asing where waktu_bulan='$bulan' and waktu_tahun='$tahun' and status='1'");
            if(mysql_num_rows($q_u)>0 || mysql_num_rows($q_k)>0 || mysql_num_rows($q_p)>0 || mysql_num_rows($q_a)>0 ){
                  echo "<table  class=\"wp-list-table widefat fixed users\">";
                  echo "<thead>";
                  echo "<tr>";
                  echo "<th>No.Reservasi</th>";
                  echo "<th>Nama</th>";
                  echo "<th>Kontak</th>";
                  echo "<th>Waktu</th>";
                  echo "<th>Harga</th>";
                  echo "<th>QTY Tiket</th>";
                  echo "<th>Total</th>";
                  echo "</tr>";
                  echo "</thead>";
                  echo "<tbody>";
                  while($hasil=mysql_fetch_array($q_u)){
                       $jam = $hasil[waktu_jam];
                       $menit = $hasil[waktu_menit];
                       if(strlen($hasil[waktu_jam])==1){
                           $jam = "0".$hasil[waktu_jam];
                       }
                       if(strlen($hasil[waktu_menit])==1){
                           $menit = "0".$hasil[waktu_menit];
                       }
                       $jam = $jam.":".$menit;
                       $total = $hasil["jumlah_personil"] * $hasil["harga_tiket"];
                       echo "<tr>";
                       echo "<td>$hasil[no_reservasi]</td>";
                       echo "<td>$hasil[nama]</td>";
                       echo "<td>$hasil[no_kontak]</td>";
                       echo "<td>$hasil[waktu_tanggal] $hasil[waktu_bulan] $hasil[waktu_tahun] jam $jam</td>";
                       echo "<td>$hasil[harga_tiket]</td>";
                       echo "<td>$hasil[jumlah_personil]</td>";
                       echo "<td>$total</td>";
                       echo "</tr>";
                  }
                  while($hasil=mysql_fetch_array($q_k)){
                       $jam = $hasil[waktu_jam];
                       $menit = $hasil[waktu_menit];
                       if(strlen($hasil[waktu_jam])==1){
                           $jam = "0".$hasil[waktu_jam];
                       }
                       if(strlen($hasil[waktu_menit])==1){
                           $menit = "0".$hasil[waktu_menit];
                       }
                       $jam = $jam.":".$menit;
                       $total = $hasil["jumlah_personil"] * $hasil["harga_tiket"];
                       echo "<tr>";
                       echo "<td>$hasil[no_reservasi]</td>";
                       echo "<td>$hasil[nama]</td>";
                       echo "<td>$hasil[no_kontak]</td>";
                       echo "<td>$hasil[waktu_tanggal] $hasil[waktu_bulan] $hasil[waktu_tahun] jam $jam</td>";
                       echo "<td>$hasil[harga_tiket]</td>";
                       echo "<td>$hasil[jumlah_personil]</td>";
                       echo "<td>$total</td>";
                       echo "</tr>";
                  }
                  while($hasil=mysql_fetch_array($q_p)){
                       $jam = $hasil[waktu_jam];
                       $menit = $hasil[waktu_menit];
                       if(strlen($hasil[waktu_jam])==1){
                           $jam = "0".$hasil[waktu_jam];
                       }
                       if(strlen($hasil[waktu_menit])==1){
                           $menit = "0".$hasil[waktu_menit];
                       }
                       $jam = $jam.":".$menit;
                       $total = $hasil["jumlah_personil"] * $hasil["harga_tiket"];
                       echo "<tr>";
                       echo "<td>$hasil[no_reservasi]</td>";
                       echo "<td>$hasil[nama]</td>";
                       echo "<td>$hasil[no_kontak]</td>";
                       echo "<td>$hasil[waktu_tanggal] $hasil[waktu_bulan] $hasil[waktu_tahun] jam $jam</td>";
                       echo "<td>$hasil[harga_tiket]</td>";
                       echo "<td>$hasil[jumlah_personil]</td>";
                       echo "<td>$total</td>";
                       echo "</tr>";
                  }
                  while($hasil=mysql_fetch_array($q_a)){
                       $jam = $hasil[waktu_jam];
                       $menit = $hasil[waktu_menit];
                       if(strlen($hasil[waktu_jam])==1){
                           $jam = "0".$hasil[waktu_jam];
                       }
                       if(strlen($hasil[waktu_menit])==1){
                           $menit = "0".$hasil[waktu_menit];
                       }
                       $jam = $jam.":".$menit;
                       $total = $hasil["jumlah_personil"] * $hasil["harga_tiket"];
                       echo "<tr>";
                       echo "<td>$hasil[no_reservasi]</td>";
                       echo "<td>$hasil[nama]</td>";
                       echo "<td>$hasil[no_kontak]</td>";
                       echo "<td>$hasil[waktu_tanggal] $hasil[waktu_bulan] $hasil[waktu_tahun] jam $jam</td>";
                       echo "<td>$hasil[harga_tiket]</td>";
                       echo "<td>$hasil[jumlah_personil]</td>";
                       echo "<td>$total</td>";
                       echo "</tr>";
                  }
                  echo "<tbody>";
                  echo "<table>";
            }else{
                 tampilNotifikasi("Maaf, Tidak ada reservasi pada waktu tersebut. Terima kasih.");
            }
        }else{
            $q = mysql_query("select * from wp_reservasi_$jenis where waktu_bulan='$bulan' and waktu_tahun='$tahun' and status='1'");
            if(mysql_num_rows($q)>0){
                  echo "<table  class=\"wp-list-table widefat fixed users\">";
                  echo "<thead>";
                  echo "<tr>";
                  echo "<th>No.Reservasi</th>";
                  echo "<th>Nama</th>";
                  echo "<th>Kontak</th>";
                  echo "<th>Waktu</th>";
                  echo "<th>Harga</th>";
                  echo "<th>QTY Tiket</th>";
                  echo "<th>Total</th>";
                  echo "</tr>";
                  echo "</thead>";
                  echo "<tbody>";
                  while($hasil=mysql_fetch_array($q)){
                       $jam = $hasil[waktu_jam];
                       $menit = $hasil[waktu_menit];
                       if(strlen($hasil[waktu_jam])==1){
                           $jam = "0".$hasil[waktu_jam];
                       }
                       if(strlen($hasil[waktu_menit])==1){
                           $menit = "0".$hasil[waktu_menit];
                       }
                       
                       $jam = $jam.":".$menit;

                       $total = $hasil["jumlah_personil"] * $hasil["harga_tiket"];
                        
                       echo "<tr>";
                       echo "<td>$hasil[no_reservasi]</td>";
                       echo "<td>$hasil[nama]</td>";
                       echo "<td>$hasil[no_kontak]</td>";
                       echo "<td>$hasil[waktu_tanggal] $hasil[waktu_bulan] $hasil[waktu_tahun] jam $jam</td>";
                       echo "<td>$hasil[harga_tiket]</td>";
                       echo "<td>$hasil[jumlah_personil]</td>";
                       echo "<td>$total</td>";
                       echo "</tr>";
                  }
                  echo "<tbody>";
                  echo "<table>";
            }else{
                tampilNotifikasi("Maaf, Tidak ada reservasi pada waktu tersebut. Terima kasih.");
            }
        }
        tutupKoneksi();
    }

    function tampilPengumuman(){
        bukaKoneksi();
        $b = mysql_query("select * from wp_geologi_pengumuman");
        if(mysql_num_rows($b)==0){
           setSubJudul("Pengumuman");
    	   echo "<div class=\"update-nag\">Tidak ada data pengumuman tersimpan di database.</div>";
    	}else{
           echo "<table class=\"wp-list-table widefat fixed users\">
	   	    <thead>
	                <tr>
	                    <th width=\"25\">No</th>
                            <th>Judul Pengumuman</th>
                            <th>Tanggal Publikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>";
              $x = 1;
              while($h=mysql_fetch_array($b)){
                  if($h[4]==0){ //unpublish
                      $uri_publish = add_query_arg(array('page'=>'kelola_pengumuman','aksi'=>'publish','id_pengumuman'=>$h[0]));
                      $stat = "Publish";
                  }else
                  if($h[4]==1){ //published
                      $uri_publish = add_query_arg(array('page'=>'kelola_pengumuman','aksi'=>'unpublish','id_pengumuman'=>$h[0]));
                      $stat = "Unpublish";
                  }
                  
                  $uri_lihat_detail = add_query_arg(array('page'=>'kelola_pengumuman','aksi'=>'detail','id_pengumuman'=>$h[0]));
                  $uri_edit = add_query_arg(array('page'=>'kelola_pengumuman','aksi'=>'edit','id_pengumuman'=>$h[0]));
                  $uri_delete = add_query_arg(array('page'=>'kelola_pengumuman','aksi'=>'delete','id_pengumuman'=>$h[0]));
                  echo "<tr>";
                      echo "<td>$x</td>";
                      echo "<td>$h[judul]</td>";
                      echo "<td>$h[tanggal_publish]</td>";
                      echo "<td>
                              <a href=\"$uri_publish\">$stat</a> |
                      	      <a href=\"$uri_edit\">Edit</a> | 
                      	      <a href=\"$uri_delete\">Delete</a> |
                      	      <a href=\"$uri_lihat_detail\">Detail</a> |   
                      	    </td>";
                  echo "</tr>";
                  $x++;
              }
              echo "</tbody>";
              echo "<tfoot>
                       <tr><td colspan=\"4\" align=\"center\"></td></tr>
                    </tfoot>";
           echo "</table>";
        }
        tutupKoneksi();
    } 

    function tambahPengumuman(){
    $uri_post = add_query_arg(array('page'=>'kelola_pengumuman','aksi'=>'insert','id_pengumuman'=>'none'));              
    echo "
        <form action=\"$uri_post\" method=\"post\">
        <table class=\"wp-list-table widefat fixed users\">
            <thead>
            <tr>
                <th align=\"center\">Tambah Pengumuman</td>
            </tr>
            </thead> 
            <tbody>
            <tr>
                <td align=center>
	            <table width=\"100%\" style=\"line-spacing:200%;\">    
	            <tr>
	                <td width=\"120\">Judul</td>
	                <td width=\"15\">:</td>
	                <td><input type=\"text\" name=\"judul\" required placeholder=\"Judul Pengumuman\" style=\"min-width:350px;\"></td>
	            </tr>
                    <tr>
	                <td>Isi Pengumuman</td>
	                <td>:</td>
	                <td><textarea name=\"isi\" required placeholder=\"Isi Pengumuman\" style=\"min-width:350px;height:120px;\"></textarea></td>
	            </tr>
                    <tr>
	                <td>Publikasikan</td>
	                <td>:</td>
	                <td>
                            <input type=\"radio\" name=\"status\" value=\"1\" checked> Ya, publikasikan!<br>
                            <input type=\"radio\" name=\"status\" value=\"0\"> Tidak, tidak di publikasikan!<br>
                        </td>
	            </tr>
	            </table>
                </td> 
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td align=\"center\">
                    <input type=\"submit\"  value=\"Submit\">
                </td>
            </tr>
            </tfoot>
        </table></form>";
    } 

    function insertPengumuman($judul, $isi, $status){
        bukaKoneksi();
        $tanggal_publish = date("Y-m-d");
        $e = mysql_query("insert into wp_geologi_pengumuman values('','$tanggal_publish','$judul','$isi','$status')");
        if($e){
    	   return true;
    	}else{
    	   return false;
    	}
        tutupKoneksi();
    }

    function detailPengumuman($id_pengumuman){
    bukaKoneksi();
    $baca = mysql_query("select * from wp_geologi_pengumuman where id_pengumuman='$id_pengumuman'");
    $h = mysql_fetch_array($baca);
    if($h[4]=="1"){ $stat = "Terpublikasi";}else{$stat = "Tidak Terpublikasi";}
    $uri_kembali = add_query_arg(array('page'=>'kelola_pengumuman','aksi'=>'init','id_pengumuman'=>'none'));              
    echo "
        <table class=\"wp-list-table widefat fixed users\">
            <thead>
            <tr>
                <th align=\"center\">Tambah Pengumuman</td>
            </tr>
            </thead> 
            <tbody>
            <tr>
                <td align=center>
	            <table width=\"100%\" style=\"line-spacing:200%;\">    
	            <tr>
	                <td width=\"120\">Judul</td>
	                <td width=\"15\">:</td>
	                <td>$h[2]</td>
	            </tr>
                    <tr>
	                <td>Isi Pengumuman</td>
	                <td>:</td>
	                <td>$h[3]</td>
	            </tr>
                    <tr>
	                <td>Publikasikan</td>
	                <td>:</td>
	                <td>$stat</td>
	            </tr>
	            </table>
                </td> 
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td align=\"center\">
                    <a href=\"$uri_kembali\">Kembali</a>
                </td>
            </tr>
            </tfoot>
        </table>";
        tutupKoneksi();
    } 
    
    function changeStatus($instruksi, $id_pengumuman){
    bukaKoneksi();
    if($instruksi=="publish"){
       $e = mysql_query("update wp_geologi_pengumuman set status='1' where id_pengumuman='$id_pengumuman'");
    }else
    if($instruksi=="unpublish"){
       $e = mysql_query("update wp_geologi_pengumuman set status='0' where id_pengumuman='$id_pengumuman'");
    }
    
      if($e){
         return true;
      }else{
         return false;
      } 
      tutupKoneksi();
    }
    
    function deletePengumuman($id_pengumuman){
        bukaKoneksi();
        $e = mysql_query("delete from wp_geologi_pengumuman where id_pengumuman='$id_pengumuman'");
        if($e){
           return true;
        }else{
           return false;
        } 
        tutupKoneksi();
    }

    function editPengumuman($id_pengumuman){
    $uri_post = add_query_arg(array('page'=>'kelola_pengumuman','aksi'=>'update','id_pengumuman'=>$id_pengumuman));   
    $baca = mysql_query("select * from wp_geologi_pengumuman where id_pengumuman='$id_pengumuman'");
    $h = mysql_fetch_array($baca);      
    if($h[4]=="1"){ 
        $stat = "<input type=\"radio\" name=\"status\" value=\"1\" checked>Publikasikan!<br>
                 <input type=\"radio\" name=\"status\" value=\"0\" >Tidak!<br>";
    }else{
        $stat = "<input type=\"radio\" name=\"status\" value=\"0\">Publikasikan!<br>
                 <input type=\"radio\" name=\"status\" value=\"1\" checked>Tidak!<br>";
    }
    echo "
        <form action=\"$uri_post\" method=\"post\">
        <table class=\"wp-list-table widefat fixed users\">
            <thead>
            <tr>
                <th align=\"center\">Tambah Pengumuman</td>
            </tr>
            </thead> 
            <tbody>
            <tr>
                <td align=center>
	            <table width=\"100%\" style=\"line-spacing:200%;\">    
	            <tr>
	                <td width=\"120\">Judul</td>
	                <td width=\"15\">:</td>
	                <td><input type=\"text\" name=\"judul\" required placeholder=\"Judul Pengumuman\" style=\"min-width:350px;\" value=\"$h[2]\"></td>
	            </tr>
                    <tr>
	                <td>Isi Pengumuman</td>
	                <td>:</td>
	                <td><textarea name=\"isi\" required placeholder=\"Isi Pengumuman\" style=\"min-width:350px;height:120px;\">$h[3]</textarea></td>
	            </tr>
                    <tr>
	                <td>Publikasikan</td>
	                <td>:</td>
	                <td>
                             $stat
                            <!--input type=\"radio\" name=\"status\" value=\"1\" $stat> Ya, publikasikan!<br>
                            <input type=\"radio\" name=\"status\" value=\"0\" $stat> Tidak, tidak di publikasikan!<br-->
                        </td>
	            </tr>
	            </table>
                </td> 
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td align=\"center\">
                    <input type=\"submit\"  value=\"Perbaharui\">
                </td>
            </tr>
            </tfoot>
        </table></form>";
    }

    function updatePengumuman($id_pengumuman,$judul,$isi,$status){
        bukaKoneksi();
        $e = mysql_query("update wp_geologi_pengumuman set judul='$judul',isi='$isi',status='$status' where id_pengumuman='$id_pengumuman'");
        if($e){
    	   return true;
    	}else{
    	   return false;
    	}
        tutupKoneksi();
    }

    

    //----------------------------------------MASTER MENU-----------------------------------------
    function reservasiParentMenu() {
    add_menu_page('Reservasi Pengunjung','Reservasi','manage_options','reservasi_pengunjung', 'reservasiInitMenu');
    }
    
    function kelolaPengumuman() {
    add_menu_page('Kelola Pengumuman','Pengumuman','manage_options','kelola_pengumuman', 'pengumumanInitMenu');
    }

    function reservasiInitMenu(){
    	reservasiHeader();
    	reservasiTitle("Reservasi Pengunjung");
    	setSubJudul("Reservasi Kategori Umum");
    	tampilReservasiUmumUnconfirmed();
    	setSubJudul("Reservasi Kategori Khusus");
    	tampilReservasiKhususUnconfirmed();
    	setSubJudul("Reservasi Kategori Pelajar");
    	tampilReservasiPelajarUnconfirmed();
    	setSubJudul("Reservasi Kategori Asing");
    	tampilReservasiAsingUnconfirmed();
    	reservasiFooter();
    }
    
    function pengumumanInitMenu(){
    	reservasiHeader();
        pengumumanTitle("Pengumuman Museum Geologi");
        if(isset($_GET['aksi']) || isset($_GET['id_pengumuman'])){
           if($_GET['aksi']=="tambah"){
              setSubJudul("Tambah Pengumuman");
              tambahPengumuman();
           }else
           if($_GET['aksi']=="insert"){
              setSubJudul("Tambah Pengumuman");
              $judul = $_POST['judul'];
              $isi = $_POST['isi'];
              $status = $_POST['status'];
              $hasil = insertPengumuman($judul,$isi,$status);
              $uri_kembali = add_query_arg(array('page'=>'kelola_pengumuman','aksi'=>'init','id_pengumuman'=>'none'));
              if($hasil){
    	    	    tampilNotifikasi("Pengumuman telah berhasil disimpan <a href=$uri_kembali>Kembali ke pengumuman!</a>.");
    	      }else{
    	    	    tampilNotifikasi("Maaf, pengumuman gagal disimpan. Silahkan periksa koneksi database");
    	      }
           }else
           if($_GET['aksi']=="init"){
              setSubJudul("Pengumuman");
              tampilPengumuman();
           }else
           if($_GET['aksi']=="detail"){
              setSubJudul("Detail Pengumuman");
              detailPengumuman($_GET['id_pengumuman']);
           }else
           if($_GET['aksi']=="publish" || $_GET['aksi']=="unpublish"){
              setSubJudul("Ubah Status Publikasi");
              
              if($_GET['aksi']=="publish"){
                 $instruksi = "publish";
              }else
              if($_GET['aksi']=="unpublish"){
                 $instruksi = "unpublish";
              }

              $hasil = changeStatus($instruksi,$_GET['id_pengumuman']);
              $uri_kembali = add_query_arg(array('page'=>'kelola_pengumuman','aksi'=>'init','id_pengumuman'=>'none'));
              if($hasil){
    	    	    tampilNotifikasi("Status pengumuman telah berhasil diperbaharui <a href=$uri_kembali>Kembali ke pengumuman!</a>.");
    	      }else{
    	    	    tampilNotifikasi("Maaf, status pengumuman gagal diperbaharui. Silahkan periksa koneksi database");
    	      }
           }else
           if($_GET['aksi']=="delete"){
              setSubJudul("Delete Pengumuman");
              $hasil = deletePengumuman($_GET['id_pengumuman']);
              $uri_kembali = add_query_arg(array('page'=>'kelola_pengumuman','aksi'=>'init','id_pengumuman'=>'none'));
              if($hasil){
    	    	    tampilNotifikasi("Pengumuman telah berhasil dihapus <a href=$uri_kembali>Kembali ke pengumuman!</a>.");
    	      }else{
    	    	    tampilNotifikasi("Maaf, pengumuman gagal dihapus. Silahkan periksa koneksi database");
    	      }
           }else
           if($_GET['aksi']=="edit"){
              setSubJudul("Edit Pengumuman");
              editPengumuman($_GET['id_pengumuman']);
           }else
           if($_GET['aksi']=="update"){
              setSubJudul("Update Pengumuman");
              $judul = $_POST['judul'];
              $isi = $_POST['isi'];
              $status = $_POST['status'];
              $uri_kembali = add_query_arg(array('page'=>'kelola_pengumuman','aksi'=>'init','id_pengumuman'=>'none'));
              $hasil = updatePengumuman($_GET['id_pengumuman'],$judul,$isi,$status);
              if($hasil){
    	    	    tampilNotifikasi("Pengumuman telah berhasil diperbaharui <a href=$uri_kembali>Kembali ke pengumuman!</a>.");
    	      }else{
    	    	    tampilNotifikasi("Maaf, pengumuman gagal diperbaharui. Silahkan periksa koneksi database");
    	      }
           }
        }else
        if(!isset($_GET['aksi']) || !isset($_GET['id_pengumuman'])){
           setSubJudul("Pengumuman");
           tampilPengumuman();
        }
        reservasiFooter();
    }
    
    //add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
    function reservasiChildMenu(){
        add_submenu_page(  
            'reservasi_pengunjung' 
            , 'Reservasi Kategori Umum' 
            , 'Kategori Umum'
            , 'manage_options'
            , 'kategori_umum'
            , 'reservasiUmumInit' );
        add_submenu_page(  
            'reservasi_pengunjung' 
            , 'Reservasi Kategori Khusus' 
            , 'Kategori Khusus'
            , 'manage_options'
            , 'kategori_khusus'
            , 'reservasiKhususInit' );
        add_submenu_page(  
            'reservasi_pengunjung' 
            , 'Reservasi Kategori Pelajar' 
            , 'Kategori Pelajar'
            , 'manage_options'
            , 'kategori_pelajar'
            , 'reservasiPelajarInit' );
        add_submenu_page(  
            'reservasi_pengunjung' 
            , 'Reservasi Kategori Asing' 
            , 'Kategori Asing'
            , 'manage_options'
            , 'kategori_asing'
            , 'reservasiAsingInit' );
        add_submenu_page(  
            'reservasi_pengunjung' 
            , 'Report Reservasi' 
            , 'Report Reservasi'
            , 'manage_options'
            , 'report'
            , 'reportReservasiInit' );
    }
    
    function reservasiUmumInit(){
    	reservasiHeader();
    	reservasiTitle("Reservasi Pengunjung");
    	setSubJudul("Reservasi Kategori Umum");
    	if(!isset($_GET['aksi'])||!isset($_GET['no_reservasi'])){
    	   tampilReservasiUmumUnconfirmed();
    	}else
    	if(isset($_GET['aksi'])||isset($_GET['no_reservasi'])){
    	    if($_GET['aksi']=="terima"){
    	    	$hasil = reservasiTerima("umum",$_GET['no_reservasi']);
    	    	if($hasil){
    	    	    tampilNotifikasi("Reservasi telah dimasukkan ke dalam database kunjungan.");
    	    	}else{
    	    	    tampilNotifikasi("Maaf, data gagal dimasukkan ke dalam database. Silahkan periksa koneksi database");
    	    	}
    	    }else
    	    if($_GET['aksi']=="tolak"){
    	    	$hasil = reservasiTolak("umum",$_GET['no_reservasi']);
                if($hasil){
    	    	    tampilNotifikasi("Reservasi telah berhasil ditolak.");
    	    	}else{
    	    	    tampilNotifikasi("Maaf, penolakan reservasi gagal dilakukan. Silahkan periksa koneksi database");
    	    	}
    	    }else
    	    if($_GET['aksi']=="detail"){
    	    	lihatDetailUmum($_GET['no_reservasi']);
    	    }else{
    	    	tampilReservasiUmumUnconfirmed();
    	    }
    	    //tampilReservasiUmumUnconfirmed();
    	}
    	
    	reservasiFooter();
    }
    
    function reservasiKhususInit(){
    	reservasiHeader();
    	reservasiTitle("Reservasi Pengunjung");
    	setSubJudul("Reservasi Kategori Khusus");
        if(!isset($_GET['aksi'])||!isset($_GET['no_reservasi'])){
    	   tampilReservasiKhususUnconfirmed();
    	}else
    	if(isset($_GET['aksi'])||isset($_GET['no_reservasi'])){
    	    if($_GET['aksi']=="terima"){
    	    	$hasil = reservasiTerima("khusus",$_GET['no_reservasi']);
    	    	if($hasil){
    	    	    tampilNotifikasi("Reservasi telah dimasukkan ke dalam database kunjungan.");
    	    	}else{
    	    	    tampilNotifikasi("Maaf, data gagal dimasukkan ke dalam database. Silahkan periksa koneksi database");
    	    	}
    	    }else
    	    if($_GET['aksi']=="tolak"){
    	    	$hasil = reservasiTolak("khusus",$_GET['no_reservasi']);
                if($hasil){
    	    	    tampilNotifikasi("Reservasi telah berhasil ditolak.");
    	    	}else{
    	    	    tampilNotifikasi("Maaf, penolakan reservasi gagal dilakukan. Silahkan periksa koneksi database");
    	    	}
    	    }else
    	    if($_GET['aksi']=="detail"){
    	    	lihatDetailKhusus($_GET['no_reservasi']);
    	    }else{
    	        tampilReservasiKhususUnconfirmed();
            }
    	}
    	reservasiFooter();
    }
    
    function reservasiPelajarInit(){
    	reservasiHeader();
    	reservasiTitle("Reservasi Pengunjung");
    	setSubJudul("Reservasi Kategori Pelajar");
    	if(!isset($_GET['aksi'])||!isset($_GET['no_reservasi'])){
    	   tampilReservasiPelajarUnconfirmed();
    	}else
    	if(isset($_GET['aksi'])||isset($_GET['no_reservasi'])){
    	    if($_GET['aksi']=="terima"){
    	    	$hasil = reservasiTerima("pelajar",$_GET['no_reservasi']);
    	    	if($hasil){
    	    	    tampilNotifikasi("Reservasi telah dimasukkan ke dalam database kunjungan.");
    	    	}else{
    	    	    tampilNotifikasi("Maaf, data gagal dimasukkan ke dalam database. Silahkan periksa koneksi database");
    	    	}
    	    }else
    	    if($_GET['aksi']=="tolak"){
    	    	$hasil = reservasiTolak("pelajar",$_GET['no_reservasi']);
                if($hasil){
    	    	    tampilNotifikasi("Reservasi telah berhasil ditolak.");
    	    	}else{
    	    	    tampilNotifikasi("Maaf, penolakan reservasi gagal dilakukan. Silahkan periksa koneksi database");
    	    	}
    	    }else
    	    if($_GET['aksi']=="detail"){
    	    	lihatDetailPelajar($_GET['no_reservasi']);
    	    }else{
    	        tampilReservasiPelajarUnconfirmed();
            }
    	}
    	reservasiFooter();
    }
    
    function reservasiAsingInit(){
    	reservasiHeader();
    	reservasiTitle("Reservasi Pengunjung");
    	setSubJudul("Reservasi Kategori Asing");
    	if(!isset($_GET['aksi'])||!isset($_GET['no_reservasi'])){
    	   tampilReservasiAsingUnconfirmed();
    	}else
    	if(isset($_GET['aksi'])||isset($_GET['no_reservasi'])){
    	    if($_GET['aksi']=="terima"){
    	    	$hasil = reservasiTerima("asing",$_GET['no_reservasi']);
    	    	if($hasil){
    	    	    tampilNotifikasi("Reservasi telah dimasukkan ke dalam database kunjungan.");
    	    	}else{
    	    	    tampilNotifikasi("Maaf, data gagal dimasukkan ke dalam database. Silahkan periksa koneksi database");
    	    	}
    	    }else
    	    if($_GET['aksi']=="tolak"){
    	    	$hasil = reservasiTolak("asing",$_GET['no_reservasi']);
                if($hasil){
    	    	    tampilNotifikasi("Reservasi telah berhasil ditolak.");
    	    	}else{
    	    	    tampilNotifikasi("Maaf, penolakan reservasi gagal dilakukan. Silahkan periksa koneksi database");
    	    	}
    	    }else
    	    if($_GET['aksi']=="detail"){
    	    	lihatDetailAsing($_GET['no_reservasi']);
    	    }else{
    	        tampilReservasiAsingUnconfirmed();
            }
    	}
    	reservasiFooter();
    }

    function reportReservasiInit(){
        reservasiHeader();
    	reservasiTitle("Reservasi Pengunjung");
    	setSubJudul("Report Reservasi");
        if(!isset($_GET['aksi'])){
    	   tampilFormReportInit();
    	}else
    	if(isset($_GET['aksi'])){
    	   tampilFormReportInit();      
           tampilResultReport($_POST["jenis"],$_POST["bulan"],$_POST["tahun"]);
        }else{
           tampilFormReportInit();
        }
        reservasiFooter();
    }
    
    //---------------------------------Buka Plugin Harga-----------------------------------------
    //add_action('admin_menu','add_plugin');
    //add_action('admin_menu','add_submenu');
    add_action('admin_menu','kelolaHargaTiket');

    function kelolaHargaTiket() {
       add_menu_page('Kelola Harga Tiket','Harga Tiket','manage_options','kelola_hargatiket', 'initHargaTiket');
    }
    function updateHarga(){
       $res = $_GET['no_reservasi'];
       $url_post = add_query_arg(array('page'=>'kelola_hargatiket','aksi'=>'insert','no_reservasi'=>$res));
       echo "<h2>Kelola Harga Tiket</h2>";
       $baca = mysql_query("select * from wp_reservasi_harga where id_harga='$res'");
       $h = mysql_fetch_array($baca);
       echo "<form action=\"$url_post\" method=\"POST\" >
       <table>
            <tr>
            <th>Kategori</th>
            <th>Harga</th>
            <td></td>
	    </tr>
	    <tr>
	    <td><b>$h[1]</b></td>
            <td align=\"right\"><input type=\"text\" name=\"harga\" placeholder=\"2000\" value=\"$h[2]\"></td>
            <td><input type=\"submit\" value=\"Perbaharui\"></td>
            </table></form>";


    }

    function tampilHarga(){
        bukaKoneksi();
        $query = mysql_query("select * from wp_reservasi_harga");
	if(mysql_num_rows($query)==0){
		echo "<div class=\"update-nag\">Tidak ada data pengumuman tersimpan di database.</div>";
	}else{
		echo "<table class=\"wp-list-table widefat fixed users\">
			<thead>
			<tr>
			<th width=\"25\">No</th>
			<th>Kategori</th>
			<th>Harga</th>
			<th>Aksi</th>
			</tr>
			</thead>
                  <tbody>";

                  while($h=mysql_fetch_array($query)){
                  	$uri_edit = add_query_arg(array('page'=>'kelola_hargatiket','aksi'=>'edit','no_reservasi'=>$h[0]));
                  	echo "<tr>
                  		  <td>$h[id_harga]</td>
                  		  <td>$h[kategori]</td>
                  		  <td>$h[harga]</td>
                  		  <td><a href=\"$uri_edit\">Edit Harga</a></td>
                  		  </tr>";
                  }
                  echo "</tbody>";
				  echo "<tfoot>
				        <tr><td colspan=\"4\" align=\"center\"></td></tr>
				        </tfoot>";
           echo "</table>";
		}

		tutupKoneksi();
	}
        
        function initHargaTiket(){
    	reservasiHeader();
        reservasiTitle("Harga Tiket");
    	if(isset($_GET['aksi'])||isset($_GET['no_reservasi'])){
    	    if($_GET['aksi'] == "edit"){
                setSubJudul("Edit Harga Tiket");
    	    	updateHarga();
    	    }else
    	    if($_GET['aksi'] == "insert"){
                setSubJudul("Update Harga Tiket");
    		$harga = $_POST['harga'];
    		//$kategori = $_POST['kategori'];
		$hsl = updateHargaTiket($harga,$_GET['no_reservasi']);
		//echo $hsl;
		$url_kembali = add_query_arg(array('page'=>'kelola_hargatiket','aksi'=>'init','no_reservasi'=>'none'));
			if($hsl){
				 tampilNotifikasi("Harga telah berhasil diperbaharui, silahkan <a href=$url_kembali>kembali</a>.");
				}else{
				 tampilNotifikasi("Maaf, pengumuman gagal disimpan. Silahkan periksa koneksi database");
				}
    		}else
    		if($_GET['aksi']=="init"){
                     setSubJudul("List Harga Tiket");
    	             tampilHarga();
    		}
    	}else
        if(!isset($_GET['aksi']) || !isset($_GET['no_reservasi'])){

           tampilHarga();
        }
    	reservasiFooter();

    }

    function updateHargaTiket($harga,$kategori){
    	bukaKoneksi();
	$query = mysql_query("UPDATE wp_reservasi_harga set harga = '$harga' where id_harga='$kategori'")or die(mysql_error());
	//echo $harga.$kategori;
	//die();
	if($query){
		return true;
	}else{
		return false;
	}
    	tutupKoneksi();

    }

    //---------------------------------Tutup Plugin Harga------------------------------------

    //------------------------------------EKSEKUTOR-----------------------------------------------
    add_action('admin_menu','reservasiParentMenu');
    add_action('admin_menu','reservasiChildMenu');
    add_action('admin_menu','kelolaPengumuman');
}
?>