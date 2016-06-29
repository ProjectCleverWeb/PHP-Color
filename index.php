<?php

require_once __DIR__.'/../autoload.php';


function hexrgb_rand($min_r = 0, $max_r = 255, $min_g = 0, $max_g = 255, $min_b = 0, $max_b = 255) {
	$hex_arr = array(
		rand(abs((int) $min_r) % 256, abs((int) $max_r) % 256),
		rand(abs((int) $min_g) % 256, abs((int) $max_g) % 256),
		rand(abs((int) $min_b) % 256, abs((int) $max_b) % 256)
	);
	$result = '';
	foreach ($hex_arr as $int) {
		$result .= str_pad(base_convert($int, 10, 16), 2, '0', STR_PAD_LEFT);
	}
	return strtoupper($result);
}

function hexrgb_invert($hex) {
	$arr = str_split($hex, 2);
	foreach ($arr as &$value) {
		$c = base_convert($value, 16, 10);
		$value = str_pad(base_convert(255 - $c, 10, 16), 2, '0', STR_PAD_LEFT);
	}
	list($r, $g, $b) = $arr;
	return implode('', $arr);
}

function hexrgb_is_dark($hex) {
	$r = hexdec(substr($hex,0,2));
	$g = hexdec(substr($hex,2,2));
	$b = hexdec(substr($hex,4,2));
	$yiq = (($r*299)+($g*587)+($b*114))/1000;
	return ($yiq >= 128) ? FALSE : TRUE;
}

// $fmt = '<div style="background: #%1$s; color: #%3$s;">%1$s / <span style="color: #%2$s;">%2$s</span> / %3$s</div>';
// foreach (range(1,50) as $i) {
// 	$c1 = hexrgb_rand();
// 	$c2 = hexrgb_invert($c1);
// 	$c3 = hexrgb_is_dark($c1) ? 'ffffff' : '000000';
// 	printf($fmt, $c1, $c2, $c3);
// }


foreach (range(1, 50) as $i) {
	$a = hexrgb_rand();
	printf('#%s - ', $a);
	new main($a);
}


// $test_a = ['r' => 128, 'g' => 128, 'b' => 128];
// $test_a = generate::hex_to_rgb('8be674');
// $best = [
// 	'color' => ['r' => 128, 'g' => 128, 'b' => 128],
// 	'diff'  => 0.0
// ];
// foreach (range(0, 255) as $r) {
// 	foreach (range(0, 255) as $g) {
// 		foreach (range(0, 255) as $b) {
// 			$test_b = ['r' => $r, 'g' => $g, 'b' => $b];
// 			// YQI sensitive contrast check
// 			$diff = check::rgb_contrast($test_a, $test_b);
// 			if ($diff > $best['diff']) {
// 				$best = [
// 					'color' => $test_b,
// 					'diff'  => $diff
// 				];
// 			}
// 		}
// 	}
// }
// var_dump($best);


