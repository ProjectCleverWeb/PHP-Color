<?php

namespace projectcleverweb\color;

/**
 * @requires PHP 7.0
 * @requires PHPUnit 5
 */
class MainTest extends unit_test {
	
	/**
	 * @test
	 */
	public function Export_Colors() {
		$color = $this->vars['conversions']['FF0000'];
		$main  = new main($color['rgb']);
		$this->assertEquals($color['rgb'] + ['a' => 100], $main->rgb());
		$this->assertEquals($color['hsl'] + ['a' => 100], $main->hsl());
		$this->assertEquals($color['hsb'] + ['a' => 100], $main->hsb());
		$this->assertEquals($color['cmyk'] + ['a' => 100], $main->cmyk());
		$this->assertEquals($color['hex'], $main->hex());
		$this->assertEquals($color['hex'], $main->web_safe());
		$this->assertEquals('#'.$color['hex'], $main->css());
	}
}
