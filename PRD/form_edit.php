<?php
session_start();
require '../koneksi.php';
require '../function.php';

	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['section']==""){
		header("location:../index.php?pesan=gagal");
	} 

  $g= $_SESSION['username'];
  $query5=mysqli_query($koneksi, "SELECT *	FROM tb_karyawan K
  left join tb_section s on s.id_sec=k.section
  left join tb_jabatan j on j.id=k.id_jab  where nik='$g'   ");
   $row3=mysqli_fetch_array($query5);

$tgl = date("Y-m-d"); 
$tgl1 = date("l, d F Y");
date_default_timezone_set("Asia/Makassar");
$time = date(" h:i a");



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Job Pending</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/dicon.ico" type="image/x-icon"/>
	
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
<body>
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
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
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
									left join tb_karyawan k on k.nik=j.di_tujukan where status in ('Close') ;");
									while($row5=mysqli_fetch_array($query)){
									
								?>
								<span class="notification" style="background-color: red;">
								
													<?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Close' ;");
													echo mysqli_num_rows($jumlah_teknik); ?>
													
								</span>
								<?php } ?>
							</a>
							<?php  
									$query=mysqli_query($koneksi, "SELECT *	FROM tb_job j
									left join tb_karyawan k on k.nik=j.di_tujukan where status in ('Close') ;");
									while($row=mysqli_fetch_array($query)){
									$idj=$row['id_job']; 
								?>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									<div class="dropdown-title">You have <?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Close';");
													echo mysqli_num_rows($jumlah_teknik); ?> Job</div>
								</li>
								<li>
								<?php  
								$ambildatastock=mysqli_query($koneksi, "SELECT * FROM tb_job j left join tb_karyawan k on k.nik=j.di_tujukan  where status='Close'");
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
													<span class="time">Location : <?php echo $fetch['lokasi'] ?>  | Action By. <?php echo $fetch['nama'] ?></span> 
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
							<?php } ?>
						</li>
						<!-- <li class="nav-item dropdown hidden-caret">
							<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
								<i class="fas fa-layer-group"></i>
							</a>
							<div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
								<div class="quick-actions-header">
									<span class="title mb-1">Form</span>
									<span class="subtitle op-8">Shortcuts</span>
								</div>
								<div class="quick-actions-scroll scrollbar-outer">
									<div class="quick-actions-items">
										<div class="row m-0">
											<a class="col-6 col-md-6 p-0" data-toggle="modal" data-target="#addRowModal1">
												<div class="quick-actions-item">
													<i class="flaticon-file-1"></i>
													<span class="text">Creat New Job</span>
												</div>
											</a>
											<a class="col-6 col-md-6 p-0" data-toggle="modal" data-target="#addRowModal2">
												<div class="quick-actions-item">
													<i class="flaticon-pen"></i>
													<span class="text">Create New User</span>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</li> -->
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
												<p class="text-muted" style="font-size:10px;"><?php echo $row3['nik'] ?></p><a href="#" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
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
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

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
						<li class="nav-item">
							<a href="index.php">
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
								<p>Location</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="tables">
								<ul class="nav nav-collapse">
									<li>
										<a href="lokasi1.php">
											<span class="sub-item">Pit Panel 1</span>
										</a>
									</li>
									<li>
										<a href="laksi2.php">
											<span class="sub-item">Pit Panel 2</span>
										</a>
									</li>
									<li>
										<a href="lokasi3.php">
											<span class="sub-item">Pit Panel 3</span>
										</a>
									</li>
									<li>
										<a href="lokasi4.php">
											<span class="sub-item">Pit Tiwa</span>
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
		<div class="main-panel">
			<?php
			$id  = mysqli_real_escape_string($koneksi,$_GET['id']);
			$query1=mysqli_query($koneksi, "SELECT * FROM tb_job j
			 left join tb_karyawan k on k.nik=j.di_tujukan  where id_job='$id'  ");
			$row=mysqli_fetch_array($query1);
			?>
		<div class="content">
				<div class="page-inner">
					<img src="../logo.jpg" alt="navbar brand" class="navbar-brand pull-right" style="height:50px; width:110px;">
					<div class="page-header">
						<h4 class="page-title">Forms Detail</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="../index.php">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Forms</a>
							</li>
							
						</ul>
					</div>
					<?php  
					 $ambildatastock=mysqli_query($koneksi, "SELECT * FROM tb_revisi where  id_job='$id'");
					 $no=0;
					 $no++;
                     while($fetch=mysqli_fetch_array($ambildatastock)){
					?>
                 	 <div class="alert alert-warning" role="alert">
							Revisi <?php echo $no; ?> : <?php echo $fetch['ket_revisi']?> 
					 </div>
                  <?php $no++; }?>
					<div class="row" >
						<div class="col-md-12" >
							<div class="card">
								<div class="card-header">
									<div class="card-title"><b> <?php echo $row['nama']?> / <?php echo $row['nik']?></b>
										<a href="#" class="btn btn-info btn-border btn-round btn-sm pull-right">
											<span class="btn-label">
												<i class="fa fa-print"></i>
											</span>
											Print
										</a>
									</div>
								</div>
								<div class="card-body">
								<table style="width:100%; border:none; ">
  <tr style="font-size:14px; border:none;">
    <td colspan="6" style="border:none;"></td>
  </tr>
    <tr style="height:20px; border:none;"><td colspan="6" style="border:none;"></td></tr>
  <tr style="font-size:15px; border:none;">
    <td width='15%' style="border:none;">Activity</td>
    <td colspan="2" style="border:none;">: <?php echo$row['aktivitas'] ?></td>
    <td colspan="4" style="border:none;">Start &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; <?php echo$row['create_job'] ?></td>
  </tr>
  <tr style="font-size:15px; border:none;">
    <td width='15%' style="border:none;">Problem </td>
    <td colspan="2" style="border:none;">: <?php echo $row['problem'] ?></td>
	<td colspan="4" style="border:none;">End &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; <?php echo$row['update_at'] ?></td>
  </tr>
  <tr style="font-size:15px; border:none;">
    <td width='15%' style="border:none;">Location </td>
    <td colspan="2" style="border:none;">: <?php echo $row['lokasi'] ?></td>
	<td colspan="4" style="border:none;">Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php $create    =new DateTime($row['create_job']);
																							$today      =new DateTime($row['update_at']);
																							$diff = $today->diff($create);
																							echo $diff->d; echo " Hari Kerja";?>
  </td>	
  </tr>
  <tr style="font-size:15px; border:none;">
    <td width='15%' style="border:none;">Statusikh </td>
    <td colspan="2" style="border:none;">: <?php echo$row['status_ikh'] ?></td>
  </tr>
  <tr style="font-size:15px; border:none;">
    <td width='15%' style="border:none;">Tindakan </td>
    <td colspan="2" style="border:none;">: <?php echo$row['tindakan_perbaikan'] ?></td>
  </tr>
  <tr style="font-size:15px; border:none; "  >
    <td width='15%' style="border:none;">Ket </td>
    <td colspan="2" style="border:none;">: <?php echo$row['ket'] ?></td>
  </tr>

  <tr style="height:20px; border:none;"><td colspan="6" style="border:none;"></td></tr>

  <tr style="height:12x; border:none;"><td colspan="6" style="border:none;"></td></tr>
  <tr style="font-size:13px; height:100px;">
     <td colspan="6" style="vertical-align : top; border:1px solid black;" ><b > sketsa</b> :<br><center><img style="width:100%; height:100%;" src="../uploads/<?php echo $row['sketsa_'] ?>" ></center></td>
  </tr>
  <tr style="font-size:13px; height:100px;">
     <td colspan="6" style="vertical-align : top; border:1px solid black;" ><b >Eviden</b> <text style="font-size:10px;">(Create By ENG)</text> :<br><center><img style="width:100%; height:100%;" src="../uploads/eviden/<?php echo $row['eviden'] ?>" ></center></td>
  </tr>
 
  </table>

								</div>
								
							</div>
						</div>
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
	<div class="modal fade" id="pending" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Di tujukan kepada</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
				<div class="form-group">
					<label for="pillSelect">Select Nama :</label>
					<select class="form-control input-pill" id="pillSelect">
						<option>xxxxxxxx xxx xxx - 10032422</option>
						<option>xxxxxxxx xxx xxx - 10032422</option>
						<option>xxxxxxxx xxx xxx - 10032422</option>
						<option>xxxxxxxx xxx xxx - 10032422</option>
						<option>xxxxxxxx xxx xxx - 10032422</option>
					</select>
				</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end Modal -->
	

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
					<form method="post" role="form" enctype="multipart/form-data" class="form-horizontal">
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
									<input id="addPosition" type="text" class="form-control" name="problem" placeholder="Problem" required>
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
									<input type="file" class="form-control-file" name="gambar" id="exampleFormControlFile1" required>
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
					<input type="number" class="form-control" id="exampleFormControlInput1" name="nik" placeholder="Nik">
					</div>
					<div class="form-group">
					<label for="exampleFormControlInput1">Nama</label>
					<input type="text" class="form-control" id="exampleFormControlInput1" name="nama" placeholder="Nama">
					</div>
					<div class="form-group">
					<label for="exampleFormControlInput1">No WA</label>
					<input type="number" class="form-control" id="exampleFormControlInput1" name="wa" placeholder="No Wa">
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
	<!-- Datatables -->
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>
	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="../assets/js/setting-demo2.js"></script>
	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 25,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>
</body>
</html>