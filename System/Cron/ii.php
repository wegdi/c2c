<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yandex Harita API Örneği</title>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=YOUR_API_KEY&lang=tr_TR" type="text/javascript"></script>
    <!-- Yukarıdaki satırdaki YOUR_API_KEY yerine kendi API anahtarınızı ekleyin -->
    <style>
        #harita {
            width: 100%;
            height: 500px;
        }
    </style>
</head>
<body>

<div id="harita"></div>

<script>
    ymaps.ready(function () {
        var harita = new ymaps.Map('harita', {
            center: [39.9334, 32.8597], // Türkiye'nin ortasında
            zoom: 6
        });

        // Türkiye'nin illeri ve ilçelerini temsil eden bir dizi oluşturun
        var turkiyeBolgeler = {
            "Istanbul": {
                merkez: [41.0082, 28.9784],
                kullanici: ["Kullanıcı: 10 kişi"]

            },
            "Ankara": {
                merkez: [39.9334, 32.8597],
                kullanici: ["Kullanıcı: 10 kişi"]
            }
            // Diğer illeri ve ilçeleri ekleyin
        };

        // Her bir il için işaretçi (marker) ekleyin
        for (var il in turkiyeBolgeler) {
            if (turkiyeBolgeler.hasOwnProperty(il)) {
                var ilBilgisi = turkiyeBolgeler[il];
                var marker = new ymaps.Placemark(ilBilgisi.merkez, {
                    hintContent: il + ': ' + ilBilgisi.kullanici.join(', ')
                });

                harita.geoObjects.add(marker);
            }
        }
    });
</script>

</body>
</html>
