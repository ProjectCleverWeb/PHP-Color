<?php

namespace projectcleverweb\color\_interface;

/**
 * Object Interface
 * ================
 * This is a slight hack, but it works as expected. Basically, PHP doesn't have
 * any native support for type-hinting function/method arguments as an object.
 * So we just make all of our classes, abstract classes, and interfaces use
 * this interface.
 * 
 * Then for the function argument, we just check if it is an instance of this
 * empty interface.
 * 
 * HOWEVER, this will only work for the objects within this project, or objects
 * that extend the objects in this project. Which for this project is ok, but
 * would be WAY better if PHP just supported it natively.
 */
interface object {}
