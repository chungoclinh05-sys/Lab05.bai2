<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';
require_login();

$s = current_student();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-body">

      <h4 class="mb-4">👤 Hồ sơ sinh viên</h4>

      <p><b>Mã SV:</b> <?=htmlspecialchars($s['student_code'])?></p>
      <p><b>Họ tên:</b> <?=htmlspecialchars($s['full_name'])?></p>
      <p><b>Lớp:</b> <?=htmlspecialchars($s['class_name'])?></p>
      <p><b>Email:</b> <?=htmlspecialchars($s['email'])?></p>

      <div class="mt-4">
        <a class="btn btn-outline-primary btn-sm" href="grades.php">📊 Xem điểm</a>
        <a class="btn btn-outline-success btn-sm" href="courses.php">📝 Đăng ký học phần</a>
        <a class="btn btn-outline-secondary btn-sm" href="registrations.php">📚 Học phần đã đăng ký</a>
      </div>

      <form method="post" action="../logout.php" class="mt-3">
        <input type="hidden" name="csrf" value="<?=csrf_token()?>">
        <button class="btn btn-danger btn-sm">Logout</button>
      </form>

    </div>
  </div>
</div>
</body>
</html>
