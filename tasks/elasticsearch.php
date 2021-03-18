<?php

namespace Deployer;

task('artisan:elastic:migrate:all', function () {
    run('{{bin/php}} {{release_path}}/artisan elastic:migrate --force');
//    run('{{bin/php}} {{release_path}}/artisan scout:import "App\Models\Document"');
//    run('{{bin/php}} {{release_path}}/artisan scout:import "App\Models\Tag"');
});

task('artisan:elastic:migrate', function () {
    run('{{bin/php}} {{release_path}}/artisan elastic:migrate --force');
//    run('{{bin/php}} {{release_path}}/artisan scout:import "App\Models\Document"');
//    run('{{bin/php}} {{release_path}}/artisan scout:import "App\Models\Tag"');
})->once();

task('elastic:migrate', function () {
    run('{{bin/php}} {{current_path}}/artisan elastic:migrate --force');
//    run('{{bin/php}} {{current_path}}/artisan scout:import "App\Models\Document"');
//    run('{{bin/php}} {{current_path}}/artisan scout:import "App\Models\Tag"');
});

//task('artisan:elastic:import', function () {
//    run('cd {{current_path}} && git pull');
//
//    run('{{bin/php}} {{current_path}}/artisan scout:import "App\Models\Tag"');
//});

task('elastic:refresh', function(){
    run('cd {{current_path}} && php artisan elastic:migrate:refresh --force && php artisan scout:import App\\\\Models\\\\Tag && php artisan scout:import App\\\\Models\\\\Document',
        ['tty' => true, 'timeout' => null]);
});
task('scout:import', function(){
    run('cd {{current_path}} && php artisan scout:import App\\\\Models\\\\Document',
        ['tty' => true, 'timeout' => null]);
});
