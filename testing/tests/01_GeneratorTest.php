<?php

namespace projectcleverweb\color;

/**
 * @requires PHP 7.0
 * @requires PHPUnit 5
 */
class GeneratorTest extends unit_test {
	
	/**
	 * @test
	 */
	public function HEX_To_RGB() {
		foreach ($this->vars['hex_rgb'] as $hex => $rgb) {
			$this->assertEquals(generate::hex_to_rgb($hex), $rgb);
		}
	}
	
	/**
	 * @test
	 */
	public function RGB_To_HEX() {
		foreach ($this->vars['hex_rgb'] as $hex => $rgb) {
			$this->assertEquals(generate::rgb_to_hex($rgb['r'], $rgb['g'], $rgb['b']), $hex);
		}
	}
	
	/**
	 * @test
	 */
	public function RGB_To_CMYK() {
		
	}
	
	/**
	 * @test
	 */
	public function CMYK_To_RGB() {
		
	}
	
	/**
	 * @test
	 */
	public function RGB_Contrast() {
		
	}
	
	/**
	 * @test
	 */
	public function RGB_Invert() {
		
	}
	
	/**
	 * @test
	 */
	public function YIQ_Score() {
		
	}
	
	/**
	 * @test
	 */
	public function Random() {
		
	}
	
	/**
	 * @test
	 */
	public function RGB_To_HSL() {
		
	}
	
	/**
	 * @test
	 */
	public function HSL_To_RGB() {
		
	}
	
}
