<?php
function convertCDATAtoText($node) {
    foreach ($node->childNodes as $child) {
        if ($child instanceof \DOMCdataSection) {
            $textNode = $node->ownerDocument->createTextNode($child->nodeValue);
            $node->replaceChild($textNode, $child);
        } elseif ($child->hasChildNodes()) {
            convertCDATAtoText($child);
        }
    }
}

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);
require_once(SYSTEM.'General/General.php');
$db = new General();
//$uniqid = uniqid();


    //1. kategori bilgileri
    $domain = 'https://www.onlineyedekparca.com';
    echo $domain;
    echo '<br>';
    preg_match_all('/data-selector="first-level-navigation".*?<a\s+href="(.*?)".*?title="(.*?)"/s', file_get_contents("$domain"), $kategori);
    $r = 1;
    echo count($kategori[1]);
    echo '<br>';
    $uniqid = uniqid();
    $data = array(
        'Uniqid' => $uniqid,
        'GroupId'=> '0',
        'Url' => $kategori[1][$r],
        'Title' => $db->Guvenlik($kategori[2][$r])
    );
    //$db->Add("Category_Menu", $data);
    //2. kategori bilgileri
    $domain2 = $domain.'/kategori/opel-yedek-parca';
    echo '- '.$domain2;
    echo '<br>';
    $dom = new DOMDocument();
    $dom->loadHTML(file_get_contents("$domain2"));
    $finder = new DomXPath($dom);
    $classname = "filter-menu-category-content";
    $kategori2 = $finder->query("//*[contains(@class, '$classname')]//a");
    $k = 0;
    foreach ($kategori2 as $kategori2_item) {
        $uniqid2 = uniqid();
        $data2 = array(
            'Uniqid' => $uniqid2,
            'GroupId'=> $uniqid,
            'Url' => $kategori2_item->getAttribute('href'),
            'Title' => $db->Guvenlik($kategori2_item->getAttribute('title'))
        );
        //$db->Add("Category_Menu", $data2);
        //son kategori bilgileri
        $domain3 = $domain.$kategori2_item->getAttribute('href');
        echo '-- '.$domain3;
        echo '<br>';
        $dom3 = new DOMDocument();
        $dom3->loadHTML(file_get_contents("$domain3"));
        $finder3 = new DomXPath($dom3);
        $classname3 = "filter-menu-category-content";
        $kategori3 = $finder3->query("//*[contains(@class, '$classname3')]//a");
        if($kategori3->length > 0){
            $t = 0;
            foreach ($kategori3 as $kategori3_item) {
                echo '+++ https://www.onlineyedekparca.com'.$kategori3_item->getAttribute('href');
                echo '<br>';
                $uniqid3 = uniqid();
                $data3 = array(
                    'Uniqid' => $uniqid3,
                    'GroupId'=> $uniqid2,
                    'Url' => $kategori3_item->getAttribute('href'),
                    'Title' => $db->Guvenlik($kategori3_item->getAttribute('title'))
                );
                //$db->Add("Category_Menu", $data3);
            }
        }else{
            echo '+++ alt yok boş';
        }
        
        $k = $k+1;
    }
    echo '<br>';
    echo 'bitti';

?>
