<?php
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
        $query = "SELECT * FROM users";
        $result = $db->query($query);
    
        if (!$result) {
            throw new Exception("查询数据库失败");
        }
    } catch (Exception $e) {
        // 处理异常，例如输出错误信息
        echo "出现错误：" . $e->getMessage();
        exit();
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>osubpre</title>
</head>
<body>
    <p>选择订阅</P>
    <form action="" method="post" >
    <select name="ourl">
    <?php        
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<option value=\"" . htmlspecialchars($row['name']) . "\">" . $row['name'] . "</option>";
    }
    ?>
    </select>
    <button type="submit" name = "osub" >提交</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['ourl'];
    // 获取当前请求的 URI
    $currentUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] ;
    $rurl = $currentUrl . "/osub.php?ourl=$name&osub=";
    echo "<a href = '$rurl'>订阅链接：$rurl</a>";
    }
    ?>
</body>
</html>
