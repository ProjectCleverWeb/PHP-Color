<?php

// Configure File
namespace projectcleverweb\color;
use \projectcleverweb\color\_interface\object;

/**
 * Theme [IMMUTABLE]
 * =================
 * This class is for working with a predefined set of colors that cannot be
 * changed.
 */
class theme implements object {
	
	/**
	 * Stores the data about a theme
	 * @var data
	 */
	protected $data;
	
	public function __construct(array $colors) {
		
	}
}
