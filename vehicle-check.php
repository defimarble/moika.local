<?php
$vehicleNumber = isset($_GET['number']) && is_string($_GET['number'])
    ? strtoupper(trim($_GET['number']))
    : '';
$vehicleNumber = preg_replace('/\s+/u', '', $vehicleNumber);

if (!preg_match('/^[A-Z0-9-]{1,20}$/', $vehicleNumber)) {
    http_response_code(400);
    $vehicleNumber = '';
}

header('Content-Type: text/html; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: no-referrer');
header("Content-Security-Policy: default-src 'none'; script-src 'unsafe-inline'; style-src 'unsafe-inline'; base-uri 'none'; form-action 'none'; frame-ancestors 'none'");

$registryUrl = 'https://eteenindus.mnt.ee/public/soidukTaustakontroll.jsf?lang=ru';
$escapedNumber = htmlspecialchars($vehicleNumber, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Проверка автомобиля</title>
    <style>
        :root { color-scheme: light dark; }
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; font: 18px/1.5 Arial, sans-serif; background: #101720; color: #eeeae4; }
        main { width: min(420px, calc(100% - 40px)); text-align: center; }
        strong { display: block; margin: 18px 0; font-size: 2rem; letter-spacing: .08em; }
        button { width: 100%; padding: 15px 18px; border: 0; border-radius: 6px; background: #d0a237; color: #0d2842; font: inherit; font-weight: 700; cursor: pointer; }
        p { color: #aaa49b; }
        [hidden] { display: none; }
    </style>
</head>
<body>
<main>
<?php if ($vehicleNumber === ''): ?>
    <h1>Номер автомобиля не указан</h1>
<?php else: ?>
    <h1>Проверка автомобиля</h1>
    <p>Регистрационный номер</p>
    <strong id="vehicle-number"><?php echo $escapedNumber; ?></strong>
    <p id="status">Копируем номер…</p>
    <button type="button" id="copy-open" hidden>Скопировать номер и открыть Transpordiamet</button>
    <script>
        (function () {
            var number = <?php echo json_encode($vehicleNumber, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
            var registryUrl = <?php echo json_encode($registryUrl, JSON_UNESCAPED_SLASHES); ?>;
            var status = document.getElementById('status');
            var button = document.getElementById('copy-open');

            function copyNumber() {
                if (navigator.clipboard && window.isSecureContext) {
                    return navigator.clipboard.writeText(number);
                }

                var input = document.createElement('textarea');
                input.value = number;
                input.setAttribute('readonly', '');
                input.style.position = 'fixed';
                input.style.opacity = '0';
                document.body.appendChild(input);
                input.select();
                var copied = document.execCommand('copy');
                input.remove();
                return copied ? Promise.resolve() : Promise.reject();
            }

            function openRegistry() {
                window.location.replace(registryUrl);
            }

            function requireButton() {
                status.textContent = 'Браузеру требуется подтверждение копирования.';
                button.hidden = false;
            }

            button.addEventListener('click', function () {
                copyNumber().then(openRegistry, function () {
                    status.textContent = 'Не удалось скопировать номер. Скопируйте его вручную.';
                    button.textContent = 'Открыть Transpordiamet';
                    button.onclick = openRegistry;
                });
            });

            copyNumber().then(function () {
                status.textContent = 'Номер скопирован. Открываем Transpordiamet…';
                window.setTimeout(openRegistry, 500);
            }, requireButton);
        }());
    </script>
<?php endif; ?>
</main>
</body>
</html>
