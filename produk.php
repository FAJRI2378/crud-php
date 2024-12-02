<?php 
	include 'header.php';
?>

<!-- PRODUK TERBARU -->
<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid #ff8680"><b>Produk Kami</b></h2>

	<!-- Form Pencarian -->
	<form action="" method="GET" class="form-inline my-4">
		<div class="form-group">
			<input type="text" name="search" class="form-control" placeholder="Cari produk..." value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
		</div>
		<button type="submit" class="btn btn-primary">Cari</button>
	</form>

	<div class="row">
		<?php 
		// Ambil kata kunci dari pencarian
		$search = isset($_GET['search']) ? $_GET['search'] : '';
		$query = "SELECT * FROM produk";
		
		// Tambahkan kondisi pencarian jika ada input
		if (!empty($search)) {
			$query .= " WHERE nama LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'";
		}

		$result = mysqli_query($conn, $query);
		
		// Periksa apakah ada hasil pencarian
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
		?>
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<img src="image/produk/<?= $row['image']; ?>" >
						<div class="caption">
							<h3><?= $row['nama'];  ?></h3>
							<h4>Rp.<?= number_format($row['harga']); ?></h4>
							<div class="row">
								<div class="col-md-6">
									<a href="detail_produk.php?produk=<?= $row['kode_produk']; ?>" class="btn btn-warning btn-block">Detail</a> 
								</div>
								<?php if(isset($_SESSION['kd_cs'])){ ?>
									<div class="col-md-6">
										<a href="proses/add.php?produk=<?= $row['kode_produk']; ?>&kd_cs=<?= $kode_cs; ?>&hal=1" class="btn btn-success btn-block" role="button"><i class="glyphicon glyphicon-shopping-cart"></i> Tambah</a>
									</div>
								<?php 
								} else { ?>
									<div class="col-md-6">
										<a href="keranjang.php" class="btn btn-success btn-block" role="button"><i class="glyphicon glyphicon-shopping-cart"></i> Tambah</a>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			<?php 
			}
		} else {
			echo "<p class='text-center'>Tidak ada produk ditemukan.</p>";
		}
		?>
	</div>
</div>

<?php 
	include 'footer.php';
?>
