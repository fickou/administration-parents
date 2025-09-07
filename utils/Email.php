<?php

class Email
{
    private $to;
    private $subject;
    private $message;
    private $headers;

    public function __construct(string $to, string $subject, string $message, string $from = null)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;

        // Headers basiques
        $this->headers = "MIME-Version: 1.0" . "\r\n";
        $this->headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        if ($from) {
            $this->headers .= "From: " . $from . "\r\n";
        }
    }

    /**
     * Envoie l'email
     * @return bool
     */
    public function send(): bool
    {
        return mail($this->to, $this->subject, $this->message, $this->headers);
    }
}
?>