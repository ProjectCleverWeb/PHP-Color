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
		$rgb = $this->color->rgb + ['a' => $this->color->alpha()];
		unset($this->color);
		$this->set($rgb, 'rgb');
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
	
	/**
	 * Handles scheme generator callbacks
	 * 
	 * @param  string $scheme_name The name of the scheme algorithm to use
	 * @param  string $callback    The return type callback
	 * @param  array  $hsl         The base color as an HSL array
	 * @return array               The resulting scheme in the proper format, OR an empty array on failure.
	 */
	protected static function _scheme(string $scheme_name, string $callback, array $hsl) :array {
		if (is_callable($callable = [new scheme, $callback])) {
			return call_user_func($callable, $hsl['h'], $hsl['s'], $hsl['l'], $scheme_name);
		}
		error::call(sprintf(
			'The $callback "%s" is not a valid callback',
			$scheme_name,
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
