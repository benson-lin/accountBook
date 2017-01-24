;(function($){
    'use strict';

    var uniqueId = (function(){
        var id = 0;
        return function(){ return id++; };
    })();
    
    /**
     * obj2url() takes a json-object as argument and generates
     * a querystring. pretty much like jQuery.param()
     * 
     * how to use:
     *
     *    `obj2url({a:'b',c:'d'},'http://any.url/upload?otherParam=value');`
     *
     * will result in:
     *
     *    `http://any.url/upload?otherParam=value&a=b&c=d`
     *
     * @param  Object JSON-Object
     * @param  String current querystring-part
     * @return String encoded querystring
     */
    var obj2url = function(obj, temp, prefixDone){
        var uristrings = [],
            prefix = '&',
            add = function(nextObj, i){
                var nextTemp = temp 
                    ? (/\[\]$/.test(temp)) // prevent double-encoding
                       ? temp
                       : temp+'['+i+']'
                    : i;
                if ((nextTemp != 'undefined') && (i != 'undefined')) {  
                    uristrings.push(
                        (typeof nextObj === 'object') 
                            ? obj2url(nextObj, nextTemp, true)
                            : (Object.prototype.toString.call(nextObj) === '[object Function]')
                                ? encodeURIComponent(nextTemp) + '=' + encodeURIComponent(nextObj())
                                : encodeURIComponent(nextTemp) + '=' + encodeURIComponent(nextObj)
                    );
                }
            }; 
    
        if (!prefixDone && temp) {
          prefix = (/\?/.test(temp)) ? (/\?$/.test(temp)) ? '' : '&' : '?';
          uristrings.push(temp);
          uristrings.push(obj2url(obj));
        } else if ((Object.prototype.toString.call(obj) === '[object Array]') && (typeof obj != 'undefined') ) {
            // we wont use a for-in-loop on an array (performance)
            for (var i = 0, len = obj.length; i < len; ++i){
                add(obj[i], i);
            }
        } else if ((typeof obj != 'undefined') && (obj !== null) && (typeof obj === "object")){
            // for anything else but a scalar, we will use for-in-loop
            for (var i in obj){
                add(obj[i], i);
            }
        } else {
            uristrings.push(encodeURIComponent(temp) + '=' + encodeURIComponent(obj));
        }
    
        return uristrings.join(prefix)
                         .replace(/^&/, '')
                         .replace(/%20/g, '+'); 
    };
    
    var FileUpload = function(option){
        var $this = this;

        $this.options = $.extend(true, {}, FileUpload.defaults, option);
        
        // 计数, 正在上传文件个数
        $this.countInProgress = 0;

        // 上传handler(form or xhr)
        $this.handler = $this.createUploadHandler(); 
        
        // 上传按钮, 触发上传的element
        if ($this.options.button){ 
            $this.button = $this.createUploadButton($this.options.button);
        }
        
        // 页面关闭时, 提醒用户文件上传中
        $(window).on('beforeunload', function(){
            if (!$this.countInProgress){return;}
            var e = e || window.event;
            // for ie, ff
            e.returnValue = $this.options.messages.onLeave;
            // for webkit
            return $this.options.messages.onLeave;
        });
    };

    FileUpload.defaults = {
        // 开启演示, 由于上传需要server的支持, 本地演示将不提交代码
        demo: false,
        // 是否开启debug
        debug: false,
        // upload file cgi
        action: '/server/upload',
        // 额外参数
        params: {},
        // 上传按钮
        button: null,
        // 是否开启多个文件同时上传(需xhr有效)
        multiple: true,
        // 多个文件同时上传上限
        maxConnections: 3,
        
        // 限制扩展名
        allowedExtensions: [],
        // 限制上传大小(字节), 0: 不限制
        sizeLimit: 0,   
        // 限制上传文件最小值(字节), 0: 不限制
        minSizeLimit: 0,

        // onSubmit提交前触发, 返回false取消上传
        onSubmit: function(id, filename){},

        // onProgress上传中触发(需xhr有效, form无法触发)
        onProgress: function(id, filename, loaded, total){ },
        
        // onComplete上传完成触发
        onComplete: function(id, filename, result){ },

        // onCancel上传取消触发
        onCancel: function(id, filename){ },

        // 消息
        messages: {
            typeError: "{file} 无效. 只允许上传 {extensions} 的文件.",
            sizeError: "{file} 太大, 只允许上传 {sizeLimit} 大小的文件.",
            minSizeError: "{file} 太小, 上传文件至少 {minSizeLimit} 以上.",
            emptyError: "{file} 文件没有内容, 请重新选择上传文件.",
            onLeave: "还有文件在上传中, 如果退出页面, 上传进程将被中断."
        },
        
        // 提示消息
        showMessage: function(message){
            alert(message);
        }
    };
       
    FileUpload.prototype = {
        
        // 设置上传文件的请求参数
        setParams: function(params){
            this.options.params = params;
        },
        
        // 创建上传按钮
        createUploadButton: function(element){
            var $this = this;
            return new UploadButton({
                element: element,
                multiple: $this.options.multiple && UploadHandlerXhr.isSupported(),
                onChange: function(input){
                    $this.onInputChange(input);
                }
            });
        },

        // 创建上传handler
        createUploadHandler: function(){
            var $this = this,
                handlerClass;
            
            if(UploadHandlerXhr.isSupported()){
                handlerClass = UploadHandlerXhr;
            } else {
                handlerClass = UploadHandlerForm;
            }

            var handler = new handlerClass({
                demo: $this.options.demo,
                name: $this.options.name,
                debug: $this.options.debug,
                action: $this.options.action,
                maxConnections: $this.options.maxConnections,
                onProgress: function(id, filename, loaded, total){
                    $this.onProgress(id, filename, loaded, total);
                    $this.options.onProgress(id, filename, loaded, total);
                },
                onComplete: function(id, filename, result){
                    $this.onComplete(id, filename, result);
                    $this.options.onComplete(id, filename, result);
                },
                onCancel: function(id, filename){
                    $this.onCancel(id, filename);
                    $this.options.onCancel(id, filename);
                }
            });
            return handler;
        },
        onSubmit: function(id, filename){ this.countInProgress++; },
        onCancel: function(id, filename){ this.countInProgress--; },
        onProgress: function(id, filename, loaded, total){ },
        onComplete: function(id, filename, result){
            this.countInProgress--;
            if (result.error){
                this.options.showMessage(result.error);
            }
        },
        onInputChange: function(input){
            if (this.handler instanceof UploadHandlerXhr){
                this.uploadFiles(input.files);
            } else {
                if (this.validate(input)){
                    this.uploadFile(input);
                }
            }
            this.button.reset();
        },
        uploadFiles: function(files){
            for (var i = 0; i < files.length; i++){
                if (!this.validate(files[i])){
                    return ;
                }
            }
            for (var i = 0; i < files.length; i++){
                this.uploadFile(files[i]);
            }
        },
        uploadFile: function(file){
            var id = this.handler.add(file);
            var filename = this.handler.getName(id);
            
            if (this.options.onSubmit(id, filename) !== false){
                this.onSubmit(id, filename);
                this.handler.upload(id, this.options.params);
            }
        },      
        validate: function(file){
            var name, size;
            if (file.val()){
                name = file.val().replace(/.*(\/|\\)/, "");
            } else {
                name = file.attr('fileName') || file.attr('name');
                size = file.attr('fileSize') || file.attr('size');
            }
            if (!this.isAllowedExtension(name)){
                this.error('typeError', name);
                return false;
            } else if (size === 0){
                this.error('emptyError', name);
                return false;
            } else if (size && this.options.sizeLimit && size > this.options.sizeLimit){
                this.error('sizeError', name);
                return false;
            } else if (size && size < this.options.minSizeLimit){
                this.error('minSizeError', name);
                return false;
            }
            return true;
        },
        error: function(code, filename){
            var message = this.options.messages[code];
            function replace(name, replacement){ 
                message = message.replace(name, replacement); 
            }
            replace('{file}', this.formatFileName(filename));        
            replace('{extensions}', this.options.allowedExtensions.join(', '));
            replace('{sizeLimit}', this.formatSize(this.options.sizeLimit));
            replace('{minSizeLimit}', this.formatSize(this.options.minSizeLimit));
            this.options.showMessage(message);                
        },
        formatFileName: function(name){
            if (name.length > 33){
                name = name.slice(0, 19) + '...' + name.slice(-13);    
            }
            return name;
        },
        isAllowedExtension: function(filename){
            var ext = (-1 !== filename.indexOf('.')) ? filename.replace(/.*[.]/, '').toLowerCase() : '';
            var allowed = this.options.allowedExtensions;
            
            if (!allowed.length){return true;}        
            
            for (var i = 0; i < allowed.length; i++){
                if (allowed[i].toLowerCase() == ext){ return true;}    
            }
            
            return false;
        },    
        formatSize: function(bytes){
            var i = -1;
            do {
                bytes = bytes / 1024;
                i++;  
            } while (bytes > 99);
            
            return Math.max(bytes, 0.1).toFixed(1) + ['kB', 'MB', 'GB', 'TB', 'PB', 'EB'][i];          
        }
    };


    // 上传按钮
    // 由于浏览器限制, 必须用户点击file, 才能获取文件
    // 按钮原理: 生成一个<input type="file" />, 添加到元素里, 引导用户点击元素同时触发上传。
    var UploadButton = function(option){

        this.options = $.extend({}, {
            element: null,  
            multiple: false,
            name: 'file',
            onChange: function(input){
            },
            hoverClass: 'fileupload-button-hover',
            focusClass: 'fileupload-button-focus'
        }, option);
            
        this.element = $(this.options.element);
        this.element.css({
            position: 'relative',
            overflow: 'hidden',
            direction: 'ltr'
        })
        
        this.input = this.createInput();
    };
    
    UploadButton.prototype = {
        getInput: function(){
            return this.input;
        },
        reset: function(){
            this.input.remove();
            this.input = this.createInput();
            this.element.removeClass(this.options.focusClass);
        },    
        createInput: function(){ 
            var $this = this
              , element = $this.element
              , options = $this.options
              , hoverClass = options.hoverClass
              , focusClass = options.focusClass
              , input = $("<input>");
            
            if (options.multiple){
                input.attr("multiple", "multiple");
            }

            input.attr({
                'type': 'file',
                'name': options.name
            }).css({
                position: 'absolute',
                fontFamily: 'Arial',
                fontSize: '200px',
                top: 0,
                right: 0,
                margin: 0,
                padding: 0,
                opacity: 0,
                cursor: 'pointer',
                height: 'auto',
                '+height': '100%',  
            })
            
            element.append(input);

            input.on('change', function(){
                options.onChange(input); // dom element
            }).hover(function(){ element.addClass(hoverClass); }, 
                     function(){ element.removeClass(hoverClass); })
              .on('focus', function(){ element.addClass(focusClass); })
              .on('blur', function(){ element.removeClass(focusClass); });
    
            // IE and Opera, unfortunately have 2 tab stops on file input
            // which is unacceptable in our case, disable keyboard access
            if (window.attachEvent){
                // it is IE or Opera
                input.attr('tabIndex', "-1");
            }
            return input; 
        }
    };

    var UploadHandlerAbstract = function(option){
        this.options = $.extend({}, {
            debug: false,
            action: '/server/upload',
            maxConnections: 3,
            onProgress: function(id, filename, loaded, total){ },
            onComplete: function(id, filename, result){ },
            onCancel: function(id, filename){ }
        }, option);
        // upload queue 
        this.queue = [];
        // params for files in queue
        this.params = [];
    };

    UploadHandlerAbstract.prototype = {
        log: function(str) { if (this.options.debug && window.console) console.log('[uploader] ' + str); },
        add: function(file){ },
        upload: function(id, params){
            this.params[id] = $.extend({}, params);
            // 控制上传数量, 太多就不能再上传
            if (this.queue.push(id) <= this.options.maxConnections){
                this._upload(id, this.params[id]);
            }
        },
        cancel: function(id){
            this._cancel(id);
            this.dequeue(id);
        },
        cancelAll: function(){
            for (var i=0; i<this.queue.length; i++){
                this._cancel(this.queue[i]);
            }
            this.queue = [];
        },
        getName: function(id){ },
        getSize: function(id){ },
        getQueue: function(){ return this.queue; },

        dequeue: function(id){
            var i = $.inArray(id, this.queue);
            if (i > 0) this.queue.splice(i, 1);

            // 上传队列里待上传的文件
            var max = this.options.maxConnections;
            if (this.queue.length >= max){
                var nextId = this.queue[max - 1];
                this.upload(nextId, this.params[nextId]);
            }
        },
        
        // 上传逻辑
        _upload: function(id){ },

        // 上传取消逻辑
        _cancel: function(id){ }
    };
    
    // 使用iframe与form来上传文件的Handler
    var UploadHandlerForm = function(o){
        UploadHandlerAbstract.apply(this, arguments);
        this.inputs = {};
    };

    UploadHandlerForm.prototype = $.extend({}, UploadHandlerAbstract.prototype, {
        add: function(file){
            this.log('set upload name: ' + this.options.name);
            file.attr('name', this.options.name || 'file[]');
            var id = 'fileupload-handler-iframe' + uniqueId();       
            this.inputs[id] = file;
            file.remove(); // 将input移出dom(append到form里)
            return id;
        },
        getName: function(id){
            return this.inputs[id].val().replace(/.*(\/|\\)/, "");
        },    
        getContentJSON: function(iframe){
            var doc = iframe.contentDocument ? iframe.contentDocument: iframe.contentWindow.document,
                response;
            this.log("Convert iframe's innerHTML to JSON");
            this.log("innerHTML = " + doc.body.innerHTML);
            try { response = eval("(" + doc.body.innerHTML + ")"); } 
            catch(err){ response = {}; }        
            return response;
        },
        createIFrame: function(id){
            var iframe = $('<iframe src="javascript:false;" name="' + id + '" />');
            iframe
              .attr('id', id)
              .css('display', 'none')
              .appendTo(document.body);
            return iframe;
        },
        createForm: function(params){
            var form = $('<form method="post" enctype="multipart/form-data"></form>');
            form
              .attr('action', obj2url(params, this.options.action))
              .css('display', 'none')
              .appendTo(document.body);
            return form;
        },

        _upload: function(id, params){
            var $this = this;
            var input = $this.inputs[id];
            
            if (!input || input.length == 0){
                throw new Error('文件没找到, 或者上传已经被取消');
            }
    
            var name = $this.getName(id);

            var iframe = $this.createIFrame(id);
            iframe.on('load', function(){
                if (!this.parentNode) {
                    return ;
                }
                // fixing Opera 10.53
                if (this.contentDocument &&
                    this.contentDocument.body &&
                    this.contentDocument.body.innerHTML == "false"){
                    // In Opera event is fired second time
                    // when body.innerHTML changed from false
                    // to server response approx. after 1 sec
                    // when we upload file with iframe
                    return;
                }
                var response = $this.getContentJSON(this);

                $this.options.onComplete(id, name, response);
                $this.dequeue(id);

                delete $this.inputs[id];

                // timeout added to fix busy state in FF3.6
                setTimeout(function(){
                    iframe.remove(); // 移除iframe
                }, 1);
            });

            var form = $this.createForm(params);

            form.attr('target', iframe.attr('name')); // post target
            form.append(input);
            // 演示不提交
            if ($this.options.demo) {
                $this.options.onComplete(id, name, {result:'success'});
                $this.dequeue(id);
                iframe.remove();
            } else {
                form.submit();
            }
            form.remove();
            
            return id;
        }, 
        _cancel: function(id){
            this.options.onCancel(id, this.getName(id));
            
            delete this.inputs[id];        
    
            var iframe = $('#' + id);
            if (iframe.length){
                // to cancel request set src to something else
                // we use src="javascript:false;" because it doesn't
                // trigger ie6 prompt on https
                iframe.attr('src', 'javascript:false;');
                iframe.remove();
            }
        }
    });
    
    // xhr模式暂时不提供(兼容ie)
    // 同时使用xhr, upload server要写两套逻辑
    var UploadHandlerXhr = function(o){
        UploadHandlerAbstract.apply(this, arguments);
        this.files = [];
        this.xhrs = [];
        this.loaded = [];
    };

    UploadHandlerXhr.isSupported = function(){return false;};

    $.fn.FileUpload = function(option){
        return this.each(function(){
            option = $.extend({}, option, {
                button: this
            });
            new FileUpload(option);
        });
    };

    $('[data-toggle=file-upload]').each(function(){
        var $this = $(this)
          , name = $this.attr('data-name') || 'file'
          , maxSize = $this.attr('data-max-size') ? parseInt($this.attr('data-max-size')) : 0
          , minSize = $this.attr('data-min-size') ? parseInt($this.attr('data-min-size')) : 0
          , extension = $this.attr('data-extension') ? $this.attr('data-extension').split(';') : []
          , action = $this.attr('data-action')
          , target = $this.attr('data-target')
          , demo = $this.attr('data-demo') === 'true';

        $this.FileUpload({
            demo: demo,
            name: name,
            debug: true,
            action: action,
            allowedExtensions: extension,
            sizeLimit: maxSize,
            minSizeLimit: minSize,
            onSubmit: function(id, filename){
                return $this.triggerHandler('submit.fileupload', [id, filename]);
            },
            onComplete: function(id, filename, result) {
                if (!result.error && target && $(target).length) {
                  $(target).val(filename);
                }
                return $this.triggerHandler('complete.fileupload', [id, filename, result]);
            }
        });
    });

}(window.jQuery));
