<?php
require_once("config.php");
$update = json_decode(file_get_contents('php://input'), true);

$codes = [ 1 => '2567', 2 => '4198', 3 => '3716', 4 => '9182', 5 => '5619', 6 => '7256' ];

if (isset($update["message"])) {
    $chat_id = $update["message"]["chat"]["id"];
    $text = trim($update["message"]["text"]);

    $step = getUserStep($chat_id);

    if ($text === "/start") {
        setUserStep($chat_id, 1);
        setCode($chat_id, "");

        sendMessage($chat_id, "<b>Шановний Долгов Давид Русланович!</b>\n\nКомпанія <i>«Щаслива наречена»</i> щиро вітає Вас з визначною подією — <b>25-м Днем Народження!</b>🎉🎂\n\nУ зв’язку з цим святковим фактом, Вам надається доступ до <b>ексклюзивної програми приємностей</b>, розробленої спеціально для Вас😎\n\nДля активації бонусів необхідно виконати <i>низку нескладних дій</i>, кожна з яких принесе Вам приємні емоції та сюрпризи🎁🕵️‍♂️\n\n<b>Початок співпраці</b> полягає в пошукі різноманітних підказок⬇️\n\n📍Шукайте <i>в місці збереження Ваших педалей</i> або ж <i>у притулку втомлених підошов</i>\n\nЗ найкращими побажаннями щастя, натхнення, сили, любові та стабільного інтернету, <i>команда компанії «Щаслива наречена»</i>💌");

        $keyboard = [
            'keyboard' => [
                [['text' => '1️⃣'], ['text' => '2️⃣'], ['text' => '3️⃣']],
                [['text' => '4️⃣'], ['text' => '5️⃣'], ['text' => '6️⃣']],
                [['text' => '7️⃣'], ['text' => '8️⃣'], ['text' => '9️⃣']],
            ],
            'resize_keyboard' => true,
            'one_time_keyboard' => false
        ];

        sendMessage($chat_id, "Введіть код використовуючи клавіатуру бота:", $keyboard);

    } elseif (in_array($text, ['1️⃣', '2️⃣', '3️⃣', '4️⃣', '5️⃣', '6️⃣', '7️⃣', '8️⃣', '9️⃣'])) {
        $emoji_to_number = [
            '1️⃣' => '1', '2️⃣' => '2', '3️⃣' => '3',
            '4️⃣' => '4', '5️⃣' => '5', '6️⃣' => '6',
            '7️⃣' => '7', '8️⃣' => '8', '9️⃣' => '9',
        ];

        $code = getCode($chat_id);
        $code .= $emoji_to_number[$text];
        setCode($chat_id, $code);

        $display_code = "";
        for ($i = 0; $i < 4; $i++) {
            $display_code .= isset($code[$i]) ? $code[$i] . " " : "_ ";
        }
        $display_code = trim($display_code);
        sendMessage($chat_id, "Ваш код: $display_code");

        if (strlen($code) == 4) {
            sendMessage($chat_id, "Зачекай кілька секунд, йде перевірка коду... ⏳");
            sleep(2);

            global $codes;
            $current_step = getUserStep($chat_id);

            if (isset($codes[$current_step]) && $code === $codes[$current_step]) {
                $next_step = $current_step + 1;
                setUserStep($chat_id, $next_step);
                setCode($chat_id, "");

                switch ($next_step) {
                    case 2:
                        sendMessage($chat_id, "📍Шукай у місці для найкращого сексу... 🤭\n\n 💁🏼‍♀️ https://youtu.be/vg29p-3Yw5E?t=38", null, true);
                        break;
                    case 3:
                        sendMessage($chat_id, "📍Там, де розігріваються найсмачніші ідеї, а аромат здатен викликати спогади. Шукай уважно — тепло підкаже шлях🥩🔥");
                        break;
                    case 4:
                        sendMessage($chat_id, "📍Ти щодня зазираєш туди, обираючи, ким бути сьогодні: суворим, розслабленим чи невимушеним. Але хтось обрав тебе — і залишив слід. Пошукай між улюбленими кольорами й знайди дещо особливе🧶");
                        break;
                    case 5:
                        sendMessage($chat_id, "📍Є одне місце, куди тобі завжди було \"не можна\". Але, як відомо, найбільше хочеться саме того, що заборонено. Сьогодні я знімаю заборону. Всередині — те, що точно змусить тебе посміхнутися👰🏼");
                        break;
                    case 6:
                        sendMessage($chat_id, "📍 У місці, що допомагало нам змивати сліди найяскравіших пригод, сьогодні заховане щось, що вже чисте, як мої почуття до тебе🧼");
                        break;
                    case 7:
                        sendMessage($chat_id, "🏁🥳\n\nКоханий, з Днем народження 💌\n\nНу от і настав той день — день, коли світ став трішки кращим, бо в ньому з'явився <b>ТИ.</b> А потім ще кращим — бо ми зустрілися. Ідеальне комбо☯️︎\n\nХочу тобі побажати найголовнішого — не втрачати себе. Того себе, якого я шалено люблю: розумного, іноді трішки впертого, смішного, гарячого (в усіх сенсах🤭), доброго й такого особливого. І щоб кожен твій день був неймовірно чарівним✨\n\nЯ дуже ціную, що ти є. Що ти поруч. Що ти — мій🫂\nА ще я ціную твої обійми, твою усмішку, твої жарти, твою балякучість. Люблю все в тобі. Будь завжди щасливим, тому що, коли щасливий ти - щаслива я❤️\n\nТож, коханий мій, будь здоровим, щасливим, голодним до життя й ситим любов’ю. Нехай усі твої мрії збуватимуться з шаленою швидкістю🎁\n\nЛюблю тебе сильно-сильно, ти моя найкраща людина,\n<i>твоя шалено закохана маленька</i>❤️‍🔥\n\nP.S. Ти звісно знаєш, що отримав свій найкращий улов, але можливо знайдеш щось ще? Шукай у місці, де завжди можна знайти спокій і час для роздумів🦈");
                        setUserStep($chat_id, 0);
                        return;
                }

                sendMessage($chat_id, "Ваш код: _ _ _ _");
            } else {
                sendMessage($chat_id, "Код невірний😒 Спробуй ще раз🧐");
                setCode($chat_id, "");
                sendMessage($chat_id, "Ваш код: _ _ _ _");
            }
        }
    }
}

function sendMessage($chat_id, $text, $keyboard = null, $disable_preview = false) {
    global $token;
    $url = "https://api.telegram.org/bot$token/sendMessage";

    $data = [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => 'HTML',
        'disable_web_page_preview' => $disable_preview ? 'true' : 'false'
    ];

    if ($keyboard) {
        $data['reply_markup'] = json_encode($keyboard);
    }

    file_get_contents($url . "?" . http_build_query($data));
}

function setUserStep($chat_id, $step) {
    if (!is_dir("user_data")) {
        mkdir("user_data", 0777, true);
    }
    file_put_contents("user_data/$chat_id.step", $step);
}

function getUserStep($chat_id) {
    if (file_exists("user_data/$chat_id.step")) {
        return (int)file_get_contents("user_data/$chat_id.step");
    }
    return 0;
}

function setCode($chat_id, $code) {
    if (!is_dir("user_data")) {
        mkdir("user_data", 0777, true);
    }
    file_put_contents("user_data/$chat_id.code", $code);
}

function getCode($chat_id) {
    if (file_exists("user_data/$chat_id.code")) {
        return file_get_contents("user_data/$chat_id.code");
    }
    return "";
}
?>
