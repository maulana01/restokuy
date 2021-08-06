<?php
define("DEVELOPMENT", TRUE);
function dbConnect()
{
	$db = new mysqli("localhost:3306", "root", "", "restokuy"); // Sesuaikan dengan konfigurasi server anda.
	return $db;
}

/*========================== Dashboard Admin ==========================*/
function totalPelayan()
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT count(jabatan) as Pelayan
						 FROM pegawai
						 WHERE jabatan='pelayan'");
		if ($res) {
			$data = $res->fetch_object();
			$totalPelayan = $data->Pelayan;
			$res->free();
			echo $totalPelayan;
			return $totalPelayan;
		} else
			return FALSE;
	} else
		return FALSE;
}

function totalKoki()
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT count(jabatan) as Koki
						 FROM pegawai
						 WHERE jabatan='koki'");
		if ($res) {
			$data = $res->fetch_object();
			$totalKoki = $data->Koki;
			$res->free();
			echo $totalKoki;
			return $totalKoki;
		} else
			return FALSE;
	} else
		return FALSE;
}

function totalKasir()
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT count(jabatan) as Kasir
						 FROM pegawai
						 WHERE jabatan='kasir'");
		if ($res) {
			$data = $res->fetch_object();
			$totalKasir = $data->Kasir;
			$res->free();
			echo $totalKasir;
			return $totalKasir;
		} else
			return FALSE;
	} else
		return FALSE;
}

function totalMenu()
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT count(id_menu) as Menu
						 FROM menu");
		if ($res) {
			$data = $res->fetch_object();
			$totalMenu = $data->Menu;
			$res->free();
			echo $totalMenu;
			return $totalMenu;
		} else
			return FALSE;
	} else
		return FALSE;
}

/*========================== END DASHBOARD ADMIN ==========================*/

/*========================== CRUD Pegawai ==========================*/
function getListPegawai()
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT p.*, a.username
						 FROM pegawai p JOIN akun a WHERE p.id_akun = a.id_akun
						 ORDER BY id_pegawai");
		if ($res) {
			$data = $res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		} else
			return FALSE;
	} else
		return FALSE;
}

function tambahDataPegawai()
{
	if (isset($_POST["btn_tambah"])) {
		$db = dbConnect();
		if ($db->connect_errno == 0) {
			// Bersihkan data
			$namaPegawai	    = $db->escape_string($_POST["nama_pegawai"]);
			$tempat_lahir	    = $db->escape_string($_POST["tempat_lahir"]);
			$tgl_lahir   	    = $db->escape_string($_POST["tgl_lahir"]);
			$alamat	            = $db->escape_string($_POST["alamat"]);
			$no_hp	            = $db->escape_string($_POST["no_hp"]);
			$jabatan	        = $db->escape_string($_POST["jabatan"]);
			$username	        = $db->escape_string($_POST["username"]);
			$password	        = $db->escape_string($_POST["password"]);
			// Susun query insert
			$sql = "INSERT INTO akun(id_akun, username, password)
            VALUES('', '$username', '$password')";

			// Eksekusi query insert
			$res = $db->query($sql);
			if ($res === TRUE) {

				// Ambil IdAkun yang terbaru
				$ambilIdAkun = "SELECT MAX(id_akun) as id_akun from akun";
				$queryAmbilIdAkun = $db->query($ambilIdAkun);
				$fetchIdAkun = $queryAmbilIdAkun->fetch_object();
				$IdAkun = $fetchIdAkun->id_akun;

				$sql2 = "INSERT INTO pegawai(id_pegawai, nama_pegawai, alamat, tempat_lahir, tgl_lahir, no_hp, jabatan, id_akun)
                VALUES('', '$namaPegawai', '$alamat', '$tempat_lahir', '$tgl_lahir', '$no_hp', '$jabatan', '$IdAkun')";

				// Eksekusi Query Insert Transaksi
				$db->query($sql2);

				if ($db->affected_rows > 0) { // jika ada penambahan data
					alertBerhasil("Data Pegawai Berhasil Ditambah!");
					echo '<meta http-equiv="refresh" content="3;URL=pegawai-tambah.php" />';
				}
			} else {
				alertGagal("Gagal Menambahkan Data Pegawai!");
				echo '<meta http-equiv="refresh" content="3;URL=pegawai-tambah.php" />';
			}
		} else
			echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
	}
}

function hapusDataPegawai()
{
	if (isset($_POST["hapusPegawai"])) {
		$db = dbConnect();
		if ($db->connect_errno == 0) {
			$id_akun = $db->escape_string($_POST["id_akun"]);
			// Susun query delete
			$sql = "DELETE FROM akun WHERE id_akun='$id_akun'";
			// Eksekusi query delete
			$res = $db->query($sql);
			if ($res) {
				if ($db->affected_rows > 0) { // jika ada data terhapus
					alertBerhasil("Data Pegawai Berhasil Dihapus!");
					echo '<meta http-equiv="refresh" content="3;URL=pegawai.php" />';
				} else { // Jika sql sukses tapi tidak ada data yang dihapus
					alertGagal("Gagal Menghapus Data Pegawai dikarenakan data sudah tidak ada.");
					echo '<meta http-equiv="refresh" content="3;URL=pegawai.php" />';
				}
			} else { // gagal query
				alertGagal("Gagal Menghapus Data Pegawai!");
				echo '<meta http-equiv="refresh" content="3;URL=pegawai.php" />';
			}
		} else
			echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
	}
}

function getDataPegawai($id_pegawai, $id_akun)
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT p.*, a.*
						 FROM pegawai p JOIN akun a
						 WHERE p.id_pegawai='$id_pegawai' and a.id_akun='$id_akun'");
		if ($res) {
			if ($res->num_rows > 0) {
				$data = $res->fetch_assoc();
				$res->free();
				return $data;
			} else
				return FALSE;
		} else
			return FALSE;
	} else
		return FALSE;
}

function updateDataPegawai()
{
	if (isset($_POST["btn_edit"])) {
		$db = dbConnect();
		if ($db->connect_errno == 0) {

			$id_akun	    = $db->escape_string($_POST["id_akun"]);
			$id_pegawai	    = $db->escape_string($_POST["id_pegawai"]);
			$namaPegawai	    = $db->escape_string($_POST["nama_pegawai"]);
			$tempat_lahir	    = $db->escape_string($_POST["tempat_lahir"]);
			$tgl_lahir   	    = $db->escape_string($_POST["tgl_lahir"]);
			$alamat	            = $db->escape_string($_POST["alamat"]);
			$no_hp	            = $db->escape_string($_POST["no_hp"]);
			$jabatan	        = $db->escape_string($_POST["jabatan"]);
			$username	        = $db->escape_string($_POST["username"]);
			$password	        = $db->escape_string($_POST["password"]);
			// Susun query insert
			$sql = "UPDATE akun SET username='$username', password='$password' WHERE id_akun='$id_akun'";

			// Eksekusi query insert
			$res = $db->query($sql);
			if ($res === TRUE) {

				// Ambil IdAkun yang terbaru
				// $ambilIdAkun = "SELECT MAX(id_akun) as id_akun from akun";
				// $queryAmbilIdAkun = $db->query($ambilIdAkun);
				// $fetchIdAkun = $queryAmbilIdAkun->fetch_object();
				// $IdAkun = $fetchIdAkun->id_akun;

				$sql2 = "UPDATE pegawai SET nama_pegawai='$namaPegawai', alamat='$alamat', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', no_hp='$no_hp', jabatan='$jabatan' WHERE id_pegawai='$id_pegawai'";

				// Eksekusi Query Insert Transaksi
				$db->query($sql2);

				if ($db->affected_rows > 0) { // jika ada penambahan data
					alertBerhasil("Data Pegawai Berhasil Diubah!");
					echo '<meta http-equiv="refresh" content="3;URL=pegawai-edit.php?id_pegawai=' . $id_pegawai . '&id_akun=' . $id_akun . '" />';
				}
			} else {
				alertGagal("Gagal Merubah Data Pegawai!");
				echo '<meta http-equiv="refresh" content="3;URL=pegawai-edit.php?id_pegawai=' . $id_pegawai . '&id_akun=' . $id_akun . '" />';
			}
		} else
			echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
	}
}

/*========================== END CRUD Pegawai ==========================*/

/*========================== CRUD Menu ==========================*/
function getListMenu()
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT * FROM menu
						 ORDER BY id_menu AND CAST(kategori_menu as CHAR)='minuman'");
		if ($res) {
			$data = $res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		} else
			return FALSE;
	} else
		return FALSE;
}

function tambahDataMenu()
{
	if (isset($_POST["btn_tambah"])) {
		$db = dbConnect();
		if ($db->connect_errno == 0) {
			// Bersihkan data
			$nama_menu	        = $db->escape_string($_POST["nama_menu"]);
			$kategori_menu	    = $db->escape_string($_POST["kategori_menu"]);
			$jenis_menu   	    = $db->escape_string($_POST["jenis_menu"]);
			$harga_menu         = $db->escape_string($_POST["harga_menu"]);
			$gambar_menu		= addslashes(file_get_contents($_FILES['gambar_menu']['tmp_name']));
			move_uploaded_file($gambar_menu, __DIR__ . '../img/' . $gambar_menu);


			// Susun query insert
			$sql = "INSERT INTO menu(id_menu, nama_menu, kategori_menu, jenis_menu, harga_menu, status, gambar_menu)
            VALUES('', '$nama_menu', '$kategori_menu', '$jenis_menu', '$harga_menu', 'tidak tersedia', '$gambar_menu')";

			// Eksekusi query insert
			$res = $db->query($sql);
			if ($res === TRUE) {
				if ($db->affected_rows > 0) { // jika ada penambahan data
					alertBerhasil("Data Menu Berhasil Ditambah!");
					echo '<meta http-equiv="refresh" content="3;URL=menu-tambah.php" />';
				}
			} else {
				alertGagal("Gagal Menambahkan Data Menu!");
				echo '<meta http-equiv="refresh" content="3;URL=menu-tambah.php" />';
			}
		} else
			echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
	}
}

function getDataMenu($id_menu)
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT *
						 FROM menu
						 WHERE id_menu='$id_menu'");
		if ($res) {
			if ($res->num_rows > 0) {
				$data = $res->fetch_assoc();
				$res->free();
				return $data;
			} else
				return FALSE;
		} else
			return FALSE;
	} else
		return FALSE;
}

function updateDataMenu()
{
	if (isset($_POST["btn_edit"])) {
		$db = dbConnect();
		if ($db->connect_errno == 0) {
			// Bersihkan data
			$id_menu	        = $db->escape_string($_POST["id_menu"]);
			$nama_menu	        = $db->escape_string($_POST["nama_menu"]);
			$kategori_menu	    = $db->escape_string($_POST["kategori_menu"]);
			$jenis_menu   	    = $db->escape_string($_POST["jenis_menu"]);
			$harga_menu         = $db->escape_string($_POST["harga_menu"]);
			$gambar_menu		= addslashes(file_get_contents($_FILES['gambar_menu']['tmp_name']));


			// Susun query insert
			$sql = "UPDATE menu SET nama_menu='$nama_menu', kategori_menu='$kategori_menu', jenis_menu='$jenis_menu', harga_menu='$harga_menu', gambar_menu='$gambar_menu' WHERE id_menu='$id_menu'";

			// Eksekusi query insert
			$res = $db->query($sql);
			if ($res === TRUE) {
				alertBerhasil("Data Menu Berhasil Diubah.");
				echo '<meta http-equiv="refresh" content="3;URL=menu-edit.php?id_menu=' . $id_menu . '" />';
			} else {
				alertGagal("Gagal Merubah Data Menu!");
				echo '<meta http-equiv="refresh" content="3;URL=menu-edit.php?id_menu=' . $id_menu . '" />';
			}
		} else
			echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
	}
}

function hapusDataMenu()
{
	if (isset($_POST["hapusMenu"])) {
		$db = dbConnect();
		if ($db->connect_errno == 0) {
			$id_menu = $db->escape_string($_POST["id_menu"]);
			// Susun query delete
			$sql = "DELETE FROM menu WHERE id_menu='$id_menu'";
			// Eksekusi query delete
			$res = $db->query($sql);
			if ($res) {
				if ($db->affected_rows > 0) { // jika ada data terhapus
					alertBerhasil("Data Menu Berhasil Dihapus!");
					echo '<meta http-equiv="refresh" content="3;URL=menu.php" />';
				} else { // Jika sql sukses tapi tidak ada data yang dihapus
					alertGagal("Gagal Menghapus Data Menu dikarenakan data sudah tidak ada!");
					echo '<meta http-equiv="refresh" content="3;URL=menu.php" />';
				}
			} else { // gagal query
				alertGagal("Gagal Menghapus Data Menu!");
				echo '<meta http-equiv="refresh" content="3;URL=menu.php" />';
			}
		} else
			echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
	}
}

/*========================== END CRUD Menu ==========================*/

/*========================== CRUD Pesanan Pelayan ==========================*/
function getListPesanan()
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT * FROM pesanan
						 ORDER BY no_pesanan AND status = 'belum selesai' desc");
		if ($res) {
			$data = $res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		} else
			return FALSE;
	} else
		return FALSE;
}

function getNoPesanan()
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT MAX(no_pesanan + 1) as nopesanan FROM pesanan
						 ORDER BY no_pesanan");
		if ($res) {
			$data = $res->fetch_object();
			$nopesanan = $data->nopesanan;
			$res->free();
			return $nopesanan;
		} else
			return FALSE;
	} else
		return FALSE;
}

function tambahDetailPesanan()
{
	if (isset($_POST["btn_tambah_menu"])) {
		$db = dbConnect();
		if ($db->connect_errno == 0) {
			// Bersihkan data
			$no_pesanan	        = $db->escape_string($_POST["no_pesanan"]);
			$id_menu	        = $db->escape_string($_POST["id_menu"]);
			// Susun query insert
			$sql = "INSERT INTO detail_pesanan(no_pesanan, id_menu, jumlah_pesanan, `status`)
            VALUES('$no_pesanan', '$id_menu', '1', 'belum pasti')";

			// Eksekusi query insert
			$res = $db->query($sql);
			if ($res === TRUE) {
				if ($db->affected_rows > 0) { // jika ada penambahan data
					if ($_SERVER['REQUEST_URI'] == "/restokuy/roles/pelayan/pesanan/pesanan-tambah.php") {
						echo '<meta http-equiv="refresh" content="0;URL=pesanan-tambah.php" />';
					} else {
						echo "<meta http-equiv=\"refresh\" content=\"2;URL=pesanan-edit.php?no_pesanan=$no_pesanan\" />";
					}
				}
			} else {
				if ($_SERVER['REQUEST_URI'] == "/restokuy/roles/pelayan/pesanan/pesanan-tambah.php") {
					echo '<meta http-equiv="refresh" content="0;URL=pesanan-tambah.php" />';
				} else {
					echo "<meta http-equiv=\"refresh\" content=\"2;URL=pesanan-edit.php?no_pesanan=$no_pesanan\" />";
				}
			}
		} else
			echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
	}
}

function tampilDetailPesananTerbaru()
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT * FROM detail_pesanan 
		JOIN menu ON menu.`id_menu` = detail_pesanan.`id_menu`
		WHERE detail_pesanan.status='belum pasti' and no_pesanan = (SELECT MAX(no_pesanan) FROM detail_pesanan)");
		if ($res) {
			$data = $res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		} else
			return FALSE;
	} else
		return FALSE;
}

function tampilPesananBerdasarkanStatus()
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT ps.*, pg.* FROM pesanan ps JOIN pegawai pg WHERE ps.id_pegawai=pg.id_pegawai AND status='belum selesai'");
		if ($res) {
			$data = $res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		} else
			return FALSE;
	} else
		return FALSE;
}

function getDataPesananDanDetailPesanan($no_pesanan)
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT ps.*, dtsp.*, mn.* FROM pesanan ps JOIN detail_pesanan dtsp JOIN menu mn WHERE ps.no_pesanan='$no_pesanan' AND ps.no_pesanan=dtsp.no_pesanan");
		if ($res) {
			if ($res->num_rows > 0) {
				$data = $res->fetch_array();
				$res->free();
				return $data;
			} else
				return FALSE;
		} else
			return FALSE;
	} else
		return FALSE;
}

function getDataMenuByNoPesanan($no_pesanan)
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT dtsp.*, mn.*, (jumlah_pesanan * harga_menu) AS harga FROM detail_pesanan dtsp JOIN menu mn WHERE dtsp.no_pesanan='$no_pesanan' AND dtsp.id_menu=mn.id_menu");
		if ($res) {
			if ($res->num_rows > 0) {
				$data = $res->fetch_all(MYSQLI_ASSOC);
				$res->free();
				return $data;
			} else
				return FALSE;
		} else
			return FALSE;
	} else
		return FALSE;
}

function hapusDetailPesanan()
{
	if (isset($_POST["hapus_list_pesanan"])) {
		$db = dbConnect();
		$no_pesanan = $db->escape_string($_POST["no_pesanan"]);
		$data = getDataDetailPesanan($no_pesanan);
		if ($db->connect_errno == 0) {
			foreach ($data as $hasil) {
				$id = $hasil['id_menu'];
				if (isset($_POST["id_menu" . $id])) {
					$id_menu = $db->escape_string($_POST["id_menu" . $id]);
				}
			}
			// Susun query insert
			$sql = "DELETE FROM detail_pesanan WHERE no_pesanan = $no_pesanan AND id_menu = $id_menu";
			// Eksekusi query insert
			$res = $db->query($sql);
			if ($db->affected_rows > 0) { // jika ada penambahan data
				if ($_SERVER['REQUEST_URI'] == "/restokuy/roles/pelayan/pesanan/pesanan-tambah.php") {
					echo '<meta http-equiv="refresh" content="0;URL=pesanan-tambah.php" />';
				} else {
					echo "<meta http-equiv=\"refresh\" content=\"2;URL=pesanan-edit.php?no_pesanan=$no_pesanan\" />";
				}
			}
		} else
			echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
	}
}

function tambahPesanan()
{
	if (isset($_POST["btn_tambah"])) {
		$db = dbConnect();
		if ($db->connect_errno == 0) {
			// Bersihkan data
			$tanggal = $db->escape_string($_POST["tgl"]);
			$no_meja = $db->escape_string($_POST["no_meja"]);
			$id_pegawai = $db->escape_string($_POST["id_pegawai"]);
			$no_pesanan = $db->escape_string($_POST["no_pesanan"]);
			$harga_total = $db->escape_string($_POST["harga_total"]);

			$query_select_jumlah = "SELECT * FROM detail_pesanan WHERE no_pesanan = $no_pesanan AND `status` = 'belum pasti'";
			$res_jumlah = $db->query($query_select_jumlah);

			// Susun query insert
			$sql = "INSERT INTO pesanan(no_pesanan, tgl_pesanan, no_meja, `status`, id_pegawai) VALUES 
			('', '$tanggal', '$no_meja', 'belum selesai', '$id_pegawai')";


			// Eksekusi query insert
			$res = $db->query($sql);
			if ($res) {
				foreach ($res_jumlah = getDataDetailPesanan($no_pesanan) as $hasil) {
					$id = $hasil['id_menu'];
					$jumlah = $db->escape_string($_POST["jumlah_pesanan" . $id]);
					$id_menu = $db->escape_string($_POST["id_menu" . $id]);

					$sql2 = "UPDATE detail_pesanan SET jumlah_pesanan= '$jumlah', status='dipesan' WHERE no_pesanan='$no_pesanan' and id_menu='$id_menu'";
					$update_jumlah = $db->query($sql2);
				}

				$sql3 = "INSERT INTO transaksi(no_transaksi, total_bayar, `status`, id_pegawai, no_pesanan) VALUES ('', $harga_total, 'belum dibayar', $id_pegawai, $no_pesanan)";
				$insert_transaksi = $db->query($sql3);


				if ($db->affected_rows > 0) { // jika ada penambahan data
					alertBerhasil("Data Pesanan Berhasil Ditambah!");
					echo '<meta http-equiv="refresh" content="1;URL=pesanan-tambah.php" />';
				}
			} else {
				alertGagal("Gagal Menambah Data Pesanan!");
				echo '<meta http-equiv="refresh" content="1;URL=pesanan-tambah.php" />';
			}
		} else
			echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
	}
}

function getListMenuTersedia()
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT * FROM menu WHERE status='tersedia'	
						 ORDER BY id_menu AND CAST(kategori_menu as CHAR)='minuman'");
		if ($res) {
			$data = $res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		} else
			return FALSE;
	} else
		return FALSE;
}

function getDataDetailPesanan($no_pesanan)
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT * FROM detail_pesanan JOIN menu ON menu.id_menu = detail_pesanan.id_menu 
		WHERE no_pesanan = $no_pesanan");
		if ($res) {
			$data = $res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		} else
			return FALSE;
	} else
		return FALSE;
}

function resetDetailPesanan()
{
	if (isset($_POST['btn_reset'])) {
		$db = dbConnect();
		$no_pesanan = $db->escape_string($_POST['no_pesanan']);
		echo "<meta http-equiv=\"refresh\" content=\"2;URL=pesanan-edit.php?no_pesanan=$no_pesanan\" />";
	}
}

function simpanDataPesanan()
{
	if (isset($_POST["btn_simpan"])) {
		$db = dbConnect();
		if ($db->connect_errno == 0) {
			// Bersihkan data
			$tanggal = $db->escape_string($_POST["tgl"]);
			$no_meja = $db->escape_string($_POST["no_meja"]);
			$id_pegawai = $db->escape_string($_POST["id_pegawai"]);
			$no_pesanan = $db->escape_string($_POST["no_pesanan"]);
			$harga_total = $db->escape_string($_POST["harga_total"]);

			// Susun query insert
			$sql = "UPDATE pesanan SET no_meja = $no_meja, id_pegawai = $id_pegawai WHERE no_pesanan = $no_pesanan";

			// Eksekusi query insert
			$res = $db->query($sql);
			if ($res) {
				foreach ($res_jumlah = getDataDetailPesanan($no_pesanan) as $hasil) {
					$id = $hasil['id_menu'];
					$jumlah = $db->escape_string($_POST["jumlah_pesanan" . $id]);
					$id_menu = $db->escape_string($_POST["id_menu" . $id]);

					$sql2 = "UPDATE detail_pesanan SET jumlah_pesanan= '$jumlah', status='dipesan' WHERE no_pesanan='$no_pesanan' and id_menu='$id_menu'";
					$update_jumlah = $db->query($sql2);
				}

				$sql3 = "UPDATE transaksi SET total_bayar = $harga_total, id_pegawai = $id_pegawai WHERE no_pesanan = $no_pesanan";
				$insert_transaksi = $db->query($sql3);


				if ($db->affected_rows > 0) { // jika ada penambahan data
					alertBerhasil("Data Pesanan Berhasil Diubah!");
					echo "<meta http-equiv=\"refresh\" content=\"2;URL=pesanan-edit.php?no_pesanan=$no_pesanan\" />";
				}
			} else {
				alertGagal("Gagal Mengubah Data Pesanan!");
				echo "<meta http-equiv=\"refresh\" content=\"2;URL=pesanan-edit.php?no_pesanan=$no_pesanan\" />";
			}
		} else
			echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
	}
}

function hapusPesanan()
{
	if (isset($_POST["btn_hapus_pesanan"])) {
		$db = dbConnect();
		if ($db->connect_errno == 0) {
			$no_pesanan = $db->escape_string($_POST["no_pesanan"]);
			// Susun query delete
			$sql = "DELETE FROM transaksi WHERE no_pesanan = $no_pesanan";
			// Eksekusi query delete
			$res = $db->query($sql);
			if ($res) {
				if ($db->affected_rows > 0) { // jika ada data terhapus
					// Alert Berhasil
					$sql2 = "DELETE FROM pesanan WHERE no_pesanan = $no_pesanan";
					$res2 = $db->query($sql2);
					alertBerhasil("Data Pesanan Berhasil Dihapus!");
					echo '<meta http-equiv="refresh" content="3;URL=pesanan.php" />';
				} else { // Jika sql sukses tapi tidak ada data yang dihapus
					alertGagal("Gagal Menghapus Data Pesanan dikarenakan data sudah tidak ada.");
					echo '<meta http-equiv="refresh" content="3;URL=pesanan.php" />';
				}
			} else { // gagal query
				alertGagal("Gagal Menghapus Data Pesanan!");
				echo '<meta http-equiv="refresh" content="3;URL=pesanan.php" />';
			}
		} else
			echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
	}
}

/*========================== END CRUD Pesanan Pelayan ==========================*/

/*========================== CRUD Pesanan Koki ==========================*/
function getListMenuTersediaDanTidakTersedia()
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT * FROM menu
						 ORDER BY id_menu AND CAST(status AS char)='tidak tersedia'");
		if ($res) {
			$data = $res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		} else
			return FALSE;
	} else
		return FALSE;
}

function ubahStatusKetersediaanMenu()
{
	if (isset($_POST["ubahStatusKetersediaanMenu"])) {
		$db = dbConnect();
		if ($db->connect_errno == 0) {

			$id_menu     	    = $db->escape_string($_POST["id_menu"]);
			$status		        = $db->escape_string($_POST["status"]);
			// Susun query insert
			$sql = "UPDATE menu SET id_menu='$id_menu', status='$status' WHERE id_menu='$id_menu'";

			// Eksekusi query insert
			$res = $db->query($sql);
			if ($res === TRUE) {
				if ($db->affected_rows > 0) { // jika ada penambahan data
					alertBerhasil("Status Ketersediaan Menu Berhasil Diubah!");
					echo '<meta http-equiv="refresh" content="3;URL=cek-menu.php" />';
				}
			} else {
				alertGagal("Gagal Merubah Status Ketersediaan Menu");
				echo '<meta http-equiv="refresh" content="3;URL=cek-menu.php" />';
			}
		} else
			echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
	}
}

function totalPesanan()
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT count(no_pesanan) as no_pesanan
						 FROM pesanan");
		if ($res) {
			$data = $res->fetch_object();
			$totalPesanan = $data->no_pesanan;
			$res->free();
			echo $totalPesanan;
			return $totalPesanan;
		} else
			return FALSE;
	} else
		return FALSE;
}

function ubahStatusPesanan()
{
	if (isset($_POST["ubahStatusPesanan"])) {
		$db = dbConnect();
		if ($db->connect_errno == 0) {

			$no_pesanan     	= $db->escape_string($_POST["no_pesanan"]);
			$status		        = $db->escape_string($_POST["status"]);
			// Susun query insert
			$sql = "UPDATE pesanan SET no_pesanan='$no_pesanan', status='$status' WHERE no_pesanan='$no_pesanan'";

			// Eksekusi query insert
			$res = $db->query($sql);
			if ($res === TRUE) {
				if ($db->affected_rows > 0) { // jika ada penambahan data
					alertBerhasil("Pesanan Dengan No : $no_pesanan Sudah Selesai!");
					echo '<meta http-equiv="refresh" content="3;URL=pemesanan.php" />';
				}
			}
		} else
			echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
	}
}
/*========================== END CRUD Pesanan Koki ==========================*/


/*========================== Dashboard Kasir ==========================*/
function getPesananBelumBayar()
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT count(*) as no_transaksi
						 FROM transaksi WHERE `status` = 'belum dibayar'");
		if ($res) {
			$data = $res->fetch_object();
			$banyakPesanan = $data->no_transaksi;
			$res->free();
			return $banyakPesanan;
		} else
			return FALSE;
	} else
		return FALSE;
}
/*========================== END Dashboard Kasir ==========================*/

/*========================== CRUD Pembayaran Kasir ==========================*/
function getListPembayaran()
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT t.no_transaksi, t.no_pesanan, total_bayar, t.status, (SELECT nama_pegawai FROM pegawai WHERE id_pegawai = p.id_pegawai) as nama FROM transaksi t JOIN pesanan p ON p.no_pesanan = t.no_pesanan WHERE t.status = 'belum dibayar'");
		if ($res) {
			$data = $res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		} else
			return FALSE;
	} else
		return FALSE;
}

function getListPembayaranLunas()
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT t.no_transaksi, t.no_pesanan, total_bayar, t.status, (SELECT nama_pegawai FROM pegawai WHERE id_pegawai = t.id_pegawai) as nama FROM transaksi t JOIN pesanan p ON p.no_pesanan = t.no_pesanan WHERE t.status = 'dibayar'");
		if ($res) {
			$data = $res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		} else
			return FALSE;
	} else
		return FALSE;
}

function ubahStatusLunas()
{
	if (isset($_POST['btn_lunas'])) {
		$db = dbConnect();
		$no_transaksi = $db->escape_string($_POST['no_transaksi']);
		$sql = "UPDATE transaksi SET `status` = 'dibayar' WHERE no_transaksi = $no_transaksi";
		$res = $db->query($sql);
		if ($res) {
			if ($db->affected_rows) {
				alertBerhasil("Berhasil Mengubah Status!");
				echo '<meta http-equiv="refresh" content="1;URL=transaksi.php" />';
			} else {
				alertGagal("Gagal Mengubah Status!");
				echo '<meta http-equiv="refresh" content="1;URL=transaksi.php" />';
			}
		} else {
			alertGagal("Gagal Mengubah Status!");
			echo '<meta http-equiv="refresh" content="1;URL=transaksi.php" />';
		}
	}
}
function ubahStatusBelumLunas()
{
	if (isset($_POST['btn_belum_lunas'])) {
		$db = dbConnect();
		$no_transaksi = $db->escape_string($_POST['no_transaksi']);
		$sql = "UPDATE transaksi SET `status` = 'belum dibayar' WHERE no_transaksi = $no_transaksi";
		$res = $db->query($sql);
		if ($res) {
			if ($db->affected_rows) {
				alertBerhasil("Berhasil Mengubah Status!");
				echo '<meta http-equiv="refresh" content="1;URL=transaksi.php" />';
			} else {
				alertGagal("Gagal Mengubah Status!");
				echo '<meta http-equiv="refresh" content="1;URL=transaksi.php" />';
			}
		} else {
			alertGagal("Gagal Mengubah Status!");
			echo '<meta http-equiv="refresh" content="1;URL=transaksi.php" />';
		}
	}
}
/*========================== END CRUD Pembayaran Kasir ==========================*/

/*========================== Rekapitulasi Kasir ==========================*/
function getListRekap()
{
	$db = dbConnect();
	if (isset($_POST['btn_filter'])) {
		$tgl_awal = $db->escape_string($_POST['tanggal_awal']);
		$tgl_akhir = $db->escape_string($_POST['tanggal_akhir']);
		$sql = "SELECT * FROM transaksi t JOIN pesanan p ON p.no_pesanan = t.no_pesanan WHERE t.status = 'dibayar' AND tgl_pesanan BETWEEN '$tgl_awal' AND '$tgl_akhir'";
	} else {
		$sql = "SELECT * FROM transaksi t JOIN pesanan p ON p.no_pesanan = t.no_pesanan WHERE t.status = 'dibayar'";
	}
	if ($db->connect_errno == 0) {
		$res = $db->query($sql);
		if ($res) {
			$data = $res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		} else
			return FALSE;
	} else
		return FALSE;
}

function refreshFilter()
{
	if (isset($_POST['btn_filter'])) {
		echo "
			<div class=\"offset-2 col-auto gy-3\">
			<form method=\"post\">
			<button type=\"submit\" class=\"btn font-btn bg-secondary font-white\" name=\"btn_refresh\">Refresh Data</button>
			</form>
			</div>
			";
		if (isset($_POST['btn_refresh'])) {
			echo '<meta http-equiv="refresh" content="0;URL=rekapitulasi.php" />';
		}
	}
}

function getDataTransaksi($no_transaksi)
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		$res = $db->query("SELECT tr.*, ps.*, dtps.*, mn.* FROM transaksi tr JOIN pesanan ps JOIN detail_pesanan dtps JOIN menu mn WHERE no_transaksi=$no_transaksi AND tr.no_pesanan=ps.no_pesanan and ps.no_pesanan=dtps.no_pesanan and dtps.id_menu=mn.id_menu");
		if ($res) {
			$data = $res->fetch_assoc();
			$res->free();
			return $data;
		} else
			return FALSE;
	} else
		return FALSE;
}

function getDataRekap()
{
	$db = dbConnect();
	if (isset($_GET['tanggal_awal']) && isset($_GET['tanggal_akhir'])) {
		$tgl_awal = $db->escape_string($_GET['tanggal_awal']);
		$tgl_akhir = $db->escape_string($_GET['tanggal_akhir']);
		$sql = "SELECT *, SUM(total_bayar) as total FROM transaksi t JOIN pesanan p ON p.no_pesanan = t.no_pesanan WHERE t.status = 'dibayar' AND tgl_pesanan BETWEEN '$tgl_awal' AND '$tgl_akhir'";
	} else {
		$sql = "SELECT * FROM transaksi t JOIN pesanan p ON p.no_pesanan = t.no_pesanan WHERE t.status = 'dibayar'";
	}
	$res = $db->query($sql);
	if ($db->connect_errno == 0) {
		$res = $db->query($sql);
		if ($res) {
			$data = $res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		} else
			return FALSE;
	} else
		return FALSE;
}

function btnCetakRekap()
{
	$db = dbConnect();
	if (isset($_POST['btn_filter'])) {
		$tanggal_awal = $db->escape_string($_POST['tanggal_awal']);
		$tanggal_akhir = $db->escape_string($_POST['tanggal_akhir']);
		echo "<a href=\"cetak-rekap.php?tanggal_awal=$tanggal_awal&tanggal_akhir=$tanggal_akhir\" class=\"btn font-btn bg--primary font-white\" name=\"btn_cetak\">Cetak</a>";
	} else {
		echo "<a href=\"cetak-rekap.php\" class=\"btn font-btn bg--primary font-white\" name=\"btn_cetak\">Cetak</a>";
	}
}

function getPeriodeCetak()
{
	$db = dbConnect();
	$tanggal = array();
	if (isset($_GET['tanggal_awal']) && isset($_GET['tanggal_akhir'])) {
		$tgl_awal = $db->escape_string($_GET['tanggal_awal']);
		$tgl_akhir = $db->escape_string($_GET['tanggal_akhir']);
		$tanggal['awal'] = $tgl_awal;
		$tanggal['akhir'] = $tgl_akhir;
	} else {
		$sql = "SELECT MAX(tgl_pesanan) as akhir FROM pesanan";
		$res = $db->query($sql);
		if ($res) {
			$data = $res->fetch_assoc();
			$tanggal['akhir'] = $data['akhir'];

			$sql = "SELECT MIN(tgl_pesanan) as awal FROM pesanan";
			$res = $db->query($sql);
			$hasil = $res->fetch_assoc();
			$tanggal['awal'] = $hasil['awal'];
		}
	}
	return $tanggal;
}

function getTotalPendapatan()
{
	$db = dbConnect();
	if (isset($_GET['tanggal_awal']) && isset($_GET['tanggal_akhir'])) {
		$tgl_awal = $db->escape_string($_GET['tanggal_awal']);
		$tgl_akhir = $db->escape_string($_GET['tanggal_akhir']);
		$sql = "SELECT SUM(total_bayar) as total FROM transaksi t JOIN pesanan p ON p.no_pesanan = t.no_pesanan WHERE t.status = 'dibayar' AND tgl_pesanan BETWEEN '$tgl_awal' AND '$tgl_akhir'";
	} else {
		$sql = "SELECT SUM(total_bayar) as total FROM transaksi t JOIN pesanan p ON p.no_pesanan = t.no_pesanan WHERE t.status = 'dibayar'";
	}
	$res = $db->query($sql);
	if ($db->connect_errno == 0) {
		$res = $db->query($sql);
		if ($res) {
			$data = $res->fetch_assoc();
			$res->free();
			return $data;
		} else
			return FALSE;
	} else
		return FALSE;
}
/*========================== END Rekapitulasi Kasir ==========================*/

function alertGagal($message)
{
	echo "<svg xmlns=\"http://www.w3.org/2000/svg\" style=\"display: none;\">
					<symbol id=\"exclamation-triangle-fill\" fill=\"currentColor\" viewBox=\"0 0 16 16\">
						<path d=\"M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z\" />
					</symbol>
				</svg>
				<div class=\"alert alert-danger d-flex align-items-center alert-dismissible fade show\" role=\"alert\">
					<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Danger:\">
						<use xlink:href=\"#exclamation-triangle-fill\" />
					</svg>
					<div>
						$message
					</div>
					<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
				</div>";
}

function alertBerhasil($message)
{
	echo "<svg xmlns=\"http://www.w3.org/2000/svg\" style=\"display: none;\">
		<symbol id=\"check-circle-fill\" fill=\"currentColor\" viewBox=\"0 0 16 16\">
			<path d=\"M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z\" />
		</symbol>
	</svg>
	<div class=\"alert alert-success d-flex align-items-center alert-dismissible fade show\" role=\"alert\">
		<svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Success:\">
			<use xlink:href=\"#check-circle-fill\" />
		</svg>
		<div>
			$message
		</div>
		<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
	</div>";
}
