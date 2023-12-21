<?php
// SQLite数据库文件路径
$dbFile = 'db/wky.db';

try {
    // 尝试连接到数据库，如果不存在则创建
    $db = new SQLite3($dbFile);

    // 查询数据库以获取数据
    $query = "SELECT * FROM users";
    $result = $db->query($query);

    // 输出表格开始标签和表头
    echo '<form action="" method="post">';
    echo '<table border="1">';
    echo '<tr><th>Select</th><th>ID</th><th>Name</th><th>Email</th></tr>';

    // 循环处理所有行数据
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        // 输出每行的数据以及复选框
        echo '<tr>';
        echo '<td><input type="checkbox" name="selectedRows[]" value="' . $row['id'] . '"></td>';
        echo '<td>' . $row['url'] . '</td>';
        echo '</tr>';
    }

    // 输出表格结束标签
    echo '</table>';

    // 添加删除按钮
    echo '<br><input type="submit" name="delete" value="Delete Selected Rows">';
    echo '</form>';

    // 处理删除操作
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
        if (isset($_POST['selectedRows']) && is_array($_POST['selectedRows'])) {
            // 删除选定的行
            foreach ($_POST['selectedRows'] as $selectedId) {
                $deleteQuery = "DELETE FROM users WHERE id = :id";
                $deleteStatement = $db->prepare($deleteQuery);
                $deleteStatement->bindValue(':id', $selectedId, SQLITE3_INTEGER);
                $deleteStatement->execute();
            }

            // 重新加载页面以显示更新后的数据
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    // 关闭数据库连接
    $db->close();
} catch (Exception $e) {
    // 处理异常，例如输出错误信息
    echo "出现错误：" . $e->getMessage();
}
?>
