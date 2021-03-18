<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'my_project');

// Project repository
set('repository', 'git@gitlab.com:colombo-group/gldoc-main.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
//add('shared_files', []);
//add('shared_dirs', []);

set('shared_files', [

]);

set( 'writable_mode', 'chmod' );
set( 'writable_chmod_recursive', false );
set( 'writable_chmod_mode', '0777' );
set( 'allow_anonymous_stats', false );

// Writable dirs by web server 
add('writable_dirs', [
    'storage/tmp'
]);
set('allow_anonymous_stats', false);

// Hosts

include __DIR__ . "/autoload.php";
    
// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'upload_settings',
    'deploy:vendors',
    'deploy:writable',
    'artisan:storage:link',
    'artisan:config:cache',
    'artisan:route:cache',
    'artisan:view:clear',
    'artisan:optimize',
    'artisan:migrate:all',
    'artisan:elastic:migrate:all',
    'deploy:symlink',
    'deploy:unlock',
    'opcache:reset',
    'cleanup',
    'artisan:asset-cdn:enable',
]);

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');


