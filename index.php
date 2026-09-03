<?php include_once('elements/top-page.php'); ?>
    <title>Автомойка Pirita Pesula</title>
	<meta name="description" content="✓Профессиональная ручная мойка автомобиля в Таллинне ✪ Pirita Pesula ✪ Качественный сервис и чистота вашего автомобиля с 2016 года ➨ Записывайтесь!">

<?php include_once('elements/header.php'); ?>

    <div id="main-slider">
        <div id="slider">
            <ul>
				<li>
					<a href="moika_avto_snaruzhi.php"
                       data-title="Наружная мойка автомобиля"
                       data-copy="Безопасная ручная мойка и тщательная сушка кузова.">
                    <img decoding="async" src="slider/SlideOuterWash_ru.webp" alt="Наружная мойка автомобиля">
					</a>
                </li>
				<li>
					<a href="chistka_salona_avto.php"
                       data-title="Чистка салона автомобиля"
                       data-copy="Профессиональная уборка салона для чистоты и комфорта.">
                    <img decoding="async" src="slider/SlideInsideWash_ru.webp" alt="Чистка салона автомобиля">
					</a>
                </li>
 				<li>
					<a href="polirovka_kuzova.php"
                       data-title="Полировка автомобиля"
                       data-copy="Восстанавливаем блеск кузова и уменьшаем видимость дефектов.">
                    <img decoding="async" src="slider/SlidePolish_ru.webp" alt="Полировка автомобиля">
					</a>
                </li>

            </ul>
            <div id="next-review">

            </div>
            <div id="prev-review">

            </div>
            
        </div>
    </div>
    <div id="main-advantages">
        <div id="advantages">
            <div class="block-title">
                наши преимущества
            </div>
            <ul class="advantages-list">
                <li>
                    Отличное качество
                    предлагаемых услуг
                </li>
                <li>
                    Быстрое
                    выполнение услуг
                </li>
                <li>
                    Индивидуальный
                    подход к клиенту
                </li>
                <li>
                    Квалифицированый
                    персонал
                </li>
                <li>
                    Мы используем только
                    современное оборудование
                </li>
                <li>
                    Удобная оплата услуг
                </li>
            </ul>
        </div>
    </div>
    <div id="main-service">
	<div class="line" id="mainserv"></div>
        <div id="service">
            <div class="line" id="price"></div>
            <div class="block-title">
                Основные услуги
            </div>
            <ul class="service-list">
                <li id="moyka">
                    <a href="moika_avto_snaruzhi.php" class="title">
                        наружная мойка
                    </a>
                    <div class="list">
                        <div class="sub-title">
                            <span>Цена от:</span> 75 €
                        </div>
                        <ul class="short-desc">
                            <li>
                                антибитумная пропитка
                            </li>
                            <li>
                                пропитка от солей и крупных загрязнений
                            </li>
                            <li>
                                мойка шампунем 
                            </li>
                            <li>
                                покрытие жидким воском
                            </li>
                            <li>
                                мойка дисков кислотой
                            </li>
                            
                            <li>
                                очистка насадок выхлопных труб
                            </li>
                            <li>
                                мойка проемов
                            </li>
                            <li>
                                мойка арок
                            </li>
                            <li>
                                очистка пылесосом ковриков и пола
                            </li>
                            <li>
                                чистка стекол снаружи
                            </li>
                            <li>
                                блеск для резины
                            </li>
                        </ul>
                    </div>
                    <div class="bt-bron" onclick="AlexApp.popup('Мойка')">
                        Забронировать
                    </div>
                </li>
                <li id="salon">
                    <a href="chistka_salona_avto.php" class="title">
                        чистка салона
                    </a>
                    <div class="list">
                        <div class="sub-title">
                            <span>Цена от:</span> 60 €
                        </div>
                        <ul class="short-desc">
                            <li>
                                чистка пылесосом всего салона 
                            </li>
                            <li>
                                чистка пылесосом багажника
                            </li>
                            <li>
                                комплексная обработка передней панели
                            </li>
                            <li>
                                чистка всего пластика очищающими составами
                            </li>
                            <li>
                                чистка и защитная обработки кожи
                            </li>
                            <li>
                                чистка стекол изнутри
                            </li>
                        </ul>
                    </div>
                    <div class="bt-bron" onclick="AlexApp.popup('Чистка салона')">
                        Забронировать
                    </div>
                </li>
                <li id="deitering">
                    <a href="deteiling_tallinn.php" class="title">
                        Детейлинг
                    </a>
                    <div class="list">
                        <div class="sub-title">
                            <span>Цена от:</span> 150 €
                        </div>
                        <ul class="short-desc">
                            <li>
                                комплексная и частичная химчистка салона
                            </li>
                            <li>
                                химчистка двигателя
                            </li>
                            <li>
                                защитное покрытие воском
                            </li>
                            <li>
                                защитная обработка керамическими составами
                            </li>
                            <li>
                                антиголограммная полировка
                            </li>
			    <li>
                                очистка и защита стекол 
                            </li>
			    <li>
                                полная очистка автомобиля
                            </li>
                            
                        </ul>
                    </div>
                    <div class="bt-bron" onclick="AlexApp.popup('Детейлинг')">
                        Забронировать
                    </div>
                </li>
            </ul>
            <a href="price.php" class="full-price">
                <span>
                    Полный прайс-лист услуг >
                </span>
            </a>
        </div>
    </div>
    <div id="main-booking">
        <div id="booking">
            <div class="left">
                <div class="title">
                    Бронирование
                </div>
                <div class="main-form">
                    <script>
                        $(function(){
                            var $bookingForm = $("#booking-form");
                            var $bookingStatus = $("#booking-status");
                            var $submitButton = $bookingForm.find('button[type="submit"]');
                            var bookingValidationMessages = <?php echo json_encode(array(
                                'service' => site_translate('Выберите услугу'),
                                'name' => site_translate('Введите имя'),
                                'date' => site_translate('Введите дату'),
                                'dateInvalid' => site_translate('Введите корректную дату'),
                                'time' => site_translate('Введите время'),
                                'phone' => site_translate('Введите телефон'),
                                'phoneInvalid' => site_translate('Введите корректный телефон')
                            ), JSON_UNESCAPED_SLASHES); ?>;

                            $.validator.addMethod("internationalPhone", function(value, element) {
                                return this.optional(element) || /^\+?[0-9\s()\-]{7,20}$/.test(value);
                            }, bookingValidationMessages.phoneInvalid);

                            $bookingForm.validate({
                                rules: {
                                    usl: "required",
                                    name: "required",
                                    date: {
                                        required: true,
                                        bookingDate: true
                                    },
                                    time: "required",
                                    tel: {
                                        required: true,
                                        internationalPhone: true
                                    }
                                },
                                messages: {
                                    usl: bookingValidationMessages.service,
                                    name: bookingValidationMessages.name,
                                    date: {
                                        required: bookingValidationMessages.date,
                                        bookingDate: bookingValidationMessages.dateInvalid
                                    },
                                    time: bookingValidationMessages.time,
                                    tel: {
                                        required: bookingValidationMessages.phone,
                                        internationalPhone: bookingValidationMessages.phoneInvalid
                                    }
                                },
                                ignore: "div:hidden input, div:hidden select",
                                errorElement: "span",
                                errorPlacement: function(error, element) {
                                    var $styledSelect = element.closest(".jq-selectbox");
                                    if (element.is("select") && $styledSelect.length) {
                                        error.insertAfter($styledSelect);
                                        return;
                                    }
                                    if (element.attr("name") === "date") {
                                        error.insertAfter(element.closest(".booking-date-control"));
                                        return;
                                    }
                                    error.insertAfter(element);
                                },
                                submitHandler : function(form){
                                    var formData = BookingDate.formData(form);
                                    $bookingStatus.removeClass("ok error").text("");
                                    $submitButton.prop("disabled", true).text("Отправляем…");
                                    $.ajax({
                                        type: "POST",
                                        processData: false,
                                        contentType: false,
                                        url: "/sender.php",
                                        data:  formData,
                                        success: function(data){
                                            $bookingStatus.addClass("ok").text(data);
                                            form.reset();
                                            $bookingForm.find("select").trigger("refresh");
                                        },
                                        error: function(xhr){
                                            var message = xhr.responseText || "Не удалось отправить заявку. Позвоните нам по телефону +372 5391 8434.";
                                            $bookingStatus.addClass("error").text(message);
                                        },
                                        complete: function(){
                                            $submitButton.prop("disabled", false).text("Забронировать");
                                        }
                                    });
                                }
                            });
                        });
                    </script>
                    <form id="booking-form" action="/sender.php" method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(booking_csrf_token(), ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="lang" value="<?php echo htmlspecialchars(site_language(), ENT_QUOTES, 'UTF-8'); ?>">
                        <ul>
                            <li>
                                <label for="booking-service">Услуга</label>
                                <select name="usl" id="booking-service" required>
                                    <option value="">Выберите услугу</option>
                                    <option value="Наружная мойка и чистка салона">Наружная мойка и чистка салона</option>
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
                                <label for="booking-name">Ваше имя</label>
                                <input type="text" name="name" id="booking-name" placeholder="Ваше имя *" autocomplete="name" maxlength="80" required>
                            </li>
                            <li>
                                <label for="booking-phone">Ваш телефон</label>
                                <input type="tel" name="tel" id="booking-phone" placeholder="Телефон *" autocomplete="tel" inputmode="tel" maxlength="30" required>
                            </li>
                            <li>
                                <ul class="sb">
                                    <li>
                                        <label for="datepicker">Дата</label>
                                        <span class="booking-date-control">
                                            <input type="text" name="date" id="datepicker" placeholder="Дата *" autocomplete="off" required>
                                            <button type="button" class="booking-date-trigger" data-date-input="datepicker" aria-label="Выберите дату"></button>
                                        </span>
                                    </li>
                                    <li>
                                        <label for="booking-time">Время</label>
                                        <select name="time" id="booking-time" required>
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
                                        </select>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <label for="booking-car">Номер автомобиля</label>
                                <input type="text" placeholder="Номер автомобиля" name="auto_number" id="booking-car" autocomplete="off" maxlength="20">
                            </li>
                            <li>
                                <label for="booking-message">Комментарий</label>
                                <textarea name="message" id="booking-message" placeholder="Комментарий (необязательно)" maxlength="1000"></textarea>
                            </li>
                            <li class="booking-honeypot" aria-hidden="true">
                                <label for="booking-website">Сайт</label>
                                <input type="text" name="website" id="booking-website" tabindex="-1" autocomplete="off">
                            </li>
                            <li>
                                <p class="booking-note">Поля со звёздочкой обязательны. Мы свяжемся с вами для подтверждения времени.</p>
                                <button type="submit">Забронировать</button>
                            </li>
                        </ul>
                        <div id="booking-status" class="booking-status" role="status" aria-live="polite"></div>
                    </form>
                </div>

            </div>
            <div class="right">
                <div class="title">
                    Свяжитесь с нами!
                </div>
                <a class="number" href="tel:+37253918434">
                    +372 5391 8434
                </a>
            </div>
        </div>
    </div>
    <div id="main-map">
        <div id="map">
            <div class="line" id="contacts"></div>
			<iframe style="pointer-events: none;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10180.264503675768!2d24.82739872526673!3d59.4745489641172!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x469292d30aacc571%3A0xe17c0c690816561d!2sPirita%20Pesula!5e0!3m2!1sen!2sus!4v1716416879604!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <script>
            setTimeout(function () {
                // Disable scroll zooming and bind back the click event
                var onMapMouseleaveHandler = function (event) {
                    var that = $(this);

                    that.on('click', onMapClickHandler);
                    that.off('mouseleave', onMapMouseleaveHandler);
                    that.find('iframe').css("pointer-events", "none");
                }

                var onMapClickHandler = function (event) {
                    var that = $(this);

                    // Disable the click handler until the user leaves the map area
                    that.off('click', onMapClickHandler);

                    // Enable scrolling zoom
                    that.find('iframe').css("pointer-events", "auto");

                    // Handle the mouse leave event
                    that.on('mouseleave', onMapMouseleaveHandler);
                }
                // Enable map zooming with mouse scroll when the user clicks the map
                $('#map').on('click', onMapClickHandler);
            },500)
        </script>
        </div>
    </div>
    
<?php include_once('elements/footer.php'); ?>
