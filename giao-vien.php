<?php
include 'connect.php';

// Thêm giáo viên mới
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_teacher'])) {
    $ten = $_POST['name'];
    $email = $_POST['email'];
    $sdt = $_POST['phone'];
    $chuyen_mon = $_POST['specialty'];

    $sql = "INSERT INTO giao_vien (ho_ten, email, so_dien_thoai, chuyen_mon) VALUES ('$ten', '$email', '$sdt', '$chuyen_mon')";
    $conn->query($sql);
    header("Location: giao-vien.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Giáo Viên - Admin VAA English</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-info" href="#"><i class="bi bi-shield-lock-fill me-2"></i>VAA ADMIN (MySQL)</a>
            <div class="d-flex text-white align-items-center">
                <span class="me-3 small">Xin chào, Admin</span>
                <a href="login.html" class="btn btn-outline-light btn-sm">Đăng xuất</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse shadow-sm min-vh-100 p-3">
                <ul class="nav flex-column gap-1">
                    <li class="nav-item"><a class="nav-link text-dark" href="index.html"><i class="bi bi-speedometer2 me-2"></i> Tổng Quan</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="hoc-vien.php"><i class="bi bi-people me-2"></i> Quản Lý Học Viên</a></li>
                    <li class="nav-item"><a class="nav-link active bg-primary text-white rounded" href="giao-vien.php"><i class="bi bi-person-badge me-2"></i> Quản Lý Giáo Viên</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="lop-hoc.php"><i class="bi bi-journal-bookmark me-2"></i> Quản Lý Lớp Học</a></li>
                </ul>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">Quản Lý Danh Sách Giáo Viên</h2>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addTeacherModal">
                        <i class="bi bi-plus-lg me-1"></i> Thêm Giáo Viên
                    </button>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#ID</th>
                                    <th>Họ và Tên</th>
                                    <th>Email</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Chuyên Môn</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $conn->query("SELECT * FROM giao_vien");
                                if ($result && $result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                                <td>#GV0" . $row["id"] . "</td>
                                                <td class='fw-semibold'>" . $row["ho_ten"] . "</td>
                                                <td>" . $row["email"] . "</td>
                                                <td>" . $row["so_dien_thoai"] . "</td>
                                                <td><span class='badge bg-info-subtle text-info-emphasis'>" . $row["chuyen_mon"] . "</span></td>
                                                <td>
                                                    <a href='delete-teacher.php?id=" . $row["id"] . "' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Xóa giáo viên này?\")'><i class='bi bi-trash'></i></a>
                                                </td>
                                              </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center text-muted'>Chưa có dữ liệu giáo viên (hoặc bảng chưa có cột tương ứng).</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Thêm Giáo Viên -->
    <div class="modal fade" id="addTeacherModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Thêm Giáo Viên Mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Họ và Tên</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số Điện Thoại</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Chuyên Môn</label>
                            <input type="text" class="form-control" name="specialty" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_teacher" class="btn btn-primary w-100">Lưu Giáo Viên</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>