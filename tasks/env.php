<?php

namespace Deployer;

// Upload env/config file
task('upload_env', function(){
    upload(base_dir('domains/{{domain}}/.env'), '{{release_path}}/.env');
});

task('update_env', function(){
    upload(base_dir('domains/{{domain}}/.env'), '{{current_path}}/.env');
    $output = run('{{bin/php}} {{current_path}}/artisan config:cache');
    writeln('<info>' . $output . '</info>');
});
after('update_env', 'opcache:reset');

task('upload_settings', function (){
    upload(base_dir('domains/{{domain}}/.env'), '{{release_path}}/.env');
    $domain = get('domain');
    $up_dir = base_dir('domains/' . $domain . '/disks');
    upload($up_dir,  '{{release_path}}/disks/', [
        'options' => [
            "--include='*.php'",
            "--exclude='*'",
        ]
    ]);
});
task('update_settings', function (){
    upload(base_dir('domains/{{domain}}/.env'), '{{current_path}}/.env');
    $domain = get('domain');
    $up_dir = base_dir('domains/' . $domain . '/disks');
    upload($up_dir,  '{{current_path}}/disks/', [
        'options' => [
            "--include='*.php'",
            "--exclude='*'",
        ]
    ]);
    $output = run('{{bin/php}} {{current_path}}/artisan config:cache');
    writeln('<info>' . $output . '</info>');
});
after('update_settings', 'opcache:reset');