<?php 
	//koneksi database
	$server ="localhost";
	$user = "root";
	$pass ="";
	$database ="arkademy";

	$koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));
 	
 	if(isset($_POST['bsimpan']))
 	{
 		if($_GET['hal'] == "update")
 		{
 			$edit = mysqli_query($koneksi, "UPDATE produk set
 											nama_Produk = '$_POST[tnim]',
 											Keterangan = '$_POST[tketerangan]',
 											Harga = '$_POST[tharga]',
 											Jumlah = '$_POST[tjumlah]'
 											WHERE nama_Produk = '$_GET[id]'

 										");
	 		if($edit)
	 		{
	 			echo "<script>
	 					alert('Update Data Suskes');
	 					document.location='index.php';
	 				</script>";
	 		}
	 		else
	 		{
	 			echo "<script>
	 					alert('Update Data GAGAL!!');
	 					document.location='index.php';
	 				</script>";
	 		}
 		}else
 		{
 			$simpan = mysqli_query($koneksi, "INSERT INTO produk(nama_Produk, Keterangan, Harga, Jumlah)
 										  VALUES('$_POST[tnim]', 
 										  		 '$_POST[tketerangan]', 
 										  		 '$_POST[tketerangan]', 
 										  		 '$_POST[tjumlah]')
 										");
	 		if($simpan)
	 		{
	 			echo "<script>
	 					alert('Simpan Data Suskes');
	 					document.location='index.php';
	 				</script>";
	 		}
	 		else
	 		{
	 			echo "<script>
	 					alert('Simpan Data GAGAL!!');
	 					document.location='index.php';
	 				</script>";
	 		}
 		}

 		
 	}

 	if(isset($_GET['hal']))
 	{
 		if($_GET['hal']=="update")
 		{
 			$tampil = mysqli_query($koneksi, "SELECT * from produk WHERE nama_Produk = '$_GET[id]' ");
 			$data = mysqli_fetch_array($tampil);
 			if($data)
 			{
 				$vnama = $data['nama_Produk'];
 				$vketerangan = $data['Keterangan'];
 				$vharga = $data['Harga'];
 				$vjumlah = $data['Jumlah'];
 			}
 		}
 		else if ($_GET['hal'] =="hapus")
 		{
 			$hapus = mysqli_query($koneksi, "DELETE FROM produk WHERE nama_Produk = '$_GET[id]' ");
 			if($hapus){
 				echo "<script>
	 					alert('Hapus Data Suskes');
	 					document.location='index.php';
	 				</script>";
 			}

 		}
 	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>CRUD ARKADEMY</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
	<h1 class="text-center mt-2">CRUD TES ARKADEMY</h1>

	<div class="card mt-5">
	  <div class="card-header bg-primary text-white">

	    Form Input Data Produk
	  </div>
	  <div class="card-body">
		<form method="post" action="">
			<div class="form-group">
				<label>Nama Produk</label>
				<input type="text" name="tnim" value="<?=@$vnama?>" class="form-control" placeholder="Input nama produk" required>
			</div>
				<div class="form-group">
				<label>Keterangan</label>
				<textarea class="form-control" name="tketerangan" placeholder="Input Keterangan Produk"><?=@$vketerangan?></textarea>
			</div>
				<div class="form-group">
				<label>Harga Produk</label>
				<input type="text" name="tharga" value="<?=@$vharga?>" class="form-control" placeholder="Input Harga Produk" required>
			</div>
				<div class="form-group">
				<label>Jumlah</label>
				<input type="text" name="tjumlah" value="<?=@$vjumlah?>" class="form-control" placeholder="Input Jumlah Produk" required>
			</div>
			<button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
			<button type="reset" class="btn btn-danger" name="bbatal">Batal</button>
		</form>	  	
	  </div>
	</div>

	<!-- card tabel -->
	<div class="card mt-5">
	  <div class="card-header bg-success text-white">
	    Daftar Produk
	  </div>
	  <div class="card-body">
		<table class="table table-bordered table-striped">
			<tr>
				<th>No.</th>
				<th>Nama Produk</th>
				<th>Keterangan</th>
				<th>Harga Produk</th>
				<th>Jumlah</th>
				<th>Action</th>
			</tr>
			<?php
				$no = 1;
				$tampil= mysqli_query($koneksi, "SELECT * from produk order by nama_Produk desc");
				while($data = mysqli_fetch_array($tampil)) :

			?>
			<tr>
				<td><?=$no++;?></td>
				<td><?=$data['nama_Produk']?></td>
				<td><?=$data['Keterangan']?></td>
				<td><?=$data['Harga']?></td>
				<td><?=$data['Jumlah']?></td>
				<td>
					<a href="index.php?hal=update&id=<?=$data['nama_Produk']?>" class="btn btn-warning">Update</a>
					<a href="index.php?hal=hapus&id=<?=$data['nama_Produk']?>" onclick="return confirm('Yakin Ingin Menghapus Data ini?')" class="btn btn-danger">Hapus</a>
				</td>
			</tr>
			<?php endwhile; ?>

		</table>
	  </div>
	</div>

</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>