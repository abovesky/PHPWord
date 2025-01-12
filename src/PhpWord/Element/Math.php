<?php

namespace PhpOffice\PhpWord\Element;

class Math extends AbstractElement
{
    protected $source;

    public function __construct($source)
    {
        $this->source = self::mmlToTex($source);
    }

    public function getSource(){
        return $this->source;
    }

    public static function mmlToTex($source){
        libxml_disable_entity_loader(false);
        $xslDoc = new \DOMDocument();
        $xslDoc->load(dirname(__FILE__)."/xsltml/mmltex.xsl");
        $xmlDoc = new \DOMDocument();
        $xmlDoc->loadXML($source);
        $proc = new \XSLTProcessor();
        $success = $proc->importStylesheet($xslDoc);
        
        return $proc->transformToXML($xmlDoc);
    }
}
