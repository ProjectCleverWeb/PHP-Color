<?php

namespace projectcleverweb\color;

/**
 * @requires PHP 7.0
 * @requires PHPUnit 5
 */
class RegulateTest extends unit_Test {
	
	/**
	 * @test
	 */
	public function Percent() {
		// Expected range (note: 0 - 100 actually has 101 offsets)
		foreach (range(0, 100) as $i) {
			$test1 = $i;
			regulate::percent($test1);
			$this->assertEquals($i, $test1);
		}
		// Loop around
		$test2 = 101;
		regulate::percent($test2);
		$this->assertEquals(0, $test2);
		// Negative values
		$test3 = -1;
		regulate::percent($test3);
		$this->assertEquals(1, $test3);
		// Negative loop around
		$test3 = -101;
		regulate::percent($test3);
		$this->assertEquals(0, $test3);
		// Multiple loops
		$test4 = 505;
		regulate::percent($test4);
		$this->assertEquals(0, $test4);
	}
	
	/**
	 * @test
	 */
	public function RGB() {
		// Expected range
		foreach (range(0, 255) as $i) {
			$test1 = $i;
			regulate::rgb($test1);
			$this->assertEquals($i, $test1);
		}
		// Loop around
		$test2 = 256;
		regulate::rgb($test2);
		$this->assertEquals(0, $test2);
		// Negative values
		$test3 = -1;
		regulate::rgb($test3);
		$this->assertEquals(1, $test3);
		// Negative loop around
		$test3 = -256;
		regulate::rgb($test3);
		$this->assertEquals(0, $test3);
		// Multiple loops
		$test4 = 1024;
		regulate::rgb($test4);
		$this->assertEquals(0, $test4);
	}
	
	/**
	 * @test
	 */
	public function RGB_Array() {
		// Expected range
		foreach (range(0, 255) as $i) {
			$test1 = $i = ['r' => $i, 'g' => $i, 'b' => $i];
			regulate::rgb_array($test1);
			$this->assertEquals($i, $test1);
		}
		$expected = ['r' => 1, 'g' => 1, 'b' => 1];
		// Loop around
		$test2 = ['r' => 257, 'g' => 257, 'b' => 257];
		regulate::rgb_array($test2);
		$this->assertEquals($expected, $test2);
		// Negative values
		$test3 = ['r' => -1, 'g' => -1, 'b' => -1];
		regulate::rgb_array($test3);
		$this->assertEquals($expected, $test3);
		// Negative loop around
		$test4 = ['r' => -257, 'g' => -257, 'b' => -257];
		regulate::rgb_array($test3);
		$this->assertEquals($expected, $test3);
		// Multiple loops
		$test5 = ['r' => 1025, 'g' => 1025, 'b' => 1025];
		regulate::rgb_array($test4);
		$this->assertEquals($expected, $test4);
		// Extra keys
		$test6b = $test6a = ['r' => 1, 'g' => 1, 'b' => 1, 'a' => 1, 'z' => 1];
		regulate::rgb_array($test6b);
		$this->assertEquals($test6a, $test6b);
		// Missing keys
		$test7a = ['r' => 0, 'g' => 0, 'b' => 0];
		$test7b = [];
		regulate::rgb_array($test7b);
		$this->assertEquals($test7a, $test7b);
	}
	
	/**
	 * @test
	 */
	public function HSL() {
		// Expected range
		foreach (range(0, 359) as $i) {
			$test1a = $i;
			regulate::hsl($test1a, 'h');
			$this->assertEquals($i, $test1a);
		}
		foreach (range(0, 100) as $i) {
			$test1b = $i;
			$test1c = $i;
			regulate::hsl($test1b, 's');
			regulate::hsl($test1c, 'l');
			$this->assertEquals($i, $test1b);
			$this->assertEquals($i, $test1c);
		}
		// Loop around
		$test2 = 360;
		regulate::hsl($test2, 'h');
		$this->assertEquals(0, $test2);
		// Negative values
		$test3 = -1;
		regulate::hsl($test3, 'h');
		$this->assertEquals(1, $test3);
		// Negative loop around
		$test3 = -360;
		regulate::hsl($test3, 'h');
		$this->assertEquals(0, $test3);
		// Multiple loops
		$test4 = 3600;
		regulate::hsl($test4, 'h');
		$this->assertEquals(0, $test4);
	}
	
	/**
	 * @test
	 */
	public function HSL_Array() {
		$this->assertTrue(TRUE);
	}
	
	/**
	 * @test
	 */
	public function CMYK() {
		$this->assertTrue(TRUE);
	}
	
	/**
	 * @test
	 */
	public function Alpha() {
		$this->assertTrue(TRUE);
	}
	
	/**
	 * @test
	 */
	public function CMYK_Array() {
		$this->assertTrue(TRUE);
	}
	
	/**
	 * @test
	 */
	public function Hex() {
		$this->assertTrue(TRUE);
	}
	
	/**
	 * @test
	 */
	public function Hex_Int() {
		$this->assertTrue(TRUE);
	}
	
	/**
	 * @test
	 */
	public function Strip_Hash() {
		$this->assertTrue(TRUE);
	}
	
	/**
	 * @test
	 */
	public function Expand_Shorthand() {
		$this->assertTrue(TRUE);
	}
	
	/**
	 * @test
	 */
	public function Validate_Hex_Str() {
		$this->assertTrue(TRUE);
	}
}
