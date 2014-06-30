<?php // index.php
require_once('router.class.php');

$r = new Router;

$r->urls = array(
	// frontend
	'/' => 'frontpage:index',
	);

$r->run();