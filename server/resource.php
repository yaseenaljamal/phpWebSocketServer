<?php

/**
 * Description of coreApp
 *
 * @author Heinz
 */
class resource {

    public $server;

    /*
     * ***********************************************
     * Overwrite these functions, when needed, in an 
     * application class then register with the  server
     * ***********************************************
     */

    function onOpen($SocketID) {
        $this->server->Log("Telling Client to start on  #$SocketID");
        $msg = (object) Array('opcode' => 'ready', 'os' => $this->server->serveros);
        $this->server->Write($SocketID, json_encode($msg));
    }

    function onData($SocketID, $M) { // date has benn received from client        
    }

    function onClose($SocketID) { // ...socket has been closed AND deleted        
    }

    function onError($SocketID, $M) { // ...any connection-releated error   
    }

    function onOther($SocketID, $M) { // ...any connection-releated notification
    }

    function onOpening($SocketID) { // ...being accepted and added to the client list
    }

    final public function registerServer($server) {
        $this->server = $server;
    }

    final function getPacket($M) {
        $packet = json_decode($M);
        $err = json_last_error();
        if ($err) {
            $packet = (object) ['opcode' => 'jsonerror', 'message' => $err];
        }
        return $packet;
    }

}
