<?php
namespace nomadjimbob\MCPEDiscordRelay;

use pocketmine\Server;
use pocketmine\utils\Terminal;
use pocketmine\utils\TextFormat;

class Attachment extends \ThreadedLoggerAttachment implements \LoggerAttachment {

    private $stream = "";
    private $enabled = true;

    public function __construct() {

    }

    public function log($level, $message) {
        $cleanMsg = TextFormat::clean($message);
        
        $msg = Terminal::toANSI($cleanMsg) . "\r\n";
        if($this->enabled) {
            $this->stream.= $msg;
        }
    }

    public function appendStream($msg) {
        $this->stream.= $msg . "\r\n";
    }

    public function clearStream() {
        $stream = $this->stream;
        $this->stream = "";
        return $stream;
    }

    public function enable($enable) {
        $this->enabled = $enable;
    }
}
