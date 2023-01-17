<?php
/*
 * File: class.template.php
 * File Created: Sunday, 7th August 2022 10:22:11 pm
 * Author: hiimcody1
 * 
 * Last Modified: Sunday, 7th August 2022 11:00:01 pm
 * Modified By: hiimcody1
 * 
 * License: MIT License http://www.opensource.org/licenses/MIT
 */

class Template {
    public $viewVars = Array();

    public function render($viewPage) {
        ob_start();
        $TemplateVars = $this->viewVars;
        include(Config::TemplatesPath . $viewPage);
        return ob_get_clean();
    }
}

?>