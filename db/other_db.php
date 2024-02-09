<?php
$dbFile = 'otherurl.db';
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
    url TEXT NOT NULL,
    name TEXT NOT NULL
)";

// 执行创建表的SQL语句
$db->exec($createTableQuery);
$db->close();
