<?php namespace Oophpmvc;

class Router
{
    private $registeredRoutes = [];
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
