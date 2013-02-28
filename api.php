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
    const API_SECRET = "a94a8fe5ccb19ba61c4c0873d391e987982fbbd3";


    /**
     * Sends a command to the DJ Panel API Server
     * @param array $parameters Request Parameters
     * @return array
     */
    private static function sendCommand($path, $parameters = array())
    {
        $parameters["api_secret"] = self::API_SECRET;

        $options = array("http" => array("method"  => 'POST', "content" => http_build_query($parameters)));
        $context  = stream_context_create($options);
        $response = file_get_contents(self::API_PATH . "/" . $path, false, $context);

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

    /**
     * Submits a shoutout
     *
     * @param string $content  Shoutout Content
     * @param string $username Username of the person who sent the shoutout
     * @param string $via      Shoutout submitted via (e.g Minecraft, TF2, Website)
     *
     * @return array
     */
    public static function submitShoutout($content, $username, $via)
    {
        return self::sendCommand("shoutout", array("content" => $content, "username" => $username, "via" => $via));
    }

}