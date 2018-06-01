<?php

// Configure File
namespace projectcleverweb\color;
use \projectcleverweb\color\_interface\object;

/**
 * Library [IMMUTABLE]
 * ===================
 * This class is for working with a predefined set of colors that have been
 * curated by the original library owner.
 */
class library implements object {
	
	/**
	 * Stores the data for the library
	 * @var data
	 */
	protected $data;
	
	public function __construct(array $colors) {
		
	}
}
