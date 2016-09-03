<?php

namespace Model;

class Session implements \Modelable {
    private static $session = null;

    public static function tryToConnect(string $username, string $password): bool {
        $req = \Client::get()->prepare('POST', 'session', [
            'username' => $username,
            'password' => $password
        ]);
        $req->send();

        if ($req->getResponseCode() == 201) {
            self::$session = $req->getResponseData()->session->session_id;
            return true;
        }

        return false;
    }

    public static function getSession() {
        return self::$session;
    }
}