<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db = new General();

header('Content-Type: application/json');

$Token = $_POST["token"];
$UserControl = $db->Query('Users', ['mobiltoken' => (string)$Token], [], 'TEK');
if ($UserControl["_id"]!="") {

$Companies = $db->Query('Companies', ['CompanyCode' => (int)$UserControl["CompanyCode"]], [], 'TEK');

$GoogleKeyword = $db->Query('GoogleKeyword', ['CompaniesCode' => (int)$UserControl["CompanyCode"]], [], 'COK');

$keywordConversionsMap = array();

foreach ($GoogleKeyword as $key => $value) {
    $keyword = $value["Keyword"];
    $conversions = $value["Conversions"];

    // Eğer anahtar kelime zaten varsa, toplam dönüşümü güncelle.
    if (array_key_exists($keyword, $keywordConversionsMap)) {
        $keywordConversionsMap[$keyword] += $conversions;
    } else {
        // Yeni anahtar kelimeyi ekleyin.
        $keywordConversionsMap[$keyword] = $conversions;
    }
}

// Dönüşüm sayısına göre sırala.
arsort($keywordConversionsMap);

// İlk 5 öğeyi al.
$top5Keywords = array_slice($keywordConversionsMap, 0, 5);

// Sonuçları kullanabilirsiniz.
$i = 1;
foreach ($top5Keywords as $keyword => $totalConversions) {
    $arrayName['Keyword' . $i] = array(
        'text' => $keyword,
        'count' => floor($totalConversions) // veya ceil($totalConversions)
    );
    $i++;
}

// Diğer JSON verilerini ekle
if ($UserControl["_id"] != "") {
    $json = [
        'TotatlConversion' => [
            'text' => 'Toplam Dönüşüm',
            'count' => floor($db->TotatlConversion($UserControl["CompanyCode"]))
        ],
        'Conversion30' => [
            'text' => '30 G. Dönüşüm',
            'count' => floor($db->Conversion30($UserControl["CompanyCode"]))
        ],
        'Last30' => [
            'text' => '30 G. Harcama',
            'count' => '₺' . number_format($db->Last30($UserControl["CompanyCode"]), 2, ',', '.')
        ],
        'TotalBudget' => [
            'text' => 'Toplam Harcama',
            'count' => '₺' . number_format($db->TotatlBuget($UserControl["CompanyCode"]), 2, ',', '.')
        ],
        'DayBalance' => [
            'text' => 'Bugün Harcanan Tutar',
            'count' => '₺' . number_format($db->DailyBudgetBar($UserControl["CompanyCode"]), 2, ',', '.')
        ],
        'TotalBalance' => [
            'text' => 'Kalan Tutar',
            'count' => '₺' . number_format($Companies["Balance"], 2, ',', '.')
        ],
        'Promosyon' => [
            'text' => 'Promosyon',
            'count' => '₺'.number_format(100000 - floor($db->TotatlBuget($UserControl["CompanyCode"])), 2, ',', '.')
        ],

    ];
    $json = array_merge($json, $arrayName);
    echo json_encode($json);
} else {
    $json = [
        'TotalConversion' => [
            'text' => 'Toplam Dönüşüm',
            'count' => 0
        ],
        'Conversion30' => [
            'text' => '30 Günlük Dönüşüm',
            'count' => 0
        ],
        'Last30' => [
            'text' => 'Toplam Harcama',
            'count' => 0
        ],
        'TotalBudget' => [
            'text' => 'Toplam Harcama',
            'count' => 0
        ],
    ];
    echo json_encode($json);
}
}
?>
