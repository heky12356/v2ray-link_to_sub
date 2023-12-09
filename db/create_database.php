<?php
// 检查是否通过 POST 方法提交数据
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 使用 $_POST 获取表单数据
    $dbname = $_POST["dbname"];
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

// 执行创建表的SQL语句
$db->exec($createTableQuery);
    echo $dbname . ".db 创建成功";

    // 关闭数据库连接
    $db->close();
} else {
    // 如果不是通过 POST 方法提交的数据，进行适当的处理
    echo "请通过表单提交数据";
}
