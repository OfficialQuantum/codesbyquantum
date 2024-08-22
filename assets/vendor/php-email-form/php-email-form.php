<?php

class PHP_Email_Form {
  public $to;
  public $from_name;
  public $from_email;
  public $subject;
  public $smtp;
  public $ajax;
  private $messages = array();

  public function add_message($content, $title = '', $priority = 0) {
    $this->messages[] = array('content' => $content, 'title' => $title, 'priority' => $priority);
  }

  public function send() {
    $headers = "From: {$this->from_name} <{$this->from_email}>\r\n";
    $headers .= "Reply-To: {$this->from_email}\r\n";

    $message = "";
    foreach ($this->messages as $msg) {
      $message .= "{$msg['title']}: {$msg['content']}\n";
    }

    if (!empty($this->smtp)) {
      return $this->send_with_smtp($message, $headers);
    } else {
      return mail($this->to, $this->subject, $message, $headers) ? 'Message sent!' : 'Message could not be sent!';
    }
  }

  private function send_with_smtp($message, $headers) {
    // Implement SMTP sending here using PHPMailer or similar library if needed
    // This is a placeholder for SMTP implementation
    return 'SMTP sending is not implemented in this basic version.';
  }
}

?>
