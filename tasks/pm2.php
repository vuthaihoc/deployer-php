<?php

namespace Deployer;

task('pm2:upload', function(){
    $domain = get('domain');
    $files = glob( base_dir('domains/' . $domain . '/') . "/*.yml");
    foreach ($files as $file){
        $file_name = basename( $file);
        upload($file, '{{deploy_path}}/' . $file_name);
    }
});