<?php include_once('elements/top-page.php'); ?>
    <title>Автомойка Pirita Pesula</title>
	<meta name="description" content="✓Профессиональная ручная мойка автомобиля в Таллинне ✪ Pirita Pesula ✪ Качественный сервис и чистота вашего автомобиля с 2016 года ➨ Записывайтесь!">

<?php include_once('elements/header.php'); ?>

    <div id="main-slider">
        <div id="slider">
            <ul>
				<li>
					<a href="/moika_avto_snaruzhi.php">
                    <img src="slider/SlideOuterWash_ru.jpg" alt="Наружная мойка автомобиля">
					</a>
                </li>
				<li>
					<a href="/chistka_salona_avto.php">
                    <img src="slider/SlideInsideWash_ru.jpg" alt="Чистка салона автомобиля">
					</a>
                </li>
 				<li>
					<a href="/polirovka_kuzova.php">
                    <img src="slider/SlidePolish_ru.jpg" alt="Полировка автомобиля">
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
                            $("#booking form").validate({
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
                                    var formData = new FormData($('#booking form')[0]);
                                    $.ajax({
                                        type: "POST",
                                        processData: false,
                                        contentType: false,
                                        url: "sender.php",
                                        data:  formData,
                                        success: function(data){
                                            $('#booking form').html('<p class="ok">'+data+'</p>');
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
                                        Наружная мойка
                                    </option>
                                    <option value="Чистка салона">
                                        Чистка салона
                                    </option >
                                    <option value="Детейлинг автомобиля">
                                        Детейлинг автомобиля
                                    </option>
									<option value="Детейлинг яхты">
                                        Детейлинг яхты
                                    </option>
                                </select>
                            </li>
                            <li>
                                <input type="tel" name="tel" placeholder="Ваш телефон">
                            </li>
                            <li>
                                <ul class="sb">
                                    <li>
                                        <input type="text" name="date" id="datepicker" placeholder="Дата">
                                    </li>
                                    <li>
                                        <input type="text" name="time" placeholder="Время" class="time2">
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