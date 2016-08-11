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
	public function Random() {
		foreach (range(1, 1000) as $i) {
			$rgb = generate::rand();
			$this->assertTrue($rgb['r'] >= 0 && $rgb['r'] <= 255);
			$this->assertTrue($rgb['g'] >= 0 && $rgb['g'] <= 255);
			$this->assertTrue($rgb['b'] >= 0 && $rgb['b'] <= 255);
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
}
