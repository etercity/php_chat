function send()
{
    //Считываем сообщение из поля ввода с id mess_to_add
    var comment=$("#mess_to_send").val();
    // Отсылаем паметры
    $.ajax({
        type: "POST",
        url: "/chat/add",
        data:"comment="+comment,
        // Выводим то что вернул PHP
        success: function(html)
        {
            //Если все успешно, загружаем сообщения
            load_messes();
            //Очищаем форму ввода сообщения
            $("#mess_to_send").val('');
        }
    });
}
function sendprivate()
{
    //Считываем сообщение из поля ввода с id mess_to_add
    var comment=$("#mess_to_send").val();
    // Отсылаем паметры
    $.ajax({
        type: "POST",
        url: "/chat/private",
        data:"comment="+comment,
        // Выводим то что вернул PHP
        success: function(html)
        {
            //Если все успешно, загружаем сообщения
            load_messes();
            //Очищаем форму ввода сообщения
            $("#mess_to_send").val('');
        }
    });
}
//Функция загрузки сообщений
function load_messes()
{
    $.ajax({
        type: "POST",
        url:  "/chat/main",
        data: "req=ok",
        // Выводим то что вернул PHP
        success: function(html)
        {
            //Очищаем форму вывода
            $("#chatbox").empty();
            //Выводим что вернул нам php
            $("#chatbox").append(html);
            //Прокручиваем блок вниз(если сообщений много)
            $("#chatbox").scrollTop(90000);
        }
    });
}
//Фоновая функция загрузки сообщений
function load_fone_messes()
{
    $.ajax({
        type: "POST",
        url:  "/chat/main",
        data: "req=ok",
        // Выводим то что вернул PHP
        success: function(html)
        {
            //Очищаем форму вывода
            $("#chatbox").empty();
            //Выводим что вернул нам php
            $("#chatbox").append(html);
        }
    });
}
//Функция загрузки users
function load_users()
{
    $.ajax({
        type: "POST",
        url:  "/chat/loadusers",
        data: "req=ok",
        // Выводим то что вернул PHP
        success: function(html)
        {
            //Очищаем форму вывода
            $("#users").empty();
            //Выводим что вернул нам php
            $("#users").append(html);
        }
    });
}
//Функция выбора смайликов
function select_smile() {
    $(document).ready(function(){
        $(".smile").click(function(){
            var smile = $(this).attr('alt');
            var text = $.trim($("#mess_to_send").val());
            $("#mess_to_send").focus().val(text + ' ' + smile + ' ');
        });
    });
}
//Функция выбора login
function select_user() {
    $(document).ready(function(){
        $(".login").click(function(){
            var login = $(this).attr('value');
            $("#mess_to_send").focus().val('[' + login + '] ');
        });
    });
}
//
function soundClick() {
    var audio = new Audio(); // Создаём новый элемент Audio
    audio.src = '/sound/doorbell.mp3'; // Указываем путь к звуку "клика"
    audio.autoplay = true; // Автоматически запускаем
}
//Функция выбора login по никам в окне чата
function select_user_chat() {
    $(document).ready(function(){
        $(".user_login").click(function(){
            var user_login = $(this).attr('value');
            $("#mess_to_send").focus().val('[' + user_login + '] ');
        });
    });
}
//Ответ по времени
function select_time() {
    $(document).ready(function(){
        $(".mess_time_they").click(function(){
            var mess_time_they = $(this).attr('value');
            $("#mess_to_send").focus().val('' + mess_time_they + ' ');
        });
    });
}
//