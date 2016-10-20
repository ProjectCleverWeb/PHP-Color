<?php
/**
 * Autoloader for PHP URI Library
 * 
 * Licensed under WTFPL, so have at it.
 * 
 * @author    Nicholas Jordon
 * @link      https://github.com/ProjectCleverWeb
 * @copyright 2014 Nicholas Jordon - All Rights Reserved
 * @version   1.0.0
 * @license   http://www.wtfpl.net/
 */

/**
 * Simple PSR-4 autoloader
 * 
 * This is ignored by code coverage because the autoload is not considered a
 * part of the actual library, and is not required for the library to work in
 * some cases. (such as when loaded by composer)
 * 
 * @codeCoverageIgnore
 */
spl_autoload_register(function ($class) {
	$prefix = 'projectcleverweb\\color';
	$dir    = 'src';
	if (version_compare(PHP_VERSION, '7.0.0', '<')) {
		$dir = 'php5';
	}
	
	$prefix_len = strlen($prefix);
	if(strncmp($prefix, $class, $prefix_len) !== 0) {
		return;
	}
	
	$file = __DIR__.'/'.$dir.str_replace('\\', DIRECTORY_SEPARATOR, substr($class, $prefix_len)).'.php';
	
	if(file_exists($file) && is_file($file)) {
		require_once $file;
	}
});
