<?php

namespace projectcleverweb\color;

/**
 * @requires PHP 7.0
 * @requires PHPUnit 5
 */
class SchemeTest extends unit_test {
	
	/**
	 * @test
	 */
	public function Analogous_Set() {
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$schemes = [
				scheme::analogous_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				scheme::analogous_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				scheme::analogous_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				foreach ($scheme as $key => $color) {
					$this->assertEquals(['h', 's', 'l'], array_keys($color));
					$diff = $color;
					regulate::hsl_array($color);
					$this->assertEquals($diff, $color);
				}
			}
		}
	}
	
	/**
	 * @test
	 */
	public function Complementary_Set() {
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$schemes = [
				scheme::complementary_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				scheme::complementary_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				scheme::complementary_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				foreach ($scheme as $key => $color) {
					$this->assertEquals(['h', 's', 'l'], array_keys($color));
					$diff = $color;
					regulate::hsl_array($color);
					$this->assertEquals($diff, $color);
				}
			}
		}
	}
	
	/**
	 * @test
	 */
	public function Compound_Set() {
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$schemes = [
				scheme::compound_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				scheme::compound_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				scheme::compound_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				foreach ($scheme as $key => $color) {
					$this->assertEquals(['h', 's', 'l'], array_keys($color));
					$diff = $color;
					regulate::hsl_array($color);
					$this->assertEquals($diff, $color);
				}
			}
		}
	}
	
	/**
	 * @test
	 */
	public function Monochromatic_Set() {
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$schemes = [
				scheme::monochromatic_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				scheme::monochromatic_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				scheme::monochromatic_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				foreach ($scheme as $key => $color) {
					$this->assertEquals(['h', 's', 'l'], array_keys($color));
					$diff = $color;
					regulate::hsl_array($color);
					$this->assertEquals($diff, $color);
				}
			}
		}
	}
	
	/**
	 * @test
	 */
	public function Shades_Set() {
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$schemes = [
				scheme::shades_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				scheme::shades_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				scheme::shades_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				foreach ($scheme as $key => $color) {
					$this->assertEquals(['h', 's', 'l'], array_keys($color));
					$diff = $color;
					regulate::hsl_array($color);
					$this->assertEquals($diff, $color);
				}
			}
		}
	}
	
	/**
	 * @test
	 */
	public function Tetrad_Set() {
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$schemes = [
				scheme::tetrad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				scheme::tetrad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				scheme::tetrad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				foreach ($scheme as $key => $color) {
					$this->assertEquals(['h', 's', 'l'], array_keys($color));
					$diff = $color;
					regulate::hsl_array($color);
					$this->assertEquals($diff, $color);
				}
			}
		}
	}
	
	/**
	 * @test
	 */
	public function Weighted_Tetrad_Set() {
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$schemes = [
				scheme::weighted_tetrad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				scheme::weighted_tetrad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				scheme::weighted_tetrad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				foreach ($scheme as $key => $color) {
					$this->assertEquals(['h', 's', 'l'], array_keys($color));
					$diff = $color;
					regulate::hsl_array($color);
					$this->assertEquals($diff, $color);
				}
			}
		}
	}
	
	/**
	 * @test
	 */
	public function Triad_Set() {
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$schemes = [
				scheme::triad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				scheme::triad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				scheme::triad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				foreach ($scheme as $key => $color) {
					$this->assertEquals(['h', 's', 'l'], array_keys($color));
					$diff = $color;
					regulate::hsl_array($color);
					$this->assertEquals($diff, $color);
				}
			}
		}
	}
	
	/**
	 * @test
	 */
	public function Weighted_Triad_Set() {
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$schemes = [
				scheme::weighted_triad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				scheme::weighted_triad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				scheme::weighted_triad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				foreach ($scheme as $key => $color) {
					$this->assertEquals(['h', 's', 'l'], array_keys($color));
					$diff = $color;
					regulate::hsl_array($color);
					$this->assertEquals($diff, $color);
				}
			}
		}
	}
	
	/**
	 * @test
	 */
	public function Rectangular_Set() {
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$schemes = [
				scheme::rectangular_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				scheme::rectangular_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				scheme::rectangular_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				foreach ($scheme as $key => $color) {
					$this->assertEquals(['h', 's', 'l'], array_keys($color));
					$diff = $color;
					regulate::hsl_array($color);
					$this->assertEquals($diff, $color);
				}
			}
		}
	}
	
}
