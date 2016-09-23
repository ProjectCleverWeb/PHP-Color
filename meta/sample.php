<?php

namespace projectcleverweb\color;

require_once __DIR__.'/../autoload.php';

$colors = [
	// Base Colors
	new main('000000'),
	new main('FFFFFF'),
	new main('FFFF00'),
	new main('FF00FF'),
	new main('FF0000'),
	new main('00FFFF'),
	new main('00FF00'),
	new main('0000FF'),
	// Low Contrast
	new main('7F7F7F'),
	new main('808080'),
	// HSL at 10% increments
	new main(array('h' => 72, 's' => 20, 'l' => 20)),
	new main(array('h' => 108, 's' => 30, 'l' => 30)),
	new main(array('h' => 144, 's' => 40, 'l' => 40)),
	new main(array('h' => 180, 's' => 50, 'l' => 50)),
	new main(array('h' => 216, 's' => 60, 'l' => 60)),
	new main(array('h' => 252, 's' => 70, 'l' => 70)),
	new main(array('h' => 288, 's' => 80, 'l' => 80)),
	new main(array('h' => 324, 's' => 90, 'l' => 90))
];


$colors = array_reverse($colors);

// Scheme functions and their definitions
$funcs = [
	'shades'          => '5 different shades of one color. (unaffected by YIQ)',
	'monochromatic'   => '5 complementary shades of one color. (unaffected by YIQ)',
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
	<div style="height: 5px"></div>
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
$output .= '<div class="sixteen wide column"><div class="ui center aligned header">YIQ vs Standard Schemes <div class="sub header">Standard schemes use equally sized color spaces for red, green, and blue. However, the human eye can\'t see blue as well as it can see red, and it also can\'t see red as well as it can see green. To account for this, schemes can optionally use the YIQ spectrum (which accounts for these differences in the human eye) in their calculations rather than the standard RGB spectrum.</div></div></div>';
foreach ($colors as $i => $color) {
	$rgb         = $color->rgb();
	$hex         = $color->hex();
	$hex_text    = $color->is_dark() ? 'FFFFFF' : '000000';
	$hsl         = $color->hsl();
	$hsb         = $color->hsb();
	$cmyk        = $color->cmyk();
	$background  = sprintf(' style="background: #%s"', $color->is_dark() ? 'FFFFFF' : '282828');
	$header_bg   = $color->is_dark() ? '' : ' inverted';
	$output     .= sprintf(
		'<div class="sixteen wide column"'.$background.'>
			<h2 class="ui black inverted block header" style="background: #%1$s; color: #%2$s;">
				#%1$s
				<div class="sub header" style="color: #%2$s;"><code>rgb(%3$s) / hsl(%4$s) / hsb(%5$s) / cmyk(%6$s)</code></div>
			</h2>
		</div>',
		$hex,
		$hex_text,
		implode(',', array_slice($rgb, 0, 3)),
		implode(',', array_slice($hsl, 0, 3)),
		implode(',', array_slice($hsb, 0, 3)),
		implode(',', array_slice($cmyk, 0, 4))
	);
	foreach ($funcs as $func => $desc) {
		$output .= '<div class="eight wide column"'.$background.'>';
		
		$scheme     = $color->scheme($func, 'hsl');
		$yiq_scheme = $color->yiq_scheme($func, 'hsl');
		$schemes    = array();
		foreach ($scheme as $key => $color_scheme) {
			$color_scheme = new main($color_scheme);
			$yiq_color_scheme = new main($yiq_scheme[$key]);
			$schemes['std'][$key] = array(
				'rgb'  => $color_scheme->rgb(),
				'hex'  => $color_scheme->hex(),
				'text' => $color_scheme->is_dark() ? 'FFFFFF' : '000000'
			);
			$schemes['yiq'][$key] = array(
				'rgb'  => $yiq_color_scheme->rgb(),
				'hex'  => $yiq_color_scheme->hex(),
				'text' => $yiq_color_scheme->is_dark() ? 'FFFFFF' : '000000'
			);
			unset($color_scheme, $yiq_color_scheme);
		}
		
		$adobe = sprintf(
			'https://color.adobe.com/create/color-wheel/?base=2&rule=Custom&selected=2&name=%s&mode=hsv&rgbvalues=%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s&swatchOrder=0,1,2,3,4',
			urlencode(sprintf('Hex %s - %s', $hex, ucwords(str_replace('_', ' ', $func)))),
			$schemes['std'][1]['rgb']['r'] / 255,
			$schemes['std'][1]['rgb']['g'] / 255,
			$schemes['std'][1]['rgb']['b'] / 255,
			$schemes['std'][2]['rgb']['r'] / 255,
			$schemes['std'][2]['rgb']['g'] / 255,
			$schemes['std'][2]['rgb']['b'] / 255,
			$schemes['std'][0]['rgb']['r'] / 255,
			$schemes['std'][0]['rgb']['g'] / 255,
			$schemes['std'][0]['rgb']['b'] / 255,
			$schemes['std'][3]['rgb']['r'] / 255,
			$schemes['std'][3]['rgb']['g'] / 255,
			$schemes['std'][3]['rgb']['b'] / 255,
			$schemes['std'][4]['rgb']['r'] / 255,
			$schemes['std'][4]['rgb']['g'] / 255,
			$schemes['std'][4]['rgb']['b'] / 255
		);
		$yiq_adobe = sprintf(
			'https://color.adobe.com/create/color-wheel/?base=2&rule=Custom&selected=2&name=%s&mode=hsv&rgbvalues=%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s&swatchOrder=0,1,2,3,4',
			urlencode(sprintf('Hex %s - %s', $hex, 'YIQ '.ucwords(str_replace('_', ' ', $func)))),
			$schemes['yiq'][1]['rgb']['r'] / 255,
			$schemes['yiq'][1]['rgb']['g'] / 255,
			$schemes['yiq'][1]['rgb']['b'] / 255,
			$schemes['yiq'][2]['rgb']['r'] / 255,
			$schemes['yiq'][2]['rgb']['g'] / 255,
			$schemes['yiq'][2]['rgb']['b'] / 255,
			$schemes['yiq'][0]['rgb']['r'] / 255,
			$schemes['yiq'][0]['rgb']['g'] / 255,
			$schemes['yiq'][0]['rgb']['b'] / 255,
			$schemes['yiq'][3]['rgb']['r'] / 255,
			$schemes['yiq'][3]['rgb']['g'] / 255,
			$schemes['yiq'][3]['rgb']['b'] / 255,
			$schemes['yiq'][4]['rgb']['r'] / 255,
			$schemes['yiq'][4]['rgb']['g'] / 255,
			$schemes['yiq'][4]['rgb']['b'] / 255
		);
		
		$output .= sprintf(
			'<h3 class="ui'.$header_bg.' header">%s <div class="sub header"><a href="%s" target="_blank">Edit Scheme</a> | <a href="%s" target="_blank">Edit YIQ Scheme</a></div></h3>',
			ucwords(str_replace('_', ' ', $func)),
			$adobe,
			$yiq_adobe
		);
		$output .= sprintf(
			$fmt,
			$i,                         // %1$s
			$schemes['std'][0]['hex'],  // %2$s
			$schemes['std'][0]['text'], // %3$s
			$schemes['std'][1]['hex'],  // %4$s
			$schemes['std'][1]['text'], // %5$s
			$schemes['std'][2]['hex'],  // %6$s
			$schemes['std'][2]['text'], // %7$s
			$schemes['std'][3]['hex'],  // %8$s
			$schemes['std'][3]['text'], // %9$s
			$schemes['std'][4]['hex'],  // %10$s
			$schemes['std'][4]['text']  // %11$s
		);
		if (!in_array($func, array('shades', 'monochromatic'))) {
			$output .= '<div class="eight wide column"><h4 class="ui'.$header_bg.' header">YIQ:</h4></div>'.PHP_EOL;
			$output .= sprintf(
				$fmt,
				$i,                         // %1$s
				$schemes['yiq'][0]['hex'],  // %2$s
				$schemes['yiq'][0]['text'], // %3$s
				$schemes['yiq'][1]['hex'],  // %4$s
				$schemes['yiq'][1]['text'], // %5$s
				$schemes['yiq'][2]['hex'],  // %6$s
				$schemes['yiq'][2]['text'], // %7$s
				$schemes['yiq'][3]['hex'],  // %8$s
				$schemes['yiq'][3]['text'], // %9$s
				$schemes['yiq'][4]['hex'],  // %10$s
				$schemes['yiq'][4]['text']  // %11$s
			);
		} else {
			$output .= '<div class="eight wide column"><h5 class="ui'.$header_bg.' header">YIQ Can\'t Affect This Scheme.</h5></div>'.PHP_EOL;
		}
		$output .= '</div>';
	}
}
$output .= '</div>';

file_put_contents(__DIR__.'/sample.html', $output);
