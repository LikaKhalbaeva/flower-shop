<?php
session_start();
$email = trim($_POST['email'] ?? '');
$base = (strpos($_SERVER['HTTP_REFERER'] ?? '', '/pages/') !== false) ? '../' : '';

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['subscribed'] = true;
}

$referer = $_SERVER['HTTP_REFERER'] ?? ($base . 'index.php');
header('Location: ' . $referer . (strpos($referer, '?') !== false ? '&' : '?') . 'subscribed=1');
exit;
