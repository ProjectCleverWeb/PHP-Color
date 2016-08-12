<?php


namespace projectcleverweb\color;


class generate {
	
	public static function rgb_contrast(int $r = 0, int $g = 0, int $b = 0) :array {
		return [
			'r' => ($r < 128) ? 255 : 0,
			'g' => ($g < 128) ? 255 : 0,
			'b' => ($b < 128) ? 255 : 0
		];
	}
	
	public static function rgb_invert(int $r = 0, int $g = 0, int $b = 0) :array {
		return [
			'r' => 255 - $r,
			'g' => 255 - $g,
			'b' => 255 - $b
		];
	}
	
	public static function yiq_score(int $r = 0, int $g = 0, int $b = 0) :float {
		return (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
	}
	
	public static function rgb_rand(int $min_r = 0, int $max_r = 255, int $min_g = 0, int $max_g = 255, int $min_b = 0, int $max_b = 255) :array {
		return [
			'r' => rand(abs((int) $min_r) % 256, abs((int) $max_r) % 256),
			'g' => rand(abs((int) $min_g) % 256, abs((int) $max_g) % 256),
			'b' => rand(abs((int) $min_b) % 256, abs((int) $max_b) % 256)
		];
	}
	
	public static function hsl_rand(int $min_h = 0, int $max_h = 255, int $min_s = 0, int $max_s = 255, int $min_l = 0, int $max_l = 255) :array {
		return [
			'h' => rand(abs((int) $min_h) % 256, abs((int) $max_h) % 256),
			's' => rand(abs((int) $min_s) % 256, abs((int) $max_s) % 256),
			'l' => rand(abs((int) $min_l) % 256, abs((int) $max_l) % 256)
		];
	}
	
	public static function blend(float $r1, float $g1, float $b1, float $a1, float $r2, float $g2, float $b2, float $a2, float $amount = 50.0) :array {
		$x1 = regulate::div(100 - $amount, 100);
		$x2 = regulate::div($amount, 100);
		return [
			'r' => round(($r1 * $x1) + ($r2 * $x2), 0),
			'g' => round(($g1 * $x1) + ($g2 * $x2), 0),
			'b' => round(($b1 * $x1) + ($b2 * $x2), 0),
			'a' => ($a1 * $x1) + ($a2 * $x2)
		];
	}
	
	public static function web_safe(int $r = 0, int $g = 0, int $b = 0) :string {
		return convert::rgb_to_hex(
			round($r / 0x33) * 0x33,
			round($g / 0x33) * 0x33,
			round($b / 0x33) * 0x33
		);
	}
}
