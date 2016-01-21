<?php

namespace DIPcms\ACEeditor\Components;


use Nette\Application\UI;
use DIPcms\ACEeditor\Config;

class Editor extends UI\Control{
    
    /**
     *
     * @var integer 
     */
    private $id;

    
    /**
     *
     * @var array
     */
    public $onSave = array();
    
    
    /**
     *
     * @var config 
     */
    private $config;
    
    /**
     *
     * @var string
     */
    private $theme;
    
    /**
     *
     * @var string
     */
    private $mode;
    
    
    /**
     *
     * @var string 
     */
    private $value = "";
    
    /**
     *
     * @var \Nette\Application\UI\Presenter 
     */
    private $presenter;
    
    
    public function __construct(
            Config $config, $id
        ){
        $this->config = $config;
        $this->id = $id;
        
        $this->theme = $this->config->thems['monokai'];
        $this->mode = $this->config->mods['css'];
        
        
    }
       
    
    public function render(){
        $this->presenter = $this->getPresenter();
        $settings = array(
            "id" => $this->id,
            "theme" => $this->theme,
            "mode" => $this->mode,
            "value" => $this->value,
            "handler" => $this->link('//Save!')
        );
        $this->template->settings  = $settings;
        $this->template->setFile(__DIR__.'/ace_editor.latte');
        $this->template->render();
    }
    
    
    public function handleSave(){
        $this->presenter = $this->getPresenter();
        if($this->presenter->isAjax()){
            $request = $this->presenter->getRequest();
            $result = $request->getPost();
           
            foreach($this->onSave as $call){
                $call($result);
            }
            $this->presenter->payload->neco = $result;
            $this->presenter->sendPayload();
        }
    }
    
    
    /**
     * 
     * @param string $theme
     * @return \DIPcms\ACEeditor\Components\Editor
     * @throws \Exception
     */
    public function setTheme($theme){
        
        if(!isset($this->config->thems[$theme])){
            throw new \Exception("Theme '$theme' is not defined");
        }
        
        $this->theme = $this->config->thems[$theme];
        return $this;
    }
    
    
    /**
     * 
     * @param string $mode
     * @return \DIPcms\ACEeditor\Components\Editor
     * @throws \Exception
     */
    public function setMode($mode){
        if(!isset($this->config->mods[$mode])){
            throw new \Exception("Theme '$mode' is not defined");
        }
        
        $this->mode = $this->config->mods[$mode];
        return $this;
    }
    
    
    
    /**
     * @param string $value
     * @return \DIPcms\ACEeditor\Components\Editor
     */
    public function addValue($value){
        $this->value .= "\n".$value;
        return $this;
    }
    
    
    
    /**
     * @param string $value
     * @return \DIPcms\ACEeditor\Components\Editor
     */
    public function setValue($value){
        $this->value = $value;
        
        return $this;
    }
    
    
    
    /**
     * @return string
     */
    public function getValues(){
        return $this->value;
    }
    
    
    
    /**
     * 
     * @return Config
     */
    public function getConfig(){
        return $this->config;
    }
    

}


