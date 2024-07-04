<?php
// 检查是否通过 POST 方法提交数据
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 使用 $_POST 获取表单数据并进行清理
    $dbname = trim($_POST["dbname"]);
    
    if (empty($dbname)) {
        die("数据库名称不能为空");
    }

    // 检查数据库名称是否合法（例如，只允许字母、数字和下划线）
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $dbname)) {
        die("数据库名称不合法");
    }

    $dbFile = $dbname . ".db";

    // 尝试连接到数据库，如果不存在则创建
    $db = new SQLite3($dbFile);

    // 检查连接是否成功
    if (!$db) {
        die("连接失败: " . $db->lastErrorMsg());
    }

    // 创建表的SQL语句
    $createTableQuery = "
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        url TEXT NOT NULL
    )";

    // 执行创建表的SQL语句并检查是否成功
    if ($db->exec($createTableQuery)) {
        echo $dbname . ".db 创建成功";
    } else {
        echo "创建表失败: " . $db->lastErrorMsg();
    }

    // 关闭数据库连接
    $db->close();
} else {
    // 如果不是通过 POST 方法提交的数据，进行适当的处理
    echo "请通过表单提交数据";
}
?>
