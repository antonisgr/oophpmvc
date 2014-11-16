<?php namespace Oophpmvc;

class App
{
    private $controller = null;
    private $action = null;
    private $params;

    public function __construct()
    {
        $this->splitUrl();
    }

    private function splitUrl()
    {
        if (isset($_GET['url'])) {
            // split URL
            $url = trim(strtolower($_GET['url']), '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $this->controller = isset($url[0]) ? ucwords($url[0]).'Controller' : null;
            $this->action = isset($url[1]) ? $url[1] : null;
            // Remove controller and action from the split URL
            unset($url[0], $url[1]);
            // Rebase array keys and store the URL params
            $this->params = array_values($url);
        }
    }

    public function run()
    {
        // if there isn't controller set in URL, show PagesController->home()
        if ($this->controller == null) {
            $this->controller = new \PagesController();
            $this->controller->home();
        //check if the controller exists. If it does, instantiate it.
        } elseif (file_exists(APP_ROOT."/controllers/{$this->controller}.php")) {
            $this->controller = new $this->controller();

            //check if method exists
            if (method_exists($this->controller, $this->action)) {
                $this->controller->{$this->action}();
            } elseif (empty($this->action)) {
                $this->controller->home(); //default method for every controller
            } else {
                throw new \Exception('Method does not exist');
            }
        }
        //if controller doesn't exist
        else {
            throw new \Exception('The controller does not exist.');
        }
    }
}
