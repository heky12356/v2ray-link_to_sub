<?php
// SQLite数据库文件路径
$dbFile = 'db/wky.db';

// 尝试连接到数据库，如果不存在则创建
$db = new SQLite3($dbFile);

// 查询数据库以获取数据
$query = "SELECT * FROM users";
$result = $db->query($query);
while ($row = $result->fetchArray(SQLITE3_NUM)) {
    // 将索引数组转换为字符串
    $rowString = implode(', ', $row);
    
    // 输出字符串
    echo  $rowString . "<br>";
}
// 关闭数据库连接
$db->close();
?>