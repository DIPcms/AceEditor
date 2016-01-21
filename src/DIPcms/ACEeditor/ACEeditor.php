<?php


/**
 * Description of ACEeditor
 *
 * @author Mykola Chomenko <mykola.chomenko@dipcom.cz>
 */
namespace DIPcms\ACEeditor;


use Nette;
use DIPcms\ACEeditor\Components\Editor;
use DIPcms\Scripter\Scripter;

class ACEeditor extends Nette\Object{
    
    /**
     *
     * @var Config
     */
    private $config;
    
    /**
     *
     * @var Scripter 
     */
    private $scripter;
    
    
    /**
     * 
     * @var ArrayObject[]|Editor
     */
    private $components = array();
    
    
    
    public function __construct(
            Config $config,
            Scripter $scripter
        ){
        
        $this->config = $config;
        $this->scripter = $scripter;
    }
    
    
    
    /**
     * 
     * @return \DIPcms\ACEeditor\Components\Editor
     */
    public function createComponent(){
        
        if(count($this->components) == 0){
            $this->scripter->addJs(__DIR__.'/Components/ace_config.js');
            $this->scripter->addCss(__DIR__.'/Components/ace.css');
        }        
        
        $c = count($this->components)-1; 
        $id = $c < 0? 0: $c;
        $component = new Editor($this->config, $id);
        $this->components[$id] = $component;
        $this->components[] = $component;
        
        return $component;
    }
    
    
    
    /**
     * 
     * @return ArrayObject[]|Editor
     */
    public function getComponents(){
        return $this->components;
    }
    
    
}
