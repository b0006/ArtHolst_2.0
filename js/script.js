$( document ).ready(function() {

    /*$("#mobile_phone").mask("+7 ?(999) 999 99 99");*/

    $(".send").click(function(){
        $(this).toggleClass("choose");
    });

    $('#callback_form').submit(function (evtObj) {
        evtObj.preventDefault();

        /* --------------------------- */
        // Получаем выделенный тип фото
        var arResult = [];
        var isFind = "";

        $("#for_choose > li").each(function(){
            isFind = $(this).hasClass("choose");
            if(isFind == true){
                var result = $(this).text();
                //убираем лишние пробелы
                arResult.push(result.replace(/\s{2,}/g, ''));
            }
        });

        // передача с изображение и без немного отличается
        // НЕБОЛЬШОЙ КОСТЫЛЬ
        var resultData_without_img = "";
        var resultData_with_img = [];

        for(var i = 0; i < arResult.length; i++){
            resultData_without_img += "&choose" + (i + 1) + "=" + arResult[i];
            resultData_with_img["choose" + (i + 1)] = arResult[i];
        }

        /* --------------------------- */

        if (document.getElementById("callback_form").image_file.value !== '') {
            var form = document.forms.callback_form;
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/include/callback.php");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        data = xhr.responseText;

                        alert("Отправлено письмо с Вашей фотографией");
                        document.getElementById("callback_form").reset();
                    }
                }
            };
            /* --------------- */
            // Добавление выбранных видов картин
            for(var item in resultData_with_img) {
                formData.append(item, resultData_with_img[item]);
            }
            /* -------------- */
            xhr.send(formData);
        } else {
            var form = $(this);
            $.ajax({
                url: '/include/callback.php',
                type: 'POST',
                dataType: "html",
                data: form.serialize() + resultData_without_img,
                success: function (data) {
                    //alert(data);
                    alert("Ваше письмо отправлено");
                    document.getElementById("callback_form").reset();
                },
                error: function (data) {
                    alert(data);
                }
            });
        }
    });
});