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
		// Expected range
		foreach (range(0, 359) as $i) {
			$s = $l = $i;
			if ($i > 100) {
				$s = $l = 50;
			}
			$test1a = $test1b = ['h' => $i, 's' => $s, 'l' => $l];
			regulate::hsl_array($test1b);
			$this->assertEquals($test1a, $test1b);
		}
		$expected = ['h' => 180, 's' => 100, 'l' => 50];
		// Loop around
		$test2 = ['h' => 540, 's' => 201, 'l' => 151];
		regulate::hsl_array($test2);
		$this->assertEquals($expected, $test2);
		// Negative values
		$test3 = ['h' => -180, 's' => -100, 'l' => -50];
		regulate::hsl_array($test3);
		$this->assertEquals($expected, $test3);
		// Negative loop around
		$test4 = ['h' => -540, 's' => -201, 'l' => -151];
		regulate::hsl_array($test3);
		$this->assertEquals($expected, $test3);
		// Multiple loops
		$test5 = ['h' => 1980, 's' => 505, 'l' => 555];
		regulate::hsl_array($test4);
		$this->assertEquals($expected, $test4);
		// Extra keys
		$test6b = $test6a = ['h' => 1, 's' => 1, 'l' => 1, 'a' => 1, 'z' => 1];
		regulate::hsl_array($test6b);
		$this->assertEquals($test6a, $test6b);
		// Missing keys
		$test7a = ['h' => 0, 's' => 0, 'l' => 0];
		$test7b = [];
		regulate::hsl_array($test7b);
		$this->assertEquals($test7a, $test7b);
	}
	
	/**
	 * @test
	 */
	public function HSB_Array() {
		// Expected range
		foreach (range(0, 359) as $i) {
			$s = $b = $i;
			if ($i > 100) {
				$s = $b = 50;
			}
			$test1a = $test1b = ['h' => $i, 's' => $s, 'b' => $b];
			regulate::hsb_array($test1b);
			$this->assertEquals($test1a, $test1b);
		}
		$expected = ['h' => 180, 's' => 100, 'b' => 50];
		// Loop around
		$test2 = ['h' => 540, 's' => 201, 'b' => 151];
		regulate::hsb_array($test2);
		$this->assertEquals($expected, $test2);
		// Negative values
		$test3 = ['h' => -180, 's' => -100, 'b' => -50];
		regulate::hsb_array($test3);
		$this->assertEquals($expected, $test3);
		// Negative loop around
		$test4 = ['h' => -540, 's' => -201, 'b' => -151];
		regulate::hsb_array($test3);
		$this->assertEquals($expected, $test3);
		// Multiple loops
		$test5 = ['h' => 1980, 's' => 505, 'b' => 555];
		regulate::hsb_array($test4);
		$this->assertEquals($expected, $test4);
		// Extra keys
		$test6b = $test6a = ['h' => 1, 's' => 1, 'b' => 1, 'a' => 1, 'z' => 1];
		regulate::hsb_array($test6b);
		$this->assertEquals($test6a, $test6b);
		// Missing keys
		$test7a = ['h' => 0, 's' => 0, 'b' => 0];
		$test7b = [];
		regulate::hsb_array($test7b);
		$this->assertEquals($test7a, $test7b);
	}
	
	/**
	 * @test
	 */
	public function CMYK() {
		// Expected range
		foreach (range(0, 100) as $i) {
			$test1 = $i;
			regulate::cmyk($test1);
			$this->assertEquals($i, $test1);
		}
		// Loop around
		$test2 = 101;
		regulate::cmyk($test2);
		$this->assertEquals(0, $test2);
		// Negative values
		$test3 = -1;
		regulate::cmyk($test3);
		$this->assertEquals(1, $test3);
		// Negative loop around
		$test3 = -101;
		regulate::cmyk($test3);
		$this->assertEquals(0, $test3);
		// Multiple loops
		$test4 = 505;
		regulate::cmyk($test4);
		$this->assertEquals(0, $test4);
	}
	
	/**
	 * @test
	 */
	public function Alpha() {
		// Expected range
		foreach (range(0, 100) as $i) {
			$test1 = $i;
			regulate::alpha($test1);
			$this->assertEquals($i, $test1);
		}
		// Loop around
		$test2 = 101;
		regulate::alpha($test2);
		$this->assertEquals(0, $test2);
		// Negative values
		$test3 = -1;
		regulate::alpha($test3);
		$this->assertEquals(1, $test3);
		// Negative loop around
		$test3 = -101;
		regulate::alpha($test3);
		$this->assertEquals(0, $test3);
		// Multiple loops
		$test4 = 505;
		regulate::alpha($test4);
		$this->assertEquals(0, $test4);
	}
	
	/**
	 * @test
	 */
	public function CMYK_Array() {
		// Expected range
		foreach (range(0, 100) as $i) {
			$test1 = $i = ['c' => $i, 'm' => $i, 'y' => $i, 'k' => $i];
			regulate::cmyk_array($test1);
			$this->assertEquals($i, $test1);
		}
		$expected = ['c' => 1, 'm' => 1, 'y' => 1, 'k' => 1];
		// Loop around
		$test2 = ['c' => 102, 'm' => 102, 'y' => 102, 'k' => 102];
		regulate::cmyk_array($test2);
		$this->assertEquals($expected, $test2);
		// Negative values
		$test3 = ['c' => -1, 'm' => -1, 'y' => -1, 'k' => -1];
		regulate::cmyk_array($test3);
		$this->assertEquals($expected, $test3);
		// Negative loop around
		$test4 = ['c' => -102, 'm' => -102, 'y' => -102, 'k' => -102];
		regulate::cmyk_array($test3);
		$this->assertEquals($expected, $test3);
		// Multiple loops
		$test5 = ['c' => 505, 'm' => 505, 'y' => 505, 'k' => 505];
		regulate::cmyk_array($test4);
		$this->assertEquals($expected, $test4);
		// Extra keys
		$test6b = $test6a = ['c' => 1, 'm' => 1, 'y' => 1, 'k' => 1, 'a' => 1, 'z' => 1];
		regulate::cmyk_array($test6b);
		$this->assertEquals($test6a, $test6b);
		// Missing keys
		$test7a = ['c' => 0, 'm' => 0, 'y' => 0, 'k' => 0];
		$test7b = [];
		regulate::cmyk_array($test7b);
		$this->assertEquals($test7a, $test7b);
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
	
	/**
	 * @test
	 */
	public function Hex() {
		$this->assertTrue(TRUE);
	}
	
	/**
	 * @test
	 */
	public function Div() {
		$this->assertTrue(TRUE);
	}
}
