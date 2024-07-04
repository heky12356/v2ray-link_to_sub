<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>urlview</title>
</head>
<body>
<p>选择数据库</P>
    <form action="urlview.php" method="post" >
        <select name="db">
            <?php
            // 指定要查看的目录
            $directory = '../../db/';

            // 使用 scandir 获取目录中的文件列表
            $files = scandir($directory);

            // 输出选项 <option value="option1">Option 1</option>
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    if ($file == "create_database.php" || $file == "usr_db.php" || $file == "usrdb.db") {
                        continue;
                    }

                    // 获取文件名的长度
                    $length = strlen($file);

                    // 截取除了最后三个字符之外的部分
                    $substring = substr($file, 0, $length - 3);

                    echo "<option value=\"" . htmlspecialchars($substring) . "\">" . $substring . "</option>";
                }
            }
            ?>
        </select>
        <input type="submit" name = "urlview" value="提交">
    </form>
</body>
</html>
