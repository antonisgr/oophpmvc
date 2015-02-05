<?php
use Oophpmvc\Router;

class RouterTest extends PHPUnit_Framework_TestCase
{
    protected $router;

    public function setUp()
    {
        $this->router = new Router;
    }

    /**
     * @expectedException Exception
     */
    public function testRequiresRegisteredRoute()
    {
        $this->router->run();
    }

    public function testCallsRegisteredClosureIfRouteExists()
    {
        $this->router->get('home', function(){
            return 'hello world';
        });

        //todo
    }
}