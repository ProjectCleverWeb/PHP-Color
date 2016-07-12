<?php

namespace projectcleverweb\color;

/**
 * @requires PHP 7.0
 * @requires PHPUnit 5
 */
class ColorSpaceTest extends unit_test {
	
	/**
	 * Testing for mathematical drifts when converting between color spaces.
	 * 
	 * NOTE: This is not a full color space test, it only skims the RGB color
	 * space for differences.
	 * 
	 * @test
	 */
	public function RGB_HSL_Interlace_Color_Drift() {
		foreach (range(0 ,51) as $b) {
			foreach (range(0 ,51) as $g) {
				foreach (range(0 ,51) as $r) {
					$rgb1 = ['r' => $r * 5, 'g' => $g * 5, 'b' => $b * 5];
					$hsl1 = generate::rgb_to_hsl($rgb1['r'], $rgb1['g'],$rgb1['b']);
					$rgb2 = generate::hsl_to_rgb($hsl1['h'], $hsl1['s'],$hsl1['l']);
					$hsl2 = generate::rgb_to_hsl($rgb2['r'], $rgb2['g'],$rgb2['b']);
					if (!empty(array_diff_assoc($rgb1, $rgb2)) || !empty(array_diff_assoc($hsl1, $hsl2))) {
						$this->assertEmpty(array_diff_assoc($rgb1, $rgb2), sprintf(
							'RGB color drift detected: rgb1(%s, %s, %s) != rgb2(%s, %s, %s)',
							$rgb1['r'],
							$rgb1['g'],
							$rgb1['b'],
							$rgb2['r'],
							$rgb2['g'],
							$rgb2['b']
						));
						$this->assertEmpty(array_diff_assoc($rgb1, $rgb2), sprintf(
							'HSL color drift detected: hsl1(%s, %s, %s) != hsl2(%s, %s, %s)',
							$hsl1['r'],
							$hsl1['g'],
							$hsl1['b'],
							$hsl2['r'],
							$hsl2['g'],
							$hsl2['b']
						));
					}
				}
			}
		}
	}
}
