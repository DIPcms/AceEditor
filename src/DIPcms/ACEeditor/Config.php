<?php


/**
 *
 * @author Mykola Chomenko <mykola.chomenko@dipcom.cz>
 */
namespace DIPcms\ACEeditor;


use Nette;

class Config extends Nette\Object{
    
    
    
    /**
     *
     * @var array
     */
    public $thems = array(
        'monokai' => 'ace/theme/monokai',
        'twilight' => 'ace/theme/twilight'
    );
    
    
    /**
     * @var array 
     */
    public $mods = array(
        'css' => 'ace/mode/css',
        'js' => 'ace/mode/javascript',
        'html' => 'ace/mode/html',
        'php' => 'ace/mode/php'
    );
    
    
    
    public function __construct() {
        
    }
    
    
}
