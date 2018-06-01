<?php

// Configure File
namespace projectcleverweb\color;
use \projectcleverweb\color\_interface\object;
use \projectcleverweb\color\blend;
use \projectcleverweb\color\gradient;
use \projectcleverweb\color\palette;
use \projectcleverweb\color\data\store;
use \projectcleverweb\color\data\configuration;
use \projectcleverweb\color\_trait\configuration_support;
use \projectcleverweb\color\_trait\cache_support;
use \projectcleverweb\color\_trait\generate_color_support;
use \projectcleverweb\color\_trait\export_support;

/**
 * Color
 * =====
 * This class is for working with a singular color
 */
class color implements object {
	use configuration_support;
	use cache_support;
	use generate_color_support;
	use export_support;
	
	/**
	 * The current version number
	 * @see https://semver.org/
	 */
	const VERSION = '1.0.0';
	
	/**
	 * The default configuration array for this class
	 */
	const CONFIGURATION_DEFAULT = array(
		'precision' => 14, // Default for most PHP installations; Don't go higher 14 unless you know what you're doing
		'cache'     => array(
			'active' => TRUE,
			'method' => 'memory',
		)
	);
	
	/**
	 * The default configuration array for this class
	 */
	const CONFIGURATION_SPEC = array(
		'precision' => 'range:0,32',
		'cache'     => array(
			'active' => 'bool',
			'method' => 'enum_string:none,memory,redis,memcached',
		)
	);
	
	const EXPORT_CONFIGURATION = array(
		'callbacks' => array(
			'rgb' => array(__NAMESPACE__.'\\convert', 'to_rgb')
		)
	);
	
	const CACHE_PREFIX = 'COLOR_';
	
	/**
	 * An instance of a supported caching method
	 * @var data\configuration
	 */
	protected $configuration;
	
	/**
	 * Stores the data about the current color
	 * @var data\store
	 */
	protected $store;
	
	/**
	 * An instance of a supported caching method
	 * @var _abstract/cache
	 */
	protected static $cache;
	
	/**
	 * Setup color and cache for this object
	 * 
	 * @param mixed  $color A color described as Hex string or int, RGB array, HSL array, HSB array, CMYK array, or instance of color
	 * @param string $type  The type of color to process $color as
	 */
	public function __construct($color, string $type = NULL, configuration $configuration = NULL) {
		static::configuration_import($this, $configuration ?? new configuration(array())); // from _trait\configuration_support
		// static::cache_initialize($this); // from _trait\cache_support
		// $this->import($color, $type);
	}
	
	public function import($color = NULL, $type = NULL, bool $no_cache = FALSE) :color {
		
	}
	
	public function export(string $type) {
		return static::export_data($type, $this);
	}
	
	public function set(string $attribute, string $value) :color {
		
	}
	
	public function add(string $attribute, string $value) :color {
		
	}
	
	public function subtract(string $attribute, string $value) :color {
		
	}
	
	public function is(string $attribute) :bool {
		
	}
	
	// public function blend(color $color, configuration $configuration = NULL) :blend {
	// 	return blend::from($this, $color, $configuration);
	// }
	
	// public function gradient(color $color, configuration $configuration = NULL) :gradient {
	// 	return new gradient($this, $color, $configuration);
	// }
	
	// public function palette(configuration $configuration = NULL) :palette {
	// 	return new palette($this, $configuration);
	// }
	
	public static function generate(configuration $configuration = NULL) :color {
		
	}
	
	public static function cache(string $action) :bool {
		
	}
	
	protected static function _cache_update($instance) {
		if (!$instance->configuration['cache']['active']) {
			return;
		}
		static::cache_add($instance->export_as('hexa'), $instance->data); // from _trait\cache_support
	}
	
	protected static function _import($color, $type) :color {
		
		static::_cache_update($this);
		return $this;
	}
}
