<?php

namespace projectcleverweb\color\_abstract;
use \projectcleverweb\color\_interface\object;
use \projectcleverweb\color\error;
use \projectcleverweb\color\_abstract\array_object;

/**
 * Array Object Immutable
 * ======================
 * 1-to-1 of array_object except it is immutable
 */
abstract class array_object_immutable extends array_object implements object {
	
	/**
	 * Creates new instance of $this based on $array
	 * 
	 * @param  mixed        $array The input array (or ArrayObject)
	 * @return array_object        Instance of $this
	 */
	final public function __invoke($array) {
		return new $this($array);
	}
	
	/**
	 * Without the ability to change information, this becomes an alias of
	 * getArrayCopy()
	 * 
	 * @param  array $array The array to "exchange"
	 * @return array        The current (unchanged) array
	 */
	final public function exchangeArray($array) {
		return $this->getArrayCopy();
	}
	
	/**
	 * Allows for easy calling for *most* of the built in PHP array functions. For
	 * example, you can call array_sum() with $this->sum(). Note: array_combine
	 * has been split into $this->combine_keys() and $this->combine_values().
	 * 
	 * @param  string $function  The function callback as a string
	 * @param  array  $arguments The arguments for the callback as an array
	 * @return mixed             *See each function's official PHP documentation*
	 */
	final public function __call($function, $arguments) {
		if (!isset(static::MAPPED_FUNCTIONS[$function])) {
			error::trigger(error::INVALID_FUNCTION, get_class().'::'.$function.'() is not a valid function');
		}
		$data          = $this->getArrayCopy();
		$callback_args = array();
		reset($arguments);
		foreach (range(0, count($arguments)) as $index) {
			if ($index == static::MAPPED_FUNCTIONS[$function]['callback_index']) {
				if (static::MAPPED_FUNCTIONS[$function]['as_ref']) {
					$callback_args[] = &$data;
				} else {
					$callback_args[] = $data;
				}
			} else {
				$callback_args[] = current($arguments);
				next($arguments);
			}
		}
		$return = call_user_func_array(static::MAPPED_FUNCTIONS[$function]['callback'], $callback_args);
		return $return;
	}
	
	final public function asort() {}
	final public function ksort() {}
	final public function natcasesort() {}
	final public function natsort() {}
	final public function uasort($cmp_function) {}
	final public function uksort($cmp_function) {}
	final public function append($value) {}
	final public function unserialize($serialized) {}
	final public function offsetSet($index, $newval) {}
	final public function offsetUnset($index) {}
}
