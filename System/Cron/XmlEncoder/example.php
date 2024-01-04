<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML İndirme</title>
</head>
<body>

<script>
    // Sayfa yenilendiğinde çalışacak JavaScript kodu
    window.onload = function() {
        // XML verisini çekmek için URL
        var xmlUrl = 'https://b2b.dogan-oto.com.tr/bayi/xmlexportv3Dogan.aspx?code=%C4%B0STANBUL.0631';

        // Yeni bir a etiketi oluştur
        var link = document.createElement('a');
        link.href = xmlUrl;

        // Dosya adını belirle
        var fileName = 'indirilen_xml.xml';

        // İndirme işlemi için gerekli olan özellikleri ayarla
        link.download = fileName;
        link.target = '_blank';

        // Yeni oluşturulan a etiketini tıklama işlemi gerçekleştir
        link.click();
    };
</script>

</body>
</html>
