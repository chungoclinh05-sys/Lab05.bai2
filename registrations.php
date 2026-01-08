<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/data.php';
require_login();

$student = current_student();
$code = $student['student_code'];

$enrollments = read_json('enrollments.json', []);
$courses = read_json('courses.json', []);

$courseMap = [];
foreach ($courses as $c) {
    $courseMap[$c['course_code']] = $c['course_name'];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Học phần đã đăng ký</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-body">

      <h4 class="mb-4">📚 Học phần đã đăng ký</h4>

      <table class="table table-bordered align-middle">
<thead class="table-primary">
<tr>
  <th>#</th>
  <th>Tên học phần</th>
  <th>Thao tác</th>
</tr>
</thead>
<tbody>
<?php
$i = 1;
$found = false;
foreach ($enrollments as $e):
    if ($e['student_code'] === $code):
        $found = true;
?>
<tr>
  <td><?=$i++?></td>
  <td><?=htmlspecialchars($courseMap[$e['course_code']] ?? $e['course_code'])?></td>
  <td>
    <form method="post" action="unregister.php"
          onsubmit="return confirm('Bạn chắc chắn muốn hủy học phần này?')"
          class="d-inline">
      <input type="hidden" name="course_code" value="<?=$e['course_code']?>">
      <button class="btn btn-sm btn-danger">Hủy</button>
    </form>
  </td>
</tr>
<?php
    endif;
endforeach;
?>

<?php if (!$found): ?>
<tr>
  <td colspan="3" class="text-center text-muted">
    Chưa đăng ký học phần nào
  </td>
</tr>
<?php endif; ?>
</tbody>
</table>


      <a href="profile.php" class="btn btn-link">← Quay lại</a>

    </div>
  </div>
</div>
</body>
</html>
