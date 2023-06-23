<?php

//KODENKSI
$koneksi=mysqli_connect("localhost","root","","db_jobpending");

//menambah stock ==================================================================================================================================
if(isset($_POST['addnew']))
{ 
    $cnunit=$_POST['cnunit'];
    $aktivitas=$_POST['aktivitas'];
    $status_ikh=$_POST['status_ikh'];
    $problem=$_POST['problem'];
    $tindakan_perbaikan=$_POST['tindakan_perbaikan'];
    $lokasi=$_POST['lokasi'];
    $ket=$_POST['ket'];
    // upload gambar
    $nama_file = $_FILES['pdf']['name'];
    $source = $_FILES['pdf']['tmp_name'];
    $folder='./../uploads/'; 
    //batas upload gambar
   move_uploaded_file($source, $folder.$nama_file);
    $adddata=mysqli_query($koneksi, "insert into tb_job (lokasi, cnunit, aktivitas, status_ikh, problem, tindakan_perbaikan, ket, status, sketsa_) values('$lokasi','$cnunit','$aktivitas','$status_ikh','$problem','$tindakan_perbaikan','$ket','Open','$nama_file')");
    if($adddata){
        header('location:tables.php'); 
    }else
    {
       echo 'gagal'; 
    }

}
//update file dpf =======================================================================================================================================
if(isset($_POST['updatefile']))
{
    $idj=$_POST['id'];

    // upload file
    $nama_file = $_FILES['doc']['name'];
    $source = $_FILES['doc']['tmp_name'];
    $folder='./../uploads/';
    //batas upload file
    move_uploaded_file($source, $folder.$nama_file);
    $updatenya=mysqli_query($koneksi,"update tb_job set sketsa_='$nama_file'  where id_job='$idj'") or die($koneksi->error);
    if($updatenya)
    {
        header("location:form_edit.php?id=$idj");
    } else {
        echo "Gagal";
    }
}
//revisi ==================================================================================================================================
if(isset($_POST['subrevisi']))
{ 
    $ket=$_POST['ket'];
    $id_job=$_POST['id_job'];
   
    $updatenya=mysqli_query($koneksi,"update tb_job set status='Open'  where id_job='$id_job'") or die($conn->error);
    $addtotable=mysqli_query($koneksi, "insert into tb_revisi (id_job, ket_revisi) values('$id_job','$ket')");
    if($addtotable){
        header("location:forms1.php?id=$id_job");
    }else
    {
       echo 'gagal'; 
    }

}

//add user ==================================================================================================================================
if(isset($_POST['adduser']))
{  
    $nik=$_POST['nik'];
    $nama=$_POST['nama'];
    $id_sec=$_POST['id_sec'];
    $id_jab=$_POST['id_jab'];
    $wa=$_POST['wa'];

    $addtotable=mysqli_query($koneksi, "insert into tb_karyawan (nik, nama, no_telp, section, id_jab, password) values('$nik','$nama','$wa','$id_sec','$id_jab',md5('admin'))");
    if($addtotable){
        header("location:user.php");
    }else
    {
       echo 'gagal';   
    }

}
//add user prd ==================================================================================================================================
if(isset($_POST['adduser1']))
{ 
    $nik=$_POST['nik'];
    $nama=$_POST['nama'];
    $id_jab=$_POST['id_jab'];
    $wa=$_POST['wa'];

    $addtotable=mysqli_query($koneksi, "insert into tb_karyawan (nik, nama, no_telp, section, id_jab, password) values('$nik','$nama','$wa','1','$id_jab',md5('admin'))");
    if($addtotable){
        header("location:user.php");
    }else
    {
       echo 'gagal';   
    }

}
//update user ==================================================================================================================================
if(isset($_POST['updateuser']))
{ 
    $nik=$_POST['nik']; 
    $pwd=MD5($_POST['pwd']); 

    $update=mysqli_query($koneksi,"update tb_karyawan set password='$pwd' where nik='$nik'") or die($conn->error);
     if($update){
        header("location:user.php");
    }else
    {
       echo 'gagal';  
    }

}

//update user ==================================================================================================================================
if(isset($_POST['updateuser1']))
{ 
    $id=$_POST['id']; 
    $nik=$_POST['nik']; 
    $nama=$_POST['nama']; 
    $telp=$_POST['telp']; 

    $update=mysqli_query($koneksi,"update tb_karyawan set nik='$nik', nama='$nama', no_telp='$telp' where nik='$id'") or die($conn->error);
     if($update){
        header("location:user.php");
    }else
    {
       echo 'gagal';  
    }

}
//Delete user ==============================================================================================================================================
if(isset($_POST['deleteuser']))
{
    $nik=$_POST['nik'];

    $qhapus=mysqli_query($koneksi,"delete from tb_karyawan where nik='$nik' ") or die($conn->error);
    
    if($qhapus)
    {
        header("location:user.php");
    } else {
        echo "Gagal";
    }
}


//Delete data job ==============================================================================================================================================
if(isset($_POST['deletejob']))
{
    $idj=$_POST['id_job'];

    $qhapus=mysqli_query($koneksi,"delete from tb_job where id_job='$idj' ") or die($conn->error);
    
    if($qhapus)
    {
        header("location:tables.php");
    } else {
        echo "Gagal";
    }
}
//Delete data job1 ==============================================================================================================================================
if(isset($_POST['deletejob1']))
{
    $idj=$_POST['id_job'];

    $qhapus=mysqli_query($koneksi,"delete from tb_job where id_job='$idj' ") or die($conn->error);
    
    if($qhapus)
    {
        header("location:data_onprog.php");
    } else {
        echo "Gagal";
    }
}
//Delete data job2 ==============================================================================================================================================
if(isset($_POST['deletejob2']))
{
    $idj=$_POST['id_job'];

    $qhapus=mysqli_query($koneksi,"delete from tb_job where id_job='$idj' ") or die($conn->error);
    
    if($qhapus)
    {
        header("location:data_close.php");
    } else {
        echo "Gagal";
    } 
}
// Job di tujukan ke ==============================================================================================================================================
if(isset($_POST['ditujukan']))
{
    $idj=$_POST['id'];
    $nik=$_POST['nik'];
    date_default_timezone_set("Asia/Makassar");
    $tgl1 = date("Y-n-d H:i:s");

    $updatenya=mysqli_query($koneksi,"update tb_job set di_tujukan='$nik', create_job='$tgl1'  where id_job='$idj'") or die($conn->error);
    
    if($updatenya)
    {
        header("location:tables.php");
    } else {
        echo "Gagal";
    }
}

// Job pendingan ==============================================================================================================================================
if(isset($_POST['pendingan']))
{ 
    $idj=$_POST['id'];
    $nik=$_POST['nik'];
    $value=$_POST['value'];
    $ket=$_POST['ket'];
    
    $addtotable=mysqli_query($koneksi, "insert into tb_ket (id_job, ket) values('$idj','$ket')");
    $updatenya=mysqli_query($koneksi,"update tb_job set di_tujukan='$nik'  where id_job='$idj'") or die($conn->error);
    $update=mysqli_query($koneksi,"update tb_job set status='Pending', progress='$value'  where id_job='$idj'") or die($conn->error);
    
    if($updatenya&&$update&&$addtotable)
    {
        header("location:data_onprog.php");
    } else {
        echo "Gagal";
    }
}

// Job pendingan ==============================================================================================================================================
if(isset($_POST['updateprog']))
{ 
    $idj=$_POST['id'];
    $value=$_POST['value'];

    $update=mysqli_query($koneksi,"update tb_job set progress='$value'  where id_job='$idj'") or die($conn->error);
    
    if($update)
    {
        header("location:data_onprog.php");
    } else {
        echo "Gagal";
    }
}

// Job on progress ==============================================================================================================================================
if(isset($_POST['onprogress']))
{
    $idj=$_POST['id'];

    $updatenya=mysqli_query($koneksi,"update tb_job set status='Progress', progress='25'  where id_job='$idj'") or die($conn->error);
    
    if($updatenya)
    {
        header("location:data_onprog.php");
    } else {
        echo "Gagal";
    }
}

// Job close ==============================================================================================================================================
if(isset($_POST['close']))
{
    $idj=$_POST['id'];

    $updatenya=mysqli_query($koneksi,"update tb_job set status='Close', progress='100'  where id_job='$idj'") or die($conn->error);
    
    if($updatenya)
    {
        header("location:data_onprog.php");
    } else {
        echo "Gagal";
    }
}

// Job close ==============================================================================================================================================
if(isset($_POST['approve']))
{
    $idj=$_POST['id_job'];
    $nama=$_POST['nama'];
      // upload gambar
      $nama_file = $_FILES['eviden']['name'];
      $source = $_FILES['eviden']['tmp_name'];
      $folder='./../uploads/eviden/'; 
      //batas upload gambar
     move_uploaded_file($source, $folder.$nama_file);

    $updatenya=mysqli_query($koneksi,"update tb_job set status='Done', aproved_by='$nama', eviden='$nama_file'  where id_job='$idj'") or die($conn->error);
    
    if($updatenya)
    {
        header("location:data_close.php");
    } else {
        echo "Gagal";
    }
}
//edit data job  =======================================================================================================================================
if(isset($_POST['editjob']))
{
    $idj=$_POST['id'];
    $cnunit=$_POST['cnunit'];
    $aktivitas=$_POST['aktivitas'];
    $status_ikh=$_POST['status_ikh'];
    $problem=$_POST['problem'];
    $tindakan_perbaikan=$_POST['tindakan_perbaikan'];
    $ket=$_POST['ket'];
    $lokasi=$_POST['lokasi'];

    $updatenya=mysqli_query($koneksi,"update tb_job set cnunit='$cnunit', aktivitas='$aktivitas', status_ikh='$status_ikh', problem='$problem', tindakan_perbaikan='$tindakan_perbaikan', ket='$ket'  where id_job='$idj'") or die($koneksi->error);
    if($updatenya)
    {
       
        header("location:form_edit.php?id=$idj");
    } else {
        echo "Gagal";
    }
}



?>