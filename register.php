<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/data.php';
require_login();

$code = current_student()['student_code'];
$course = $_POST['course_code'];

$en = read_json('enrollments.json');
foreach($en as $e){
    if($e['student_code']===$code && $e['course_code']===$course){
        header('Location: courses.php'); exit;
    }
}
$en[]=['student_code'=>$code,'course_code'=>$course];
write_json('enrollments.json',$en);
header('Location: registrations.php');
