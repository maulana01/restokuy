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
?>
					<!-- Alert Berhasil -->
					<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
						<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
							<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
						</symbol>
						<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
							<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
						</symbol>
					</svg>
					<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
						<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
							<use xlink:href="#check-circle-fill" />
						</svg>
						<div>
							Data Pegawai Berhasil Ditambah!
						</div>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php
					echo '<meta http-equiv="refresh" content="3;URL=pegawai-tambah.php" />';
				}
			} else {
				?>
				<!-- Alert Gagal -->
				<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
					<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
					</symbol>
					<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
					</symbol>
				</svg>
				<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
					<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
						<use xlink:href="#exclamation-triangle-fill" />
					</svg>
					<div>
						Gagal Menambahkan Data Pegawai!
					</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<?php
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
					// Alert Berhasil
					echo
					'<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
					<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
					</symbol>
					<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
					</symbol>
				</svg>
				<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
					<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
						<use xlink:href="#check-circle-fill" />
					</svg>
					<div>
						Data Pegawai Berhasil Dihapus!
					</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
					echo '<meta http-equiv="refresh" content="3;URL=pegawai.php" />';
				} else { // Jika sql sukses tapi tidak ada data yang dihapus
					echo '
				<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
					<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
					</symbol>
					<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
					</symbol>
				</svg>
				<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
					<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
						<use xlink:href="#exclamation-triangle-fill" />
					</svg>
					<div>
						Gagal Menghapus Data Pegawai dikarenakan data sudah tidak ada.
					</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
					echo '<meta http-equiv="refresh" content="3;URL=pegawai.php" />';
				}
			} else { // gagal query
				echo '
					<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
						<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            				<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
          				</symbol>
          				<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            				<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
          				</symbol>
					</svg>
					<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
						<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
					  		<use xlink:href="#exclamation-triangle-fill" />
						</svg>
						<div>
					  		Gagal Menghapus Data Pegawai!
						</div>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				  </div>';
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
				?>
					<!-- Alert Berhasil -->
					<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
						<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
							<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
						</symbol>
						<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
							<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
						</symbol>
					</svg>
					<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
						<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
							<use xlink:href="#check-circle-fill" />
						</svg>
						<div>
							Data Pegawai Berhasil Diubah!
						</div>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php
					echo '<meta http-equiv="refresh" content="3;URL=pegawai-edit.php?id_pegawai=' . $id_pegawai . '&id_akun=' . $id_akun . '" />';
				}
			} else {
				?>
				<!-- Alert Gagal -->
				<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
					<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
					</symbol>
					<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
					</symbol>
				</svg>
				<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
					<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
						<use xlink:href="#exclamation-triangle-fill" />
					</svg>
					<div>
						Gagal Merubah Data Pegawai!
					</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<?php
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
				?>
					<!-- Alert Berhasil -->
					<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
						<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
							<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
						</symbol>
						<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
							<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
						</symbol>
					</svg>
					<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
						<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
							<use xlink:href="#check-circle-fill" />
						</svg>
						<div>
							Data Menu Berhasil Ditambah!
						</div>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php
					echo '<meta http-equiv="refresh" content="3;URL=menu-tambah.php" />';
				}
			} else {
				?>
				<!-- Alert Gagal -->
				<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
					<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
					</symbol>
					<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
					</symbol>
				</svg>
				<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
					<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
						<use xlink:href="#exclamation-triangle-fill" />
					</svg>
					<div>
						Gagal Menambahkan Data Menu!
					</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php
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
			?>
				<!-- Alert Berhasil -->
				<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
					<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
					</symbol>
					<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
					</symbol>
				</svg>
				<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
					<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
						<use xlink:href="#check-circle-fill" />
					</svg>
					<div>
						Data Menu Berhasil Diubah.
					</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php
				echo '<meta http-equiv="refresh" content="3;URL=menu-edit.php?id_menu=' . $id_menu . '" />';
			} else {
			?>
				<!-- Alert Gagal -->
				<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
					<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
					</symbol>
					<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
					</symbol>
				</svg>
				<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
					<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
						<use xlink:href="#exclamation-triangle-fill" />
					</svg>
					<div>
						Gagal Merubah Data Menu!
					</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<?php
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
					// Alert Berhasil
					echo
					'<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
					<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
					</symbol>
					<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
					</symbol>
				</svg>
				<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
					<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
						<use xlink:href="#check-circle-fill" />
					</svg>
					<div>
						Data Menu Berhasil Dihapus!
					</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
					echo '<meta http-equiv="refresh" content="3;URL=menu.php" />';
				} else { // Jika sql sukses tapi tidak ada data yang dihapus
					echo '
				<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
					<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
					</symbol>
					<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
					</symbol>
				</svg>
				<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
					<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
						<use xlink:href="#exclamation-triangle-fill" />
					</svg>
					<div>
						Gagal Menghapus Data Menu dikarenakan data sudah tidak ada!
					</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
					echo '<meta http-equiv="refresh" content="3;URL=menu.php" />';
				}
			} else { // gagal query
				echo '
					<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
						<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            				<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
          				</symbol>
          				<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            				<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
          				</symbol>
					</svg>
					<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
						<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
					  		<use xlink:href="#exclamation-triangle-fill" />
						</svg>
						<div>
					  		Gagal Menghapus Data Menu!
						</div>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				  </div>';
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
						 ORDER BY no_pesanan");
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
			$sql = "INSERT INTO detail_pesanan(no_pesanan, id_menu, jumlah_pesanan)
            VALUES('$no_pesanan', '$id_menu', '0')";

			// Eksekusi query insert
			$res = $db->query($sql);
			if ($res === TRUE) {
				if ($db->affected_rows > 0) { // jika ada penambahan data
					echo '<meta http-equiv="refresh" content="0;URL=pesanan-tambah.php" />';
				}
			} else {
				echo '<meta http-equiv="refresh" content="0;URL=pesanan-tambah.php" />';
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
		WHERE no_pesanan = (SELECT MAX(no_pesanan) FROM detail_pesanan)");
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
		$res = $db->query("SELECT ps.*, dtps.* FROM pesanan ps JOIN detail_pesanan dtps WHERE ps.no_pesanan=dtps.no_pesanan AND ps.no_pesanan='$no_pesanan'");
		if ($res) {
			$data = $res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		} else
			return FALSE;
	} else
		return FALSE;
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
				?>
					<!-- Alert Berhasil -->
					<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
						<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
							<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
						</symbol>
						<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
							<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
						</symbol>
					</svg>
					<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
						<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
							<use xlink:href="#check-circle-fill" />
						</svg>
						<div>
							Status Ketersediaan Menu Berhasil Diubah!
						</div>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php
					echo '<meta http-equiv="refresh" content="3;URL=cek-menu.php" />';
				}
			} else {
				?>
				<!-- Alert Gagal -->
				<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
					<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
					</symbol>
					<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
						<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
					</symbol>
				</svg>
				<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
					<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
						<use xlink:href="#exclamation-triangle-fill" />
					</svg>
					<div>
						Gagal Merubah Status Ketersediaan Menu
					</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
	<?php
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
/*========================== END CRUD Pesanan Koki ==========================*/

function alertLogin($msg)
{
	echo '
	<!-- Alert -->
	<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
		<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
			<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
		</symbol>
		<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
			<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
		</symbol>
		<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
			<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
		</symbol>
	</svg>
	<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
		<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
			<use xlink:href="#exclamation-triangle-fill" />
		</svg>
		<div>
			' . $msg . '
		</div>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>';
}

function showError($message)
{
	?>
	<?php echo $message; ?>
<?php
}
?>