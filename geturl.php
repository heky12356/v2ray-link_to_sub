<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['urlview'])) {
    $db = $_POST['db'];
    echo $db;
}
