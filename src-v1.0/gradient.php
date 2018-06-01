<?php

// Configure File
namespace projectcleverweb\color;
use \projectcleverweb\color\_interface\object;
use \projectcleverweb\color\color;

/**
 * Gradient
 * ========
 * This class is for generating a set of colors from 2 or more base colors
 */
class gradient implements object {
	
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
	
	public function __construct(color $color_a, color $color_b) {
		
	}
}
