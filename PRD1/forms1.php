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

$id    = mysqli_real_escape_string($koneksi,$_GET['id']);
$query1=mysqli_query($koneksi, "SELECT *
 FROM tb_job  where id_job='$id'  ");
$row=mysqli_fetch_array($query1);

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
	<link rel="icon" href="../assets/img/icosn.ico" type="image/x-icon"/>
	
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
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				<div class="container-fluid">
					<div class="pull-right" style="color: aliceblue; font-size:medium;">
						PT. BUKIT MAKMUR
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
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
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									<div class="dropdown-title">You have <?php $jumlah_teknik = mysqli_query($koneksi,"SELECT * FROM tb_job where status='Close';");
													echo mysqli_num_rows($jumlah_teknik); ?> Approval</div>
								</li>
								<li>
								<?php  
								$ambildatastock=mysqli_query($koneksi, "SELECT * FROM tb_job where status='Close'");
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
													<span class="time">Location : <?php echo $fetch['lokasi'] ?></span> 
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
											<a class="col-6 col-md-4 p-0" data-toggle="modal" data-target="#addRowModal1">
												<div class="quick-actions-item">
													<i class="flaticon-file-1"></i>
													<span class="text">Creat New Job</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" data-toggle="modal" data-target="#addRowModal">
												<div class="quick-actions-item">
													<i class="flaticon-pen"></i>
													<span class="text">Create New xxxxx</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" data-toggle="modal" data-target="#addRowModal">
												<div class="quick-actions-item">
													<i class="flaticon-pen"></i>
													<span class="text">Create New xxxxx</span>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
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
										<a class="dropdown-item" href="#">Logout</a>
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
		<div class="sidebar" data-background-color=" ">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?php echo $row3['nama']?>
									<span class="user-level"><?php echo $row3['nik']?></span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav ">
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
											<span class="sub-item">Data Close</span>
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
					</ul>
				</div>
			</div>
		</div>
		<div class="main-panel" >
			<div class="content">
				<div class="page-inner">
					<img src="../logo.jpg" alt="navbar brand" class="navbar-brand pull-right" style="height:50px; width:110px;">
					<div class="page-header">
						<h4 class="page-title">Forms</h4>
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
					 <?php  
					 $ambildata=mysqli_query($koneksi, "SELECT * FROM tb_ket where  id_job='$id'");
					 $no=0;
					 $no++;
                     while($fetch1=mysqli_fetch_array($ambildata)){
					?>
                 	 <div class="alert alert-info" role="alert">
						<b>Ket dari Shift sebelumnya :</b>  <?php echo $fetch1['ket']?> 
					 </div>
                  <?php $no++; }?>
					<div class="row" >
						<div class="col-md-12" >
							<div class="card">
								<div class="card-header">
									<div class="card-title">Form Elements 
										<a href="#" class="btn btn-info btn-border btn-round btn-sm pull-right">
											<span class="btn-label">
												<i class="fa fa-print"></i>
											</span>
											Print
										</a>
									</div>
								</div>
								<div class="card-body">
									<form method="post" role="form" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group form-group-default">
                                                    <label><b style="color: rgb(31, 64, 162);">cnunit :</b></label>
                                                    <input id="Name" type="hidden" class="form-control" name="id" name="cnunit" value="<?php echo $row['id_job'] ?>">
                                                    <input id="Name" type="text" class="form-control" name="cnunit" value="<?php echo $row['cnunit'] ?>">
                                                </div>
                                                <div class="form-group form-group-default">
                                                    <label><b style="color: rgb(31, 64, 162);">Activity :</b></label>
                                                    <input id="Name" type="text" class="form-control" name="aktivitas" value="<?php echo $row['aktivitas'] ?>">
                                                </div>
                                                <div class="form-group form-group-default">
                                                    <label><b style="color: rgb(31, 64, 162);">Statusikh :</b></label>
                                                    <input id="Name" type="text" class="form-control" name="status_ikh" value="<?php echo $row['status_ikh'] ?>">
                                                </div>
                                                <div class="form-group form-group-default">
                                                    <label><b style="color: rgb(31, 64, 162);">Problem :</b></label>
                                                    <input id="Name" type="text" class="form-control" name="problem" value="<?php echo $row['problem'] ?>">
                                                </div>
                                                <div class="form-group form-group-default">
                                                    <label><b style="color: rgb(31, 64, 162);">Tindakan :</b></label>
                                                    <input id="Name" type="text" class="form-control" name="tindakan_perbaikan" value="<?php echo $row['tindakan_perbaikan'] ?>">
                                                </div>
                                                <div class="form-group form-group-default">
                                                    <label><b style="color: rgb(31, 64, 162);">Lokasi :</b></label>
                                                    <input id="Name" type="text" class="form-control" placeholder="Lokasi" value="<?php echo $row['lokasi'] ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="comment"><b style="color: rgb(31, 64, 162);">Ket</b></label>
                                                    <textarea class="form-control" id="comment" name="ket" rows="8"><?php echo $row['ket'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-8">
                                                <div style="width:100%; height:725px;">
                                                    <embed style="width:100%; height:100%;" src="../uploads/<?php echo $row['sketsa_'] ?>" type="application/pdf">
                                                </div>
                                                <div class="form-group">
                                                    <label><b style="color: rgb(31, 64, 162);">"Jika ada Note pada file pdf, silahkan save terlebih dahulu filenya dan Upload kembali", Di bawah :</b></label>
                                                        <div class="input-group">
                                                            <input type="file" class="form-control" name="doc" aria-label="" aria-describedby="basic-addon1">
                                                            <button class="btn btn-default" type="submit" name="updatefile">Update File</button>
                                                        </div>
                                                    </div>	
                                            </div>
                                        </div>
                                        <div class="card-action ">
											<button class="btn btn-info btn-round pull-right " name="onprogress">On Prog</button>
                                          <!--  <button type="submit" name="editjob" class="btn btn-warning btn-round pull-right">Update</button> -->
                                        </div>
                                    </form>
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

											<!-- Modal Approve -->
											<div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLongTitle">Modal Approve</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															you believe this work has been done.??
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-success">Ok</button>
														</div>
													</div>
												</div>
											</div>
											<!--end modal Approve-->


	<!-- Modal -->
	<div class="modal fade" id="revisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Revisi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="comment"><b style="color: rgb(31, 64, 162);">Beri Keterangan :</b></label>
									<textarea class="form-control" id="comment" rows="5" name="ket" placeholder="Ket..."></textarea>
								</div>
							</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end Modal -->
	<!-- Modal -->
	<div class="modal fade bd-example-modal-lg" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header no-bd">
					<h5 class="modal-title">
						<span class="fw-mediumbold">
						New</span> 
						<span class="fw-light">
							Row
						</span>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p class="small">Create a new row using this form, make sure you fill them all</p>
					<form>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group form-group-default">
									<label><b>CN/unit :</b></label>
									<input id="addName" type="text" class="form-control" placeholder="fill name">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group form-group-default">
									<label><b>Activity :</b></label>
									<input id="addName" type="text" class="form-control" placeholder="fill name">
								</div>
							</div>
							<div class="col-md-6 pr-0">
								<div class="form-group form-group-default">
									<label><b>Statusikh :</b></label>
									<input id="addPosition" type="text" class="form-control" placeholder="fill position">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label><b>Problem :</b></label>
									<input id="addPosition" type="text" class="form-control" placeholder="fill position">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="exampleFormControlFile1">Example file input</label>
									<input type="file" class="form-control-file" id="exampleFormControlFile1">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="comment">Tindakan</label>
									<textarea class="form-control" id="comment" rows="5"></textarea>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer no-bd">
					<button type="button" id="addRowButton" class="btn btn-primary">Add</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="../assets/js/setting-demo2.js"></script>
</body>
</html>