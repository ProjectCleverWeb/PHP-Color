<?php


namespace projectcleverweb\color;


class hsl implements \ArrayAccess {
	
	private $hsl;
	protected $accuracy;
	
	public function __construct(array $rgb_array, int $accuracy = 3) {
		$this->accuracy = $accuracy;
		$this->hsl      = generate::rgb_to_hsl($rgb_array['r'], $rgb_array['g'], $rgb_array['b'], $this->accuracy);
	}
	
	public function offsetExists($offset) :bool {
		return isset($this->hsl[$offset]);
	}
	
	public function offsetGet($offset) {
		if ($this->offsetExists($offset)) {
			return $this->hsl[$offset];
		}
		trigger_error(sprintf('Offset "%s" does not exist', $offset));
	}
	
	public function offsetSet($offset, $value) {
		if ($this->offsetExists($offset)) {
			return $this->hsl[$offset] = (float) $value;
		}
		trigger_error(sprintf('Offset "%s" cannot be set', $offset));
	}
	
	public function offsetUnset($offset) {
		if ($this->offsetExists($offset)) {
			return $this->hsl[$offset] = 0.0;
		}
	}
}


