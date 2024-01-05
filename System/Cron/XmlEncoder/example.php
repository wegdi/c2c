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


    $domain = 'https://www.onlineyedekparca.com/';

    preg_match_all('/data-selector="first-level-navigation".*?<a\s+href="(.*?)".*?title="(.*?)"/s', file_get_contents("$domain"), $kategori);
    $r = 0;
    while($r<= count($kategori[1])){
        if($r == 0){
            $uniqid = uniqid();
            $data = array(
                'Uniqid' => $uniqid,
                'Url' => 'kategori/opel-yedek-parca',
                'Title' => $db->Guvenlik($kategori[2][$r])
            );
            $db->Add("Category_Menu", $data);
        }else{
            $uniqid = uniqid();
            $data = array(
                'Uniqid' => $uniqid,
                'Url' => $kategori[1][$r],
                'Title' => $db->Guvenlik($kategori[2][$r])
            );
            $db->Add("Category_Menu", $data);
        }
        $r = $r+1;
    }
    echo 'bitti';

?>
