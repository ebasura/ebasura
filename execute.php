<?php
include_once 'init.php';
use phpseclib3\File\ANSI;
use phpseclib3\Net\SSH2;

$ansi = new ANSI;
$ssh = new SSH2("192.168.0.125");

$ssh = new SSH2("192.168.0.125");
$ssh->login("bitress", "@bitress123");
$ssh->enablePTY();
$ssh->exec('source /var/www/ebasura/system/.venv/bin/activate && cd /var/www/ebasura/system/ && python main.py');

// Set timeout for reading logs
$ssh->setTimeout(5);

$output = $ssh->read();
    $ansi->appendString($output);
    echo $ansi->getScreen();  // Output the log progressively

