<?php include_once('elements/related-services.php'); ?>
<div id="main-footer">
        <div id="footer">
            <p class="slogan">Наш сервис - самый лучший!</p>
            <ul class="social">
                <li>
                    <a href="https://vk.com/piritapesula" target="_blank" rel="noopener noreferrer">
                        <img loading="lazy" decoding="async" src="image/vk.png" alt="Pirita Pesula во ВКонтакте">
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/piritapesula/" target="_blank" rel="noopener noreferrer">
                        <img loading="lazy" decoding="async" src="image/fc.png" alt="Pirita Pesula в Facebook">
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/piritapesula/" target="_blank" rel="noopener noreferrer">
                        <img loading="lazy" decoding="async" src="image/inst.png" alt="Pirita Pesula в Instagram">
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
                    <a href="index.php#contacts">
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
            $.validator.addMethod("internationalPhone", function(value, element) {
                return this.optional(element) || /^\+?[0-9\s()\-]{7,20}$/.test(value);
            }, "Введите корректный телефон");

            $("#datepicker2").datepicker("option", {
                minDate: 0,
                dateFormat: "dd.mm.yy"
            });

            var $popupForm = $("#popup-booking-form");
            var $popupStatus = $("#popup-booking-status");
            var $popupSubmit = $popupForm.find('input[type="submit"]');

            $popupForm.validate({
                rules: {
                    name: "required",
                    date: "required",
                    time: "required",
                    tel: {
                        required: true,
                        internationalPhone: true
                    }
                },
                messages: {
                    name: "Введите имя",
                    date: "Введите дату",
                    time: "Введите время",
                    tel: {
                        required: "Введите телефон",
                        internationalPhone: "Введите корректный телефон"
                    }
                },
                ignore: "div:hidden input, div:hidden select",
                errorElement: "span",
                submitHandler : function(form){
                    var formData = new FormData(form);
                    $popupStatus.removeClass("ok error").text("");
                    $popupSubmit.prop("disabled", true).val("Отправляем…");
                         $.ajax({
                             type: "POST",
                             processData: false,
                             contentType: false,
                             url: "sender.php",
                             data:  formData,
                             success: function(data){
                                 $popupStatus.addClass("ok").text(data);
                                 form.reset();
                                 $popupForm.find("select").trigger("refresh");
                             },
                             error: function(xhr){
                                 var message = xhr.responseText || "Не удалось отправить заявку. Позвоните нам по телефону +372 5391 8434.";
                                 $popupStatus.addClass("error").text(message);
                             },
                             complete: function(){
                                 $popupSubmit.prop("disabled", false).val("Забронировать");
                             }
                         });
                }
            });
        });
    </script>
    <form id="popup-booking-form" action="sender.php" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(booking_csrf_token(), ENT_QUOTES, 'UTF-8'); ?>">
        <ul>
            <li>
                <label for="popup-service">Услуга</label>
                <select name="usl" id="popup-service" required>
                    <option value="">Выберите услугу</option>
                    <option value="Наружная мойка">Наружная мойка</option>
                    <option value="Чистка салона">Чистка салона</option>
                    <option value="Полировка кузова">Полировка кузова</option>
                    <option value="Полировка и восстановление фар">Полировка и восстановление фар</option>
                    <option value="Химчистка салона">Химчистка салона</option>
                    <option value="Химчистка двигателя">Химчистка двигателя</option>
                    <option value="Полная очистка автомобиля">Полная очистка автомобиля</option>
                    <option value="Покрытие воском">Покрытие воском</option>
                    <option value="Покрытие керамикой">Покрытие керамикой</option>
                    <option value="Покрытие защитной плёнкой">Покрытие защитной плёнкой</option>
                    <option value="Детейлинг автомобиля">Детейлинг автомобиля</option>
                    <option value="Детейлинг яхты">Детейлинг яхты</option>
                </select>
            </li>
            <li>
                <label for="popup-name">Ваше имя</label>
                <input type="text" name="name" id="popup-name" placeholder="Ваше имя *" autocomplete="name" maxlength="80" required>
            </li>
            <li>
                <label for="popup-phone">Ваш телефон</label>
                <input type="tel" name="tel" id="popup-phone" placeholder="Телефон, например +372 5555 5555 *" autocomplete="tel" inputmode="tel" maxlength="30" required>
            </li>
            <li>
                <ul class="sb">
                    <li>
                        <label for="datepicker2">Дата</label>
                        <input type="text" name="date" id="datepicker2" placeholder="Дата *" autocomplete="off" required>
                    </li>
                    <li>
                        <label for="popup-time">Время</label>
                        <select name="time" id="popup-time" required>
                            <option value="">Время *</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                            <option value="18:00">18:00</option>
                            <option value="19:00">19:00</option>
                        </select>
                    </li>
                </ul>
            </li>
            <li>
                <label for="popup-car">Номер автомобиля</label>
                <input type="text" placeholder="Номер автомобиля (необязательно)" name="auto_number" id="popup-car" autocomplete="off" maxlength="20">
            </li>
            <li>
                <label for="popup-message">Комментарий</label>
                <textarea name="message" id="popup-message" placeholder="Комментарий (необязательно)" maxlength="1000"></textarea>
            </li>
            <li class="booking-honeypot" aria-hidden="true">
                <label for="popup-website">Сайт</label>
                <input type="text" name="website" id="popup-website" tabindex="-1" autocomplete="off">
            </li>
            <li>
                <p class="booking-note">Поля со звёздочкой обязательны. Мы свяжемся с вами для подтверждения времени.</p>
                <input type="submit" value="Забронировать">
            </li>
        </ul>
        <div id="popup-booking-status" class="booking-status" role="status" aria-live="polite"></div>
    </form>
</div>
</body>
</html>
