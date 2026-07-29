<?php

if (PHP_SAPI !== 'cli') {
    exit("CLI only.\n");
}

$root = dirname(__DIR__);
require_once $root . '/elements/i18n.php';

$pages = site_public_pages();
$strings = array();

foreach ($pages as $page) {
    $curl = curl_init('http://moika.local/' . $page);
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 20
    ));
    $html = curl_exec($curl);
    curl_close($curl);

    if (!is_string($html) || $html === '') {
        fwrite(STDERR, "Could not render {$page}\n");
        continue;
    }

    $document = new DOMDocument();
    libxml_use_internal_errors(true);
    $document->loadHTML('<?xml encoding="UTF-8">' . $html);
    libxml_clear_errors();
    $xpath = new DOMXPath($document);

    foreach ($xpath->query('//text()[not(ancestor::script) and not(ancestor::style)]') as $node) {
        add_translation_string($strings, $node->nodeValue);
    }

    foreach (array('placeholder', 'alt', 'title', 'content', 'value') as $attribute) {
        foreach ($xpath->query('//*[@' . $attribute . ']') as $node) {
            add_translation_string($strings, $node->getAttribute($attribute));
        }
    }

    foreach ($xpath->query('//script') as $script) {
        if (preg_match_all('/(["\'])([^"\']*[А-Яа-яЁё][^"\']*)\1/u', $script->nodeValue, $matches)) {
            foreach ($matches[2] as $value) {
                add_translation_string($strings, $value);
            }
        }
    }
}

$strings = array_values($strings);
usort($strings, function ($left, $right) {
    return mb_strlen($right, 'UTF-8') <=> mb_strlen($left, 'UTF-8');
});

echo 'Collected strings: ' . count($strings) . PHP_EOL;

foreach (array('en', 'et') as $language) {
    $targetFile = $root . '/languages/' . $language . '.generated.php';
    $existing = is_file($targetFile) ? require $targetFile : array();
    $missing = array_values(array_filter($strings, function ($source) use ($existing) {
        return !isset($existing[$source]);
    }));

    echo strtoupper($language) . ' missing: ' . count($missing) . PHP_EOL;
    if ($missing) {
        $translated = translate_strings($missing, $language);
        foreach ($translated as $index => $translation) {
            if ($translation !== '') {
                $existing[$missing[$index]] = $translation;
            }
        }
    }

    $ordered = array();
    foreach ($strings as $source) {
        if (isset($existing[$source])) {
            $ordered[$source] = $existing[$source];
        }
    }

    $php = "<?php\n// Generated translation catalogue. Manual terminology overrides live in {$language}.php.\nreturn " .
        var_export($ordered, true) . ";\n";
    file_put_contents($targetFile, $php);
    echo strtoupper($language) . ' written: ' . count($ordered) . PHP_EOL;
}

function add_translation_string(&$strings, $value)
{
    $value = preg_replace('/\s+/u', ' ', trim(html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8')));
    if ($value !== '' && preg_match('/[А-Яа-яЁё]/u', $value)) {
        $strings[$value] = $value;
    }
}

function translate_strings($strings, $language)
{
    $results = array_fill(0, count($strings), '');
    $queue = array_keys($strings);
    $multi = curl_multi_init();
    $handles = array();
    $concurrency = 8;

    while ($queue || $handles) {
        while ($queue && count($handles) < $concurrency) {
            $index = array_shift($queue);
            $url = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=ru&tl=' .
                rawurlencode($language) . '&dt=t&q=' . rawurlencode($strings[$index]);
            $handle = curl_init($url);
            curl_setopt_array($handle, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 25,
                CURLOPT_CONNECTTIMEOUT => 10,
                CURLOPT_HTTPHEADER => array('User-Agent: Mozilla/5.0')
            ));
            curl_multi_add_handle($multi, $handle);
            $handles[(int) $handle] = array($handle, $index);
        }

        do {
            $status = curl_multi_exec($multi, $running);
        } while ($status === CURLM_CALL_MULTI_PERFORM);

        while ($info = curl_multi_info_read($multi)) {
            $handle = $info['handle'];
            $key = (int) $handle;
            $index = $handles[$key][1];
            $body = curl_multi_getcontent($handle);
            $decoded = json_decode($body, true);

            if (isset($decoded[0]) && is_array($decoded[0])) {
                $translation = '';
                foreach ($decoded[0] as $part) {
                    if (isset($part[0])) {
                        $translation .= $part[0];
                    }
                }
                $results[$index] = trim($translation);
            } else {
                fwrite(STDERR, "Translation failed at index {$index}\n");
            }

            curl_multi_remove_handle($multi, $handle);
            curl_close($handle);
            unset($handles[$key]);
        }

        if ($running) {
            curl_multi_select($multi, 1.0);
        }
    }

    curl_multi_close($multi);
    return $results;
}
