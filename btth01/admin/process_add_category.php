<?php
require './session_login.php';
?><?php   

$theloai = $_POST['txtCatName'];
$con = mysqli_connect('localhost','root','','btth01_cse485' );
if(!$con){
    die('Kết nối tới sever bị lỗi');
}
if($theloai == ""){
    echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    echo "<script>window.location = 'add_category.php'</script>";
    die();
}


$sql = "INSERT INTO theloai (ten_tloai) VALUES ('$theloai')";
$rs =  mysqli_query($con,$sql);
if ($rs) {
    echo "<script>alert('Thêm thể loại thành công!');</script>";
    echo "<script>window.location = 'category.php'</script>";
} else {
    echo "<script>alert('Thêm thể loại thất bại!');</script>";
    echo "<script>window.location = 'category.php'</script>";
}
    
                        
                            
