<?php

namespace projectcleverweb\color;

/**
 * @requires PHP 7.0
 * @requires PHPUnit 5
 */
class ErrorTest extends unit_test {
	
	/**
	 * @test
	 */
	public function Set() {
		error_reporting(-1);
		error::set('active', TRUE);
		error::set('active', FALSE);
		error::set('use_exceptions', TRUE);
		error::set('use_exceptions', FALSE);
		error::set('invalid', TRUE);
		error::set('invalid', FALSE);
	}
	
	/**
	 * @test
	 * @expectedException Exception
	 * @expectedExceptionMessage test
	 */
	public function ExceptionCall() {
		error_reporting(-1);
		error::set('active', TRUE);
		error::set('use_exceptions', TRUE);
		error::call('test');
	}
	
	/**
	 * @test
	 */
	public function ExceptionIgnore() {
		error_reporting(-1);
		error::set('active', FALSE);
		error::set('use_exceptions', TRUE);
		error::call('test');
	}
	
	/**
	 * @test
	 * @expectedException PHPUnit_Framework_Error
	 * @expectedExceptionMessage test
	 */
	public function TriggerCall() {
		error_reporting(-1);
		error::set('active', TRUE);
		error::set('use_exceptions', FALSE);
		error::call('test');
	}
	
	/**
	 * @test
	 */
	public function TriggerIgnore() {
		error_reporting(-1);
		error::set('active', FALSE);
		error::set('use_exceptions', FALSE);
		error::call('test');
	}
}
