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
	public function RGB_Random() {
		foreach (range(1, 1000) as $i) {
			$rgb = generate::rgb_rand();
			$this->assertTrue($rgb['r'] >= 0 && $rgb['r'] <= 255);
			$this->assertTrue($rgb['g'] >= 0 && $rgb['g'] <= 255);
			$this->assertTrue($rgb['b'] >= 0 && $rgb['b'] <= 255);
		}
	}
	
	/**
	 * @test
	 */
	public function HSL_Random() {
		foreach (range(1, 1000) as $i) {
			$hsl = generate::hsl_rand();
			$this->assertTrue($hsl['h'] >= 0 && $hsl['h'] <= 359);
			$this->assertTrue($hsl['s'] >= 0 && $hsl['s'] <= 100);
			$this->assertTrue($hsl['l'] >= 0 && $hsl['l'] <= 100);
		}
	}
	
	/**
	 * @test
	 */
	public function Blend() {
		$rgb1 = $this->vars['conversions']['FFFFFF']['rgb'] + ['a' => 100];
		$rgb2 = $this->vars['conversions']['000000']['rgb'] + ['a' => 100];
		$rgb3 = generate::blend($rgb1['r'], $rgb1['g'], $rgb1['b'], $rgb1['a'], $rgb2['r'], $rgb2['g'], $rgb2['b'], $rgb2['a']);
		$this->assertEquals(['r' => 128, 'g' => 128, 'b' => 128, 'a' => 100], $rgb3);
		
		$rgb1 = $this->vars['conversions']['FFFFFF']['rgb'] + ['a' => 100];
		$rgb2 = $this->vars['conversions']['000000']['rgb'] + ['a' => 50];
		$rgb3 = generate::blend($rgb1['r'], $rgb1['g'], $rgb1['b'], $rgb1['a'], $rgb2['r'], $rgb2['g'], $rgb2['b'], $rgb2['a'], 25);
		$this->assertEquals(['r' => 191, 'g' => 191, 'b' => 191, 'a' => 87.5], $rgb3);
	}
	
	
	/**
	 * @test
	 */
	public function Web_Safe() {
		foreach (range(1, 1000) as $i) {
			$rgb = generate::rgb_rand();
			$web = generate::web_safe($rgb['r'], $rgb['g'], $rgb['b']);
			foreach (convert::hex_to_rgb($web) as $val) {
				$this->assertTrue(is_int($val / 0x33));
			}
		}
	}
	
	/**
	 * @test
	 */
	public function Gradient() {
		// count down
		$test1 = generate::gradient_range(2, 0, 0, 0, 0, 0);
		$this->assertEquals([
			['r' => 2, 'g' => 0, 'b' => 0],
			['r' => 1, 'g' => 0, 'b' => 0],
			['r' => 0, 'g' => 0, 'b' => 0]
		], $test1);
		// count up
		$test2 = generate::gradient_range(0, 0, 0, 2, 0, 0);
		$this->assertEquals([
			['r' => 0, 'g' => 0, 'b' => 0],
			['r' => 1, 'g' => 0, 'b' => 0],
			['r' => 2, 'g' => 0, 'b' => 0]
		], $test2);
		// count up and down
		$test3 = generate::gradient_range(5, 0, 3, 0, 5, 3);
		$this->assertEquals([
			['r' => 5, 'g' => 0, 'b' => 3],
			['r' => 4, 'g' => 1, 'b' => 3],
			['r' => 3, 'g' => 2, 'b' => 3],
			['r' => 2, 'g' => 3, 'b' => 3],
			['r' => 1, 'g' => 4, 'b' => 3],
			['r' => 0, 'g' => 5, 'b' => 3]
		], $test3);
		// 1 color
		$test4 = generate::gradient_range(5, 5, 5, 5, 5, 5);
		$this->assertEquals([
			['r' => 5, 'g' => 5, 'b' => 5]
		], $test4);
		// stretch
		$test5 = generate::gradient_range(5, 0, 3, 0, 5, 3, 12);
		$this->assertEquals([
			['r' => 5, 'g' => 0, 'b' => 3],
			['r' => 5, 'g' => 0, 'b' => 3],
			['r' => 4, 'g' => 1, 'b' => 3],
			['r' => 4, 'g' => 1, 'b' => 3],
			['r' => 3, 'g' => 2, 'b' => 3],
			['r' => 3, 'g' => 2, 'b' => 3],
			['r' => 2, 'g' => 3, 'b' => 3],
			['r' => 2, 'g' => 3, 'b' => 3],
			['r' => 1, 'g' => 4, 'b' => 3],
			['r' => 1, 'g' => 4, 'b' => 3],
			['r' => 0, 'g' => 5, 'b' => 3],
			['r' => 0, 'g' => 5, 'b' => 3]
		], $test5);
		// stretch 1 color
		$test4 = generate::gradient_range(5, 5, 5, 5, 5, 5, 5);
		$this->assertEquals([
			['r' => 5, 'g' => 5, 'b' => 5],
			['r' => 5, 'g' => 5, 'b' => 5],
			['r' => 5, 'g' => 5, 'b' => 5],
			['r' => 5, 'g' => 5, 'b' => 5],
			['r' => 5, 'g' => 5, 'b' => 5]
		], $test4);
	}
}
