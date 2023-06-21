let base64 = "";
let fileB64 = "";
//leer file al soltar en input
readURL = function(input) {

    if (input.files && input.files[0]) {

        var ext = $("#archivo").val().split(".").pop().toLowerCase();
        var peso = input.files[0].size / 1024 / 1024;

        var reader = new FileReader();
        reader.onload = function(e) {
            $(".image-upload-wrap").hide();

            /* if (ext == "pdf") {
                $(".file-upload-image").attr("src", $("#imgpdf").val());
                $(".file-upload-image").removeClass("w-100");
                $(".file-upload-image").removeClass("w-25");
                $(".file-upload-image").addClass("w-25");
                $(".file-upload-image").removeClass("w-100");
                $("#DocumentoNombre").val($("#archivo").val().split("\\").pop());
            } else  */
            if (ext == "jpg" || ext == "jpeg" || ext == "png") {
                $(".file-upload-image").attr("src", e.target.result);
                $(".file-upload-image").removeClass("w-100");
                $(".file-upload-image").removeClass("w-25");
                $(".file-upload-image").addClass("w-100");
                $("#DocumentoNombre").val($("#archivo").val().split("\\").pop());
            }

            if (peso <= 3) {
                base64 = e.target.result;
                $("#archivo64").val(base64);
                fileB64 = base64;

                $(".file-upload-content").show();

            } else {
                removeUpload();
                toastr.options.timeOut = 3000;
                toastr.error("Su imagen debe ser menor a 3MB", "Datos incorrectos!");
            }
        };

        reader.readAsDataURL(input.files[0]);

    } else {
        removeUpload();
    }
};
//css para componente arrastrable file
removeUpload = function() {
    $(".file-upload-input").replaceWith($(".file-upload-input").clone());
    $(".file-upload-content").hide();
    $(".image-upload-wrap").show();
    $(".file-upload-input").val("");
    $(".image-upload-wrap").removeClass("image-dropping");
    base64 = "";
    fileB64 = "";
};

$(".image-upload-wrap").bind("dragover", function() {
    $(".image-upload-wrap").addClass("image-dropping");
});

$(".image-upload-wrap").bind("dragleave", function() {
    $(".image-upload-wrap").removeClass("image-dropping");
});




/* AUXILIAR PARA ARCHIVOS */
let base64_aux = "";
let fileB64_aux = "";
var fileTypes_aux = ['pdf', 'txt', 'doc', 'docx', 'xls', 'xlsx']; //acceptable file types
//leer file al soltar en input
readURL_aux = function(input) {

    if (input.files && input.files[0]) {

        var ext = $("#archivo_aux").val().split(".").pop().toLowerCase();
        var peso = input.files[0].size / 1024 / 1024;

        var reader = new FileReader();
        reader.onload = function(e) {
            $(".image-upload-wrap_aux").hide();

            if (fileTypes_aux.indexOf(ext) > -1) {
                if (ext == "jpg" || ext == "jpeg" || ext == "png") {
                    $(".file-upload-image_aux").attr("src", e.target.result);
                    $(".file-upload-image_aux").removeClass("w-100");
                    $(".file-upload-image_aux").removeClass("w-25");
                    $(".file-upload-image_aux").addClass("w-100");
                    $("#DocumentoNombre_aux").val($("#archivo_aux").val().split("\\").pop());
                } else {
                    $(".file-upload-image_aux").attr("src", $("#imgfile_aux").val());
                    if (ext == "pdf") {
                        $(".file-upload-image_aux").attr("src", $("#imgpdf_aux").val());
                    }
                    if (ext == "txt") {
                        $(".file-upload-image_aux").attr("src", $("#imgtxt_aux").val());
                    }
                    if (ext == "doc" || ext == "doc") {
                        $(".file-upload-image_aux").attr("src", $("#imgdoc_aux").val());
                    }
                    if (ext == "xls" || ext == "xlsx") {
                        $(".file-upload-image_aux").attr("src", $("#imgxls_aux").val());
                    }
                    if (ext == "ppt" || ext == "pptx") {
                        $(".file-upload-image_aux").attr("src", $("#imgppt_aux").val());
                    }
                    $(".file-upload-image_aux").removeClass("w-100");
                    $(".file-upload-image_aux").removeClass("w-25");
                    $(".file-upload-image_aux").addClass("w-25");
                    $(".file-upload-image_aux").removeClass("w-100");
                    $("#DocumentoNombre_aux").val($("#archivo_aux").val().split("\\").pop());
                }

                if (peso <= 3) {
                    base64_aux = e.target.result;
                    $("#archivo64_aux").val(base64_aux);
                    fileB64_aux = base64_aux;

                    $(".file-upload-content_aux").show();

                } else {
                    removeUpload_aux();
                    toastr.options.timeOut = 3000;
                    toastr.error("Su documento debe ser menor a 3MB", "Datos incorrectos!");
                }

            } else {
                removeUpload_aux();
                toastr.options.timeOut = 3000;
                toastr.error("Formatos permitidos: .doc .docx .xls .xlsx .ppt .pptx .txt .pdf", "Formato no permitido!");
            }
        };

        reader.readAsDataURL(input.files[0]);

    } else {
        removeUpload_aux();
    }
};
//css para componente arrastrable file
removeUpload_aux = function() {
    $(".file-upload-input_aux").replaceWith($(".file-upload-input_aux").clone());
    $(".file-upload-content_aux").hide();
    $(".image-upload-wrap_aux").show();
    $(".file-upload-input_aux").val("");
    $(".image-upload-wrap_aux").removeClass("image-dropping_aux");
    base64_aux = "";
    fileB64_aux = "";
};

$(".image-upload-wrap_aux").bind("dragover", function() {
    $(".image-upload-wrap_aux").addClass("image-dropping_aux");
});

$(".image-upload-wrap_aux").bind("dragleave", function() {
    $(".image-upload-wrap_aux").removeClass("image-dropping_aux");
});