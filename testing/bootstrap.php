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
abstract class unit_test extends \PHPUnit_Framework_TestCase {
	
	public $vars;
	
	/**
	 * Reset the vars
	 */
	public function setUp() {
		error::set('use_exceptions', TRUE);
		error::set('active', FALSE);
		$this->vars = [
			'conversions' => [
				// The 8 basic colors of the RGB spectrum with their conversions
				'000000' => [
					'int'  => 0x000000,
					'hex'  => '000000',
					'rgb'  => ['r' => 0, 'g' => 0, 'b' => 0 ],
					'hsl'  => ['h' => 0, 's' => 0, 'l' => 0],
					'hsb'  => ['h' => 0, 's' => 0, 'b' => 0],
					'cmyk' => ['c' => 0, 'm' => 0, 'y' => 0, 'k' => 100]
				],
				'FFFFFF' => [
					'int'  => 0xFFFFFF,
					'hex'  => 'FFFFFF',
					'rgb'  => ['r' => 255, 'g' => 255, 'b' => 255],
					'hsl'  => ['h' => 0, 's' => 0, 'l' => 100],
					'hsb'  => ['h' => 0, 's' => 0, 'b' => 100],
					'cmyk' => ['c' => 0, 'm' => 0, 'y' => 0, 'k' => 0]
				],
				'FFFF00' => [
					'int'  => 0xFFFF00,
					'hex'  => 'FFFF00',
					'rgb'  => ['r' => 255, 'g' => 255, 'b' => 0 ],
					'hsl'  => ['h' => 60, 's' => 100, 'l' => 50],
					'hsb'  => ['h' => 60, 's' => 100, 'b' => 100],
					'cmyk' => ['c' => 0, 'm' => 0, 'y' => 100, 'k' => 0]
				],
				'FF00FF' => [
					'int'  => 0xFF00FF,
					'hex'  => 'FF00FF',
					'rgb'  => ['r' => 255, 'g' => 0, 'b' => 255],
					'hsl'  => ['h' => 300, 's' => 100, 'l' => 50],
					'hsb'  => ['h' => 300, 's' => 100, 'b' => 100],
					'cmyk' => ['c' => 0, 'm' => 100, 'y' => 0, 'k' => 0]
				],
				'FF0000' => [
					'int'  => 0xFF0000,
					'hex'  => 'FF0000',
					'rgb'  => ['r' => 255, 'g' => 0, 'b' => 0 ],
					'hsl'  => ['h' => 0, 's' => 100, 'l' => 50],
					'hsb'  => ['h' => 0, 's' => 100, 'b' => 100],
					'cmyk' => ['c' => 0, 'm' => 100, 'y' => 100, 'k' => 0]
				],
				'00FFFF' => [
					'int'  => 0x00FFFF,
					'hex'  => '00FFFF',
					'rgb'  => ['r' => 0, 'g' => 255, 'b' => 255],
					'hsl'  => ['h' => 180, 's' => 100, 'l' => 50],
					'hsb'  => ['h' => 180, 's' => 100, 'b' => 100],
					'cmyk' => ['c' => 100, 'm' => 0, 'y' => 0, 'k' => 0]
				],
				'00FF00' => [
					'int'  => 0x00FF00,
					'hex'  => '00FF00',
					'rgb'  => ['r' => 0, 'g' => 255, 'b' => 0 ],
					'hsl'  => ['h' => 120, 's' => 100, 'l' => 50],
					'hsb'  => ['h' => 120, 's' => 100, 'b' => 100],
					'cmyk' => ['c' => 100, 'm' => 0, 'y' => 100, 'k' => 0]
				],
				'0000FF' => [
					'int'  => 0x0000FF,
					'hex'  => '0000FF',
					'rgb'  => ['r' => 0, 'g' => 0, 'b' => 255],
					'hsl'  => ['h' => 240, 's' => 100, 'l' => 50],
					'hsb'  => ['h' => 240, 's' => 100, 'b' => 100],
					'cmyk' => ['c' => 100, 'm' => 100, 'y' => 0, 'k' => 0]
				]
			]
		];
	}
	
	/**
	 * 
	 */
	public function tearDown() {
		
	}
}
