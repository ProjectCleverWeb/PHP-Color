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
	
	/**
	 * @test
	 */
	public function Import_Color() {
		foreach ($this->vars['conversions'] as $color) {
			foreach ($color as $type => $val) {
				$color1 = new color($val);
				$color2 = new color($color1);
				$this->assertEquals($color['rgb'], $color1->rgb);
				$this->assertEquals($color['rgb'], $color1->rgb);
				$this->assertTrue($color1 !== $color2);
			}
		}
	}
	
	/**
	 * @test
	 * @expectedException Exception
	 * @expectedExceptionMessage The color supplied to projectcleverweb\color\color's constructor was not valid
	 */
	public function Import_Error() {
		$color = new color(new \stdClass);
		$this->assertEquals(0, $color->rgb['r']);
		$this->assertEquals(0, $color->rgb['g']);
		$this->assertEquals(0, $color->rgb['b']);
		error::set('active', TRUE);
		$color = new color(new \stdClass);
	}
	
	/**
	 * @test
	 */
	public function Alpha() {
		$color = $this->vars['conversions']['FF0000'];
		$obj = new color($color['rgb'] + ['a' => 50.0]);
		$this->assertEquals(50.0, $obj->alpha());
		$this->assertEquals(90.0, $obj->alpha(90));
		$this->assertEquals(90.0, $obj->alpha());
	}
	
	/**
	 * @test
	 */
	public function As_HSL() {
		$color = new color($this->vars['conversions']['FF0000']['rgb']);
		$hsl   = $color->hsl();
		$this->assertEquals(0, $hsl['h']);
		$this->assertEquals(100, $hsl['s']);
		$this->assertEquals(50, $hsl['l']);
	}
	
	/**
	 * @test
	 */
	public function Serialize() {
		$color      = new color($this->vars['conversions']['FF0000']['rgb']);
		$serialized = serialize($color);
		$this->assertEquals('C:28:"projectcleverweb\color\color":29:{{"r":255,"g":0,"b":0,"a":100}}', $serialized);
		$this->assertEquals($color, unserialize($serialized));
	}
	
	/**
	 * @test
	 */
	public function JSON_Serialize() {
		$color = new color($this->vars['conversions']['FF0000']['rgb']);
		$json  = json_encode($color);
		$this->assertEquals('{"r":255,"g":0,"b":0,"a":100}', $json);
	}
}
