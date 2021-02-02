<?php

namespace App\Services\Communication;

class CurlService
{
    public function loadPage(string $link): string
    {
        $ok = substr(md5('ok' . $link), 0, 3);
        $server = rand(0, 10) < 5 ? 3 : 5;
        $url = 'http://s.inkapi.net/page.php?o=' . urlencode($ok) . '&p=' . urlencode($link);
        return $this->get($url);
    }

    public function get(string $link): string
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POST, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Opera 10.00');
        $content = curl_exec($curl);
        curl_close($curl);
        return trim($content);
    }
}
