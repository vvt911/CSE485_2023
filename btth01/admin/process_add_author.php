<?php
require './session_login.php';
?><?php
// Kết nối tới database
$con = mysqli_connect('localhost', 'root', '', 'btth01_cse485');

// Lấy dữ liệu từ form
$ten_tgia = $_POST['txtTenTacGia'];
$hinhanh = $_FILES['fileHinhAnh']['name'];

// Kiểm tra các trường dữ liệu
if ($ten_tgia == "") {
    echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    echo "<script>window.location = 'add_author.php'</script>";
    die();
}

// Kiểm tra có thay đổi ảnh hay không
if ($hinhanh != "") {
    $target_dir = "../images/songs/";
    $target_file = $target_dir . basename($_FILES["fileHinhAnh"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $extensions_arr)) {
        move_uploaded_file($_FILES["fileHinhAnh"]["tmp_name"], $target_file);
    } else {
        echo "<script>alert('Chỉ chấp nhận file ảnh định dạng JPG, JPEG, PNG hoặc GIF!');</script>";
        echo "<script>window.location = 'add_author.php'</script>";
        die();
    }
}

// Thêm bài viết vào database
$sql = "INSERT INTO tacgia (ten_tgia,hinh_tgia) VALUES ('$ten_tgia','$hinhanh')";
$result = mysqli_query($con, $sql);

if ($result) {
    echo "<script>alert('Thêm tác giả thành công!');</script>";
    echo "<script>window.location = 'author.php'</script>";
} else {
    echo "<script>alert('Thêm tác giả thất bại!');</script>";
    echo "<script>window.location = 'add_author.php'</script>";
}
