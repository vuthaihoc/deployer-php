<?php

$tasks_dir = __DIR__ . "/tasks/";
$domains_dir = __DIR__ . "/domains/";

function base_dir($path = ''){
    return __DIR__ . "/" . ltrim($path, "/");
}

$task_files = glob($tasks_dir . "*.php");
foreach ($task_files as $task_file){
    include_once $task_file;
}
$server_files = glob($domains_dir . "*/servers.php");
foreach ($server_files as $server_file){
    include_once $server_file;
}