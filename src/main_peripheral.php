<?php
/**
 * Handles the "extra" functionality for the main class.
 */

namespace projectcleverweb\color;

/**
 * Handles the "extra" functionality for the main class.
 */
abstract class main_peripheral implements \Serializable, \JsonSerializable {
	
	/**
	 * Makes sure cloning works as expected
	 * 
	 * @return void
	 */
	public function __clone() {
		$this->color = clone $this->color;
		$this->cache = clone $this->cache;
	}
	
	/**
	 * Custom serialize function
	 * 
	 * @return string This instance serialized as an RGB string
	 */
	public function serialize() :string {
		return $this->color->serialize();
	}
	
	/**
	 * Custom unserialize function
	 * 
	 * @param  string $serialized This instance serialized as an RGB string
	 * @return void
	 */
	public function unserialize($serialized) {
		$unserialized = (array) json_decode((string) $serialized);
		regulate::rgb_array($unserialized);
		$this->set($unserialized, 'rgb');
	}
	
	/**
	 * Custom JSON serialize function
	 * 
	 * @return string This instance serialized as an JSON RGB string
	 */
	public function jsonSerialize() :array {
		return $this->color->jsonSerialize();
	}
	
	protected function get_scheme(string $scheme_name, string $return_type = 'hex', $scheme_class) :array {
		if (!is_null($cached = $this->cache->get(get_class($scheme_class).'_'.$scheme_name.'_'.$return_type, $this->hex()))) {
			return $cached;
		}
		$result = static::_scheme($scheme_name, [$scheme_class, strtolower($return_type)], $this->hsl(3));
		$this->cache->set(get_class($scheme_class).'_'.$scheme_name.'_'.$return_type, $this->hex(), $result);
		return $result;
	}
	
	/**
	 * Handles scheme generator callbacks
	 * 
	 * @param  string $scheme_name The name of the scheme algorithm to use
	 * @param  string $callback    The return type callback
	 * @param  array  $hsl         The base color as an HSL array
	 * @return array               The resulting scheme in the proper format, OR an empty array on failure.
	 */
	protected static function _scheme(string $scheme_name, array $callback, array $hsl) :array {
		if (is_callable($callback)) {
			return call_user_func($callback, $hsl['h'], $hsl['s'], $hsl['l'], $scheme_name);
		}
		error::trigger(error::INVALID_ARGUMENT, sprintf(
			'The $callback "%s" is not a valid callback',
			print_r($callback, 1),
			__CLASS__,
			__FUNCTION__
		));
		return [];
	}
	
	/**
	 * Set whether or not caching should be active.
	 * 
	 * @param  bool $active If TRUE caching is turned on, otherwise cashing is turned off.
	 * @return void
	 */
	public function cache(bool $active = TRUE) {
		$this->cache->active = $active;
	}
	
	/**
	 * Reset the cache for this instance
	 * 
	 * @return void
	 */
	public function reset_cache() {
		$this->cache->reset();
	}
}
