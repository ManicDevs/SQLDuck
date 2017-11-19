<?php 

spl_autoload_register('Autoloader::load');

class Autoloader
{
	public static function load($className)
	{
		$namespace = str_replace('\\', '/', __NAMESPACE__);
		$className = str_replace('\\', '/', $className);
		$classPath = 'Library/' . (!empty($namespace) ? $namespace : '') . $className . '.class.php';
		
		if(!file_exists($classPath))
		{
			if(defined('VERBOSE') && VERBOSE)
				echo '[V] Missing: ', $classPath . PHP_EOL;
			exit;
		}
		
		if(defined('VERBOSE') && VERBOSE)
			echo '[V] Loading: ' . $classPath . PHP_EOL;
		require $classPath;
	}
}
