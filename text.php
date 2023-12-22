<?php
// 启动会话
session_start();

// 获取会话数据
$user = $_SESSION['user'];

// 输出用户数据
echo "Welcome, $user!";
?>
