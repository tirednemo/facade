<?php

class App {
    protected $bindings = [];

    public function bind($abstract, $concrete) {
        $this->bindings[$abstract] = $concrete;
    }

    public function make($abstract) {
        if (isset($this->bindings[$abstract])) {
            return $this->bindings[$abstract]();
        }
        throw new Exception("No binding found for {$abstract}");
    }

    public function getDependencies($abstract) {
        $reflection = new ReflectionClass($abstract);
        $constructor = $reflection->getConstructor();

        if (!$constructor) {
            return [];
        }

        // echo $constructor;
        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependencyClass = $parameter->getType()->getName();
            $dependencies[] = $this->make($dependencyClass);
        }

        return $dependencies;
    }
}