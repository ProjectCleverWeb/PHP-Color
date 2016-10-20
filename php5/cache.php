<?php
/**
 * Very simple in-memory caching
 */

namespace projectcleverweb\color;

/**
 * Very simple in-memory caching
 */
class cache {
	
	/**
	 * Whether or not caching is active
	 * @var bool
	 */
	public $active;
	
	/**
	 * The cache data
	 * @var array
	 */
	protected $data;
	
	/**
	 * Initialize this class
	 */
	public function __construct() {
		$this->reset();
		$this->active = TRUE;
	}
	
	/**
	 * Reset the entire cache
	 * 
	 * @return void
	 */
	public function reset() {
		$this->data = array();
	}
	
	/**
	 * Store a value in the cache
	 * 
	 * @param string $func  The function trying to store data (should be __FUNCTION__)
	 * @param string $id    The storage ID
	 * @param mixed  $value The value to store
	 */
	public function set($func, $id, $value) {
		if ($this->active) {
			$this->data[$func] = array($id => $value);
		}
	}
	
	/**
	 * Get a value from the cache
	 * 
	 * @param  string $func The function trying to get data (should be __FUNCTION__)
	 * @param  string $id   The storage ID
	 * @return mixed        The value stored or NULL
	 */
	public function get($func, $id) {
		if ($this->active && isset($this->data[$func][$id])) {
			return $this->data[$func][$id];
		}
	}
}
