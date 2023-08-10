<?php

// Any facade will extend base facade
// then override getFacadeAccessor() 
// and set the return value to whatever class we have binded in app container
class ConfigFacade extends Facade {
	protected static function getFacadeAccessor(){
    	return Config::class;
    }
}