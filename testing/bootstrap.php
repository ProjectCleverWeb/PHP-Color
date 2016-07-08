<?php
/**
 * Bootstrap
 */

namespace projectcleverweb\color;

// Call the autoload script
require_once realpath(__DIR__.'/../autoload.php');

/**
 * Since all the setUp() and tearDown() methods are the same, we just extend
 * this class in each of the testing classes. (just make sure this class
 * always extends the PHPUnit TestCase class AND is abstract)
 */
abstract class testing extends \PHPUnit_Framework_TestCase {
	
	public $vars;
	
	/**
	 * Reset the vars
	 */
	public function setUp() {
		$this->vars = [
			'base_colors' => [
				[0, 0, 0],
				[255, 255, 255],
				[255, 255, 0],
				[255, 0, 255],
				[255, 0, 0],
				[0, 255, 255],
				[0, 255, 0],
				[0, 0, 255]
			]
		];
	}
	
	/**
	 * Reset all the instances
	 */
	public function tearDown() {
		
	}
}
