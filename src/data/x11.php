<?php
/**
 * X11 Data Class
 * ================
 * Stores data for importing X11 colors.
 */

namespace projectcleverweb\color\data;

/**
 * X11 Data Class
 * ================
 * Stores data for importing X11 colors.
 */
class x11 {
	
	/**
	 * Array mapping of all the X11 colors to RGB
	 * @var array
	 */
	public static $map = array(
		'aliceblue'            => array('r' => 240, 'g' => 248, 'b' => 255),
		'antiquewhite'         => array('r' => 250, 'g' => 235, 'b' => 215),
		'aqua'                 => array('r' => 0, 'g' => 255, 'b' => 255),
		'aquamarine'           => array('r' => 127, 'g' => 255, 'b' => 212),
		'azure'                => array('r' => 240, 'g' => 255, 'b' => 255),
		'beige'                => array('r' => 245, 'g' => 245, 'b' => 220),
		'bisque'               => array('r' => 255, 'g' => 228, 'b' => 196),
		'black'                => array('r' => 0, 'g' => 0, 'b' => 0),
		'blanchedalmond'       => array('r' => 255, 'g' => 235, 'b' => 205),
		'blue'                 => array('r' => 0, 'g' => 0, 'b' => 255),
		'blueviolet'           => array('r' => 138, 'g' => 43, 'b' => 226),
		'brown'                => array('r' => 165, 'g' => 42, 'b' => 42),
		'burlywood'            => array('r' => 222, 'g' => 184, 'b' => 135),
		'cadetblue'            => array('r' => 95, 'g' => 158, 'b' => 160),
		'chartreuse'           => array('r' => 127, 'g' => 255, 'b' => 0),
		'chocolate'            => array('r' => 210, 'g' => 105, 'b' => 30),
		'coral'                => array('r' => 255, 'g' => 127, 'b' => 80),
		'cornflowerblue'       => array('r' => 100, 'g' => 149, 'b' => 237),
		'cornsilk'             => array('r' => 255, 'g' => 248, 'b' => 220),
		'crimson'              => array('r' => 220, 'g' => 20, 'b' => 60),
		'cyan'                 => array('r' => 0, 'g' => 255, 'b' => 255),
		'darkblue'             => array('r' => 0, 'g' => 0, 'b' => 139),
		'darkcyan'             => array('r' => 0, 'g' => 139, 'b' => 139),
		'darkgoldenrod'        => array('r' => 184, 'g' => 134, 'b' => 11),
		'darkgray'             => array('r' => 169, 'g' => 169, 'b' => 169),
		'darkgreen'            => array('r' => 0, 'g' => 100, 'b' => 0),
		'darkgrey'             => array('r' => 169, 'g' => 169, 'b' => 169),
		'darkkhaki'            => array('r' => 189, 'g' => 183, 'b' => 107),
		'darkmagenta'          => array('r' => 139, 'g' => 0, 'b' => 139),
		'darkolivegreen'       => array('r' => 85, 'g' => 107, 'b' => 47),
		'darkorange'           => array('r' => 255, 'g' => 140, 'b' => 0),
		'darkorchid'           => array('r' => 153, 'g' => 50, 'b' => 204),
		'darkred'              => array('r' => 139, 'g' => 0, 'b' => 0),
		'darksalmon'           => array('r' => 233, 'g' => 150, 'b' => 122),
		'darkseagreen'         => array('r' => 143, 'g' => 188, 'b' => 143),
		'darkslateblue'        => array('r' => 72, 'g' => 61, 'b' => 139),
		'darkslategray'        => array('r' => 47, 'g' => 79, 'b' => 79),
		'darkslategrey'        => array('r' => 47, 'g' => 79, 'b' => 79),
		'darkturquoise'        => array('r' => 0, 'g' => 206, 'b' => 209),
		'darkviolet'           => array('r' => 148, 'g' => 0, 'b' => 211),
		'deeppink'             => array('r' => 255, 'g' => 20, 'b' => 147),
		'deepskyblue'          => array('r' => 0, 'g' => 191, 'b' => 255),
		'dimgray'              => array('r' => 105, 'g' => 105, 'b' => 105),
		'dimgrey'              => array('r' => 105, 'g' => 105, 'b' => 105),
		'dodgerblue'           => array('r' => 30, 'g' => 144, 'b' => 255),
		'firebrick'            => array('r' => 178, 'g' => 34, 'b' => 34),
		'floralwhite'          => array('r' => 255, 'g' => 250, 'b' => 240),
		'forestgreen'          => array('r' => 34, 'g' => 139, 'b' => 34),
		'fuchsia'              => array('r' => 255, 'g' => 0, 'b' => 255),
		'gainsboro'            => array('r' => 220, 'g' => 220, 'b' => 220),
		'ghostwhite'           => array('r' => 248, 'g' => 248, 'b' => 255),
		'gold'                 => array('r' => 255, 'g' => 215, 'b' => 0),
		'goldenrod'            => array('r' => 218, 'g' => 165, 'b' => 32),
		'gray'                 => array('r' => 128, 'g' => 128, 'b' => 128),
		'green'                => array('r' => 0, 'g' => 128, 'b' => 0),
		'greenyellow'          => array('r' => 173, 'g' => 255, 'b' => 47),
		'grey'                 => array('r' => 128, 'g' => 128, 'b' => 128),
		'honeydew'             => array('r' => 240, 'g' => 255, 'b' => 240),
		'hotpink'              => array('r' => 255, 'g' => 105, 'b' => 180),
		'indianred'            => array('r' => 205, 'g' => 92, 'b' => 92),
		'indigo'               => array('r' => 75, 'g' => 0, 'b' => 130),
		'ivory'                => array('r' => 255, 'g' => 255, 'b' => 240),
		'khaki'                => array('r' => 240, 'g' => 230, 'b' => 140),
		'lavender'             => array('r' => 230, 'g' => 230, 'b' => 250),
		'lavenderblush'        => array('r' => 255, 'g' => 240, 'b' => 245),
		'lawngreen'            => array('r' => 124, 'g' => 252, 'b' => 0),
		'lemonchiffon'         => array('r' => 255, 'g' => 250, 'b' => 205),
		'lightblue'            => array('r' => 173, 'g' => 216, 'b' => 230),
		'lightcoral'           => array('r' => 240, 'g' => 128, 'b' => 128),
		'lightcyan'            => array('r' => 224, 'g' => 255, 'b' => 255),
		'lightgoldenrodyellow' => array('r' => 250, 'g' => 250, 'b' => 210),
		'lightgray'            => array('r' => 211, 'g' => 211, 'b' => 211),
		'lightgreen'           => array('r' => 144, 'g' => 238, 'b' => 144),
		'lightgrey'            => array('r' => 211, 'g' => 211, 'b' => 211),
		'lightpink'            => array('r' => 255, 'g' => 182, 'b' => 193),
		'lightsalmon'          => array('r' => 255, 'g' => 160, 'b' => 122),
		'lightseagreen'        => array('r' => 32, 'g' => 178, 'b' => 170),
		'lightskyblue'         => array('r' => 135, 'g' => 206, 'b' => 250),
		'lightslategray'       => array('r' => 119, 'g' => 136, 'b' => 153),
		'lightslategrey'       => array('r' => 119, 'g' => 136, 'b' => 153),
		'lightsteelblue'       => array('r' => 176, 'g' => 196, 'b' => 222),
		'lightyellow'          => array('r' => 255, 'g' => 255, 'b' => 224),
		'lime'                 => array('r' => 0, 'g' => 255, 'b' => 0),
		'limegreen'            => array('r' => 50, 'g' => 205, 'b' => 50),
		'linen'                => array('r' => 250, 'g' => 240, 'b' => 230),
		'magenta'              => array('r' => 255, 'g' => 0, 'b' => 255),
		'maroon'               => array('r' => 128, 'g' => 0, 'b' => 0),
		'mediumaquamarine'     => array('r' => 102, 'g' => 205, 'b' => 170),
		'mediumblue'           => array('r' => 0, 'g' => 0, 'b' => 205),
		'mediumorchid'         => array('r' => 186, 'g' => 85, 'b' => 211),
		'mediumpurple'         => array('r' => 147, 'g' => 112, 'b' => 219),
		'mediumseagreen'       => array('r' => 60, 'g' => 179, 'b' => 113),
		'mediumslateblue'      => array('r' => 123, 'g' => 104, 'b' => 238),
		'mediumspringgreen'    => array('r' => 0, 'g' => 250, 'b' => 154),
		'mediumturquoise'      => array('r' => 72, 'g' => 209, 'b' => 204),
		'mediumvioletred'      => array('r' => 199, 'g' => 21, 'b' => 133),
		'midnightblue'         => array('r' => 25, 'g' => 25, 'b' => 112),
		'mintcream'            => array('r' => 245, 'g' => 255, 'b' => 250),
		'mistyrose'            => array('r' => 255, 'g' => 228, 'b' => 225),
		'moccasin'             => array('r' => 255, 'g' => 228, 'b' => 181),
		'navajowhite'          => array('r' => 255, 'g' => 222, 'b' => 173),
		'navy'                 => array('r' => 0, 'g' => 0, 'b' => 128),
		'oldlace'              => array('r' => 253, 'g' => 245, 'b' => 230),
		'olive'                => array('r' => 128, 'g' => 128, 'b' => 0),
		'olivedrab'            => array('r' => 107, 'g' => 142, 'b' => 35),
		'orange'               => array('r' => 255, 'g' => 165, 'b' => 0),
		'orangered'            => array('r' => 255, 'g' => 69, 'b' => 0),
		'orchid'               => array('r' => 218, 'g' => 112, 'b' => 214),
		'palegoldenrod'        => array('r' => 238, 'g' => 232, 'b' => 170),
		'palegreen'            => array('r' => 152, 'g' => 251, 'b' => 152),
		'paleturquoise'        => array('r' => 175, 'g' => 238, 'b' => 238),
		'palevioletred'        => array('r' => 219, 'g' => 112, 'b' => 147),
		'papayawhip'           => array('r' => 255, 'g' => 239, 'b' => 213),
		'peachpuff'            => array('r' => 255, 'g' => 218, 'b' => 185),
		'peru'                 => array('r' => 205, 'g' => 133, 'b' => 63),
		'pink'                 => array('r' => 255, 'g' => 192, 'b' => 203),
		'plum'                 => array('r' => 221, 'g' => 160, 'b' => 221),
		'powderblue'           => array('r' => 176, 'g' => 224, 'b' => 230),
		'purple'               => array('r' => 128, 'g' => 0, 'b' => 128),
		'red'                  => array('r' => 255, 'g' => 0, 'b' => 0),
		'rosybrown'            => array('r' => 188, 'g' => 143, 'b' => 143),
		'royalblue'            => array('r' => 65, 'g' => 105, 'b' => 225),
		'saddlebrown'          => array('r' => 139, 'g' => 69, 'b' => 19),
		'salmon'               => array('r' => 250, 'g' => 128, 'b' => 114),
		'sandybrown'           => array('r' => 244, 'g' => 164, 'b' => 96),
		'seagreen'             => array('r' => 46, 'g' => 139, 'b' => 87),
		'seashell'             => array('r' => 255, 'g' => 245, 'b' => 238),
		'sienna'               => array('r' => 160, 'g' => 82, 'b' => 45),
		'silver'               => array('r' => 192, 'g' => 192, 'b' => 192),
		'skyblue'              => array('r' => 135, 'g' => 206, 'b' => 235),
		'slateblue'            => array('r' => 106, 'g' => 90, 'b' => 205),
		'slategray'            => array('r' => 112, 'g' => 128, 'b' => 144),
		'slategrey'            => array('r' => 112, 'g' => 128, 'b' => 144),
		'snow'                 => array('r' => 255, 'g' => 250, 'b' => 250),
		'springgreen'          => array('r' => 0, 'g' => 255, 'b' => 127),
		'steelblue'            => array('r' => 70, 'g' => 130, 'b' => 180),
		'tan'                  => array('r' => 210, 'g' => 180, 'b' => 140),
		'teal'                 => array('r' => 0, 'g' => 128, 'b' => 128),
		'thistle'              => array('r' => 216, 'g' => 191, 'b' => 216),
		'tomato'               => array('r' => 255, 'g' => 99, 'b' => 71),
		'turquoise'            => array('r' => 64, 'g' => 224, 'b' => 208),
		'violet'               => array('r' => 238, 'g' => 130, 'b' => 238),
		'wheat'                => array('r' => 245, 'g' => 222, 'b' => 179),
		'white'                => array('r' => 255, 'g' => 255, 'b' => 255),
		'whitesmoke'           => array('r' => 245, 'g' => 245, 'b' => 245),
		'yellow'               => array('r' => 255, 'g' => 255, 'b' => 0),
		'yellowgreen'          => array('r' => 154, 'g' => 205, 'b' => 50)
	);
	
	/**
	 * Gets a X11 color as RGB if it exists, otherwise returns FALSE.
	 * 
	 * @param  string     $color The color name to search for
	 * @return array|bool        Returns a RGB color array if it exists, FALSE otherwise.
	 */
	public static function get(string $color) {
		$color = strtolower(trim($color));
		if (isset(static::$map[$color])) {
			return static::$map[$color];
		}
		return FALSE;
	}
}
