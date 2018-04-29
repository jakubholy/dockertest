#!/usr/bin/php
<?php
echo "sleeping...\n";
sleep(10);

$rootpw = getenv('ROOT_PASSWORD');
$dbname = getenv('DB_NAME');
$dbuser = getenv('DB_USER');
$dbpass = getenv('DB_PASSWORD');


$commands = [];
$commands[] = ['c' => "CREATE DATABASE IF NOT EXISTS %s ", 'a' => [$dbname], 't' => 's'];
$commands[] = ['c' => "CREATE USER IF NOT EXISTS '%s'@'%%' IDENTIFIED BY '%s'", 'a' => [$dbuser, $dbpass], 't' => 'ss'];
$commands[] = ['c' => "USE %s ", 'a' => [$dbname], 't' => 's'];
$commands[] = ['c' => "GRANT ALL PRIVILEGES ON %s TO '%s'@'%%' ", 'a' => [$dbname, $dbuser], 't' => 'ss'];

$connection = new mysqli('mariadb', 'root', $rootpw);

foreach ($commands as $command) {
	$res = $connection->query(sprintf($command['c'], ...$command['a']));
	var_dump($connection->error);
}



