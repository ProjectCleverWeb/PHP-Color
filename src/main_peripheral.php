<?php


namespace projectcleverweb\color;


abstract class main_peripheral implements \Serializable, \JsonSerializable {
	
	public function __clone() {
		$rgb = $this->color->rgb + ['a' => $this->color->alpha()];
		unset($this->color);
		$this->set($rgb, 'rgb');
	}
	
	public function serialize() :string {
		return $this->color->serialize();
	}
	
	public function unserialize($serialized) {
		$unserialized = (array) json_decode((string) $serialized);
		regulate::rgb_array($unserialized);
		$this->set($unserialized, 'rgb');
	}
	
	public function jsonSerialize() :array {
		return $this->color->jsonSerialize();
	}
	
	protected static function _scheme(string $scheme_name, string $callback, array $hsl) {
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
	
	public function reset_cache() {
		$this->cache->reset();
	}
}
