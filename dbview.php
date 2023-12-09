<?php
// 指定要查看的目录
$directory = 'db/';

// 使用 scandir 获取目录中的文件列表
$files = scandir($directory);

// 输出文件列表
echo "文件列表：<br>";
foreach ($files as $file) {
    if ($file != "." && $file != "..") {
        echo $file . "<br>";
    }
}
?>