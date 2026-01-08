<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/data.php';
require_login();

$courses = read_json('courses.json', []);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Đăng ký học phần</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-body">

      <h4 class="mb-4">📘 Danh sách học phần</h4>

      <?php if (empty($courses)): ?>
        <div class="alert alert-info">Chưa có học phần.</div>
      <?php else: ?>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Mã HP</th>
              <th>Tên học phần</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($courses as $c): ?>
            <tr>
              <td><?=htmlspecialchars($c['course_code'])?></td>
              <td><?=htmlspecialchars($c['course_name'])?></td>
              <td>
                <form method="post" action="register.php">
                  <input type="hidden" name="course_code" value="<?=htmlspecialchars($c['course_code'])?>">
                  <button class="btn btn-success btn-sm">Đăng ký</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>

      <a href="profile.php" class="btn btn-link">← Quay lại</a>

    </div>
  </div>
</div>
</body>
</html>
