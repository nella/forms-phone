<?php

require __DIR__ . '/../vendor/autoload.php';

if (!class_exists('Tester\Assert')) {
	echo "Install Nette Tester using `composer update --dev`\n";
	exit(1);
}

Tester\Environment::setup();

function id($val) {
	return $val;
}

require_once __DIR__ . '/../src/Nella/Forms/Phone/PhoneNumberInput.php';
