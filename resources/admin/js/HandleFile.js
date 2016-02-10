function HandleFile(selectorFile) {
    this.selectorFile = selectorFile;
}

HandleFile.prototype.onSelect = function(callbackOnSuccess, callbackOnReadFile) {
    if (typeof this.selectorFile === 'string') {
        $(this.selectorFile).on("change", 
            function(event) {
                var files = event.target.files; // FileList object
                // Loop through the FileList and render image files as thumbnails.
                for (var i = 0, f; f = files[i]; i++) {
                
                    // Only process image files.
                    if (!f.type.match('image.*')) {
                        continue;
                    }
                    
                    var n= f;
                    console.log(f);
                    var a=f.size;
                    if (null!=n) {
                        var i=new FileReader;
                        i.onload=function(e) {
                            var n=new Image;
                            n.src=e.target.result,
                            n.onload=function() {
                                var e=document.createElement("canvas");
                                e.width=n.width,
                                e.height=n.height,
                                e.getContext("2d").drawImage(n,0,0,e.width,e.height);
                                var i=n.width < n.height ? n.width / a : n.height / a,
                                r=document.createElement("canvas");
                                r.width=n.width/i,
                                r.height=n.height/i;
                                // o["default"].resizeCanvas(e,r,{},function(){
                                //     var e=document.createElement("canvas");
                                //     e.width=a,e.height=a;
                                //     var n=(r.width-e.width)/-2,i=(r.height-e.height)/-2;
                                //     e.getContext("2d").drawImage(r,n,i,r.width,r.height),
                                //     t.isMounted()&&t.props.onChange(e.toDataURL("image/jpeg"))s
                                //     }
                                // )
                                
                                $(".box-galery-products").append(n);
                            }
                        },
                        i.readAsDataURL(n)
                    }
                    
                    callbackOnSuccess(f);
                    
                    
                //     // this.formData.append(this.nameFile, f);
                // 
                //     var reader = new FileReader();
                // 
                //     // Closure to capture the file information.
                //     reader.onload = (function(theFile) {
                //         return function(e) {
                //             // $(this.selectorImg).attr("src", e.target.result);
                //             callbackOnReadFile(e.target.result);
                //         };
                //     })(f);
                // 
                //     // Read in the image file as a data URL.
                //     reader.readAsDataURL(f);
                }
            }
        );
    } else {
        throw "El selector debe ser del tipo cadena.";
    }
}