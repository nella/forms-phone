<?php

$version = getenv('NETTE');

if (!$version || $version == 'default') {
	exit;
}

echo "Nette version " . $version . PHP_EOL;

$file = __DIR__ . '/composer.json';
$content = file_get_contents($file);
$content = preg_replace(
	'~"nette/nette": "([^"]+)"~',
	'"nette/nette": "' . $version . '"',
	$content
);
file_put_contents($file, $content);
