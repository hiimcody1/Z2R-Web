<?php
/*
 * File: class.ui.php
 * File Created: Sunday, 7th August 2022 12:06:13 am
 * Author: hiimcody1
 * 
 * Last Modified: Monday, 16th January 2023 11:10:05 pm
 * Modified By: hiimcody1
 * 
 * License: MIT License http://www.opensource.org/licenses/MIT
 */

class UI {
    private Template $Template;
    private string $RenderedView;

    public function __construct() {
        $this->Template = new Template();
    }

    public function Render($View) {
        $this->Template->viewVars["Title"] = "Z2R Web - " . $this->FormatViewName($View);
        $this->Template->viewVars["Navigation"] = $this->BuildNav($View);   //Build our navbar
        $this->Template->viewVars["Content"] = $this->Template->render($View);  //Populate Content
        $this->RenderedView = $this->Template->render("base.php");  //Build the final render
        echo $this->RenderedView;
    }

    public function GetRoute($Request,$isAPI=false) {
        if(str_starts_with($Request,"_"))
            $Request = "404";
        
        $Routes = json_decode(file_get_contents(Config::RoutesPath."web/routes.json"), true);
        $RequestFull = explode("/",$Request);
        foreach($Routes as $Route) {
            if(array_key_exists($RequestFull[1],$Route)) {
                //Hit
                return $Route[$RequestFull[1]];
            }
        }
        return preg_replace("/[^\w-]/", '', ($RequestFull[0] != "" ? $RequestFull[0] : "home")).".php";
    }

    private function BuildNav($CurrentView) {
        $views = $this->FetchAvailableViews();
        foreach($views as $view)
            $navItems[] =  '<li class="nav-item"><a href="/'.$this->FormatViewName($view,false).'" class="nav-link'.($view == $CurrentView ? ' active' : '').'">'.$this->FormatViewName($view)."</a></li>";
        return '<ul class="nav nav-pills col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">'.PHP_EOL.implode(PHP_EOL,$navItems).PHP_EOL.'</ul>';
    }

    private function FetchAvailableViews() {
        $routes = json_decode(file_get_contents(Config::RoutesPath."web/routes.json"), true);
        $viewBases = [];
        foreach($routes as $view) {
            if($view["_nav"])
                $viewBases[] = $view["_base"];
        }
        return $viewBases;
    }

    private function FormatViewName($View,$capitalize=true) {
        return $capitalize ? ucfirst(str_replace(".php","",$View)) : str_replace(".php","",$View);
    }
}

?>