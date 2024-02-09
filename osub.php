<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $name = $_GET['ourl'];
    
    $db = 'otherurl';
    // SQLite数据库文件路径
    $dbFile = 'db/' . $db . '.db';

    try {
        // 尝试连接到数据库，如果不存在则创建
        $db = new SQLite3($dbFile);

        if (!$db) {
            throw new Exception("无法连接到数据库");
        }

        // 查询数据库以获取数据
        $query = "SELECT url FROM users WHERE name = :name";
        // 准备查询并绑定参数
        $stmt = $db->prepare($query);
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        // 执行查询
        $result = $stmt->execute();
        // 检查是否有结果
        if ($result) {
            // 获取结果
            $row = $result->fetchArray(SQLITE3_ASSOC);
            if ($row) {
                // 获取查询到的url
                $url = $row['url'];
                header('Location: ' . $url);
            } else {
                echo "未找到与名称 '$name' 相关联的 URL";
            }
        } else {
            echo "查询出错: " . $db->lastErrorMsg();
        }

    } catch (Exception $e) {
        // 处理异常，例如输出错误信息
        echo "出现错误：" . $e->getMessage();
        exit();
    }
}
