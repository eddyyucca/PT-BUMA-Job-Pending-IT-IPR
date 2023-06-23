<?php
require '../koneksi.php';
require '../function.php';
session_start();

	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['section']==""){
		header("location:../index.php?pesan=gagal");
	} 

  $g= $_SESSION['username'];
  $query5=mysqli_query($koneksi, "SELECT *	FROM tb_karyawan K
  left join tb_section s on s.id_sec=k.section
  left join tb_jabatan j on j.id=k.id_jab  where nik='$g'   ");
   $row3=mysqli_fetch_array($query5);
$df=10/2*2;
$tgl2 = date("Y-m-d");
$tgl1 = date("l, d F Y");
$tgl = date("d F Y");
date_default_timezone_set("Asia/Makassar");



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>JOB Pendingan</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/Aicon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
</head>
<body data-background-color="bg3">
	<div class="wrapper sidebar_minimize">
		<div class="main-header">
			<!-- Logo Header --> 
			<div class="logo-header" data-background-color="blue">
				<a href="index.php" class="logo ">
					<p style="color: aliceblue;position:center; padding:11px; font-size:20px;">BUMA-<b>IPR</b></p>
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg navbar-dark bg-primary ">
				<div class="container-fluid">
					<div class="pull-right" style="color: aliceblue; font-size:medium;">
						PT. BUKIT MAKMUR | <b><?php echo $row3['nama_section'] ?></b>
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<div class="pull-left" style="color: aliceblue; font-size:medium;">
							<b style="font-size: small;"><?=$tgl1;?></b>&nbsp;&nbsp;&nbsp;&nbsp;
							</div> 
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-bell"></i>
								<?php  
									$query=mysqli_query($koneksi, "SELECT *	FROM tb_job j
									left join tb_karyawan k on k.nik=j.di_tujukan where status in ('Open','Pending') and di_tujukan='$g' ;");
									while($row5=mysqli_fetch_array($query)){
								?>
								<span class="notification" style="background-color: red;">
								
													<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status in ('Open','Pending') and di_tujukan='$g' ;");
													echo mysqli_num_rows($jumlah_teknik); ?>
													
								</span>
								<?php } ?>
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									<div class="dropdown-title">You have <?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status in ('Open','Pending') and di_tujukan='$g';");
													echo mysqli_num_rows($jumlah_teknik); ?> Approval</div>
								</li>
								<li>
								<?php  
								$ambildatastock=mysqli_query($koneksi, "SELECT * FROM tb_job j left join tb_karyawan k on k.nik=j.di_tujukan  where status in ('Open','Pending') and di_tujukan='$g'");
								$no=0;
								$no++;
								while($fetch=mysqli_fetch_array($ambildatastock)){
									$idj=$fetch['id_job'];
								?>
									<div class="notif-scroll scrollbar-outer">
										<div class="notif-center">
											<a href="forms1.php?id=<?=$idj;?>">
												<div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>
												<div class="notif-content">
													<span class="block">
														<?php echo $fetch['aktivitas'] ?>
													</span>
													<span class="time">Location : <?php echo $fetch['lokasi'] ?> </span> 
												</div>
											</a>
										</div>
									</div>
								<?php $no++; }?>
								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>
						
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="../assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4><?php echo $row3['nama'] ?></h4>
												<p class="text-muted"><?php echo $row3['nik'] ?></p><a href="#" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="../login_prosess/logout.php">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-1">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
								<?php echo $row3['nama'] ?>
									<span class="user-level"><?php echo $row3['nik'] ?></span>
								</span>
							</a> 
							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									<li>
										<a href="#settings">
											<span class="link-collapse">Settings</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item active">
							<a href="#">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Components</h4>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#tables">
								<i class="fas fa-table"></i>
								<p>Data Tables</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="tables">
								<ul class="nav nav-collapse">
									<li>
										<a href="tables.php">
											<span class="sub-item">Data Open</span>
										</a>
									</li>
									<li>
										<a href="data_onprog.php">
											<span class="sub-item">Data On-Prog</span>
										</a>
									</li>
									<li>
										<a href="data_close.php">
											<span class="sub-item">Approved</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#submenu">
								<i class="fas fa-bars"></i>
								<p>Menu Levels</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="submenu">
								<ul class="nav nav-collapse">
									<li>
										<a data-toggle="collapse" href="#subnav1">
											<span class="sub-item">Level 1</span>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="subnav1">
											<ul class="nav nav-collapse subnav">
												<li>
													<a href="#">
														<span class="sub-item">Level 2</span>
													</a>
												</li>
												<li>
													<a href="#">
														<span class="sub-item">Level 2</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<li>
										<a data-toggle="collapse" href="#subnav2">
											<span class="sub-item">Level 1</span>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="subnav2">
											<ul class="nav nav-collapse subnav">
												<li>
													<a href="#">
														<span class="sub-item">Level 2</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<li>
										<a href="#">
											<span class="sub-item">Level 1</span>
										</a>
									</li>
									
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a href="user.php">
							<i class="icon-people"></i>
							<p>User</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->
		<div class="main-panel">
			<div class="content">
				
				<div class="page-inner">
					<marquee scrolldelay="150s"><b>"Saya dan Anda selamat Setiap Hari <i class="fa fa-heart heart text-danger"></i>"</b></marquee>
					<!-- Card -->
					<img src="../logo.jpg" alt="navbar brand" class="navbar-brand pull-right" style="height:50px; width:110px;">
					<h4 class="page-title">General</h4>
					<hr>
					<!-- <div class="alert alert-warning" role="alert">
						This is a warning alert—check it out!
						</div> -->
					<!-- Card With Icon States Background -->
					<div class="row">
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-danger bubble-shadow-small">
												<i class="flaticon-interface-6"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Open</p>
												<h4 class="card-title">
													<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Open' and di_tujukan='$g' ;");
													echo mysqli_num_rows($jumlah_teknik); ?>
												 </h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center"> 
										<div class="col-icon">
											<div class="icon-big text-center icon-info bubble-shadow-small">
												<i class="flaticon-interface-6"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">On Progress</p>
												<h4 class="card-title">
													<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Progress' and di_tujukan='$g' ;");
													echo mysqli_num_rows($jumlah_teknik); ?>
												</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center  icon-primary bubble-shadow-small" >
												<i class="flaticon-interface-6"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Approval</p>
												<h4 class="card-title"><?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Close' and di_tujukan='$g' ;");
													echo mysqli_num_rows($jumlah_teknik); ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon" >
											<div class="icon-big text-center icon-success bubble-shadow-small">
												<i class="flaticon-interface-6"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Done</p>
												<h4 class="card-title"><?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Done' and di_tujukan='$g';");
													echo mysqli_num_rows($jumlah_teknik); ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Row Card No Padding -->
					<div class="row">
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Data one week ago </div>
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Lina Chart data for the past week</div>
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="multipleLineChart"></canvas>
									</div>
								</div>
							</div>
						</div> 
					</div>
					
					<img src="../logo.jpg" alt="navbar brand" class="navbar-brand pull-right" style="height:50px; width:110px;">
					<h4 class="page-title">Progress All Job </h4>
					<hr>
					<div class="row">
					<?php  
						$query=mysqli_query($koneksi, "SELECT *	FROM tb_job j
						left join tb_karyawan k on k.nik=j.di_tujukan where status in ('Close','Open','Progress','Pending') and progress='25' and di_tujukan='$g' ;");
						while($row=mysqli_fetch_array($query)){
						$idj=$row['id_job']; 
					 ?>
						<div class="col-12 col-sm-6 col-md-2">
						<a href="forms1.php?id=<?=$idj;?>" style="text-decoration: none; color: black;">
							<div class="card">
								<div class="card-body">
									<div class="d-flex justify-content-between">
										<div>
										
											<?php echo $row['update_at'] ?>	
											<h5><b><?php echo $row['aktivitas'] ?></b></h5>
											<p class="text-muted">Location : <?php echo $row['lokasi'] ?><br>
										</div> 
										<h3 class="text-danger fw-bold"></h3>
									</div>
									<div class="progress progress-sm">
										<div class="progress-bar bg-danger w-<?php echo $row['progress'] ?>" role="progressbar" aria-valuenow="<?php echo $row['progress'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<div class="d-flex justify-content-between mt-2">
										<p class="text-muted mb-0">Progress</p>
										<p class="text-muted mb-0"><?php echo $row['progress'] ?>%</p>
									</div>
								</div>
							</div>
						</a>
						</div>
						<?php } ?>
						<?php  
						$query=mysqli_query($koneksi, "SELECT *	FROM tb_job j
						left join tb_karyawan k on k.nik=j.di_tujukan where status in ('Close','Open','Progress','Pending') and progress='50' and di_tujukan='$g' ;");
						while($row=mysqli_fetch_array($query)){
						$idj=$row['id_job']; 
					 ?>
						<div class="col-12 col-sm-6 col-md-2">
						<a href="forms1.php?id=<?=$idj;?>" style="text-decoration: none; color: black;">
							<div class="card">
								<div class="card-body">
									<div class="d-flex justify-content-between">
										<div>
										
												<?php echo $row['update_at'] ?>
											<h5><b><?php echo $row['aktivitas'] ?></b></h5>
											<p class="text-muted">Location : <?php echo $row['lokasi'] ?><br>
										</div> 
										<h3 class="text-danger fw-bold"></h3>
									</div>
									<div class="progress progress-sm">
										<div class="progress-bar bg-warning w-<?php echo $row['progress'] ?>" role="progressbar" aria-valuenow="<?php echo $row['progress'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<div class="d-flex justify-content-between mt-2">
										<p class="text-muted mb-0">Progress</p>
										<p class="text-muted mb-0"><?php echo $row['progress'] ?>%</p>
									</div>
								</div>
							</div>
						</a>
						</div>
						<?php } ?>

						<?php  
						$query=mysqli_query($koneksi, "SELECT *	FROM tb_job j
						left join tb_karyawan k on k.nik=j.di_tujukan where status in ('Close','Open','Progress','Pending') and progress='75' and di_tujukan='$g' ;");
						while($row=mysqli_fetch_array($query)){
						$idj=$row['id_job']; 
					 ?>
						<div class="col-12 col-sm-6 col-md-2">
						<a href="forms1.php?id=<?=$idj;?>" style="text-decoration: none; color: black;">
							<div class="card">
								<div class="card-body">
									<div class="d-flex justify-content-between">
										<div>
										
												<?php echo $row['update_at'] ?>
											<h5><b><?php echo $row['aktivitas'] ?></b></h5>
											<p class="text-muted">Location : <?php echo $row['lokasi'] ?><br>
										</div> 
										<h3 class="text-danger fw-bold"></h3>
									</div>
									<div class="progress progress-sm">
										<div class="progress-bar bg-info w-<?php echo $row['progress'] ?>" role="progressbar" aria-valuenow="<?php echo $row['progress'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<div class="d-flex justify-content-between mt-2">
										<p class="text-muted mb-0">Progress</p>
										<p class="text-muted mb-0"><?php echo $row['progress'] ?>%</p>
									</div>
								</div>
							</div>
						</a>
						</div>
						<?php } ?>
						<?php  
						$query=mysqli_query($koneksi, "SELECT *	FROM tb_job j
						left join tb_karyawan k on k.nik=j.di_tujukan where status in ('Done') and progress='100' and di_tujukan='$g' ;");
						while($row=mysqli_fetch_array($query)){
						$idj=$row['id_job']; 
					 ?>
						<div class="col-12 col-sm-6 col-md-2">
						<a href="forms1.php?id=<?=$idj;?>" style="text-decoration: none; color: black;">
							<div class="card">
								<div class="card-body">
									<div class="d-flex justify-content-between">
										<div>
										
												<?php echo $row['update_at'] ?>
											<h5><b><?php echo $row['aktivitas'] ?></b></h5>
											<p class="text-muted">Location : <?php echo $row['lokasi'] ?><br>
										</div> 
										<h3 class="text-danger fw-bold"></h3>
									</div>
									<div class="progress progress-sm">
										<div class="progress-bar bg-success w-<?php echo $row['progress'] ?>" role="progressbar" aria-valuenow="<?php echo $row['progress'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<div class="d-flex justify-content-between mt-2">
										<p class="text-muted mb-0">Progress</p>
										<p class="text-muted mb-0"><?php echo $row['progress'] ?>%</p>
									</div>
								</div>
							</div>
						</a>
						</div>
						<?php } ?>


					</div>
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<div class="copyright ml-auto">
						2023, made with  </i> by <a href="#">PT. BUKIT MAKMUR - IPR</a>
					</div>				
				</div>
			</footer>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade bd-example-modal-lg" id="addRowModal1" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header no-bd" style="color: rgb(31, 64, 162);">
					<h5 class="modal-title">
						<span class="fw-mediumbold">
						Create</span> 
						<span class="fw-light">
							Data
						</span>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body"> 
					<p class="small">Create a new row using this form, make sure you fill them all</p>
					<form  method="post" role="form" enctype="multipart/form-data" class="form-horizontal"> 
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group form-group-default">
									<label><b style="color: rgb(31, 64, 162);">CN/unit :</b></label>
									<input id="addName" type="text" class="form-control" name="cnunit" placeholder="CN/unit">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group form-group-default">
									<label><b style="color: rgb(31, 64, 162);">Activity :</b></label>
									<input id="addName" type="text" class="form-control" name="aktivitas" placeholder="Activity">
								</div>
							</div>
							<div class="col-md-6 pr-0"> 
								<div class="form-group form-group-default">
									<label><b style="color: rgb(31, 64, 162);">Statusikh :</b></label>
									<input id="addPosition" type="text" class="form-control" name="status_ikh" placeholder="Statusikh">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label><b style="color: rgb(31, 64, 162);">Problem :</b></label>
									<input id="addPosition" type="text" class="form-control" name="problem" placeholder="Problem" >
								</div>
							</div>
							<div class="col-md-9 pr-0">
								<div class="form-group form-group-default">
									<label><b style="color: rgb(31, 64, 162);">Tindakan :</b></label>
									<input id="addPosition" type="text" class="form-control" name="tindakan_perbaikan" placeholder="Tindakan">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group form-group-default">
									<label><b style="color: rgb(31, 64, 162);">Lokasi :</b></label>
									<select class="form-control" name="lokasi" id="formGroupDefaultSelect">
										<option>---</option>
										<option>Panel 1</option>
										<option>Panel 2</option>
										<option>Panel 3</option>
										<option>Tiwa</option>
									</select>
								</div>  
							</div>
							<div class="col-md-12">
								<div class="form-group"> 
									<label for="exampleFormControlFile1"><b style="color: rgb(31, 64, 162);">File input</b></label>
									<input type="file" class="form-control-file" name="pdf" id="exampleFormControlFile1" aria-label="">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="comment"><b style="color: rgb(31, 64, 162);">Ket</b></label>
									<textarea class="form-control" id="comment" rows="5" name="ket" placeholder="Ket..."></textarea>
								</div>
							</div>
						</div>
						<div class="modal-footer no-bd">
							<button type="submit" id="addRowButton" name="addnew" class="btn btn-primary">Add</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end modal-->

	<!-- Modal -->
	<div class="modal fade bd-example-modal-md" id="addRowModal2" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header no-bd" style="color: rgb(31, 64, 162);">
					<h5 class="modal-title">
						<span class="fw-mediumbold">
						Create</span> 
						<span class="fw-light">
							User
						</span>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body"> 
					<form  method="post" role="form" enctype="multipart/form-data" class="form-horizontal"> 
					<div class="form-group">
					<label for="exampleFormControlInput1">NIK</label>
					<input type="text" class="form-control" id="exampleFormControlInput1" name="nik" placeholder="Nik">
					</div>
					<div class="form-group">
					<label for="exampleFormControlInput1">Nama</label>
					<input type="text" class="form-control" id="exampleFormControlInput1" name="nama" placeholder="Nama">
					</div>
					<div class="form-group">
						<label for="exampleFormControlSelect1">Sectio</label>
						<select  name="id_sec" class="form-control" id="exampleFormControlSelect1">
						<option></option>
							<?php
																	
							$query=mysqli_query($koneksi, "SELECT * FROM tb_section ") or die (mysqli_error($koneksi));
							while($data=mysqli_fetch_array($query)){
							echo "<option value=$data[id_sec]> $data[nama_section] </option>";
								}
							?> 
						</select>
					</div>
					<div class="form-group">
						<label for="exampleFormControlSelect1">Jabatan</label>
						<select  name="id_jab" class="form-control" id="exampleFormControlSelect1">
						<option></option>
							<?php
																	
							$query=mysqli_query($koneksi, "SELECT * FROM tb_jabatan ") or die (mysqli_error($koneksi));
							while($data=mysqli_fetch_array($query)){
							echo "<option value=$data[id]> $data[jabatan] </option>";
								}
							?>
						</select>
					</div>
					<div class="modal-footer no-bd">
							<button type="submit" name="adduser" class="btn btn-primary btn-sm"><span class="btn-label "><i class="icon-user-follow"></i></span> Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> 
	<!-- end modal-->

	<!--   Core JS Files   -->
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

	<!-- Chart JS -->
	<script src="../assets/js/plugin/chart.js/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Chart Circle -->
	<script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

	<!-- Datatables -->
	<script src="../assets/js/plugin/datademo1/tables/datatables.min.js"></script>

	<!-- jQuery Vector Maps -->
	<script src="../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

	<!-- Sweet Alert -->
	<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="../assets/js/setting-demo.js"></script>
	<script src="../assets/js/demo.js"></script>
	<script>
		var 
		pieChart = document.getElementById('pieChart').getContext('2d');
		var myPieChart = new Chart(pieChart, {
			type: 'pie',
			data: {
				datasets: [{
					data: [<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Open' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -7 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>,
							<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='progress' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -7 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 
							<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Done' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -7 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>],
					backgroundColor :["#f3545d","#00bfff","#59d05d"],
					borderWidth: 0
				}],
				labels: ['Open', 'On Progress',  'Done'] 
			},
			options : {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position : 'bottom',
					labels : {
						fontColor: 'rgb(154, 154, 154)',
						fontSize: 11,
						usePointStyle : true,
						padding: 20
					}
				},
				pieceLabel: {
					render: 'percentage',
					fontColor: 'white',
					fontSize: 14,
				},
				tooltips: false,
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		})
	</script>
	<?php 
	$time = date('d F Y');
	$tanggal1 = date('d F ', strtotime('-'."1".'days', strtotime($time)));
	$tanggal2 = date('d F ', strtotime('-'."2".'days', strtotime($time))); 
	$tanggal3 = date('d F ', strtotime('-'."3".'days', strtotime($time))); 
	$tanggal4 = date('d F ', strtotime('-'."4".'days', strtotime($time))); 
	$tanggal5 = date('d F ', strtotime('-'."5".'days', strtotime($time))); 
	$tanggal6 = date('d F ', strtotime('-'."6".'days', strtotime($time))); 
	$tanggal7 = date('d F ', strtotime('-'."7".'days', strtotime($time)));  
	?>
	<script>
		var
		multipleLineChart = document.getElementById('multipleLineChart').getContext('2d');

		var myMultipleLineChart = new Chart(multipleLineChart, {
			type: 'line',
			data: {
				labels: ["<?=$tanggal7;?>", "<?=$tanggal6;?>", "<?=$tanggal5;?>", "<?=$tanggal4;?>", "<?=$tanggal3;?>", "<?=$tanggal2;?>", "<?=$tanggal1;?>"],
				datasets: [{
					label: "Done",
					borderColor: "#59d05d",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#59d05d",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: "transparent",
					fill: true,
					borderWidth: 2,
					data: [	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Done' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -7 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Done' and di_tujukan='$g' and update_at = DATE_ADD(CURDATE(), INTERVAL -6 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Done' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -5 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Done' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -4 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Done' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -3 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Done' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -2 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Done' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -1 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>]
				},{
					label: "On Progress",
					borderColor: "#00bfff",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#00bfff",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: [<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='On Progres' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -7 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Progress' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -6 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Progress' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -5 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Progress' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -4 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Progress' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -3 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Progress' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -2 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Progress' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -1 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>]
				}, {
					label: "Open",
					borderColor: "#f3545d",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#f3545d",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: [<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Open' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -7 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Open' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -6 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Open' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -5 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Open' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -4 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Open' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -3 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Open' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -2 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>, 	<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Open' and di_tujukan='$g' and update_at > DATE_ADD(CURDATE(), INTERVAL -1 DAY)");
							echo mysqli_num_rows($jumlah_teknik); ?>]
				}]
			},
			options : {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position: 'top',
				},
				tooltips: {
					bodySpacing: 4,
					mode:"nearest",
					intersect: 0,
					position:"nearest",
					xPadding:10,
					yPadding:10,
					caretPadding:10
				},
				layout:{
					padding:{left:15,right:15,top:15,bottom:15}
				}
			}
		});
	</script>

</body>
</html>