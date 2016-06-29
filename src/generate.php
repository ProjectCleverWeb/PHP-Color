<?php


namespace projectcleverweb\color;


class generate {
	
	public static function expand_shorthand(string $hex) :string {
		if (strlen($hex) === 3) {
			$r = $hex[0];
			$g = $hex[1];
			$b = $hex[2];
			return $r.$r.$g.$g.$b.$b;
		}
		return $hex;
	}
	
	public static function hex_to_rgb(string $hex) :array {
		return [
			'r' => hexdec(substr($hex, 0, 2)),
			'g' => hexdec(substr($hex, 2, 2)),
			'b' => hexdec(substr($hex, 4, 2))
		];
	}
	
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
	
	public static function rand($min_r = 0, $max_r = 255, $min_g = 0, $max_g = 255, $min_b = 0, $max_b = 255) :string {
		$hex_arr = [
			rand(abs((int) $min_r) % 256, abs((int) $max_r) % 256),
			rand(abs((int) $min_g) % 256, abs((int) $max_g) % 256),
			rand(abs((int) $min_b) % 256, abs((int) $max_b) % 256)
		];
		$result = '';
		foreach ($hex_arr as $int) {
			$result .= str_pad(base_convert($int, 10, 16), 2, '0');
		}
		return $result;
	}
	
}
