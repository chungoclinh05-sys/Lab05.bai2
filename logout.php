<?php
require_once __DIR__ . '/includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST'
    || !csrf_verify($_POST['csrf'] ?? null)) {
    exit('Bad Request');
}

session_destroy();
header('Location: login.php');
exit;
