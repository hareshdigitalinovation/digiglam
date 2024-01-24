<?php

namespace RoslynCore\Lib;

/**
 * interface PostTypeInterface
 * @package RoslynCore\Lib;
 */
interface PostTypeInterface {
	/**
	 * @return string
	 */
	public function getBase();
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register();
}