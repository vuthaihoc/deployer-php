<?php

namespace Deployer;

desc('Execute artisan asset-cdn:push');
task('artisan:asset-cdn:push', function () {
    run('{{bin/php}} {{current_path}}/artisan asset-cdn:push');
})->onRoles('web');

desc('Enable asset cdn');
task('artisan:asset-cdn:enable', function () {
    run('{{bin/php}} {{current_path}}/artisan asset-cdn:push_new',['tty' => true, 'timeout' => null]);
    run('{{bin/php}} {{current_path}}/artisan asset-cdn:ctl enable --without-push');
    run('{{bin/php}} {{current_path}}/artisan opcache:clear');
})->onRoles('web');

desc('Disable asset cdn');
task('artisan:asset-cdn:disable', function () {
    run('{{bin/php}} {{current_path}}/artisan asset-cdn:ctl disable --without-push');
    run('{{bin/php}} {{current_path}}/artisan opcache:clear');
})->onRoles('web');
