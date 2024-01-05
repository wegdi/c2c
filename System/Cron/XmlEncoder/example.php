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
$uniqid = uniqid();


    $domain = 'https://www.onlineyedekparca.com';

    preg_match_all('/data-selector="first-level-navigation".*?<a\s+href="(.*?)".*?title="(.*?)"/s', file_get_contents("$domain"), $kategori);
    $r = 0;
    while($r< count($kategori[1])){
        if($r == 0){
            $uniqid = uniqid();
            $data = array(
                'Uniqid' => $uniqid,
                'GroupId'=> '0',
                'Url' => '/kategori/opel-yedek-parca',
                'Title' => $db->Guvenlik($kategori[2][$r])
            );
            $db->Add("Category_Menu", $data);
            $domain2 = $domain.'/kategori/opel-yedek-parca';
            //preg_match_all('/<a\s+href="([^"]+)"\s+title="([^"]+)"[^>]*>(.*?)<\/a>/s', file_get_contents("$domain2"), $kategori2);
            //echo '<pre>';
            //print_r($kategori2[1]);
            //echo '</pre>';
            $dom = new DOMDocument();
            $dom->loadHTML(file_get_contents("$domain2"));
            $finder = new DomXPath($dom);
            $classname = "filter-menu-category-content";
            $kategori2 = $finder->query("//*[contains(@class, '$classname')]//a");
            echo '<pre>';
            print_r($kategori2->getAttribute('href'));
            echo '</pre>';
            $k = 0;
            /*
            while($k< count($kategori2[1])){
                if($k == 0){
                    $uniqid2 = uniqid();
                    $data2 = array(
                        'Uniqid' => $uniqid2,
                        'GroupId'=> $uniqid,
                        'Url' => $kategori2[1][$k],
                        'Title' => $db->Guvenlik($kategori2[2][$k])
                    );
                    print_r($data2);
                    //$db->Add("Category_Menu", $data2);
                }
                $k = $k+1;
            }*/
        }else{
            /*
            $uniqid = uniqid();
            $data = array(
                'Uniqid' => $uniqid,
                'Url' => $kategori[1][$r],
                'Title' => $db->Guvenlik($kategori[2][$r])
            );
            $db->Add("Category_Menu", $data);*/
        }
        $r = $r+1;
    }
    echo 'bitti';

?>
