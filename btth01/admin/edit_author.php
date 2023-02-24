<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa tác giả</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Trang ngoài</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="category.php">Thể loại</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="author.php">Tác giả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="article.php">Bài viết</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-5 mb-5">

        <?php
        // Kết nối tới database
        $con = mysqli_connect('localhost', 'root', '', 'btth01_cse485');

        // Lấy giá trị ma_tgia từ URL
        if (isset($_GET['id'])) {
            $ma_tgia = intval($_GET['id']);
        } else {
            // Nếu không có mã bài viết, chuyển hướng về trang danh sách bài viết
            header('Location: author.php');
            exit();
        }

        // Truy vấn SQL để lấy dữ liệu của bài viết có ma_bviet tương ứng
        $sql = "SELECT * FROM tacgia tg where ma_tgia = $ma_tgia";
        $result = mysqli_query($con, $sql);

        // Lấy dữ liệu bài viết từ kết quả truy vấn
        $article = mysqli_fetch_assoc($result);
        ?>


        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Sửa tác giả</h3>
                <form action="process_edit_author.php" method="post" enctype="multipart/form-data">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblMaBaiViet">Mã tác giả</span>
                        <input type="text" class="form-control" name="txtMaTacGia" value="<?php echo $article['ma_tgia']; ?>" readonly>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblTenBaiHat">Tên tác giả</span>
                        <input type="text" class="form-control" name="txtTenTacGia" value="<?php echo $article['ten_tgia']; ?>">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="lblHinhAnh">Hình ảnh</span>
                        <input type="file" class="form-control" name="fileHinhAnh">
                    </div>

                    <div class="form-group float-end">
                        <input type="submit" value="Sửa" class="btn btn-success">
                        <a href="author.php" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <scrip src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
        <script>
            const form = document.querySelector('form');
            form.addEventListener('submit', (event) => {
                event.preventDefault(); // Ngăn chặn form submit nếu có lỗi

                var maTacGiaInput = document.querySelector('input[name="txtMaTacGia"]');
                var tenTacGiaInput = document.querySelector('input[name="txtTenTacGia"]');

                // Kiểm tra trường Mã bài viết
                if (maTacGiaInput.value.trim() === '') {
                    alert('Bạn chưa nhập Mã bài viết');
                    return;
                }

                // Kiểm tra trường Tiêu đề
                if (tenTacGiaInput.value.trim() === '') {
                    alert('Bạn chưa nhập Tiêu đề');
                    return;
                }

                

                // Nếu không có lỗi, submit form
                form.submit();
            });
        </script>
</body>

</html>