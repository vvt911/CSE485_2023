<?php
$con = mysqli_connect('localhost','root','','btth01_cse485' );
$ma_tloai = $_POST['txtCatId'];
$theloai = $_POST['txtCatName'];
if($theloai == ""){
    echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    echo "<script>window.location = 'edit_category.php'</script>";
    die();
}
$sql = "UPDATE theloai set ten_tloai = '$theloai' WHERE ma_tloai = '$ma_tloai'";
$rs =  mysqli_query($con,$sql);
if ($rs) {
    echo "<script>alert('Sửa thể loại thành công!');</script>";
    echo "<script>window.location = 'category.php'</script>";
} else {
    echo "<script>alert('Sửa thể loại thất bại!');</script>";
    echo "<script>window.location = 'category.php'</script>";
}