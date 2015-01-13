<?php namespace Oophpmvc;

class Router
{
    /**
     * Holds all registered routes.
     * @var array
     */
    private $registeredRoutes = [];

    /**
     * Holds the closures (1 to 1 relationship with routes).
     * @var array
     */
    private $registeredClosures = [];

    /**
     * The method that creates GET routes.
     * @param $uri      [The route uri]
     * @param $function [Closure to call]
     */
    public function get($uri, $function)
    {
        $this->registeredRoutes[] = $uri;
        $this->registeredClosures[] = $function;
    }

    /**
     * The actual routing happens here.
     * This method checks if the uri is a registered route, and if it is,
     * it calls the analogous closure.
     * @throws \Exception
     */
    public function run()
    {
        $uri = isset($_REQUEST['uri']) ? $_REQUEST['uri'] : '/';

        $found = false;
        // we want key to call the func
            foreach ($this->registeredRoutes as $key=>$registeredRoute) {
                if ($uri == $registeredRoute) {
                    $found = true;
                    call_user_func($this->registeredClosures[$key]);
                }
            }

        if ($found == false) {
            throw new \Exception('Route not found.');
        }

    }
}
