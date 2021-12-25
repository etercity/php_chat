if($('div').is('#single')){
    var buttonSingle = $("#single"),
        file;
}

if(buttonSingle){
    new AjaxUpload(buttonSingle, {
        action: buttonSingle.data('url') + "?upload=1",
        data: {name: buttonSingle.data('name')},
        name: buttonSingle.data('name'),
        onSubmit: function(file, ext){
            if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
                alert('Помилка! Дозволені лише зображення (jpg|png|jpeg|gif), вагою не більше 32 Kб!');
                return false;
            }
        },
        onComplete: function(file, response){
            response = JSON.parse(response);
            $('.' + buttonSingle.data('name')).html('<img src="/images/' + response.file + '" style="max-height: 150px;">');
        }
    });
}
