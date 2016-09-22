<?php

namespace projectcleverweb\color;

/**
 * @requires PHP 7.0
 * @requires PHPUnit 5
 */
class YIQSchemeTest extends unit_test {
	
	/**
	 * @test
	 */
	public function Analogous_Set() {
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$schemes = [
				yiq_scheme::analogous_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				yiq_scheme::analogous_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				yiq_scheme::analogous_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				$this->assertEquals($scheme[0], $conv['hsl']);
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
				yiq_scheme::complementary_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				yiq_scheme::complementary_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				yiq_scheme::complementary_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				$this->assertEquals($scheme[0], $conv['hsl']);
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
				yiq_scheme::compound_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				yiq_scheme::compound_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				yiq_scheme::compound_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				$this->assertEquals($scheme[0], $conv['hsl']);
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
				yiq_scheme::monochromatic_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				yiq_scheme::monochromatic_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				yiq_scheme::monochromatic_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				$this->assertEquals($scheme[0], $conv['hsl']);
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
				yiq_scheme::shades_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				yiq_scheme::shades_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				yiq_scheme::shades_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				$this->assertEquals($scheme[0], $conv['hsl']);
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
				yiq_scheme::tetrad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				yiq_scheme::tetrad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				yiq_scheme::tetrad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				$this->assertEquals($scheme[0], $conv['hsl']);
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
				yiq_scheme::weighted_tetrad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				yiq_scheme::weighted_tetrad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				yiq_scheme::weighted_tetrad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				$this->assertEquals($scheme[0], $conv['hsl']);
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
				yiq_scheme::triad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				yiq_scheme::triad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				yiq_scheme::triad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				$this->assertEquals($scheme[0], $conv['hsl']);
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
				yiq_scheme::weighted_triad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				yiq_scheme::weighted_triad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				yiq_scheme::weighted_triad_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				$this->assertEquals($scheme[0], $conv['hsl']);
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
				yiq_scheme::rectangular_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l']),
				yiq_scheme::rectangular_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], TRUE),
				yiq_scheme::rectangular_set($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], FALSE)
			];
			foreach ($schemes as $scheme) {
				$this->assertEquals(5, count($scheme));
				$this->assertEquals($scheme[0], $conv['hsl']);
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
	public function ReturnRGB() {
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$scheme = yiq_scheme::rgb($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], 'shades');
			$this->assertEquals(5, count($scheme));
			$this->assertEquals($scheme[0], $conv['rgb']);
			foreach ($scheme as $key => $color) {
				$this->assertEquals(['r', 'g', 'b'], array_keys($color));
				$diff = $color;
				regulate::rgb_array($color);
				$this->assertEquals($diff, $color);
			}
		}
	}
	
	/**
	 * @test
	 */
	public function ReturnHSL() {
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$scheme = yiq_scheme::hsl($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], 'shades');
			$this->assertEquals(5, count($scheme));
			$this->assertEquals($scheme[0], $conv['hsl']);
			foreach ($scheme as $key => $color) {
				$this->assertEquals(['h', 's', 'l'], array_keys($color));
				$diff = $color;
				regulate::hsl_array($color);
				$this->assertEquals($diff, $color);
			}
		}
	}
	
	/**
	 * @test
	 */
	public function ReturnHSB() {
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$scheme = yiq_scheme::hsb($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], 'shades');
			$this->assertEquals(5, count($scheme));
			$this->assertEquals($scheme[0], $conv['hsb']);
			foreach ($scheme as $key => $color) {
				$this->assertEquals(['h', 's', 'b'], array_keys($color));
				$diff = $color;
				regulate::hsb_array($color);
				$this->assertEquals($diff, $color);
			}
		}
	}
	
	/**
	 * @test
	 */
	public function ReturnHex() {
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$scheme = yiq_scheme::hex($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], 'shades');
			$this->assertEquals(5, count($scheme));
			$this->assertEquals($scheme[0], $hex);
			foreach ($scheme as $key => $color) {
				$diff = $color;
				regulate::hex($color);
				$this->assertEquals($diff, $color);
			}
		}
	}
	
	/**
	 * @test
	 */
	public function ReturnCMYK() {
		foreach ($this->vars['conversions'] as $hex => $conv) {
			$scheme = yiq_scheme::cmyk($conv['hsl']['h'], $conv['hsl']['s'], $conv['hsl']['l'], 'shades');
			$this->assertEquals(5, count($scheme));
			$this->assertEquals($scheme[0], $conv['cmyk']);
			foreach ($scheme as $key => $color) {
				$this->assertEquals(['c', 'm', 'y', 'k'], array_keys($color));
				$diff = $color;
				regulate::cmyk_array($color);
				$this->assertEquals($diff, $color);
			}
		}
	}
	
	/**
	 * @test
	 */
	public function Error() {
		$hsl = $this->vars['conversions']['FFFFFF']['hsl'];
		$result = yiq_scheme::hsl($hsl['h'], $hsl['s'], $hsl['l'], 'invalid');
		$this->assertEquals([], $result);
	}
}
