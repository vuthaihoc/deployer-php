<?php

namespace Deployer;

task('git:pull', function () {
    run('cd {{current_path}}; git pull', ['tty' => true, 'timeout' => null]);
});
task('git:pull_only', function () {
    run('cd {{current_path}}; git pull', ['tty' => true, 'timeout' => null]);
});

task('git:pull:full', [
    'git:pull_only',
    'artisan:route:cache',
    'artisan:asset-cdn:enable',
    'opcache:reset',
]);

after('git:pull', 'opcache:reset');