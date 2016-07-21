<?php


namespace projectcleverweb\color;


class hsl implements \ArrayAccess {
	
	private $hsl;
	protected $accuracy;
	
	public function __construct(array $rgb_array, int $accuracy = 3) {
		$this->accuracy = $accuracy;
		$this->hsl      = generate::rgb_to_hsl($rgb_array['r'], $rgb_array['g'], $rgb_array['b'], $this->accuracy);
	}
	
	public function __invoke() {
		return array_combine(['h', 's', 'l'], $this->hsl);
	}
	
	public function offsetExists($offset) :bool {
		return isset($this->hsl[$offset]);
	}
	
	public function offsetGet($offset) {
		if ($this->offsetExists($offset)) {
			return $this->hsl[$offset];
		}
		error::call(sprintf(
			'The offset "%s" does not exist in %s',
			(string) $offset,
			__CLASS__
		));
	}
	
	public function offsetSet($offset, $value) {
		if ($this->offsetExists($offset)) {
			return $this->hsl[$offset] = (float) $value;
		}
		error::call(sprintf(
			'The offset "%s" cannot be set in %s',
			(string) $offset,
			__CLASS__
		));
	}
	
	public function offsetUnset($offset) {
		if ($this->offsetExists($offset)) {
			return $this->hsl[$offset] = 0.0;
		}
	}
}
