<?php

namespace Deployer;

task('artisan:opcache:clear', function () {
    run('{{bin/php}} {{current_path}}/artisan opcache:clear');
});
