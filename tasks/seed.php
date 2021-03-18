<?php

namespace Deployer;

task('artisan:db:seed', function () {
    run('{{bin/php}} {{current_path}}/artisan db:seed --force');
});
