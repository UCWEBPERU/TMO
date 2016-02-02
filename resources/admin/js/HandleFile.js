function HandleFile() {
    this.selectorFile = null;
    this.callbackOnSuccess = null;
    this.callbackOnReadFile = null;
}

HandleFile.prototype.init = function(selectorFile, callbackOnSuccess, callbackOnReadFile) {
    this.selectorFile = selectorFile;
    this.callbackOnSuccess = callbackOnSuccess;
    this.callbackOnReadFile = callbackOnReadFile;
    this.listen();
}

HandleFile.prototype.listen = function() {
    if (typeof this.selectorFile === 'string') {
        $(this.selectorFile).on("change", this.onSelect);
    } else {
        throw "El selector debe ser del tipo cadena.";
    }
}

HandleFile.prototype.onSelect = function(event) {
    var files = evt.target.files; // FileList object
    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {
    
        // Only process image files.
        if (!f.type.match('image.*')) {
            continue;
        }
        
        this.callbackOnSuccess(f);
        
        // this.formData.append(this.nameFile, f);
    
        var reader = new FileReader();
    
        // Closure to capture the file information.
        reader.onload = (function(theFile) {
            return function(e) {
                // $(this.selectorImg).attr("src", e.target.result);
                this.callbackOnReadFile(f);
            };
        })(f);
    
        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    }
};