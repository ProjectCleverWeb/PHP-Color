<?php

namespace projectcleverweb\color;

/**
 * @requires PHP 7.0
 * @requires PHPUnit 5
 */
class HSLTest extends unit_test {
	
	/**
	 * @test
	 */
	public function Initialize() {
		$hsl = new hsl([
			'r' => 0,
			'g' => 0,
			'b' => 0,
		]);
		$this->assertTrue(isset($hsl['h']));
		$this->assertTrue(isset($hsl['s']));
		$this->assertTrue(isset($hsl['l']));
	}
	
	/**
	 * @test
	 */
	public function Array_Access() {
		$hsl = new hsl([
			'r' => 255,
			'g' => 0,
			'b' => 0,
		]);
		$this->assertTrue(isset($hsl['h']));
		$this->assertEquals(50, $hsl['l']);
		$hsl['l'] = 100;
		$this->assertEquals(100, $hsl['l']);
		unset($hsl['l']);
		$this->assertEquals(0, $hsl['l']);
		unset($hsl['x']); // invalid unset
	}
	
	/**
	 * @test
	 */
	public function Invoke() {
		$hsl = new hsl([
			'r' => 255,
			'g' => 0,
			'b' => 0,
		]);
		$this->assertEquals([
			'h' => 0,
			's' => 100,
			'l' => 50
		], $hsl());
	}
	
	
	/**
	 * @test
	 * @expectedException Exception
	 * @expectedExceptionMessage The offset "x" does not exist in projectcleverweb\color\hsl
	 */
	public function Invalid_Get() {
		error::set('active', TRUE);
		$hsl = new hsl([
			'r' => 255,
			'g' => 0,
			'b' => 0,
		]);
		$hsl['x'];
	}
	
	/**
	 * @test
	 * @expectedException Exception
	 * @expectedExceptionMessage The offset "x" cannot be set in projectcleverweb\color\hsl
	 */
	public function Invalid_Set() {
		error::set('active', TRUE);
		$hsl = new hsl([
			'r' => 255,
			'g' => 0,
			'b' => 0,
		]);
		$hsl['x'] = 100;
	}
}
