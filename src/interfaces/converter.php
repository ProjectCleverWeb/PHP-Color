<?php
/**
 * Conversion Class
 * ================
 * Responsible for all the conversion method between Hex, RGB, HSL, HSB, and CMYK
 */

namespace projectcleverweb\color\interfaces;

/**
 * Conversion Class
 * ================
 * Responsible for all the conversion method between Hex, RGB, HSL, HSB, and CMYK
 */
interface converter {
	public static function to_rgb($input) :array;
	public static function to_hex($input) :string;
	public static function to_cmyk($input) :array;
	public static function to_hsl($input) :array;
	public static function to_hsb($input) :array;
	// public static function to_yiq($input) :array;
	// public static function to_xyz($input) :array;
	// public static function to_yxy($input) :array;
	// public static function to_ypbpr($input) :array;
	// public static function to_yuv($input) :array;
	// public static function to_pal($input) :array;
	// public static function to_ydbdr($input) :array;
	// public static function to_ycbcr($input) :array;
	// public static function to_xvycc($input) :array;
	// public static function to_lab($input) :array;
	// public static function to_hunter_lab($input) :array;
	// public static function to_luv($input) :array;
	// public static function to_uvw($input) :array;
	// public static function to_lms($input) :array;
}
