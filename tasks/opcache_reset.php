<?php
/**
 * Created by PhpStorm.
 * User: hocvt
 * Date: 2020-06-03
 * Time: 14:24
 */


namespace Deployer;


task( 'opcache:reset', function(){
    $releases_list = get('releases_list');
    $web_url = get('web_url');

    // upload
    $deploy_public_path = get('deploy_path') . "/releases/" . $releases_list[0] . "/public";
    $current_public_path = get('deploy_path') . "/releases/" . (isset($releases_list[1]) ? $releases_list[1] : $releases_list[0]) . "/public";
    upload( __DIR__ . "/../other/cache_control.php" , $deploy_public_path . "/cache_control.php");
    if($deploy_public_path != $current_public_path) {
        upload(__DIR__ . "/../other/cache_control.php", $current_public_path . "/cache_control.php");
    }

    // run
    preg_match( "/https?:\/\/([^\/]+)/", $web_url, $matches);
    if(has( 'web_ip')){
        if(get('web_ip')){
            $output = exec( "curl -k --resolve " . $matches[1] . ":443:". get('web_ip') . " " . $web_url . "/cache_control.php?action=reset");
        }else{
            $output = exec( "curl -k " . $web_url . "/cache_control.php?action=reset");
        }
    }else{
        $output = file_get_contents( $web_url . "/cache_control.php?action=reset");
    }

    // remove
    run( "rm \"" . $deploy_public_path . "/cache_control.php\" || true");
    if($deploy_public_path != $current_public_path){
        run( "rm \"" . $current_public_path . "/cache_control.php\" || true");
    }

    writeln( $output );

});

task( 'opcache:status', function(){

    $releases_list = get('releases_list');
    $web_url = get('web_url');

    // upload
    $deploy_public_path = get('deploy_path') . "/releases/" . $releases_list[0] . "/public";
    $current_public_path = get('deploy_path') . "/releases/" . (isset($releases_list[1]) ? $releases_list[1] : $releases_list[0]) . "/public";
    upload( __DIR__ . "/../other/cache_control.php" , $deploy_public_path . "/cache_control.php");
    if($deploy_public_path != $current_public_path) {
        upload(__DIR__ . "/../other/cache_control.php", $current_public_path . "/cache_control.php");
    }

    // run
    preg_match( "/https?:\/\/([^\/]+)/", $web_url, $matches);
    if(has( 'web_ip')){
        if(get('web_ip')){
            $output = exec( "curl -k --resolve " . $matches[1] . ":443:". get('web_ip') . " " . $web_url . "/cache_control.php?action=reset");
        }else{
            $output = exec( "curl -k " . $web_url . "/cache_control.php?action=status");
        }
    }else{
        $output = file_get_contents( $web_url . "/cache_control.php?action=status");
    }

    // remove
    run( "rm \"" . $deploy_public_path . "/cache_control.php\" || true");
    if($deploy_public_path != $current_public_path){
        run( "rm \"" . $current_public_path . "/cache_control.php\" || true");
    }

    writeln( $output );
});