<?php
/**
 * The HSL Data Class
 * ==================
 * Contains a color as an HSL array
 */

namespace projectcleverweb\color;

/**
 * The HSL Data Class
 * ==================
 * Contains a color as an HSL array
 */
class hsl implements \ArrayAccess {
	
	/**
	 * The HSL data
	 * @var array
	 */
	private $hsl;
	
	/**
	 * The amount of accuracy to use when calculating HSL
	 * @var int
	 */
	protected $accuracy;
	
	/**
	 * Import a color as an HSL value
	 * 
	 * @param array $rgb_array RGB color array to import
	 * @param int   $accuracy  The amount of accuracy to use when calculating HSL
	 */
	public function __construct(array $rgb_array, int $accuracy = 3) {
		$this->accuracy = $accuracy;
		$this->hsl      = convert\rgb::to_hsl($rgb_array);
	}
	
	/**
	 * Shortcut for return the HSL array
	 * 
	 * @return array The HSL array
	 */
	public function __invoke() {
		return $this->hsl;
	}
	
	/**
	 * Check if offset exists in data array
	 * 
	 * @param  string $offset The offset to check
	 * @return bool           TRUE if the offset exist, FALSE otherwise
	 */
	public function offsetExists($offset) :bool {
		return isset($this->hsl[$offset]);
	}
	
	/**
	 * Get an offset if it exists
	 * 
	 * @param  string $offset The offset to get
	 * @return mixed          The value of the offset
	 */
	public function offsetGet($offset) {
		if ($this->offsetExists($offset)) {
			return $this->hsl[$offset];
		}
		return error::trigger(error::INVALID_ARGUMENT, sprintf(
			'The offset "%s" does not exist in %s',
			(string) $offset,
			__CLASS__
		));
	}
	
	/**
	 * Set a value in the data array
	 * 
	 * @param  string $offset The offset to set
	 * @param  mixed  $value  The value to set it to
	 * @return mixed          The result
	 */
	public function offsetSet($offset, $value) {
		if ($this->offsetExists($offset)) {
			return $this->hsl[$offset] = (float) $value;
		}
		return error::trigger(error::INVALID_ARGUMENT, sprintf(
			'The offset "%s" cannot be set in %s',
			(string) $offset,
			__CLASS__
		));
	}
	
	/**
	 * Reset an offset to 0
	 * 
	 * @param  string $offset The offset to unset
	 * @return mixed          The result
	 */
	public function offsetUnset($offset) {
		if ($this->offsetExists($offset)) {
			return $this->hsl[$offset] = 0.0;
		}
	}
}
