<?php
$action = $_GET['action'];

function show_status(array $status)
{
    foreach ($status as $k => $v){
        if(is_array($v)){
            foreach ($v as $vk => $vv){
                echo $k . "." . $vk . " = " . $vv . "\n";
            }
        }else{
            echo $k . " = " . $v . "\n";
        }
    }
}

switch ($action){
    case "status":
        $status = opcache_get_status(false);
        show_status($status);
        break;
    case "reset":
        opcache_reset();
        $status = opcache_get_status(false);
        show_status($status);
        break;
}