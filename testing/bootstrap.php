<?php
/**
 * Bootstrap
 */

namespace projectcleverweb\color;
use PHPUnit\Framework\TestCase;

// Call the autoload script
require_once realpath(__DIR__.'/../autoload.php');

/**
 * Since all the setUp() and tearDown() methods are the same, we just extend
 * this class in each of the testing classes. (just make sure this class
 * always extends the PHPUnit TestCase class AND is abstract)
 */
abstract class unit_test extends TestCase {
	
	public $vars;
	
	/**
	 * Reset the vars
	 */
	public function setUp() {
		$this->vars = [
			'hex_rgb' => [
				'000000' => ['r' => 0, 'g' => 0, 'b' => 0],
				'FFFFFF' => ['r' => 255, 'g' => 255, 'b' => 255],
				'FFFF00' => ['r' => 255, 'g' => 255, 'b' => 0],
				'FF00FF' => ['r' => 255, 'g' => 0, 'b' => 255],
				'FF0000' => ['r' => 255, 'g' => 0, 'b' => 0],
				'00FFFF' => ['r' => 0, 'g' => 255, 'b' => 255],
				'00FF00' => ['r' => 0, 'g' => 255, 'b' => 0],
				'0000FF' => ['r' => 0, 'g' => 0, 'b' => 255]
			]
		];
	}
	
	/**
	 * 
	 */
	public function tearDown() {
		
	}
}
