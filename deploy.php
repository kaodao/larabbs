<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'my_project');

// Project repository
set('repository', 'git@gitee.com:kaodao/larabbs.git');

// [Optional] Allocate tty for git clone. Default value is false.1 test
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', [storage,bootstrap/cache]);


// Hosts

host('139.196.213.134')
 ->user('deployer') // 这里填写 deployer
      // 并指定公钥的位置
    ->identityFile('~/.ssh/deployerkey')
    ->set('deploy_path', '/data/wwwroot/Laravel');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

