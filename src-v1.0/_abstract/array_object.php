<?php

namespace projectcleverweb\color\_abstract;
use \projectcleverweb\color\_interface\object;
use \ArrayObject;
use \JsonSerializable;
use \projectcleverweb\color\error;

/**
 * Array Object
 * ============
 * This is a slight improvement on PHP's built in ArrayObject. It pre-configures
 * ArrayObject, it also adds JSON support, and support for pre-filling
 * most of the array_* functions including in_array() and shuffle().
 * 
 * Under the hood this class still uses ArrayObject's storage. This is important
 * because ArrayObject has better array I/O performance than custom classes.
 */
abstract class array_object extends ArrayObject implements object, JsonSerializable {
	
	/**
	 * This is a mapping for correctly calling each built in array function.
	 */
	const MAPPED_FUNCTIONS = array(
		'change_key_case'   => array(
			'callback'       => 'array_change_key_case',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'chunk'             => array(
			'callback'       => 'array_chunk',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'column'            => array(
			'callback'       => 'array_column',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'combine_keys'      => array(
			'callback'       => 'array_combine',
			'callback_index' => 1,
			'as_ref'         => FALSE,
		),
		'combine_values'    => array(
			'callback'       => 'array_combine',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'count_values'      => array(
			'callback'       => 'array_count_values',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'diff_assoc'        => array(
			'callback'       => 'array_diff_assoc',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'diff_key'          => array(
			'callback'       => 'array_diff_key',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'diff_uassoc'       => array(
			'callback'       => 'array_diff_uassoc',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'diff_ukey'         => array(
			'callback'       => 'array_diff_ukey',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'diff'              => array(
			'callback'       => 'array_diff',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'fill_keys'         => array(
			'callback'       => 'array_fill_keys',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'filter'            => array(
			'callback'       => 'array_filter',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'flip'              => array(
			'callback'       => 'array_flip',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'intersect_assoc'   => array(
			'callback'       => 'array_intersect_assoc',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'intersect_key'     => array(
			'callback'       => 'array_intersect_key',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'intersect_uassoc'  => array(
			'callback'       => 'array_intersect_uassoc',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'intersect_ukey'    => array(
			'callback'       => 'array_intersect_ukey',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'intersect'         => array(
			'callback'       => 'array_intersect',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'key_exists'        => array(
			'callback'       => 'array_key_exists',
			'callback_index' => 1,
			'as_ref'         => FALSE,
		),
		'keys'              => array(
			'callback'       => 'array_keys',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'map'               => array(
			'callback'       => 'array_map',
			'callback_index' => 1,
			'as_ref'         => FALSE,
		),
		'merge_recursive'   => array(
			'callback'       => 'array_merge_recursive',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'merge'             => array(
			'callback'       => 'array_merge',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'multisort'         => array(
			'callback'       => 'array_multisort',
			'callback_index' => 0,
			'as_ref'         => TRUE,
		),
		'pad'               => array(
			'callback'       => 'array_pad',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'pop'               => array(
			'callback'       => 'array_pop',
			'callback_index' => 0,
			'as_ref'         => TRUE,
		),
		'product'           => array(
			'callback'       => 'array_product',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'push'              => array(
			'callback'       => 'array_push',
			'callback_index' => 0,
			'as_ref'         => TRUE,
		),
		'rand'              => array(
			'callback'       => 'array_rand',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'reduce'            => array(
			'callback'       => 'array_reduce',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'replace_recursive' => array(
			'callback'       => 'array_replace_recursive',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'replace'           => array(
			'callback'       => 'array_replace',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'reverse'           => array(
			'callback'       => 'array_reverse',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'search'            => array(
			'callback'       => 'array_search',
			'callback_index' => 1,
			'as_ref'         => FALSE,
		),
		'shift'             => array(
			'callback'       => 'array_shift',
			'callback_index' => 0,
			'as_ref'         => TRUE,
		),
		'slice'             => array(
			'callback'       => 'array_slice',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'splice'            => array(
			'callback'       => 'array_splice',
			'callback_index' => 0,
			'as_ref'         => TRUE,
		),
		'sum'               => array(
			'callback'       => 'array_sum',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'udiff_assoc'       => array(
			'callback'       => 'array_udiff_assoc',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'udiff_uassoc'      => array(
			'callback'       => 'array_udiff_uassoc',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'udiff'             => array(
			'callback'       => 'array_udiff',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'uintersect_assoc'  => array(
			'callback'       => 'array_uintersect_assoc',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'uintersect_uassoc' => array(
			'callback'       => 'array_uintersect_uassoc',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'uintersect'        => array(
			'callback'       => 'array_uintersect',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'unique'            => array(
			'callback'       => 'array_unique',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'unshift'           => array(
			'callback'       => 'array_unshift',
			'callback_index' => 0,
			'as_ref'         => TRUE,
		),
		'values'            => array(
			'callback'       => 'array_values',
			'callback_index' => 0,
			'as_ref'         => FALSE,
		),
		'walk_recursive'    => array(
			'callback'       => 'array_walk_recursive',
			'callback_index' => 0,
			'as_ref'         => TRUE,
		),
		'walk'              => array(
			'callback'       => 'array_walk',
			'callback_index' => 0,
			'as_ref'         => TRUE,
		),
		'current'           => array(
			'callback'       => 'current',
			'callback_index' => 0,
			'as_ref'         => TRUE,
		),
		'end'               => array(
			'callback'       => 'end',
			'callback_index' => 0,
			'as_ref'         => TRUE,
		),
		'key'               => array(
			'callback'       => 'key',
			'callback_index' => 0,
			'as_ref'         => TRUE,
		),
		'next'              => array(
			'callback'       => 'next',
			'callback_index' => 0,
			'as_ref'         => TRUE,
		),
		'prev'              => array(
			'callback'       => 'prev',
			'callback_index' => 0,
			'as_ref'         => TRUE,
		),
		'reset'             => array(
			'callback'       => 'reset',
			'callback_index' => 0,
			'as_ref'         => TRUE,
		),
		'in'             => array(
			'callback'       => 'in_array',
			'callback_index' => 1,
			'as_ref'         => FALSE,
		),
		'shuffle'             => array(
			'callback'       => 'shuffle',
			'callback_index' => 0,
			'as_ref'         => TRUE,
		),
	);
	
	/**
	 * Create a new array object
	 * 
	 * @param mixed $array The array (or ArrayObject) to initialize this with
	 */
	public function __construct($array = array()) {
		parent::__construct(static::_get_array($array), ArrayObject::ARRAY_AS_PROPS);
	}
	
	/**
	 * Formats an input into an array
	 * 
	 * @param  mixed $mixed The input
	 * @return array        The resulting array
	 */
	protected static function _get_array($mixed) :array {
		if (is_a($mixed, '\ArrayObject', TRUE)) {
			return $mixed->getArrayCopy();
		}
		return (array) $mixed;
	}
	
	/**
	 * Allows this class to be serialized by json_encode
	 * 
	 * @return array A copy of this object as an array
	 */
	public function jsonSerialize() {
		return $this->getArrayCopy();
	}
	
	/**
	 * Allows easy replacement of the stored values
	 * 
	 * @param  mixed        $array The input array (or ArrayObject)
	 * @return array_object        Instance of $this
	 */
	public function __invoke($array) {
		parent::__construct(static::_get_array($array), ArrayObject::ARRAY_AS_PROPS);
		return $this;
	}
	
	/**
	 * A quick way to serialize this object into JSON
	 * 
	 * @return string This instance as a JSON string
	 */
	public function __toString() {
		return json_encode($this->jsonSerialize());
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
	public function __call($function, $arguments) {
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
		if (static::MAPPED_FUNCTIONS[$function]['as_ref']) {
			$this->exchangeArray($data);
		}
		return $return;
	}
}
