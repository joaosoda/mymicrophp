<?php //router.class.php

class Router
{
	function __construct()
	{
		$this->path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
		$this->method = (isset($_REQUEST['_method'])) ? $_REQUEST['_method'] : $_SERVER['REQUEST_METHOD'];
	}

	function run()
	{
		$found = false;
		$u = $this->urls;
		$p = $this->path;
		$m = strtolower($this->method);

		krsort($u);

		foreach ($u as $regex => $class) {
			$regex = '^' . str_replace('/', '\/', $regex) . '\/?$';
			if (preg_match("/$regex/i", $p, $matches)) {
				$found = true;
				$a = $a = explode(':', $class);
				$file_name = $a[0];
				$class_name = ucfirst($file_name);
				$method_name = $m . '_' . $a[1];

				require_once('controllers/' . $file_name . ".class.php");
				$c = new $class_name;
				$c->$method_name($matches);
			}
		}

		if(!$found) {
			echo $p;
		}
	}
}