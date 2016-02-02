function HandleFile(selectorFile) {
    this.selectorFile = selectorFile;
}

HandleFile.prototype.listen = function(callbackOnSuccess, callbackOnReadFile) {
    if (typeof this.selectorFile === 'string') {
        $(this.selectorFile).on("change", this.onSelect);
    } else {
        throw "El selector debe ser del tipo cadena.";
    }
}

HandleFile.prototype.onSelect = function(event) {
    var files = event.target.files; // FileList object
    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {
    
        // Only process image files.
        if (!f.type.match('image.*')) {
            continue;
        }
        
        callbackOnSuccess(f);
        
        // this.formData.append(this.nameFile, f);
    
        var reader = new FileReader();
    
        // Closure to capture the file information.
        reader.onload = (function(theFile) {
            return function(e) {
                // $(this.selectorImg).attr("src", e.target.result);
                callbackOnReadFile(f);
            };
        })(f);
    
        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    }
};