<?php
namespace MCPEDiscordRelay;

use pocketmine\Server;
use pocketmine\utils\Terminal;

class Attachment extends \ThreadedLoggerAttachment implements \LoggerAttachment {

    private $stream = "";    

    public function __construct() {

    }

    public function log($level, $message) {
        $this->stream.= Terminal::toANSI($message) . "\r\n";
    }

    public function appendStream($msg) {
        $this->stream.= $msg . "\r\n";
    }

    public function clearStream() {
        $stream = $this->stream;
        $this->stream = "";
        return $stream;
    }
}
