<?php

namespace projectcleverweb\color;

/**
 * @requires PHP 7.0
 * @requires PHPUnit 5
 */
class CheckTest extends unit_test {
	
	/**
	 * @test
	 */
	public function Is_Dark() {
		// Black
		$this->assertTrue(check::is_dark(0, 0, 0));
		// White
		$this->assertFalse(check::is_dark(255, 255, 255));
		// Gray (mathematical dark)
		$this->assertTrue(check::is_dark(127, 127, 127));
		// Gray (mathematical light)
		$this->assertFalse(check::is_dark(128, 128, 128));
	}
	
	/**
	 * @test
	 */
	public function RGB_Contrast() {
		$possible_contrasts = [11,30,41,59,70,89,100];
		foreach ($this->vars['conversions'] as $hex1 => $color1) {
			foreach ($this->vars['conversions'] as $hex2 => $color2) {
				if ($hex1 == $hex2) {
					$this->assertEquals(0, check::rgb_contrast($color1['rgb'], $color2['rgb']));
				} else {
					$this->assertTrue(in_array(round(check::rgb_contrast($color1['rgb'], $color2['rgb'])), $possible_contrasts));
				}
			}
		}
	}
}
