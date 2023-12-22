<?php
// 检查是否通过 POST 方法提交数据
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 使用 $_POST 获取表单数据
    $usr = $_POST["usr"];
    $psw = $_POST["psw"];
    $hashedusr = password_hash($usr, PASSWORD_DEFAULT);
    $hashedpsw = password_hash($psw, PASSWORD_DEFAULT);

    // 保存到数据库
    try {
        // 连接到 SQLite 数据库（SQLite 数据库文件路径）
        $pdo = new PDO('sqlite:db/usrdb.db');

        // 设置 PDO 错误模式为异常
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 使用预处理语句
        $stmt = $pdo->prepare("INSERT INTO users (usr, psw) VALUES (?, ?)");

        // 绑定参数
        $stmt->bindParam(1, $hashedusr);
        $stmt->bindParam(2, $hashedpsw);

        // 执行预处理语句
        $stmt->execute();

        echo "数据插入成功！";
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 19) {
            echo "用户名已存在，请选择其他用户名。";
        } else {
            echo "数据插入失败，请稍后再试。";
            // 在开发环境中可以输出详细的错误信息
            // echo "错误: " . $e->getMessage();
        }
    }

    // 关闭数据库连接
    $pdo = null;
} else {
    // 如果不是通过 POST 方法提交的数据，进行适当的处理
    echo "请通过表单提交数据";
}
?>
