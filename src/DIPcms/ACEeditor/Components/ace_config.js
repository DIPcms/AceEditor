DIP.Control.ACEEditor = function(){
  
    var the = this;
    this.editors_setting = [];
    this.editors = {};
    
    
    this.startup = function(){
        the.editors_setting = __ace_config;
    };
    
   
    
    this.runAceEditors = function(){
        $.each(the.editors_setting, function(i,v){
            var name = "ace_"+v.id;
            var editor = ace.edit(name);
            
            
            editor.setOptions({
                enableBasicAutocompletion: true,
                enableSnippets: true,
                enableLiveAutocompletion: true
            });
            
            
            editor.commands.addCommand({
                name: 'save',
                bindKey: {win: 'Ctrl-S',  mac: 'Command-S'},
                exec: function(editor) {
                    the.save(editor, the.editors_setting[i]);
                },
                readOnly: true
            });
            
            editor.$blockScrolling = Infinity;
            editor.setTheme(v.theme);
            editor.getSession().setMode(v.mode);
            editor.setValue(v.value);

            the.editors[name] = editor;
            
        });
    };
  
  
  
    
    this.save = function(editor, options){
        
        new DIP.Ajax({
            url: options.handler,
            data: {value:editor.getValue()},
            success: function(e){
                console.log(e);
            }
        });
        
    };
    
    
    
    this.runShowPanel = function(){
        var timeout = null;
        $(".ace_editor_wrapped").on('mousemove', function() {
            var panel =  $(this).find('.ace_options_panel');
            if (timeout !== null) {
                panel.addClass('active');
                clearTimeout(timeout);
            }
            timeout = setTimeout(function() {
               panel.removeClass('active');
            }, 500);
        });
    };
    
    
    
};

