<?php namespace Oophpmvc;

class View
{
    /**
     * Holds all the variables passed to the View
     * @var array
     */
    protected $variables = [];

    /**
     * Makes the view with its (optional) variables.
     * @param string $template
     * @param array $with
     * @throws \Exception
     */
    static public function make($template, array $with = [])
    {
        if (file_exists(APP_ROOT."/views/{$template}.php")) {

            if (!empty($with)) {
                foreach ($with as $key => $value) {
                    ${$key} = $value;
                }
            }

            require APP_ROOT."/views/includes/header.php";
            require APP_ROOT."/views/{$template}.php";
            require APP_ROOT."/views/includes/footer.php";

        } else {
            throw new \Exception('View does not exist');
        }
    }

}