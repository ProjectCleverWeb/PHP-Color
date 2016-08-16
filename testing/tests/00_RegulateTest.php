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
		regulate::rgb_array($test4);
		$this->assertEquals($expected, $test4);
		// Multiple loops
		$test5 = ['r' => 1025, 'g' => 1025, 'b' => 1025];
		regulate::rgb_array($test5);
		$this->assertEquals($expected, $test5);
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
		regulate::hsl_array($test4);
		$this->assertEquals($expected, $test4);
		// Multiple loops
		$test5 = ['h' => 1980, 's' => 504, 'l' => 555];
		regulate::hsl_array($test5);
		$this->assertEquals($expected, $test5);
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
		regulate::hsb_array($test4);
		$this->assertEquals($expected, $test4);
		// Multiple loops
		$test5 = ['h' => 1980, 's' => 504, 'b' => 555];
		regulate::hsb_array($test5);
		$this->assertEquals($expected, $test5);
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
		regulate::cmyk_array($test4);
		$this->assertEquals($expected, $test4);
		// Multiple loops
		$test5 = ['c' => 506, 'm' => 506, 'y' => 506, 'k' => 506];
		regulate::cmyk_array($test5);
		$this->assertEquals($expected, $test5);
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
		// min
		$test1 = 0x0;
		regulate::hex_int($test1);
		$this->assertEquals(0x0, $test1);
		// max
		$test2 = 0xffffff;
		regulate::hex_int($test2);
		$this->assertEquals(0xffffff, $test2);
		// loop
		$test3 = 0x1000001;
		regulate::hex_int($test3);
		$this->assertEquals(0x1, $test3);
		// negative loop
		$test4 = -0x1000001;
		regulate::hex_int($test4);
		$this->assertEquals(0x1, $test4);
		// multiple loops
		$test5 = 0x5000001;
		regulate::hex_int($test5);
		$this->assertEquals(0x1, $test5);
		$test6 = -0x5000001;
		regulate::hex_int($test6);
		$this->assertEquals(0x1, $test6);
	}
	
	/**
	 * @test
	 */
	public function Strip_Hash() {
		$test1 = 'ffffff';
		regulate::_strip_hash($test1);
		$this->assertEquals('ffffff', $test1);
		$test2 = '#ffffff';
		regulate::_strip_hash($test2);
		$this->assertEquals('ffffff', $test2);
	}
	
	/**
	 * @test
	 */
	public function Expand_Shorthand() {
		$test1 = 'ffffff';
		regulate::_expand_shorthand($test1);
		$this->assertEquals('ffffff', $test1);
		$test2 = 'fff';
		regulate::_expand_shorthand($test2);
		$this->assertEquals('ffffff', $test2);
	}
	
	/**
	 * @test
	 */
	public function Validate_Hex_Str() {
		$test1 = '09f09F';
		regulate::_validate_hex_str($test1);
		$this->assertEquals('09f09F', $test1);
		$test2 = '#09f09F';
		regulate::_validate_hex_str($test2);
		$this->assertEquals('#09f09F', $test2);
		$test3 = '09f';
		regulate::_validate_hex_str($test3);
		$this->assertEquals('09f', $test3);
		$test4 = '#09f';
		regulate::_validate_hex_str($test4);
		$this->assertEquals('#09f', $test4);
		$test5 = 'Invalid Value';
		regulate::_validate_hex_str($test5);
		$this->assertEquals('000000', $test5);
	}
	
	/**
	 * @test
	 */
	public function Hex() {
		$test1 = '09f09F';
		regulate::hex($test1);
		$this->assertEquals('09f09F', $test1);
		$test2 = '#09f09F';
		regulate::hex($test2);
		$this->assertEquals('09f09F', $test2);
		$test3 = '09f';
		regulate::hex($test3);
		$this->assertEquals('0099ff', $test3);
		$test4 = '#09f';
		regulate::hex($test4);
		$this->assertEquals('0099ff', $test4);
		$test5 = 'Invalid Value';
		regulate::hex($test5);
		$this->assertEquals('000000', $test5);
	}
	
	/**
	 * @test
	 */
	public function Standardize_Array() {
		$test1 = ['a' => 1, 'b' => 2, 'c' => 3];
		regulate::standardize_array($test1, ['a', 'b', 'c']);
		$this->assertEquals(['a' => 1, 'b' => 2, 'c' => 3], $test1);
		$test2 = ['a' => 1, 'b' => 2, 'c' => 3];
		regulate::standardize_array($test2, ['a', 'b', 'c', 'd']);
		$this->assertEquals(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 0], $test2);
		$test3 = [1, 2, 3];
		regulate::standardize_array($test3, ['a', 'b', 'c']);
		$this->assertEquals(['a' => 1, 'b' => 2, 'c' => 3], $test3);
	}
	
	
	/**
	 * @test
	 */
	public function Div() {
		$this->assertEquals(3 / 3, regulate::div(3, 3));
		$this->assertEquals(0, regulate::div(3, 0));
	}
}
