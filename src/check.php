<?php


namespace projectcleverweb\color;

class check {
	
	
	public static function is_dark(int $r = 0, int $g = 0, int $b = 0, int $check_score = 128) :bool {
		if (generate::yiq_score($r, $g, $b) >= $check_score) {
			return FALSE;
		}
		return TRUE;
	}
	
	public static function rgb_contrast($rgb1, $rgb2) {
		$r = (max($rgb1['r'], $rgb2['r']) - min($rgb1['r'], $rgb2['r'])) * 299;
		$g = (max($rgb1['g'], $rgb2['g']) - min($rgb1['g'], $rgb2['g'])) * 587;
		$b = (max($rgb1['b'], $rgb2['b']) - min($rgb1['b'], $rgb2['b'])) * 114;
		// Sum => Average => Convert to percentage
		return ($r + $g + $b) / 1000 / 2.55;
	}
	
	
}

