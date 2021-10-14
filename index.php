<?php
require_once("Telegram.php");

define("_TOKEN", "1977393633:AAGLFKZYprFmWeTZic-VblpP3Bx_-FAqP9w");
// define("_ADMIN", "<-YourChatId->");

$json = file_get_contents('php://input');

$tg = new Telegram($json);

$chatId = $tg->getChatId();
$messageText = $tg->getText();

switch ($messageText) {
  case "/start":
    $tg->setInlineButton();
    break;
  case "1":
    $message = "شما بر روی گزینه سمت چپ کلیک کرده اید و مقدار نمایشی آن One و مقدار ارسالی آن 1 است ،";
    $message .= " این پیام پس از ده ثانیه به طور خودکار پاک می گردد.";
    $tg->sendMessage($message);
    break;
  case "2":
    $message = "یک دکمه انتخاب کنید: ";
    $tg->sendMessage($message);
    $tg->setKeyBoard();
    break;
  default:
    $message = "دستور ناشناخته است !";
    $tg->sendMessage($message);
    break;
}
