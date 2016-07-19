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
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$this->assertEquals(generate::hex_to_rgb($hex), $conv['rgb']);
		}
	}
	
	/**
	 * @test
	 */
	public function RGB_To_HEX() {
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$this->assertEquals(generate::rgb_to_hex($conv['rgb']['r'], $conv['rgb']['g'], $conv['rgb']['b']), $hex);
		}
	}
	
	/**
	 * @test
	 */
	public function RGB_To_CMYK() {
		foreach ($this->vars['conversions'] as $conv) {
			$this->assertEquals(generate::rgb_to_cmyk($conv['rgb']['r'], $conv['rgb']['g'], $conv['rgb']['b']), $conv['cmyk']);
		}
	}
	
	/**
	 * @test
	 */
	public function CMYK_To_RGB() {
		foreach ($this->vars['conversions'] as $conv) {
			$this->assertEquals(generate::cmyk_to_rgb($conv['cmyk']['c'], $conv['cmyk']['m'], $conv['cmyk']['y'], $conv['cmyk']['k']), $conv['rgb']);
		}
	}
	
	/**
	 * @test
	 */
	public function RGB_To_HSL() {
		foreach ($this->vars['conversions'] as $conv) {
			$this->assertEquals(generate::rgb_to_hsl($conv['rgb']['r'], $conv['rgb']['g'], $conv['rgb']['b']), $conv['hsl']);
		}
	}
	
	/**
	 * @test
	 */
	public function HSL_To_RGB() {
		foreach ($this->vars['conversions'] as $conv) {
			$this->assertEquals(generate::hsl_to_rgb($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']), $conv['rgb']);
		}
	}
	
	/**
	 * @test
	 */
	public function RGB_Contrast() {
		$conv = $this->vars['conversions'];
		$this->assertEquals(generate::rgb_contrast($conv['000000']['rgb']['r'], $conv['000000']['rgb']['g'], $conv['000000']['rgb']['b']), $conv['FFFFFF']['rgb']);
	}
	
	/**
	 * @test
	 */
	public function RGB_Invert() {
		$conv = $this->vars['conversions'];
		$this->assertEquals(generate::rgb_invert($conv['000000']['rgb']['r'], $conv['000000']['rgb']['g'], $conv['000000']['rgb']['b']), $conv['FFFFFF']['rgb']);
	}
	
	/**
	 * @test
	 */
	public function YIQ_Score() {
		$this->assertEquals(generate::yiq_score(255, 255, 255), 255);
		$this->assertEquals(generate::yiq_score(0, 0, 0), 0);
	}
	
	/**
	 * @test
	 */
	public function Random() {
		foreach (range(1, 1000) as $i) {
			$rgb = generate::rand();
			$this->assertTrue($rgb['r'] >= 0 && $rgb['r'] <= 255);
			$this->assertTrue($rgb['g'] >= 0 && $rgb['g'] <= 255);
			$this->assertTrue($rgb['b'] >= 0 && $rgb['b'] <= 255);
		}
	}
}
