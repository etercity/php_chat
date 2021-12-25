if($('div').is('#file')){
    var buttonFile = $("#file"),
        file;
}

if(buttonFile){
    new AjaxUpload(buttonFile, {
        action: buttonFile.data('url') + "?upload=1",
        data: {name: buttonFile.data('name')},
        name: buttonFile.data('name'),
        onSubmit: function(file, ext){
            if (! (ext && /^(jpg|png|jpeg|gif|bmp|zip|pdf|doc|docx|xls|xlsx|mp3|mp4|txt|)$/i.test(ext))){
                alert('Даний тип файлу не підтримується');
                return false;
            }

        },
        onComplete: function(file, response){
            alert(response);
        }
    });
}
