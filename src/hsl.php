<?php


namespace projectcleverweb\color;


class hsl {
	
	private $hsl;
	private $h;
	private $s;
	private $l;
	protected $accuracy;
	
	public function __construct(array $rgb_array, int $accuracy = 3) {
		$this->accuracy = $accuracy;
		$this->hsl      = generate::rgb_to_hsl($rgb_array['r'], $rgb_array['g'], $rgb_array['b'], $this->accuracy);
	}
}


