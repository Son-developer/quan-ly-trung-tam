<?php
include 'connect.php';

// Xử lý khi bấm nút "Thêm Học Viên"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_student'])) {
    $ho_ten = $_POST['ho_ten'];
    $email = $_POST['email'];
    $sdt = $_POST['so_dien_thoai'];
    $ngay_sinh = $_POST['ngay_sinh'];
    $gioi_tinh = $_POST['gioi_tinh'];
    $dia_chi = $_POST['dia_chi'];

    $sql = "INSERT INTO hoc_vien (ho_ten, email, so_dien_thoai, ngay_sinh, gioi_tinh, dia_chi) 
            VALUES ('$ho_ten', '$email', '$sdt', '$ngay_sinh', '$gioi_tinh', '$dia_chi')";
    
    if ($conn->query(query: $sql) === TRUE) {
        header("Location: hoc-vien.php");
        exit();
    } else {
        $error = "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Học Viên - VAA English</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-info" href="#"><i class="bi bi-mortarboard-fill me-2"></i>VAA ADMIN - Quản Lý Học Viên</a>
            <div class="d-flex align-items-center">
                <a href="lms.php" class="btn btn-outline-light btn-sm me-2">Quản lý Khóa Học</a>
                <a href="login.html" class="btn btn-danger btn-sm">Đăng xuất</a>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Danh Sách Học Viên</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                <i class="bi bi-plus-lg me-1"></i> Thêm Học Viên Mới
            </button>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Bảng hiển thị danh sách từ CSDL -->
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>Họ và Tên</th>
                            <th>Email</th>
                            <th>Số Điện Thoại</th>
                            <th>Ngày Sinh</th>
                            <th>Giới Tính</th>
                            <th>Địa Chỉ</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT * FROM hoc_vien ORDER BY id DESC");
                        if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>#HV0" . $row["id"] . "</td>
                                        <td class='fw-semibold'>" . $row["ho_ten"] . "</td>
                                        <td>" . $row["email"] . "</td>
                                        <td>" . $row["so_dien_thoai"] . "</td>
                                        <td>" . $row["ngay_sinh"] . "</td>
                                        <td>" . $row["gioi_tinh"] . "</td>
                                        <td>" . $row["dia_chi"] . "</td>
                                        <td>
                                            <a href='delete-student.php?id=" . $row["id"] . "' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Bạn có chắc muốn xóa học viên này?\")'><i class='bi bi-trash'></i></a>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8' class='text-center text-muted py-4'>Chưa có dữ liệu học viên trong cơ sở dữ liệu.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Thêm Học Viên -->
    <div class="modal fade" id="addStudentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Thêm Học Viên Mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Họ và Tên</label>
                            <input type="text" class="form-control" name="ho_ten" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số Điện Thoại</label>
                            <input type="text" class="form-control" name="so_dien_thoai">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ngày Sinh</label>
                            <input type="date" class="form-control" name="ngay_sinh">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giới Tính</label>
                            <select class="form-select" name="gioi_tinh">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Địa Chỉ</label>
                            <textarea class="form-control" name="dia_chi" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_student" class="btn btn-primary w-100">Lưu Học Viên</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>