<?php


namespace projectcleverweb\color;


class main {
	
	private $data;
	
	public function __construct($hex) {
		if ($hex instanceof data) {
			$this->data = $hex;
		} else {
			$this->data = new data($hex);
		}
	}
	
	public function is_dark(int $check_score = 128) :bool {
		$rgb = $this->data->rgb;
		return check::is_dark($rgb['r'], $rgb['g'], $rgb['b'], $check_score);
	}
	
	public function mod_r(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::red($this->data, $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_g(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::green($this->data, $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_b(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::blue($this->data, $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_h(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::hue($this->data, $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_s(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::saturation($this->data, $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_l(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::light($this->data, $adjustment, $as_percentage, $set_absolute);
	}
	
	
	
	
	
	
	
}
