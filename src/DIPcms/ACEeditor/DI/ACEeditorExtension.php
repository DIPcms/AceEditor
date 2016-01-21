<?php

/**
 *
 * @author Mykola Chomenko <mykola.chomenko@dipcom.cz>
 */

namespace DIPcms\ACEeditor\DI;


use Nette;
use Nette\DI\CompilerExtension;

class ACEeditorExtension extends CompilerExtension{
    
    

    
    public function loadConfiguration() {
        
        $builder = $this->getContainerBuilder();
        
        
        $builder->addDefinition($this->prefix('config'))
            ->setClass('\DIPcms\ACEeditor\Config');
        

        $builder->addDefinition($this->prefix('editor'))
            ->setClass('\DIPcms\ACEeditor\ACEeditor');
        
    }
    

    
    public function beforeCompile(){
        
        $builder = $this->getContainerBuilder();
        
    }
    
    
    
    
    
     /**
     * @param \Nette\Configurator $configurator
     */
    public static function register(Nette\Configurator $configurator){
        
        $configurator->onCompile[] = function ($config, Nette\DI\Compiler $compiler){
                $compiler->addExtension('ACEeditor', new ACEeditorExtension());
        };
    } 
    
  
}
