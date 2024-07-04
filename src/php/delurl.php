<?php
// 处理删除操作
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    if (isset($_POST['selectedRows']) && is_array($_POST['selectedRows'])) {
        $dbPath = 'db/' . $_POST['delete'] . '.db'; // 数据库文件路径

        try {
            // 连接到 SQLite 数据库
            $pdo = new PDO('sqlite:' . $dbPath);
        
            // 设置 PDO 错误模式为异常
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // 删除选定的行
            foreach ($_POST['selectedRows'] as $selectedId) {
                $deleteQuery = "DELETE FROM users WHERE id = :id";
                $deleteStatement = $pdo->prepare($deleteQuery);

                if (!$deleteStatement) {
                    throw new Exception("无法准备删除语句");
                }

                $deleteStatement->bindValue(':id', $selectedId, PDO::PARAM_INT); // 使用 PDO 的常量
                $deleteResult = $deleteStatement->execute();

                if (!$deleteResult) {
                    throw new Exception("执行删除语句失败");
                }
                
            }
            echo "删除成功！";
        } catch (PDOException $e) {
            echo "错误: " . $e->getMessage();
        } finally {
            //关闭连接
             $pdo = null;
        }
    }
}
?>
