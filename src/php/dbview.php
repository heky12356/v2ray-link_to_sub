<?php
// 指定要查看的目录
$directory = 'db/';

// 使用 scandir 获取目录中的文件列表
$files = scandir($directory);

// 输出文件列表
echo "文件列表：<br>";
foreach ($files as $file) {
    if ($file != "." && $file != "..") {
        if ($file == "create_database.php" or $file == "usr_db.php"){
            continue;
        }

        // 获取文件名的长度
        $length = strlen($file);
    
        // 截取除了最后三个字符之外的部分
        $substring = substr($file, 0, $length - 3);
    
        echo $substring . "<br>";

    }
}
?>
