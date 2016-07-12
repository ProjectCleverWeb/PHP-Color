<?php


namespace projectcleverweb\color;

class check {
	
	
	public static function is_dark(int $r = 0, int $g = 0, int $b = 0, int $check_score = 128) :bool {
		if (generate::yiq_score($r, $g, $b) >= $check_score) {
			return FALSE;
		}
		return TRUE;
	}
	
	/**
	 * Measures the visual contrast of 2 RGB colors.
	 * 
	 * NOTE: most colors do not have a 100% contrasting opposite, but all colors
	 * do have a contrasting opposite that is at least 50%.
	 * 
	 * @param  array $rgb1 The first color, array where offsets 'r', 'g', & 'b' contain their respective values.
	 * @param  array $rgb2 The second color, array where offsets 'r', 'g', & 'b' contain their respective values.
	 * @return float       The visual contrast as a percentage (e.g. 12.345)
	 */
	public static function rgb_contrast($rgb1, $rgb2) {
		$r = (max($rgb1['r'], $rgb2['r']) - min($rgb1['r'], $rgb2['r'])) * 299;
		$g = (max($rgb1['g'], $rgb2['g']) - min($rgb1['g'], $rgb2['g'])) * 587;
		$b = (max($rgb1['b'], $rgb2['b']) - min($rgb1['b'], $rgb2['b'])) * 114;
		// Sum => Average => Convert to percentage
		return ($r + $g + $b) / 1000 / 2.55;
	}
	
	
}

