<?php

define('VERBOSE', 1);

require 'Library/Autoloader.php';

$sql = new Core\SQLDuck();
$dork = $sql->loadEngine('DuckDuckGo');

$dork->search('site:google.com');