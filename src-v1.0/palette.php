<?php

// Configure File
namespace projectcleverweb\color;
use \projectcleverweb\color\_interface\object;
use \projectcleverweb\color\color;

/**
 * Palette
 * =======
 * This class is for generating a set of colors from a base color
 */
class palette implements object {
	
	/**
	 * Stores the data about the current colors
	 * @var data
	 */
	protected $data;
	
	/**
	 * An instance of a supported caching method
	 * @var cache_interface
	 */
	protected $cache;
	
	public function __construct(color $base_color) {
		
	}
}
