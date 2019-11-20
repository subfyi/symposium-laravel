(function(root, factory) {
  if(typeof define === 'function' && define.amd) {
    define(['file-dialog'], factory);
  } else if(typeof exports === 'object') {
    module.exports = factory(require('file-dialog'));
  } else {
    root.MultipleFileUploadComponent = factory(root.fileDialog);
  }
})(this, function(fileDialog) {
  return {
    register: function(name) {
      class FilePickerElement extends HTMLElement {
        constructor() {
          super();

          this.area = document.createElement('div');
          this.area.className = 'main-area';

          this.uploadBtn = document.createElement('a');
          this.uploadBtn.href = "#";
          this.uploadBtn.className = "btn btn-primary";
          this.uploadBtn.innerHTML = '<i class="fa fa-plus"></i> ' + (this.hasAttribute('desc') ? this.getAttribute('desc') : "DOSYA SEÇİN");
          var that = this;
          this.uploadBtn.onclick = function(e) {
            e.preventDefault();

            fileDialog({
              accept: that.hasAttribute('accepts') ? that.getAttribute('accepts') : '*/*',
              multiple: true
            }).then(function(files) {
              for(let file of files) {
                let fu = document.createElement('file-picker');
                fu.setAttribute('name', that.getAttribute('name'));
                fu.setAttribute('desc', that.getAttribute('desc'));
                that.area.appendChild(fu);
                fu.$controller.upload(file.name, file.type, file)
                  .then(function(a) {
                    fu.$controller.addListener(function(a) {
                      if(fu.$controller.$state == 1) {
                        that.area.removeChild(fu);
                      }
                    });
                  });
              }
            });
          };

          this.area.appendChild(this.uploadBtn);

          this.area.className = 'main-area';
        }

        connectedCallback() {
          this.appendChild(this.area);
        }

        disconnectedCallback() {
          this.removeChild(this.area);
        }
      }

      window.customElements.define(name, FilePickerElement);

      return FilePickerElement;
    }
  };
});