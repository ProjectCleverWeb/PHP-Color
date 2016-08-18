<?php

namespace projectcleverweb\color;

require_once __DIR__.'/../autoload.php';

$colors = [
	// Base Colors
	'000000',
	'FFFFFF',
	'FFFF00',
	'FF00FF',
	'FF0000',
	'00FFFF',
	'00FF00',
	'0000FF',
	// Low Contrast
	'7F7F7F',
	'808080',
	// HSL at 10% incrementsconverthsl_to_rgb(36, 10, 10),
	convert::hsl_to_rgb(72, 20, 20),
	convert::hsl_to_rgb(108, 30, 30),
	convert::hsl_to_rgb(144, 40, 40),
	convert::hsl_to_rgb(180, 50, 50),
	convert::hsl_to_rgb(216, 60, 60),
	convert::hsl_to_rgb(252, 70, 70),
	convert::hsl_to_rgb(288, 80, 80),
	convert::hsl_to_rgb(324, 90, 90)
];

foreach ($colors as &$color) {
	if (is_array($color)) {
		$color = convert::rgb_to_hex($color['r'], $color['g'], $color['b']);
	}
	$color = convert::hex_to_rgb($color);
}
$colors = array_reverse($colors);

// Scheme functions and their definitions
$funcs = [
	'shades'          => '5 different shades of one color.',
	'monochromatic'   => '5 complementary shades of one color.',
	'analogous'       => 'These colors are all close to each other on a color wheel.',
	'complementary'   => '2 of these colors are a different shade of the base color. The other 2 are a weighted opposite of the base color.',
	'triad'           => 'These colors are all equally distanced from each other on a color wheel, 2 of which have an alternate shade.',
	'weighted_triad'  => 'These colors are all similarly distanced from each other on a color wheel, 2 of which have an alternate shade. These colors are all slightly closer to the base color than in a normal triad.',
	'tetrad'          => '3 of these colors are all equally distanced from each other on a color wheel, plus 1 alternated shade for the base color and the 1 color that is opposite of the base color.',
	'weighted_tetrad' => '3 of these colors are all similarly distanced from each other on a color wheel, the base color has an alternate shade, and there is a weighted opposite color. These colors are all slightly closer to the base color than in a normal tetrad.',
	'compound'        => 'These colors use mathematical offsets that usually complement each other well, and can highlight the base color.',
	'rectangular'     => '4 of these colors form a rectangle on a color wheel, and 1 color is an alternate shade for the base color.'
];
$fmt =
'<div class="eight wide column">
	<div class="ui five buttons">
		<a href="http://rgb.to/hex/%4$s" target="_blank" class="ui button" style="background: #%4$s; color: #%5$s;">#%4$s</a>
		<a href="http://rgb.to/hex/%6$s" target="_blank" class="ui button" style="background: #%6$s; color: #%7$s;">#%6$s</a>
		<a href="http://rgb.to/hex/%2$s" target="_blank" class="ui button" style="background: #%2$s; color: #%3$s;">#%2$s</a>
		<a href="http://rgb.to/hex/%8$s" target="_blank" class="ui button" style="background: #%8$s; color: #%9$s;">#%8$s</a>
		<a href="http://rgb.to/hex/%10$s" target="_blank" class="ui button" style="background: #%10$s; color: #%11$s;">#%10$s</a>
	</div>
</div>'.PHP_EOL;
$output = '<div class="ui grid">';
$output .= '<div class="sixteen wide column"><h1 class="ui black inverted block header">Scheme Descriptions</h1></div>';
foreach ($funcs as $name => $desc) {
	$output .= '<div class="eight wide column">';
	$output .= sprintf(
		'<div class="ui header">%s <div class="sub header">%s</div></div>',
		ucwords(str_replace('_', ' ', $name)),
		$desc
	);
	$output .= '</div>';
}
foreach ($colors as $i => $rgb) {
	$hex       = convert::rgb_to_hex($rgb['r'], $rgb['g'], $rgb['b']);
	$hex_text  = check::is_dark($rgb['r'], $rgb['g'], $rgb['b']) ? 'FFFFFF' : '000000';
	$hsl       = array_map('round', convert::rgb_to_hsl($rgb['r'], $rgb['g'], $rgb['b']));
	$cmyk      = convert::rgb_to_cmyk($rgb['r'], $rgb['g'], $rgb['b']);
	$output   .= sprintf(
		'<div class="sixteen wide column"><h2 class="ui black inverted block header" style="background: #%1$s; color: #%2$s;">Color: #%1$s &mdash; rgb(%3$s) &mdash; hsl(%4$s) &mdash; cmyk(%5$s)</h2></div>',
		$hex,
		$hex_text,
		implode(',', $rgb),
		implode(',', $hsl),
		implode(',', $cmyk)
	);
	foreach ($funcs as $func => $desc) {
		$output .= '<div class="eight wide column">';
		
		// $scheme     = scheme::weighted_triad($hsl['h'], $hsl['s'], $hsl['l']);
		$scheme     = call_user_func_array(['projectcleverweb\\color\\scheme', $func.'_set'], [$hsl['h'], $hsl['s'], $hsl['l']]);
		$rgb0       = convert::hsl_to_rgb($scheme[0]['h'], $scheme[0]['s'], $scheme[0]['l']);
		$hex0_text  = check::is_dark($rgb0['r'], $rgb0['g'], $rgb0['b']) ? 'FFFFFF' : '000000';
		$hex0       = convert::rgb_to_hex($rgb0['r'], $rgb0['g'], $rgb0['b']);
		$rgb1       = convert::hsl_to_rgb($scheme[1]['h'], $scheme[1]['s'], $scheme[1]['l']);
		$hex1_text  = check::is_dark($rgb1['r'], $rgb1['g'], $rgb1['b']) ? 'FFFFFF' : '000000';
		$hex1       = convert::rgb_to_hex($rgb1['r'], $rgb1['g'], $rgb1['b']);
		$rgb2       = convert::hsl_to_rgb($scheme[2]['h'], $scheme[2]['s'], $scheme[2]['l']);
		$hex2_text  = check::is_dark($rgb2['r'], $rgb2['g'], $rgb2['b']) ? 'FFFFFF' : '000000';
		$hex2       = convert::rgb_to_hex($rgb2['r'], $rgb2['g'], $rgb2['b']);
		$rgb3       = convert::hsl_to_rgb($scheme[3]['h'], $scheme[3]['s'], $scheme[3]['l']);
		$hex3_text  = check::is_dark($rgb3['r'], $rgb3['g'], $rgb3['b']) ? 'FFFFFF' : '000000';
		$hex3       = convert::rgb_to_hex($rgb3['r'], $rgb3['g'], $rgb3['b']);
		$rgb4       = convert::hsl_to_rgb($scheme[4]['h'], $scheme[4]['s'], $scheme[4]['l']);
		$hex4_text  = check::is_dark($rgb4['r'], $rgb4['g'], $rgb4['b']) ? 'FFFFFF' : '000000';
		$hex4       = convert::rgb_to_hex($rgb4['r'], $rgb4['g'], $rgb4['b']);
		$check      = array_unique([$hex0, $hex1, $hex2, $hex3, $hex4]);
		$adobe = sprintf(
			'https://color.adobe.com/create/color-wheel/?base=2&rule=Custom&selected=2&name=%s&mode=hsv&rgbvalues=%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s&swatchOrder=0,1,2,3,4',
			urlencode(sprintf('Hex %s - %s', $hex, ucwords(str_replace('_', ' ', $func)))),
			$rgb1['r'] / 255,
			$rgb1['g'] / 255,
			$rgb1['b'] / 255,
			$rgb2['r'] / 255,
			$rgb2['g'] / 255,
			$rgb2['b'] / 255,
			$rgb0['r'] / 255,
			$rgb0['g'] / 255,
			$rgb0['b'] / 255,
			$rgb3['r'] / 255,
			$rgb3['g'] / 255,
			$rgb3['b'] / 255,
			$rgb4['r'] / 255,
			$rgb4['g'] / 255,
			$rgb4['b'] / 255
		);
		$output .= sprintf(
			'<h3 class="ui header">%s <div class="sub header"><a href="%s" target="_blank">Edit This Scheme</a></div></h3>',
			ucwords(str_replace('_', ' ', $func)),
			$adobe
		);
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
		$output .= '</div>';
	}
}
$output .= '</div>';

file_put_contents(__DIR__.'/sample.html', $output);
