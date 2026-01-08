<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/data.php';
require_login();

$student = current_student();
$code = $student['student_code'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Bad request');
}

$courseCode = $_POST['course_code'] ?? '';

$enrollments = read_json('enrollments.json', []);

$new = [];
foreach ($enrollments as $e) {
    if (!($e['student_code'] === $code && $e['course_code'] === $courseCode)) {
        $new[] = $e;
    }
}

write_json('enrollments.json', $new);

header('Location: registrations.php');
exit;
