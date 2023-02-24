<?php
require './session_login.php';
?><?php   
$ma_tloai = $_POST['txtIDCat'];
$theloai = $_POST['txtCatName'];
$con = mysqli_connect('localhost','root','','btth01_cse485' );
if(!$con){
    die('Kết nối tới sever bị lỗi');
}
if($ma_tloai == "" || $theloai == ""){
    echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    echo "<script>window.location = 'add_category.php'</script>";
    die();
}



$idCat = $_POST['txtIDCat'];           
$name = $_POST['txtCatName'];
$sql = "INSERT INTO theloai (ma_tloai,ten_tloai) VALUES ('$idCat','$name')";
$rs =  mysqli_query($con,$sql);
if ($rs) {
    echo "<script>alert('Thêm thể loại thành công!');</script>";
    echo "<script>window.location = 'category.php'</script>";
} else {
    echo "<script>alert('Thêm thể loại thất bại!');</script>";
    echo "<script>window.location = 'category.php'</script>";
}
    
                        
                            
