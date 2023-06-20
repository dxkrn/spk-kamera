<?php
session_start();
include('koneksi.php');
?>

<?php
if (isset($_POST["tambah_shutter_max"])) {
	$nama      = $_POST["nama"];
	$harga     = $_POST["harga"];
	$res_gambar       = $_POST["res_gambar"];
	$res_video    = $_POST["res_video"];
	$iso_max = $_POST["iso_max"];
	$shutter_max    = $_POST["shutter_max"];

	$harga_angka = $res_gambar_angka = $res_video_angka = $iso_max_angka = $shutter_max_angka = 0;

	if ($harga < 1000000) {
		$harga_angka = 5;
	} elseif ($harga >= 1000000 && $harga <= 3000000) {
		$harga_angka = 4;
	} elseif ($harga > 3000000 && $harga <= 4000000) {
		$harga_angka = 3;
	} elseif ($harga > 4000000 && $harga <= 5000000) {
		$harga_angka = 2;
	} elseif ($harga > 5000000) {
		$harga_angka = 1;
	}


	if ($res_gambar == 12) {
		$res_gambar_angka = 1;
	} elseif ($res_gambar == 16) {
		$res_gambar_angka = 2;
	} elseif ($res_gambar == 18) {
		$res_gambar_angka = 3;
	} elseif ($res_gambar == 20) {
		$res_gambar_angka = 4;
	} elseif ($res_gambar == 24) {
		$res_gambar_angka = 5;
	}


	if ($res_video == "HD") {
		$res_video_angka = 1;
	} elseif ($res_video == "Full HD") {
		$res_video_angka = 2;
	} elseif ($res_video == "2K") {
		$res_video_angka = 3;
	} elseif ($res_video == "4K") {
		$res_video_angka = 4;
	} elseif ($res_video == "8K") {
		$res_video_angka = 5;
	}


	if ($iso_max == 3200) {
		$iso_max_angka = 1;
	} elseif ($iso_max == 6400) {
		$iso_max_angka = 2;
	} elseif ($iso_max == 12800) {
		$iso_max_angka = 3;
	} elseif ($iso_max == 25600) {
		$iso_max_angka = 4;
	} elseif ($iso_max == 51200) {
		$iso_max_angka = 5;
	}


	if ($shutter_max == "1/2000s") {
		$shutter_max_angka = 1;
	} elseif ($shutter_max == "1/4000s") {
		$shutter_max_angka = 3;
	} elseif ($shutter_max == "1/8000s") {
		$shutter_max_angka = 5;
	}

	function derajat_keanggotaan($nilai, $bawah, $tengah, $atas)
	{
		$selisih = $atas - $bawah;

		if ($nilai < $bawah) {
			$DA = 0;
		} elseif (($nilai >= $bawah) && ($nilai <= $tengah)) {
			if ($bawah <= 0) {
				$DA = 1;
			} else {
				$DA = ((float)$nilai - (float)$bawah) / ((float)$tengah - (float)$bawah);
			}
		} elseif (($nilai > $tengah) && ($nilai <= $atas)) {
			$DA = ((float)$atas - (float)$nilai) / ((float)$atas - (float)$tengah);
		} elseif ($nilai > $atas) {
			$DA = 0;
		}

		return $DA;
	}

	$harga_rendah = derajat_keanggotaan($harga, 0, 500000, 1000000);
	$harga_sedang = derajat_keanggotaan($harga, 800000, 1500000, 2500000);
	$harga_tinggi = derajat_keanggotaan($harga, 2000000, 4000000, 5000000);
	$res_gambar_rendah = derajat_keanggotaan($res_gambar, 0, 8, 12);
	$res_gambar_sedang = derajat_keanggotaan($res_gambar, 10, 16, 18);
	$res_gambar_tinggi = derajat_keanggotaan($res_gambar, 17, 20, 24);

	$sql = "INSERT INTO `data_kamera` (`id_kamera`, `nama_kamera`, `harga_kamera`, `res_gambar`, `res_video`, `iso_max`, `shutter_max`, `harga_angka`, `res_gambar_angka`, `res_video_angka`, `iso_max_angka`, `shutter_max_angka`, `harga_rendah`,`harga_sedang`,`harga_tinggi`,`res_gambar_rendah`,`res_gambar_sedang`,`res_gambar_tinggi`) 
				VALUES (NULL, :nama_kamera, :harga_kamera, :res_gambar, :res_video, :iso_max, :shutter_max, :harga_angka, :res_gambar_angka, :res_video_angka, :iso_max_angka, :shutter_max_angka, :harga_rendah, :harga_sedang, :harga_tinggi, :res_gambar_rendah, :res_gambar_sedang, :res_gambar_tinggi)";
	// $sql2 = "INSERT INTO `derajat` (`id_kamera`, `harga_rendah`, `harga_sedang`, `harga_tinggi`, `res_gambar_rendah`, `res_gambar_sedang`, `res_gambar_tinggi`) 
	// 			VALUES (NULL, :harga_rendah, :harga_sedang, :harga_tinggi, :res_gambar_rendah, :res_gambar_sedang, :res_gambar_tinggi)";
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':nama_kamera', $nama);
	$stmt->bindValue(':harga_kamera', $harga);
	$stmt->bindValue(':res_gambar', $res_gambar);
	$stmt->bindValue(':res_video', $res_video);
	$stmt->bindValue(':iso_max', $iso_max);
	$stmt->bindValue(':shutter_max', $shutter_max);
	$stmt->bindValue(':harga_angka', $harga_angka);
	$stmt->bindValue(':res_gambar_angka', $res_gambar_angka);
	$stmt->bindValue(':res_video_angka', $res_video_angka);
	$stmt->bindValue(':iso_max_angka', $iso_max_angka);
	$stmt->bindValue(':shutter_max_angka', $shutter_max_angka);
	$stmt->bindValue(':harga_rendah', $harga_rendah);
	$stmt->bindValue(':harga_sedang', $harga_sedang);
	$stmt->bindValue(':harga_tinggi', $harga_tinggi);
	$stmt->bindValue(':res_gambar_rendah', $res_gambar_rendah);
	$stmt->bindValue(':res_gambar_sedang', $res_gambar_sedang);
	$stmt->bindValue(':res_gambar_tinggi', $res_gambar_tinggi);
	$stmt->execute();
	// $stmt2 = $db->prepare($sql2);
	// $stmt2->bindValue(':harga_rendah', $harga_rendah);
	// $stmt2->bindValue(':harga_sedang', $harga_sedang);
	// $stmt2->bindValue(':harga_tinggi', $harga_tinggi);
	// $stmt2->bindValue(':res_gambar_rendah', $res_gambar_rendah);
	// $stmt2->bindValue(':res_gambar_sedang', $res_gambar_sedang);
	// $stmt2->bindValue(':res_gambar_tinggi', $res_gambar_tinggi);
	// $stmt2->execute();
}

if (isset($_POST["hapus_kamera"])) {
	$id_hapus = $_POST['id_hapus'];
	$sql_delete = "DELETE FROM `data_kamera` WHERE `id_kamera` = :id_hapus";
	$stmt_delete = $db->prepare($sql_delete);
	$stmt_delete->bindValue(':id_hapus', $id_hapus);
	$stmt_delete->execute();
	$query_reorder_id = mysqli_query($selectdb, "ALTER TABLE data_kamera AUTO_INCREMENT = 1");

	// $sql_delete2 = "DELETE FROM `derajat` WHERE `id_kamera` = :id_hapus";
	// $stmt_delete2 = $db->prepare($sql_delete2);
	// $stmt_delete2->bindValue(':id_hapus', $id_hapus);
	// $stmt_delete2->execute();
	// $query_reorder_id = mysqli_query($selectdb, "ALTER TABLE derajat AUTO_INCREMENT = 1");
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>SPK Kamera</title>
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="assets/css/materialize.css" media="screen,projection" />
	<link rel="stylesheet" href="assets/css/table.css">
	<link rel="stylesheet" href="assets/css/style.css">

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!--Import jQuery before materialize.js-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/materialize.js"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

	<!-- Data Table -->
	<link rel="stylesheet" type="text/css" href="assets/dataTable/jquery.dataTables.min.css">
	<script type="text/javascript" charset="utf8" src="assets/dataTable/jquery.dataTables.min.js"></script>

</head>

<body>
	<div class="navbar-fixed">
		<nav>
			<div class="container">

				<div class="nav-wrapper">
					<ul class="left" style="margin-left: -52px;">
						<li><a href="home.php">HOME</a></li>
						<?php
						if ($_SESSION['role'] == "admin") {
							echo '<li><a class="active" href="daftar_kamera.php">DAFTAR KAMERA</a></li>';
						}
						?>
						<li><a href="rekomendasi.php">REKOMENDASI</a></li>
						<li><a href="metode_fuzzy.php">FUZZY</a></li>
						<li><a href="#about">TENTANG</a></li>
						<li><a href="logout.php">KELUAR</a></li>
					</ul>
				</div>

			</div>
		</nav>
	</div>
	<!-- Body Start -->

	<!-- Daftar hp Start -->
	<div style="background-color: #F7F4FF">
		<div class="container">
			<div class="section-card" style="padding: 40px 0px 20px 0px;">
				<ul>
					<li>
						<div class="row">
							<div class="card">
								<div class="card-content">
									<center>
										<h4 style="margin-bottom: 0px; margin-top: -8px;">Daftar Kamera</h4>
									</center>
									<table id="table_id" class="hover dataTablesCustom" style="width:100%">
										<thead style="border-top: 1px solid #B2B0DC;">
											<tr>
												<th>
													<center>No </center>
												</th>
												<th>
													<center>Nama Kamera</center>
												</th>
												<th>
													<center>Harga</center>
												</th>
												<th>
													<center>Resolusi Gambar</center>
												</th>
												<th>
													<center>Resolusi Video</center>
												</th>
												<th>
													<center>ISO Max</center>
												</th>
												<th>
													<center>Shutter Speed</center>
												</th>
												<th>
													<center>Action</center>
												</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$query = mysqli_query($selectdb, "SELECT * FROM data_kamera");
											$no = 1;
											while ($data = mysqli_fetch_array($query)) {
											?>
												<tr>
													<td>
														<center><?php echo $no; ?></center>
													</td>
													<td>
														<center><?php echo $data['nama_kamera'] ?></center>
													</td>
													<td>
														<center><?php echo "Rp. ", $data['harga_kamera'] ?></center>
													</td>
													<td>
														<center><?php echo $data['res_gambar'], " MP" ?></center>
													</td>
													<td>
														<center><?php echo $data['res_video'] ?></center>
													</td>
													<td>
														<center><?php echo $data['iso_max'] ?></center>
													</td>
													<td>
														<center><?php echo $data['shutter_max'] ?></center>
													</td>
													<td>
														<center>
															<form method="POST">
																<input type="hidden" name="id_hapus" value="<?php echo $data['id_kamera'] ?>">
																<button type="submit" name="hapus_kamera" style="height: 32px; width: 32px;" class="btn-floating btn-small waves-effect waves-light red"><i style="line-height: 32px;" class="material-icons">remove</i></button>
															</form>
														</center>
													</td>
												</tr>
											<?php
												$no++;
											}
											?>
										</tbody>
									</table>
								</div>

							</div>
							<a href="#tambah" class="btn-floating btn-large waves-effect waves-light teal btn-float-custom"><i class="material-icons">add</i></a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Daftar hp End -->

	<!-- Daftar hp Start -->
	<div style="background-color: #F2EDFF">
		<div class="container">
			<div class="section-card" style="padding: 1px 20% 24px 20%;">
				<ul>
					<li>
						<div class="row">
							<div class="card">
								<div class="card-content" style="padding-top: 10px;">
									<center>
										<h5 style="margin-bottom: 10px;">Analisa Kamera</h5>
									</center>
									<table class="responsive-table">

										<thead style="border-top: 1px solid #d0d0d0;">
											<tr>
												<th>
													<center>Alternatif</center>
												</th>
												<th>
													<center>C1 (Cost)</center>
												</th>
												<th>
													<center>C2 (Benefit)</center>
												</th>
												<th>
													<center>C3 (Benefit)</center>
												</th>
												<th>
													<center>C4 (Benefit)</center>
												</th>
												<th>
													<center>C5 (Benefit)</center>
												</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$query = mysqli_query($selectdb, "SELECT * FROM data_kamera");
											$no = 1;
											while ($data = mysqli_fetch_array($query)) {
											?>
												<tr>
													<td>
														<center><?php echo "A", $no ?></center>
													</td>
													<td>
														<center><?php echo $data['harga_angka'] ?></center>
													</td>
													<td>
														<center><?php echo $data['res_gambar_angka'] ?></center>
													</td>
													<td>
														<center><?php echo $data['res_video_angka'] ?></center>
													</td>
													<td>
														<center><?php echo $data['iso_max_angka'] ?></center>
													</td>
													<td>
														<center><?php echo $data['shutter_max_angka'] ?></center>
													</td>
												</tr>
											<?php
												$no++;
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Daftar hp End -->

	<!-- Modal Start -->
	<div id="tambah" class="modal" style="width: 40%; height: 100%;">
		<div class="modal-content">
			<div class="col s6">
				<div class="card-content">
					<div class="row">
						<center>
							<h5 style="margin-top:-8px;">Masukan Kamera</h5>
						</center>
						<form method="POST" action="">
							<div class="row">
								<div class="col s12">

									<div class="col s6" style="margin-top: 10px;">
										<b>Nama</b>
									</div>
									<div class="col s6">
										<input style="height: 2rem;" name="nama" type="text" required>
									</div>

									<div class="col s6" style="margin-top: 10px;">
										<b>Harga</b>
									</div>
									<div class="col s6">
										<input style="height: 2rem;" name="harga" type="number" required>
									</div>

									<div class="col s6" style="margin-top: 10px;">
										<b>Resolusi Gambar</b>
									</div>
									<div class="col s6">
										<select style="display: block; margin-bottom: 4px;" required name="res_gambar">
											<!-- <option value = "" disabled selected>Kriteria res_gambar</option>  -->
											<option value="12">12 MP</option>
											<option value="16">16 MP</option>
											<option value="18">18 MP</option>
											<option value="20">20 MP</option>
											<option value="24">24 MP</option>
										</select>
									</div>

									<div class="col s6" style="margin-top: 10px;">
										<b>Resolusi Video</b>
									</div>
									<div class="col s6">
										<select style="display: block; margin-bottom: 4px;" required name="res_video">
											<!-- <option value = "" disabled selected>Kriteria Penyimpanan</option> -->
											<option value="HD">HD</option>
											<option value="FHD">FHD</option>
											<option value="2K">2K</option>
											<option value="4K">4K</option>
											<option value="8K">8K</option>
										</select>
									</div>

									<div class="col s6" style="margin-top: 10px;">
										<b>ISO Max</b>
									</div>
									<div class="col s6">
										<select style="display: block; margin-bottom: 4px;" required name="iso_max">
											<option value="3200">3200</option>
											<option value="6400">6400</option>
											<option value="12800">12800</option>
											<option value="25600">25600</option>
											<option value="51200">51200</option>
										</select>
									</div>

									<div class="col s6" style="margin-top: 10px;">
										<b>Shutter Speed</b>
									</div>
									<div class="col s6">
										<select style="display: block; margin-bottom: 4px;" required name="shutter_max">
											<!-- <option value = "" disabled selected>Kriteria shutter_max</option> -->
											<option value="1/2000s">1/2000s</option>
											<option value="1/4000s">1/4000s</option>
											<option value="1/8000s">1/8000s</option>
										</select>
									</div>

								</div>
							</div>
							<center><button name="tambah_shutter_max" type="submit" class="waves-effect waves-light btn teal" style="margin-top: 0px;">Tambah</button></center>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div style="height: 0px; " class="modal-footer">
			<a style="margin-top: -30px;" class="modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	</div>
	<!-- Modal End -->

	<!-- Modal Start -->
	<div id="about" class="modal">
		<div class="modal-content">
			<h4>Tentang</h4>
			<p>Sistem Pendukung Keputusan Pemilihan Kamera ini menggunakan metode TOPSIS dan Fuzzy Tahani.
				Sistem ini dibuat sebagai Tugas Akhir Mata Kuliah Sistem Pendukung Keputusan Prodi Pendidikan Teknik Informatika Universitas Negeri Yogyakarta. <br>
				<br>
				Dicky Khurniawan <a href="https://github.com/dxkrnn/"> (Github)</a><br>
			</p>
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	</div>
	<!-- Modal End -->

	<!-- Body End -->

	<!-- Footer Start -->
	<div class="footer-copyright" style="padding: 0px 0px; background-color: white">
		<div class="container">
			<p align="center" style="color: #999">Dicky Khurniawan &copy;2023</p>
		</div>
	</div>
	<!-- Footer End -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('.parallax').parallax();
			$('.modal').modal();
			$('#table_id').DataTable({
				"paging": false
			});
		});
	</script>
</body>

</html>