<?php namespace Oophpmvc;

class View
{
    protected $variabless = [];

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