 <?php
 
 //  __callStatic magic method to resolve the static::getFacadeAccessor()
 // And with those we're able to access the $method property.
 class Facade{
    protected static $container;

    public static function __callStatic($method, $args){
            $facadeAccessor = static::getFacadeAccessor();
    
            // Use the container to resolve the instance using ReflectionClass
            if (static::$container) {
                $reflection = new ReflectionClass($facadeAccessor);
                $instance = $reflection->newInstanceArgs(static::$container->getDependencies($facadeAccessor));
                return $instance->$method(...$args);
            }
    
            throw new Exception('Application not set.');
    }
    
    public static function setFacadeApplication($container) {
        static::$container = $container;
    }

    protected static function getFacadeAccessor(){
        //child class will override
        throw new Exception('Facade does not implement resolveFacadeInstance method.'); 
    }
}