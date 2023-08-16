<?php

namespace App\Services;

class XMLRebuild
{
    public function xml_convert()
    {
        $file_content = file_get_contents('base.xml');
        
        $xml = simplexml_load_string($xmlstring, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        return $array;
    }
}