<?php
require_once __DIR__ . '/includes/data.php';
session_start();

$students = read_json('students.json', []);
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = strtoupper(trim($_POST['student_code'] ?? ''));
    $pass = trim($_POST['password'] ?? '');


    foreach ($students as $s) {
        if (
            strtoupper(trim($s['student_code'])) === $code &&
            password_verify($pass, $s['password_hash'])
        ) {
            $_SESSION['auth'] = true;
            $_SESSION['student'] = $s;
            header('Location: student/profile.php');
            exit;
        }
    }
    $error = 'Sai mã SV hoặc mật khẩu';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Student Login</title>
<style>
body{background:#f5f6f7;font-family:Arial}
.box{width:360px;margin:80px auto;background:#fff;padding:25px;border-radius:8px}
input,button{width:100%;padding:10px;margin:8px 0}
button{background:#1877f2;color:#fff;border:none}
.error{color:red}
</style>
</head>
<body>
<div class="box">
<h3>Đăng nhập sinh viên</h3>
<?php if($error): ?><div class="error"><?=htmlspecialchars($error)?></div><?php endif; ?>
<form method="post">
<input name="student_code" placeholder="Mã sinh viên">
<input type="password" name="password" placeholder="Mật khẩu">
<button>Đăng nhập</button>
</form>
</div>
</body>
</html>
