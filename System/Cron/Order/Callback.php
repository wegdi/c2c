<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
$db=new General();


    $post = $_POST;

    ####################### DÜZENLEMESİ ZORUNLU ALANLAR #######################
    #
    ## API Entegrasyon Bilgileri - Mağaza paneline giriş yaparak BİLGİ sayfasından alabilirsiniz.
    $merchant_key   = '6rChpURPsxGnbCN5';
    $merchant_salt  = 'SrqSr6nf9pzJic9s';
    ###########################################################################

    ####### Bu kısımda herhangi bir değişiklik yapmanıza gerek yoktur. #######
    #
    ## POST değerleri ile hash oluştur.
    $hash = base64_encode( hash_hmac('sha256', $post['merchant_oid'].$merchant_salt.$post['status'].$post['total_amount'], $merchant_key, true) );
    #
    ## Oluşturulan hash'i, paytr'dan gelen post içindeki hash ile karşılaştır (isteğin paytr'dan geldiğine ve değişmediğine emin olmak için)
    ## Bu işlemi yapmazsanız maddi zarara uğramanız olasıdır.
    if( $hash != $post['hash'] )
        die('PAYTR notification failed: bad hash');
    ###########################################################################

    ## BURADA YAPILMASI GEREKENLER
    ## 1) Siparişin durumunu $post['merchant_oid'] değerini kullanarak veri tabanınızdan sorgulayın.
    ## 2) Eğer sipariş zaten daha önceden onaylandıysa veya iptal edildiyse  echo "OK"; exit; yaparak sonlandırın.

    /* Sipariş durum sorgulama örnek
       $durum = SQL
       if($durum == "onay" || $durum == "iptal"){
            echo "OK";
            exit;
        }
     */


     $Order = $db->Query('Order',['OrderID' => (string)$post['merchant_oid']], [], 'TEK');

    if( $post['status'] == 'success' ) { ## Ödeme Onaylandı
       if ($Order["_id"]) {
         $Params = array('Status' => 1 );
         $db->UpdateByObjectId("Order",(string)$Order["_id"], $Params);
      }


    } else { ## Ödemeye Onay Verilmedi
      if ($Order["_id"]) {
        $Params = array('Status' => 3);
        $db->UpdateByObjectId("Order",(string)$Order["_id"], $Params);
     }
        ## BURADA YAPILMASI GEREKENLER
        ## 1) Siparişi iptal edin.
        ## 2) Eğer ödemenin onaylanmama sebebini kayıt edecekseniz aşağıdaki değerleri kullanabilirsiniz.
        ## $post['failed_reason_code'] - başarısız hata kodu
        ## $post['failed_reason_msg'] - başarısız hata mesajı

    }

    ## Bildirimin alındığını PayTR sistemine bildir.
    echo "OK";
    exit;
