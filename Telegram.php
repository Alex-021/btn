<?php
class Telegram {
 
  private static $jsonData;

  public function __construct($json = null) {
    if ($json != null) {
      self::$jsonData = json_decode($json);
    }
  }

  public function getChatId() {
    if (isset(self::$jsonData->callback_query->from->id))
      return self::$jsonData->callback_query->from->id;
    else
      return self::$jsonData->message->chat->id;
  }

  public function getText() {
    if (isset(self::$jsonData->callback_query->data))
      return self::$jsonData->callback_query->data;
    else
      return self::$jsonData->message->text;
  }

  public function sendMessage($message) {
    $message = urlencode($message);
    $url = "https://api.telegram.org/bot" . _TOKEN;
    $url .= "/sendMessage?chat_id=" . $this->getChatId();
    $url .= "&text=" . $message;
    $results = file_get_contents($url);

//     sleep(10);

    $results = json_decode($results);
    $messageId = $results->message_id;
    $url = "https://api.telegram.org/bot" . _TOKEN;
    $url .= "/deleteMessage?chat_id=" . $this->getChatId();
    $url .= "&message_id=" . $messageId;
    file_get_contents($url);

  }
  public function setKeyBoard() {
   $keyboard = array(
  "keyboard" =>
    array( // one => main board
      array( // two => rows board // #1
        array( // three => columns board
          "text" => "One"
        ),
        array(
          "text" => "Two"
        ),
        array(
          "text" => "Three"
        ),
        array(
          "text" => "Four"
        )
      ),
      array( // two => rows board // #2
        array(
          "text" => "Five"
        ),
        array(
          "text" => "Six"
        ),
        array(
          "text" => "Seven"
        )
      ),
      array( // two => rows board // #3
        array(
          "text" => "Eight"
        ),
        array(
          "text" => "Nine"
        )
      ),
      array( // two => rows board // #4
        array(
          "text" => "/start"
        )
      )
    ),
  "one_time_keyboard" => true,
  "resize_keyboard" => true
);
   
   $text = "این کجاس؟: ";
    $text = urlencode($text);
   
   $keyboard = json_encode($keyboard);
   
   $url = "https://api.telegram.org/bot" . _TOKEN;
    $url .= "/sendMessage?chat_id=" . $this->getChatId();
    $url .= "&text=" . $text;
    $url .= "&reply_markup=" . $keyboard;
    file_get_contents($url);
  }
 
  public function setInlineButton() {
    $keyboardArray =
      array(
        array(
          array("text" => "One", "callback_data" => "1"),
          array("text" => "Two", "callback_data" => "2")
        )
      );

    $inlineKeyboard = array(
      "inline_keyboard" => $keyboardArray
    );

    $text = "لطفا یکی از دکمه های زیر را انتخاب کنید :";
    $text = urlencode($text);

    $inlineKeyboard = json_encode($inlineKeyboard);
    $url = "https://api.telegram.org/bot" . _TOKEN;
    $url .= "/sendMessage?chat_id=" . $this->getChatId();
    $url .= "&text=" . $text;
    $url .= "&reply_markup=" . $inlineKeyboard;
    file_get_contents($url);
  }
}
