<?php
// SQLite数据库文件路径
$dbFile = 'db/wky.db';

// 尝试连接到数据库，如果不存在则创建
$db = new SQLite3($dbFile);

// 查询数据库以获取数据
$query = "SELECT * FROM users";
$result = $db->query($query);

// 提取多行数据
$rows = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $allurls .= $row['url'] . "\n";
}

// 关闭数据库连接
$db->close();

// 使用base64_encode函数进行编码
$base64 = base64_encode($allurls);

// 打印编码后的结果
echo $base64;
?>