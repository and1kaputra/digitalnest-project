<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('application', 'digitalnest');
set('repository', 'https://github.com/and1kaputra/digitalnest-project.git');
add('shared_files', []);
add('shared_files', ['.env']);
add('shared_dirs', ['storage']);

// Writable dirs by web server
add('writable_dirs', []);




// Hosts

// HARUS DIGANTI SESUAI KEBUTUHAN ANDA

host('production') // Nama remote host server ssh anda | contoh host('NAMA_REMOTE_HOST')
->setHostname('103.157.26.56')
->set('forward_agent', false) // Hostname atau IP address server anda | contoh  ->setHostname('10.10.10.1')
->set('remote_user', 'root') // SSH user server anda | contoh ->set('remote_user', 'u1234567')
->set('port', 22) // SSH port server anda, untuk kasus ini server yang saya gunakan menggunakan port custom | contoh ->set('remote_user', 65002)
->set('branch', 'main') // Git branch anda
->set('deploy_path', '/var/www/{{application}}');

 // Lokasi untuk menyimpan projek laravel pada server | contoh ->set('deploy_path', '~/public_html/api-deploy');
// Hosts




// Hooks

task('deploy:secrets', function () {
    file_put_contents(__DIR__ . '/.env', getenv('DOT_ENV'));
    upload('.env', get('deploy_path') . '/shared');
});

desc('Build assets');

task('build', function () {
    cd('{{release_path}}');
    run('npm install');
    run('npm run prod');
});


task('database:import', function () {
    $host = 'db'; // Hostname dari container Docker untuk database
    $user = 'root'; // Username database
    $password = 'kadek'; // Password database
    $database = 'digitalnesttest'; // Nama database
    $dumpPath = './database.sql'; // Path ke file dump SQL Anda

    run("mysql -h $host -u $user -p$password $database < $dumpPath");
})->desc('Import database');

after('deploy:symlink', 'database:import');


after('deploy:failed', 'deploy:unlock');
