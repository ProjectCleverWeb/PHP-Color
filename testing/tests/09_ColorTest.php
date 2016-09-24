<?php

namespace projectcleverweb\color;

/**
 * @requires PHP 7.0
 * @requires PHPUnit 5
 */
class ColorTest extends unit_test {
	
	/**
	 * @test
	 */
	public function Get_Type() {
		$color = $this->vars['conversions']['FF0000'];
		foreach ($color as $type => $val) {
			$this->assertEquals($type, color::get_type($val));
		}
		$this->assertEquals('error', color::get_type(new \stdClass));
		$this->assertEquals('error', color::get_type(['invalid array']));
	}
	
	/**
	 * @test
	 */
	public function Import() {
		foreach ($this->vars['conversions'] as $color) {
			foreach ($color as $type => $val) {
				$import = new color($val);
				$this->assertEquals($color['rgb'], $import->rgb);
			}
		}
	}
}
