<?php

namespace Deployer;

require 'recipe/laravel.php';

// Define your servers
host('digital-nest.store')
    ->set('deploy_path', '/path/to/your/project')
    ->set('branch', 'main')
    ->set('identity_file', '~/.ssh/id_rsa'); // Optional: Path to your SSH key

// Define tasks
task('build', function () {
    run('cd {{release_path}} && composer install --no-dev --optimize-autoloader');
    run('cd {{release_path}} && php artisan migrate --force');
    run('cd {{release_path}} && php artisan cache:clear');
    run('cd {{release_path}} && php artisan config:cache');
    run('cd {{release_path}} && php artisan route:cache');
});

// Define the deployment process
desc('Deploy your project');
task('deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:shared',
    'deploy:vendors',
    'deploy:build', // Custom build task
    'deploy:symlink',
    'deploy:cleanup',
]);

// [Optional] If you want to enable rollback functionality
task('rollback', [
    'deploy:rollback',
]);

// [Optional] Enable migrations
before('deploy:symlink', 'build');
