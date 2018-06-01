<?php

namespace projectcleverweb\color\_trait;
use \projectcleverweb\color\_interface\object;
use \projectcleverweb\color\data\configuration;
use \projectcleverweb\color\exception\error\invalid_configuration;

/**
 * Configuration Class [IMMUTABLE]
 * ===============================
 * Stores configuration data for a class
 */
trait configuration_support {
	
	private static $supported_specs = array(
		'null'        => array(),
		'bool'        => array(),
		'int'         => array(),
		'float'       => array(),
		'string'      => array(),
		'callable'    => array(),
		'range'       => array(),
		'list'        => array(),
		'enum_string' => array(),
		'enum_int'    => array(),
		'enum_list'   => array(),
	);
	
	
	public static function configuration_import(object $instance, configuration $configuration) {
		static::configuration_validate($instance, $configuration);
		
	}
	
	public static function configuration_validate(object $instance, configuration $configuration) {
		static::_configuration_validate_init($instance);
		
		
	}
	
	protected static function _configuration_validate_init(object $instance) {
		$class = get_class($instance);
		if (!defined('static::CONFIGURATION_SPEC')) {
			throw new invalid_configuration(sprintf(
				'The constant %s::CONFIGURATION_SPEC must be set and configured in order to use trait "%s"',
				$class,
				__TRAIT__
			));
		}
		
	}
	
}
