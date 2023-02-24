<?php
require './session_login.php';
?><?php
// Kết nối tới database
$con = mysqli_connect('localhost', 'root', '', 'btth01_cse485');

// Lấy dữ liệu từ form
$ma_bviet = $_POST['txtMaBaiViet'];
$tieude = $_POST['txtTieuDe'];
$ten_bhat = $_POST['txtTenBaiHat'];
$ma_tloai = $_POST['sltTheLoai'];
$tomtat = $_POST['txtTomTat'];
$noidung = $_POST['txtNoiDung'];
$ma_tgia = $_POST['sltTacGia'];
$hinhanh = $_FILES['fileHinhAnh']['name'];
$ngayviet = date('Y-m-d H:i:s');

// Kiểm tra các trường dữ liệu
if ($ma_bviet == "" || $tieude == "" || $ten_bhat == "" || $ma_tloai == "" || $tomtat == "" || $noidung == "" || $ma_tgia == "") {
    echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    echo "<script>window.location = 'add_article.php'</script>";
    die();
}

// Kiểm tra có thay đổi ảnh hay không
if ($hinhanh == "") {
    // Sửa bài viết vào database khi không thay đổi ảnh
    $sql = "UPDATE baiviet SET tieude = '$tieude', ten_bhat = '$ten_bhat', ma_tloai = '$ma_tloai', tomtat = '$tomtat', noidung = '$noidung', ma_tgia = '$ma_tgia', ngayviet = '$ngayviet'
    WHERE ma_bviet = '$ma_bviet'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script>alert('Sửa bài viết thành công!');</script>";
        echo "<script>window.location = 'article.php'</script>";
    } else {
        echo "<script>alert('Sửa bài viết thất bại!');</script>";
        echo "<script>window.location = 'edit_article.php?id=" . $ma_bviet . "'</script>";
    }
} else {
    $target_dir = "../images/songs/";
    $target_file = $target_dir . basename($_FILES["fileHinhAnh"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $extensions_arr)) {
        move_uploaded_file($_FILES["fileHinhAnh"]["tmp_name"], $target_file);
    } else {
        echo "<script>alert('Chỉ chấp nhận file ảnh định dạng JPG, JPEG, PNG hoặc GIF!');</script>";
        echo "<script>window.location = 'add_article.php'</script>";
        die();
    }

    // Sửa bài viết trong database
    $sql = "UPDATE baiviet SET tieude = '$tieude', ten_bhat = '$ten_bhat', ma_tloai = '$ma_tloai', tomtat = '$tomtat', noidung = '$noidung', ma_tgia = '$ma_tgia', ngayviet = '$ngayviet', hinhanh = '$hinhanh'
    WHERE ma_bviet = '$ma_bviet'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script>alert('Sửa bài viết thành công!');</script>";
        echo "<script>window.location = 'article.php'</script>";
    } else {
        echo "<script>alert('Sửa bài viết thất bại!');</script>";
        echo "<script>window.location = 'edit_article.php?id=" . $ma_bviet . "'</script>";
}
}
