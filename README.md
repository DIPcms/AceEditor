#AceEditor

How to install
--------------

```sh

$ composer require dipcms/aceeditor:@dev

$ bower install ace-builds
```

```yaml  
extensions:
	templateExtension: DIPcms\TemplateExtension\DI\TemplateExtension
	scripter: DIPcms\Scripter\DI\ScripterExtension
	ACEeditor: DIPcms\ACEeditor\DI\ACEeditorExtension
```

How to use

```php
	namespace App\Presenters;
	
	use Nette;
	use DIPcms\ACEeditor\ACEeditor;
	
	class HomepagePresenter extends Nette\Application\UI\Presenter{
		
		/**
		 * @var ACEeditor
		 */
		private $ace_editor;
			
		public function __construct(ACEeditor $ace_editor){
		        $this->ace_editor = $ace_editor;
		        
		}
		
		
		/**
		 * @return \DIPcms\ACEeditor\Components\Editor
		 */
		public function createComponentAce() {
	        
	        	$ace = $this->ace_editor->createComponent();
	        	
	        	$ace->setTheme('monokai');
	        	$ace->setValue(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/css/style.css'));
	        	
	        	$ace->onSave[] = function($result){
	           		file_put_contents($_SERVER['DOCUMENT_ROOT'].'/css/style.css', $result);
	        	};
	        
	        	return $ace;
	    	}
		
		
		
		
	}
```

In the template, simply call

```html

<head>
	<script src="{$basePath}/bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
	<script src="{$basePath}/bower_components/ace-builds/src-min/ace.js" type="text/javascript"></script>
	
	<script src="{$basePath}/js/DIP.js" type="text/javascript"></script>
	{scripter}
</head>

<body>
	{control ace}
	
	<script>
	        $(document).ready(function(){
	            DIP.Run();
	        });
	</script>
</body>

```
