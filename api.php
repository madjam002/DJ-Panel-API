<?php

namespace DjPanel;

/**
 * DJ Panel API
 */
class Api {

    /*
     * Configuration
     */

    // API Path
    const API_PATH = "http://djpanel.dev.local/api/";
    

    /**
     * Sends a command to the DJ Panel API Server
     * @param array $parameters Request Parameters
     * @return array
     */
    private static function sendCommand($path, $parameters = null)
    {
        $request = new HTTPRequest(self::API_PATH . "/" . $path, HTTP_METH_POST);
        $request->setRawPostData($parameters);
        $request->send();
        $response = $request->getResponseBody();

        return json_decode($response);
    }

    /**
     * Returns the name of the current show
     * @return string
     */
    public static function getCurrentShow()
    {
        return self::sendCommand("currentshow");
    }

    /**
     * Returns the meta-data for the current song being played
     * @return array
     */
    public static function getNowPlaying()
    {
        return self::sendCommand("nowplaying");
    }

}