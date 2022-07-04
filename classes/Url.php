<?php


    class Url
    {
    /**
     * Redirect to another url
     * @param string $url URL, required
     */
    public static function redirect($url){
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'){
        $protocol = 'https';
    }else{
        $protocol = 'http';
    }
    header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "/" .$url);
}

}