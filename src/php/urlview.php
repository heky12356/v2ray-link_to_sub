<?php
// 启动会话
session_start();
global $db;
// 检查用户是否已经登录
$isLoggedIn = isset($_SESSION['user']) && $_SESSION['user'] === 'admin';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['urlview'])) {
    $db = $_POST['db'];
}

// SQLite数据库文件路径
$dbFile = '../../db/' . $db . '.db';

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
    <title>urlview</title>
</head>
<body>

<form action="delurl.php" method="post">
    <table border="1">
	<?php
    
	if ($isLoggedIn) {
		echo "<tr><th>Select</th><th>ID</th><th>url</th></tr>";
	} else {
		echo"<tr><th>ID</th><th>url</th></tr>";
	}
        


    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    // 输出每行的数据
    echo '<tr>';
    
    // 如果用户已经登录并且是管理员，显示复选框列
    if ($isLoggedIn) {
        echo '<td><input type="checkbox" name="selectedRows[]" value="' . $row['id'] . '"></td>';
    }

    // 共同显示的列
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['url'] . '</td>';

    // 如果用户已经登录并且是管理员，可能还有其他需要显示的列

    echo '</tr>';
}
        ?>

    </table>

    <?php 
    global $db;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['urlview'])) {
        $db = $_POST['db'];
    }
	if ($isLoggedIn) {
		echo '<br><button type="submit" name="delete" value="' . $db . '">删除</button>';
	}
	?>
</form>

<button onclick="redirectToPage1()">返回</button>
<script>
    function redirectToPage1() {
        // 使用相对路径进行页面跳转
        window.location.href = 'index.html';
    }
</script>
<button onclick="redirectToPage2()">登录</button>
<script>
    function redirectToPage2() {
        // 使用相对路径进行页面跳转
        window.location.href = 'login.html';
    }
</script>
</body>
</html>
