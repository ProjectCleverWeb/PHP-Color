<?php

namespace projectcleverweb\color;

require_once __DIR__.'/autoload.php';


// $fmt = '<div style="background: #%1$s; color: #%3$s;">%1$s / <span style="color: #%2$s;">%2$s</span> / %3$s</div>';
// foreach (range(1,50) as $i) {
// 	$c1 = hexrgb_rand();
// 	$c2 = hexrgb_invert($c1);
// 	$c3 = hexrgb_is_dark($c1) ? 'ffffff' : '000000';
// 	printf($fmt, $c1, $c2, $c3);
// }

$output = '<h1 class="ui header">Weighted Triad</h1>';

$fmt =
'<div class="eight wide column">
		<div class="ui top attached fluid button" style="background: #%2$s; color: #%3$s;">%1$s &ndash; #%2$s</div>
		<div class="ui five attached buttons" style="border: solid 3px #000; z-index: 10">
			<span class="ui button" style="background: #%4$s; color: #%5$s;">&nbsp;</span>
			<span class="ui button" style="background: #%6$s; color: #%7$s;">&nbsp;</span>
			<span class="ui button" style="background: #%2$s; color: #%3$s;">&nbsp;</span>
			<span class="ui button" style="background: #%8$s; color: #%9$s;">&nbsp;</span>
			<span class="ui button" style="background: #%10$s; color: #%11$s;">&nbsp;</span>
		</div>
		<div class="ui five bottom attached buttons">
			<span class="ui button" style="background: #%4$s; color: #%5$s;">#%4$s</span>
			<span class="ui button" style="background: #%6$s; color: #%7$s;">#%6$s</span>
			<span class="ui button" style="background: #%2$s; color: #%3$s;">&nbsp;</span>
			<span class="ui button" style="background: #%8$s; color: #%9$s;">#%8$s</span>
			<span class="ui button" style="background: #%10$s; color: #%11$s;">#%10$s</span>
		</div>
	</div>'.PHP_EOL;
$output .= '<div class="ui grid">';
foreach (range(1, 200) as $i) {
	$rgb       = generate::rand();
	// $rgb       = generate::hex_to_rgb('000000');
	$hex       = generate::rgb_to_hex($rgb['r'], $rgb['g'], $rgb['b']);
	$hsl       = hsl::rgb_to_hsl($rgb['r'], $rgb['g'], $rgb['b']);
	$cmyk      = generate::rgb_to_cmyk($rgb['r'], $rgb['g'], $rgb['b']);
	$scheme    = scheme::weighted_triad($hsl['h'], $hsl['s'], $hsl['l']);
	$rgb0      = hsl::hsl_to_rgb($scheme[0][0], $scheme[0][1], $scheme[0][2]);
	$hex0_text = check::is_dark($rgb0['r'], $rgb0['g'], $rgb0['b']) ? 'FFFFFF' : '000000';
	$hex0      = generate::rgb_to_hex($rgb0['r'], $rgb0['g'], $rgb0['b']);
	$rgb1      = hsl::hsl_to_rgb($scheme[1][0], $scheme[1][1], $scheme[1][2]);
	$hex1_text = check::is_dark($rgb1['r'], $rgb1['g'], $rgb1['b']) ? 'FFFFFF' : '000000';
	$hex1      = generate::rgb_to_hex($rgb1['r'], $rgb1['g'], $rgb1['b']);
	$rgb2      = hsl::hsl_to_rgb($scheme[2][0], $scheme[2][1], $scheme[2][2]);
	$hex2_text = check::is_dark($rgb2['r'], $rgb2['g'], $rgb2['b']) ? 'FFFFFF' : '000000';
	$hex2      = generate::rgb_to_hex($rgb2['r'], $rgb2['g'], $rgb2['b']);
	$rgb3      = hsl::hsl_to_rgb($scheme[3][0], $scheme[3][1], $scheme[3][2]);
	$hex3_text = check::is_dark($rgb3['r'], $rgb3['g'], $rgb3['b']) ? 'FFFFFF' : '000000';
	$hex3      = generate::rgb_to_hex($rgb3['r'], $rgb3['g'], $rgb3['b']);
	$rgb4      = hsl::hsl_to_rgb($scheme[4][0], $scheme[4][1], $scheme[4][2]);
	$hex4_text = check::is_dark($rgb4['r'], $rgb4['g'], $rgb4['b']) ? 'FFFFFF' : '000000';
	$hex4      = generate::rgb_to_hex($rgb4['r'], $rgb4['g'], $rgb4['b']);
	$check = array_unique([$hex0, $hex1, $hex2, $hex3, $hex4]);
	if (count($check) != 5) {
		$output .= '<div class="sixteen wide column"><div class="ui red fluid button">Duplicate Colors</div></div>';
	}
	$output .= sprintf(
		$fmt,
		$i,         // %1$s
		$hex0,      // %2$s
		$hex0_text, // %3$s
		$hex1,      // %4$s
		$hex1_text, // %5$s
		$hex2,      // %6$s
		$hex2_text, // %7$s
		$hex3,      // %8$s
		$hex3_text, // %9$s
		$hex4,      // %10$s
		$hex4_text  // %11$s
	);
}
$output .= '</div>';

file_put_contents('./sample.html', $output);

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


