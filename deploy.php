<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com-phucnguyen:Phucnguyen113/bookingroom.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('10.10.1.39')
    ->set('remote_user', 'nguyen.trong.phuc')
    ->set('deploy_path', '~/bookingroom');
    // ->set('identity_file', '~/keyGit/scp-dev');

// Hooks

after('deploy:failed', 'deploy:unlock');
