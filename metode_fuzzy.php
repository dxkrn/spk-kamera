<?php
session_start();
include('koneksi.php');
?>

<?php
if (isset($_POST["hapus_kamera"])) {
	$id_hapus = $_POST['id_hapus'];
	$sql_delete = "DELETE FROM `data_kamera` WHERE `id_kamera` = :id_hapus";
	$stmt_delete = $db->prepare($sql_delete);
	$stmt_delete->bindValue(':id_hapus', $id_hapus);
	$stmt_delete->execute();
	$query_reorder_id = mysqli_query($selectdb, "ALTER TABLE data_kamera AUTO_INCREMENT = 1");
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

	<link rel="apple-touch-icon" sizes="76x76" href="assets/image/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/image/favicon.png">

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!--Import jQuery before materialize.js-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/materialize.js"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
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
							echo '<li><a href="daftar_kamera.php">DAFTAR KAMERA</a></li>';
						}
						?>
						<li><a href="rekomendasi.php">REKOMENDASI</a></li>
						<li><a class="active" href="metode_fuzzy.php">FUZZY</a></li>
						<li><a href="#about">TENTANG</a></li>
						<li><a href="logout.php">KELUAR</a></li>
					</ul>
				</div>

			</div>
		</nav>
	</div>
	<!-- Body Start -->

	<!-- Daftar Laptop Start -->
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
													<center></center>
												</th>
												<th>
													<center></center>
												</th>
												<th>
													<center></center>
												</th>
												<th>
													<center></center>
												</th>
												<th>
													<center></center>
												</th>
												<th>
													<center>Harga</center>
												</th>
												<th>
													<center></center>
												</th>
												<th>
													<center></center>
												</th>
												<th>
													<center>Resolusi</center>
												</th>
												<th>
													<center></center>
												</th>
											</tr>
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
													<center>Murah</center>
												</th>
												<th>
													<center>Sedang</center>
												</th>
												<th>
													<center>Mahal</center>
												</th>
												<th>
													<center>Rendah</center>
												</th>
												<th>
													<center>Sedang</center>
												</th>
												<th>
													<center>Tinggi</center>
												</th>


											</tr>
										</thead>
										<tbody>
											<?php
											function format_desimal($nn, $des)
											{
												return number_format($nn, $des, ",", ".");
											}

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
														<center><?php echo format_desimal($data['harga_rendah'], 2) ?></center>
													</td>
													<td>
														<center><?php echo format_desimal($data['harga_sedang'], 2) ?></center>
													</td>
													<td>
														<center><?php echo format_desimal($data['harga_tinggi'], 2) ?></center>
													</td>
													<td>
														<center><?php echo format_desimal($data['res_gambar_rendah'], 2) ?></center>
													</td>
													<td>
														<center><?php echo format_desimal($data['res_gambar_sedang'], 2) ?></center>
													</td>
													<td>
														<center><?php echo format_desimal($data['res_gambar_tinggi'], 2) ?></center>
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
							<!-- <a href="#tambah" class="btn-floating btn-large waves-effect waves-light teal btn-float-custom"><i class="material-icons">add</i></a> -->
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div style="background-color: #ECE6FF">
		<div class="container">
			<div class="section-card" style="padding: 32px 0px 20px 0px">
				<ul>
					<li>
						<div class="row">
							<div class="col s3">
							</div>
							<div class="col s6">
								<div class="card">
									<div class="card-content">
										<div class="row">
											<center>
												<h4>Masukan Query</h4>
											</center>
											<br>
											<form class="col s12" method="GET">
												<div class="row">
													<div class="col s12">

														<div class="col s6" style="margin-top: 10px;">
															<b>Tingkat Harga</b>
														</div>
														<div class="col s6">
															<select required name="harga">
																<option value="" disabled selected style="color: #eceff1;"><i>Tingkat Harga</i></option>
																<option value="harga_rendah">Murah</option>
																<option value="harga_sedang">Sedang</option>
																<option value="harga_tinggi">Mahal</option>
															</select>
														</div>



														<div class="col s6" style="margin-top: 10px;">
															<b>Operator</b>
														</div>
														<div class="col s6">
															<select required name="opr">
																<option value="" disabled selected>Operator</option>
																<option value="OR">OR</option>
																<option value="AND">AND</option>
															</select>
														</div>
														<div class="col s6" style="margin-top: 10px;">
															<b>Tingkat Resolusi Gambar</b>
														</div>
														<div class="col s6">
															<select required name="res_gambar">
																<option value="" disabled selected>Tingkat Resolusi Gambar</option>
																<option value="res_gambar_rendah">Rendah</option>
																<option value="res_gambar_sedang">Sedang</option>
																<option value="res_gambar_tinggi">Tinggi</option>
															</select>
														</div>


													</div>
													<center><button type="submit" class="waves-effect waves-light btn" style="margin-bottom:-46px;">Submit</button></center>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="col s3">
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div style="background-color: #F7F4FF">
		<div class="container">
			<div class="section-card" style="padding: 32px 0px 20px 0px">
				<ul>
					<li>
						<div class="row">
							<div class="col s3">
							</div>
							<div class="col s6">
								<div class="card">
									<div class="card-content">
										<div class="row">
											<center>
												<h4>Hasil</h4>
											</center>
											<form class="col s12" s>

												<br>

												<?php
												if (isset($_GET['opr'])) {
													$opr = $_GET['opr'];
													$harga = $_GET['harga'];
													$res_gambar = $_GET['res_gambar'];

													$hasil = mysqli_query($selectdb, "SELECT * FROM data_kamera");

													while ($row = mysqli_fetch_array($hasil)) {
														// ambil data derajat keanggotaan	
														// $c1 = $ux[$row['id']][$vitamin];
														// $c2 = $ux[$row['id']][$harga];
														$c1 = $row[$harga];
														$c2 = $row[$res_gambar];

														// tentukan operasi
														if ($opr == "OR") {
															$cc = max($c1, $c2);
														} else {
															$cc = min($c1, $c2);
														}

														if ($cc > 0) {
															echo "<center>" . $row['nama_kamera'] . " : [" . format_desimal($cc, 2) . "]<center><br>";
														}
													}
												}
												?>

												<!-- <br>
												<br> -->
												<!-- <center><button type="button" class="waves-effect waves-light btn" style="margin-bottom:-46px;">Reset</button></center> -->
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="col s3">
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Rekomendasi Laptop End -->

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
			$('select').material_select();
			$('.modal').modal();
		});
	</script>
</body>

</html>