<?php

use Oophpmvc\Controller;

class ControllerTest extends PHPUnit_Framework_TestCase
{
    protected $controller;

    public function setUp()
    {
        $this->controller = new Controller;
    }

    public function testHomeReturnsHello()
    {
        $output = $this->controller->home();
        $this->assertEquals('Hello controller\'s home!', $output);
    }
} 