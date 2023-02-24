<?php
require './session_login.php';
?><?php
// Kết nối tới database
$con = mysqli_connect('localhost', 'root', '', 'btth01_cse485');

// Lấy giá trị ma_bviet từ URL
if (isset($_GET['id'])) {
    $ma_tgia = intval($_GET['id']);
} else {
    // Nếu không có tác giả, chuyển hướng về trang danh sách tác giả
    header('Location: author.php');
    exit();
}

// Xóa bài viết
$sql = "DELETE FROM tacgia WHERE ma_tgia = '$ma_tgia'";
$result = mysqli_query($con, $sql);
if ($result) {
    echo "<script>alert('Xóa tác giả thành công!');</script>";
    echo "<script>window.location = 'author.php'</script>";
} else {
    echo "<script>alert('Xóa tác giả thất bại!');</script>";
    echo "<script>window.location = 'author.php'</script>";
}

