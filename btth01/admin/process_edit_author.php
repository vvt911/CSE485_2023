<?php
// Kết nối tới database
$con = mysqli_connect('localhost', 'root', '', 'btth01_cse485');

// Lấy dữ liệu từ form
$ma_tgia = $_POST['txtMaTacGia'];
$ten_tgia = $_POST['txtTenTacGia'];
$hinhanh = $_FILES['fileHinhAnh']['name'];

// Kiểm tra các trường dữ liệu
if ($ma_tgia == "" || $ten_tgia == "") {
    echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    echo "<script>window.location = 'add_author.php'</script>";
    die();
}

// Kiểm tra có thay đổi ảnh hay không
if ($hinhanh == "") {
    // Sửa bài viết vào database khi không thay đổi ảnh
    $sql = "UPDATE tacgia SET  ten_tgia = '$ten_tgia' WHERE ma_tgia = '$ma_tgia'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script>alert('Sửa tác giả thành công!');</script>";
        echo "<script>window.location = 'author.php'</script>";
    } else {
        echo "<script>alert('Sửa tác giả thất bại!');</script>";
        echo "<script>window.location = 'edit_author.php?id=" . $ma_tgia . "'</script>";
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
        echo "<script>window.location = 'add_author.php'</script>";
        die();
    }

    // Sửa bài viết trong database
    $sql = "UPDATE tacgia SET  ten_tgia = '$ten_tgia',hinhanh = '$hinhanh'
    WHERE ma_gia = '$ma_tgia'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script>alert('Sửa tác giả thành công!');</script>";
        echo "<script>window.location = 'article.php'</script>";
    } else {
        echo "<script>alert('Sửa tác giả thất bại!');</script>";
        echo "<script>window.location = 'edit_article.php?id=" . $ma_bviet . "'</script>";
}
}
