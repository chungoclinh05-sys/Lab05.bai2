<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/data.php';
require_login();

$code = current_student()['student_code'];
$grades = read_json('grades.json');
$courses = read_json('courses.json');

$map=[];
foreach($courses as $c) $map[$c['course_code']]=$c['course_name'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Bảng điểm</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-body">

      <h4 class="mb-4">📊 Bảng điểm</h4>

      <table class="table table-bordered table-striped align-middle">
        <thead class="table-primary">
          <tr>
            <th>#</th>
            <th>Môn học</th>
            <th>Giữa kỳ</th>
            <th>Cuối kỳ</th>
            <th>Tổng</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        $found = false;
        foreach ($grades as $g):
            if ($g['student_code'] === $code):
                $found = true;
        ?>
          <tr>
            <td><?=$i++?></td>
            <td><?=htmlspecialchars($map[$g['course_code']] ?? $g['course_code'])?></td>
            <td><?=$g['midterm']?></td>
            <td><?=$g['final']?></td>
            <td class="fw-bold
                <?=($g['total'] < 5 ? 'text-danger' : 'text-success')?>">
                <?=$g['total']?>
            </td>
          </tr>
        <?php
            endif;
        endforeach;
        ?>
        <?php if (!$found): ?>
          <tr>
            <td colspan="5" class="text-center text-muted">
              Chưa có dữ liệu điểm
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
