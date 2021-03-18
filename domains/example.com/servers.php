<?php

namespace Deployer;

$domain = 'example.com';
$ip = '1.2.3.4';
$deploy_path = '/var/www/' . $domain;

host(...[$domain])->hostname($ip)->stage( $ip )->set('domain', $domain)->roles([$domain])
    ->user('ssh_storage')
    ->set( 'repository', 'git@gitlab.com:example/web' )
    ->set('branch', 'deploy')
    ->set('deploy_path', $deploy_path)
    ->set('web_url', 'https://' . $domain)
    ->set('web_ip', $ip)
    ->set('http_user', 'nginx');