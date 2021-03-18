<?php

namespace Deployer;

desc('Execute artisan migrate for all host');
task('artisan:migrate:all', function () {
    run('{{bin/php}} {{release_path}}/artisan migrate --force');
});