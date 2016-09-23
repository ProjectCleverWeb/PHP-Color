<?php

namespace projectcleverweb\color;

/**
 * @requires PHP 7.0
 * @requires PHPUnit 5
 */
class CacheTest extends unit_test {
	
	/**
	 * @test
	 */
	public function Set_And_Get() {
		$cache = new cache;
		$rand  = rand();
		
		$cache->set('test', 'id', $rand);
		$this->assertEquals($rand, $cache->get('test', 'id'));
	}
	
	/**
	 * @test
	 */
	public function Is_Active() {
		$cache         = new cache;
		$cache->active = FALSE;
		$rand          = rand();
		
		$cache->set('test', 'id', $rand);
		$this->assertEquals(NULL, $cache->get('test', 'id'));
	}
	
	/**
	 * @test
	 */
	public function Reset() {
		$cache = new cache;
		$rand  = rand();
		
		$cache->set('test', 'id', $rand);
		$this->assertEquals($rand, $cache->get('test', 'id'));
		$cache->reset();
		$this->assertEquals(NULL, $cache->get('test', 'id'));
	}
}
