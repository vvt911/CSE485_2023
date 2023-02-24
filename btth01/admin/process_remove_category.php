<?php
$con = mysqli_connect('localhost','root','','btth01_cse485' );
if (isset($_GET['id'])) {
    $ma_tloai = intval($_GET['id']);
} else {
    header('Location: category.php');
    exit();
}

$sql = "DELETE FROM theloai WHERE ma_tloai = '$ma_tloai'";
$rs =  mysqli_query($con,$sql);
if ($rs) {
    echo "<script>alert('Xóa thể loại thành công!');</script>";
    echo "<script>window.location = 'category.php'</script>";
} else {
    echo "<script>alert('Xóa thể loại thất bại!');</script>";
    echo "<script>window.location = 'category.php'</script>";
}

?>