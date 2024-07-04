<?php
// 处理用户登录
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['usr'];
    $password = $_POST['psw'];

    try {
        // 连接到数据库，检索用户信息
        $pdo = new PDO('sqlite:../../db/usrdb.db');

        // 设置 PDO 错误模式为异常
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $statement = $pdo->prepare("SELECT id, usr, psw FROM users WHERE usr = ?");
        $statement->execute([$username]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // 简单的用户名和密码验证
        if ($user) {
            // 验证密码
            if (password_verify($password, $user['psw'])) {
                // 密码验证成功，设置登录状态
                session_start();
                $_SESSION['user'] = $user['usr'];
                $_SESSION['user_id'] = $user['id'];
                // 跳转
                header('Location: urlviewpre.php');
            } else {
                echo "用户名或密码错误！"; // 不提供具体信息
            }
        } else {
            echo "用户名或密码错误！"; // 不提供具体信息
        }
    } catch (PDOException $e) {
        echo "数据库连接错误: " . $e->getMessage(); // 显示详细错误信息
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<?php
// 输出登录错误（如果有）
if (isset($loginError)) {
    echo "<p>$loginError</p>";
}
?>

</body>
</html>
