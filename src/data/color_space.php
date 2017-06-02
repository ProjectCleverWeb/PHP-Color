<?php
/**
 * Color Space Data Model
 * ======================
 * This class acts a momentary data model cache. This is so once a conversion is
 * done once for a color it won't need to be done again. (as long as the color
 * doesn't change)
 */

namespace projectcleverweb\color\data;

use \projectcleverweb\color\error;
use \projectcleverweb\color\validate;

/**
 * Color Space Data Model
 * ======================
 * This class acts a momentary data model cache. This is so once a conversion is
 * done once for a color it won't need to be done again. (as long as the color
 * doesn't change)
 */
abstract class color_space extends \ArrayObject implements \JsonSerializable {
	
	/**
	 * The name of the current color space
	 * @var string
	 */
	protected static $name = '';
	
	/**
	 * The specification for each key of the color space
	 * @var array
	 */
	protected static $specs = array();
	
	/**
	 * Import an array as the current color space
	 * 
	 * @param array $input The color array to import
	 */
	public function __construct(array $input) {
		parent::__construct(array(), \ArrayObject::STD_PROP_LIST | \ArrayObject::ARRAY_AS_PROPS);
		static::_check_specs(static::$specs);
		$this->exchangeArray($input);
	}
	
	/**
	 * Get the name of the current color space
	 * 
	 * @return string The current color space
	 */
	public static function name() :string {
		return static::$name;
	}
	
	/**
	 * Export the array in its intended format
	 * 
	 * @return array The formatted color array
	 */
	public function export() :array {
		$data = $this->getArrayCopy();
		foreach ($data as $key => &$value) {
			if (!static::$spec[$key]['allow_float']) {
				$value = round($value);
			}
		}
		return $data;
	}
	
	/**
	 * Import a value according to its specification
	 * 
	 * @param  array  $value The value to import
	 * @param  string $key   The key being imported
	 * @param  array  $spec  The specification to follow
	 * @return void
	 */
	protected function _import_input(float $value, string $key, array $spec) {
		if (isset($value)) {
			parent::offsetSet($key, static::_run_spec($value, $key, $spec));
		} else {
			parent::offsetSet($key, $spec['min']);
		}
	}
	
	/**
	 * Check that the color space child class was correctly configured
	 * 
	 * @param  array &$specs The specification array to check
	 * @return void
	 */
	protected static function _check_specs(&$specs) {
		if (empty($specs['checked'])) {
			foreach ($specs as $key => &$spec) {
				static::_check_spec_name($spec['name'] ?? NULL, $key);
				static::_check_spec_minmax($spec['min'] ?? NULL, $spec['max'] ?? NULL, $key);
				static::_check_spec_overflow($spec['overflow_method'], $key);
				$spec['min']            = (float) $spec['min'];
				$spec['max']            = (float) $spec['max'];
				$spec['allow_negative'] = (bool) ($spec['allow_negative'] ?? TRUE);
				$spec['allow_float']    = (bool) ($spec['allow_float'] ?? TRUE);
			}
			$specs['checked'] = TRUE;
		}
	}
	
	/**
	 * Check that the name of a specification is correctly formatted
	 * 
	 * @param  mixed  $name The name value to check
	 * @param  string $key  The key being checked (for debug)
	 * @return void
	 */
	protected static function _check_spec_name($name, string $key) {
		if (!is_string($name)) {
			error::trigger(error::INVALID_CONFIG, sprintf(
				"The 'name' of the key '%s' must be a string in '%s'",
				$key,
				get_called_class()
			));
		}
		if (empty($name)) {
			error::trigger(error::INVALID_CONFIG, sprintf(
				"The 'name' of the key '%s' cannot be empty in '%s'",
				$key,
				get_called_class()
			));
		}
	}
	
	/**
	 * Check that the name of a specification is correctly formatted
	 * 
	 * @param  mixed  $min The min value to check
	 * @param  mixed  $max The max value to check
	 * @param  string $key The key being checked (for debug)
	 * @return void
	 */
	protected static function _check_spec_minmax($min, $max, string $key) {
		if (!is_numeric($min) || !is_numeric($max)) {
			error::trigger(error::INVALID_CONFIG, sprintf(
				"The 'min' and 'max' of the key '%s' must be numeric in '%s'",
				$key,
				get_called_class()
			));
		}
		if ((float) $min >= (float) $max) {
			error::trigger(error::INVALID_CONFIG, sprintf(
				"The 'min' must be greater than the 'max' of the key '%s' in '%s'",
				$key,
				get_called_class()
			));
		}
	}
	
	/**
	 * Check that the overflow value is valid
	 * 
	 * @param  mixed  &$overflow The overflow value to check
	 * @param  string $key       The key being checked (for debug)
	 * @return void
	 */
	protected static function _check_spec_overflow(&$overflow, string $key) {
		if (!is_string($overflow) || !is_callable(array(get_called_class(), '_overflow_'.$overflow))) {
			$overflow = 'error';
		}
	}
	
	/**
	 * Run the specification check on a key's value
	 * 
	 * @param  float  $value The value to check
	 * @param  string $key   The key to check against
	 * @param  array  $spec  The specification to use
	 * @return float         The value after applying the specification
	 */
	protected static function _run_spec(float $value, string $key, array $spec) :float {
		if (!$spec['allow_negative'] && $value < 0) {
			$value = abs($value);
		}
		return static::_spec_range($value, $key, $spec);
	}
	
	/**
	 * Force a value into the specification's range
	 * 
	 * @param  float  $value The value to check
	 * @param  string $key   The key to check against
	 * @param  array  $spec  The specification to use
	 * @return float         The valid value
	 */
	protected static function _spec_range(float $value, string $key, array $spec) :float {
		$in_range = validate::in_range($value, $spec['min'], $spec['max']);
		if (!$in_range && is_callable($callback = array(get_called_class(), '_overflow_'.$spec['overflow_method']))) {
			$value = call_user_func($callback, $value, $spec);
		} elseif (!$in_range) {
			error::trigger(error::INVALID_VALUE, sprintf(
				"Key '%s' equaled '%s' but must be in range: %s through %s",
				$key,
				$value,
				$spec['min'],
				$spec['max']
			));
			$value = $spec['min'];
		}
		return $value;
	}
	
	/**
	 * Force a value into the specification's range by looping back around
	 * 
	 * @param  float  $value The value to check
	 * @param  array  $spec  The specification to use
	 * @return float         The valid value
	 */
	protected static function _overflow_loop(float $value, array $spec) :float {
		if ($spac['min'] == 0 && $spec['max'] > 0) {
			return $value % $spec['max'];
		}
		return fmod($value + abs(0 - $spac['min']), abs($spac['min'] - $spec['max'])) + $spac['min'];
	}
	
	/**
	 * Force a value into the specification's range by limiting to the nearest
	 * minimum/maximum
	 * 
	 * @param  float  $value The value to check
	 * @param  array  $spec  The specification to use
	 * @return float         The valid value
	 */
	protected static function _overflow_limit(float $value, array $spec) :float {
		return max($spac['min'], min($value, $spec['max']));
	}
	
	/**
	 * Get the raw values to be serialized by JSON
	 * 
	 * @return array The current color array
	 */
	public function jsonSerialize() {
		return $this->getArrayCopy();
	}
	
	/**
	 * Set an existing offset according to its specification
	 * 
	 * @param  string $key   The key to set
	 * @param  mixed  $value The value to check and set
	 * @return float         The value that was set
	 */
	public function offsetSet($key, $value) {
		settype($key, 'string');
		if (isset(static::$specs[$key])) {
			$value = static::_run_spec($value, $key, static::$specs[$key]);
			parent::offsetSet($key, $value);
			return $value;
		}
		error::trigger(error::INVALID_ARGUMENT, sprintf(
			"Cannot set key '%s'",
			$key
		));
	}
	
	/**
	 * Set a value to its minimum value
	 * 
	 * @param  string $key   The key to set
	 * @return void
	 */
	public function offsetUnset($key) {
		if (isset(static::$specs[$key])) {
			$this->offsetSet($key, static::$specs[$key]['min']);
		}
		error::trigger(error::INVALID_ARGUMENT, sprintf(
			"Cannot unset key '%s'",
			$key
		));
	}
	
	/**
	 * Replace the current color array with another array of the same type
	 * 
	 * @param  array $input The array to import
	 * @return void
	 */
	public function exchangeArray($input) {
		static::_assoc_keys(static::$specs, $input);
		foreach (static::$specs as $key => $spec) {
			if ($key != 'checked') {
				$this->_import_input($input[$key], $key, $spec);
			}
		}
	}
	
	/**
	 * Associate expected keys when working with numerically indexed arrays
	 * 
	 * @param  array  $specs  The specification to follow
	 * @param  array  &$input The input array
	 * @return void
	 */
	protected static function _assoc_keys(array $specs, array &$input) {
		$is_assoc = FALSE;
		foreach ($input as $key => $value) {
			if (!is_numeric($key)) {
				return;
			}
		}
		$target_length = count(static::$specs);
		return array_combine(
			array_keys(static::$specs),
			array_slice(array_pad($input, $target_length, 0.0), 0, $target_length)
		);
	}
	
	/*** DISABLED METHODS ***/
	
	/**
	 * DISABLED
	 * 
	 * @param  mixed $disabled Disabled
	 * @return void
	 * @codeCoverageIgnore
	 */
	public function append($disbaled) {}
	
	/**
	 * DISABLED
	 * 
	 * @return void
	 * @codeCoverageIgnore
	 */
	public function asort() {}
	
	/**
	 * DISABLED
	 * 
	 * @return void
	 * @codeCoverageIgnore
	 */
	public function ksort() {}
	
	/**
	 * DISABLED
	 * 
	 * @param  mixed $disabled Disabled
	 * @return void
	 * @codeCoverageIgnore
	 */
	public function uasort($disabled) {}
	
	/**
	 * DISABLED
	 * 
	 * @param  mixed $disabled Disabled
	 * @return void
	 * @codeCoverageIgnore
	 */
	public function uksort($disabled) {}
	
	/**
	 * DISABLED
	 * 
	 * @return void
	 * @codeCoverageIgnore
	 */
	public function natcasesort() {}
	
	/**
	 * DISABLED
	 * 
	 * @return void
	 * @codeCoverageIgnore
	 */
	public function natsort() {}
	
	/**
	 * DISABLED
	 * 
	 * @param  mixed $disabled Disabled
	 * @return void
	 * @codeCoverageIgnore
	 */
	public function setFlags($disabled) {}
	
	/**
	 * DISABLED
	 * 
	 * @param  mixed $disabled Disabled
	 * @return void
	 * @codeCoverageIgnore
	 */
	public function setIteratorClass($disabled) {}
}
