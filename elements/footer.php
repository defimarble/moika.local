<div id="main-footer">
        <div id="footer">
            <p class="slogan">Наш сервис - самый лучший!</p>
            <ul class="social">
                <li>
                    <a href="https://vk.com/piritapesula" target="_blank">
                        <img src="image/vk.png">
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/piritapesula/" target="_blank">
                        <img src="image/fc.png">
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/piritapesula/" target="_blank">
                        <img src="image/inst.png">
                    </a>
                </li>
            </ul>
            <div class="work-time">
                <span>Время работы:</span><br>
                ПН-СБ 9:00-20:00<br>
                ВС - по предварительной записи<br>
            </div>
            <ul class="contacts">
                <li>
                    <a href="tel:+37253918434">
                        +372 5391 8434
                    </a>
                </li>
                <li>
                    <a href="mailto:piritapesula@gmail.com">
                        piritapesula@gmail.com
                    </a>
                </li>
                <li>
                    <a href="http://<?php echo $_SERVER['HTTP_HOST']?>#contacts">
                        Tallinn, Kalamehe tee, 1a
                    </a>
                </li>
            </ul>
            <div class="copyright">
                © 2016-2026 Käsipesu
            </div>
        </div>
    </div>
<div style="display: none" id="pop-up">
    <script>
        $(function(){
            jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
                phone_number = phone_number.replace(/\s+/g, "");
                return this.optional(element) || phone_number.length > 9 &&
                    phone_number.match(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/);
            }, "Please specify a valid phone number");

            $("#pop-up form").validate({
                rules: {
                    date: "required",
                    auto_number: "required",
                    time: "required",
                    tel: {
                        required: true,
                        phoneUS: true
                    }
                },
                messages: {
                    date: "Введите дату",
                    time: "Введите время",
                    tel: "Введите телефон",
                    auto_number: "Введите номер"
                },
                ignore: "div:hidden input, div:hidden select",
                submitHandler : function(){
                    var formData = new FormData($('.bron-dialog form')[0]);
                         $.ajax({
                             type: "POST",
                             processData: false,
                             contentType: false,
                             url: "sender.php",
                             data:  formData,
                             success: function(data){
                                 $('.bron-dialog form').html('<p class="ok">'+data+'</p><a href="#" class="close" onclick=\'$(".ui-dialog-content").dialog("close");\'>Закрыть</a> ');
                             }
                         })
                }
            });
        });
    </script>
    <form>
        <ul>
            <li>
                <select name="usl">
                    <option value="Мойка">
                        Мойка
                    </option>
                    <option value="Чистка салона">
                        Чистка салона
                    </option >
                    <option value="Детейлинг">
                        Детейлинг
                    </option>
					<option value="Детейлинг Яхты">
                        Детейлинг Яхты
                    </option>
                </select>
            </li>
            <li>
                <input type="tel" name="tel" placeholder="Ваш телефон">
            </li>
            <li>
                <ul class="sb">
                    <li>
                        <input type="text" name="date" id="datepicker2" placeholder="Дата">
                    </li>
                    <li>
                        <input type="text" name="time" placeholder="Время 00:00" pattern="[0-2]{2}-[0-9]{2}" class="time">
                    </li>
                </ul>
            </li>
            <li>
                <input type="text" placeholder="Номер авто" name="auto_number" style="width: 48%">
            </li>
            <li>
                            <textarea name="message" placeholder="Комментарий"></textarea>
            </li>
            <li>
                <input type="submit" value="Забронировать" >
            </li>
        </ul>
    </form>
</div>
</body>
</html>