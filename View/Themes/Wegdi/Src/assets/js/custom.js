
$(document).ready(function () {
  $('#login-btn').on('click', function () {
    // Gather form data
    var formData = {
      email: $('#username').val(),
      password: $('#password-input').val()
    };

    // Send AJAX request
    $.ajax({
      type: 'POST',
      url: '/System/Login/Login.php',
      data: formData,
      dataType: 'JSON',
      success: function (response) {
        if (response.url) {
          Swal.fire({
            title: response.status,
            text: response.message,
            icon: 'success',
            showConfirmButton: false,
            timer: 3000 // 3 seconds delay
          }).then(function () {
            // Redirect to the success page after the delay
            window.location.href = response.url;
          });
        } else {
          Swal.fire(response.status, response.message, 'error');
        }
      },
      error: function (xhr, status, error) {
        // Handle AJAX errors
        console.error(xhr.responseText);
      }
    });
  });
});





function Delete(form) {

  var formdata = new FormData($(form)[0]);

  $.ajax({
    type: "POST",
    url: "/Modal/" + param0 + "/Remove/Remove.php",
    dataType: 'JSON',
    data: formdata, // Use FormData object to send form data and files
    processData: false,
    contentType: false,
    success: function (response) {
      if (response.success==true) {
        Swal.fire({
          title: save,
          text: deletetext,
          icon: 'success'
        }).then(function () {
          // Redirect to the success page after the delay
          window.location.reload();
        });

      } else {

        Swal.fire({
          title: save,
          text: deletetitle,
          icon: 'error'
        }).then(function () {
          // Redirect to the success page after the delay
          window.location.reload();
        });

      }
    }
  });
}

function FromSaveGlobal(form, url, refresh = 0) {
  //tinyMCE.triggerSave();

  var requiredFields = $(form + ' [required]').length,
  validRequiredFields = $(form + ' [required]:valid').length;
  if (requiredFields == validRequiredFields) {
    var formdata = new FormData($(form)[0]);
    $.ajax({
      type: "POST",
      url: url,
      dataType: 'JSON',
      data: formdata, // Use FormData object to send form data and files
      processData: false,
      contentType: false,
      success: function (response) {
        if (response.success == true) {
          Swal.fire({
            title: save,
            text: savetext,
            icon: 'success'
          }).then(function () {
            // Kapatılması gereken modalı kontrol et
            if ($("#exampleModalFullscreen").hasClass("show")) {
              $("#exampleModalFullscreen").modal("hide");
            }

            var currentPage = $('#UrunList').DataTable().page();

            // DataTable'ı yeniden yükle
            $('#UrunList').DataTable().ajax.reload(function() {
                // Yeniden yükleme işlemi tamamlandıktan sonra mevcut sayfaya geri dön
                $('#UrunList').DataTable().page(currentPage).draw('page');
            });


            $('#CategoryListler').DataTable().ajax.reload(function() {
    // Yeniden yükleme işlemi tamamlandıktan sonra mevcut sayfaya geri dön
    $('#CategoryListler').DataTable().page(currentPagec).draw('page');
});




            // Redirect to the success page after the delay
            if (refresh == 0) {
              window.location.reload();
            } else {

            }
          });

        } else {

          Swal.fire({
            title: response.title,
            text: response.message,
            icon: 'error'
          });

        }
      }
    });


  } else {
    Swal.fire(
      warning,
      warningtext,
      'info'
    )
  }
}





function FromSaveGlobalOrder(form, url, refresh = 0) {
  //tinyMCE.triggerSave();

  var requiredFields = $(form + ' [required]').length,
  validRequiredFields = $(form + ' [required]:valid').length;
  if (requiredFields == validRequiredFields) {
    var formdata = new FormData($(form)[0]);
    $.ajax({
      type: "POST",
      url: url,
      dataType: 'JSON',
      data: formdata, // Use FormData object to send form data and files
      processData: false,
      contentType: false,
      success: function (response) {
        if (response.result) {
          var paytrDiv = document.getElementById('paytr');
          paytrDiv.innerHTML = response.result;
        } else {

          Swal.fire({
            title: response.title,
            text: response.message,
            icon: 'error'
          });

        }
      }
    });
  } else {
    Swal.fire(
      warning,
      warningtext,
      'info'
    )
  }
}


function FromSave(form) {
  //tinyMCE.triggerSave();

  var requiredFields = $(form + ' [required]').length,
  validRequiredFields = $(form + ' [required]:valid').length;
  if (requiredFields == validRequiredFields) {
    var formdata = new FormData($(form)[0]);
    $.ajax({
      type: "POST",
      url: "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php",
      dataType: 'JSON',
      data: formdata, // Use FormData object to send form data and files
      processData: false,
      contentType: false,
      success: function (response) {
        if (response.success==true) {
          Swal.fire({
            title: save,
            text: savetext,
            icon: 'success'
          }).then(function () {
            // Redirect to the success page after the delay
            window.location.reload();
          });

        } else {

          Swal.fire({
            title: response.title,
            text: response.message,
            icon: 'error'
          });

        }
      }
    });
  } else {
    Swal.fire(
      warning,
      warningtext,
      'info'
    )
  }
}






$(document).ready(function () {
  // Check if an element with ID "MetaTable" exists on the page
  if ($("#MetaTable").length > 0) {
    $('#MetaTable').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params="+(param2 || param3),
        "type": "POST",
      }
    });
  }
  console.log("url:", "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params="+(param2 || param3));
});




$(document).ready(function () {
  // Check if an element with ID "MetaTable" exists on the page
  if ($("#CategoryListler").length > 0) {
    var table = $('#CategoryListler').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params="+(param2 || param3),
        "type": "POST",
        "data": function (d) {
          d.Marka = $('#Marka').val();
          d.Model = $('#Model').val();
          d.Tur = $('#Tur').val();
        }
      },
      "ordering": false,  // Disable sorting
      "searching": false, // Disable searching
      "lengthChange": false,
      "pageLength": 10
    });



    $('#Marka').on('change', function () {
     table.draw(); // DataTable'Ä± yeniden Ã§izerek filtrelemeyi uygular
   });

   $('#Model').on('change', function () {
    table.draw(); // DataTable'Ä± yeniden Ã§izerek filtrelemeyi uygular
  });

  $('#Tur').on('change', function () {
   table.draw(); // DataTable'Ä± yeniden Ã§izerek filtrelemeyi uygular
 });



  }

  table.on('draw.dt', function () {
    $('.js-example-basic-single').select2({
      placeholder: 'Seçin',
      ajax: {
        url: '/System/Cron/IdeaSoft/CategoryJson.php',
        data: function (params) {
          var query = {
            search: params.term,
            type: 'public'
          }
          return query;
        },
        processResults: function (data) {
          // Map the retrieved data to the format expected by Select2
          var mappedData = data.map(function (item) {
            return {
              id: item.IdeaSoftId,
              text: item.Name
            };
          });

          return {
            results: mappedData
          };
        }
      }
    });
  });

});



$(document).ready(function () {
  // Check if an element with ID "MetaTable" exists on the page
  if ($("#UrunList").length > 0) {
    var table = $('#UrunList').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params="+(param2 || param3),
        "type": "POST",
        "data": function (d) {
          d.ProductName = $('#ProductName').val();
          d.Model = $('#Model').val();
          d.C2cCode = $('#C2cCode').val();
          d.IdeaSoftSatatus = $('#IdeaSoftSatatus').val();
          d.Brand = $('#Brand').val();
          d.Category = $('#Category').val();




        }
      },
      "ordering": false,  // Disable sorting
      "searching": false, // Disable searching
      "lengthChange": false,
      "pageLength": 10
    });

    $('#ProductName').on('keyup', function () {
     table.draw(); // DataTable'Ä± yeniden Ã§izerek filtrelemeyi uygular
   });

    $('#Model').on('keyup', function () {
       table.draw(); // DataTable'Ä± yeniden Ã§izerek filtrelemeyi uygular
    });

    $('#C2cCode').on('keyup', function () {
       table.draw(); // DataTable'Ä± yeniden Ã§izerek filtrelemeyi uygular
    });


    $('#IdeaSoftSatatus').on('change', function () {
     table.draw(); // DataTable'Ä± yeniden Ã§izerek filtrelemeyi uygular
   });

   $('#Brand').on('change', function () {
    table.draw(); // DataTable'Ä± yeniden Ã§izerek filtrelemeyi uygular
  });

  $('#Category').on('change', function () {
   table.draw(); // DataTable'Ä± yeniden Ã§izerek filtrelemeyi uygular
 });




 $('[data-toggle="tooltip"]').tooltip({
            container: 'body', // Ensure the tooltip is appended to the body
            html: true, // Enable HTML content in the tooltip
            title: function () {
                return $(this).attr('title'); // Use the 'title' attribute as the tooltip content
            }
        });



  }

  table.on('draw.dt', function () {
    $('.js-example-basic-single').select2({
      placeholder: 'Seçin',
      ajax: {
        url: '/System/Cron/IdeaSoft/CategoryJson.php',
        data: function (params) {
          var query = {
            search: params.term,
            type: 'public'
          }
          return query;
        },
        processResults: function (data) {
          // Map the retrieved data to the format expected by Select2
          var mappedData = data.map(function (item) {
            return {
              id: item.IdeaSoftId,
              text: item.Name
            };
          });

          return {
            results: mappedData
          };
        }
      }
    });

    $('.js-example-basic-single-marka').select2({
      placeholder: 'Marka Filtrele',
      ajax: {
        url: '/System/Cron/IdeaSoft/BrandJson.php',
        data: function (params) {
          var query = {
            search: params.term,
            type: 'public'
          }
          return query;
        },
        processResults: function (data) {
          // Map the retrieved data to the format expected by Select2
          var mappedData = data.map(function (item) {
            return {
              //id: item._id,
              text: item.manufacturer_name
            };
          });

          return {
            results: mappedData
          };
        }
      }
    });



  });

});


$(document).ready(function() {
  // When the "Remove" button is clicked, set the value of the input field
  $(document).on('click', '.remove-list', function() {
    var removeId = $(this).data('remove-id');
    $('#remove-id-input').val(removeId);
  });

  // When the modal is shown, clear the input field
  $('#removeTaskItemModal').on('show.bs.modal', function() {
    $('#remove-id-input').val('');
  });

});




$(document).ready(function() {
  // Her iki input için keyup olayı ekleme
  $("#tedarikciadi, #tedarkcilink").on('keyup', function() {

    $("#birinci").removeClass("col-xl-5").addClass("col-xl-5");
    $("#ikinci").hide();

    // Tedarikçi Adı'nı büyük harfe çevirme
    var tedarikciAdi = $("#tedarikciadi").val();
    $("#tedarikciadi").val(tedarikciAdi.toUpperCase());

    // Tedarikçi Linki'ni kontrol etme
    var tedarikciLink = $("#tedarkcilink").val();

    // Her iki input da dolu mu kontrol etme
    if (tedarikciAdi.trim() !== '' && tedarikciLink.trim() !== '') {
      // Geçerli bir URL ise "Kaydet" simgesini gösterme
      if (tedarikciLink) {
        $("#xmlstart").html("Kaydet <i class='fa fa-check'></i>");
      } else {
        $("#xmlstart").html("Geçerli bir URL değil");
      }
    } else {
      $("#xmlstart").html("İki Alanda Boş Olamaz");
    }

    // Baştan ve sondan boşlukları silme
    $("#tedarkcilink").val(tedarikciLink.trim());
  });

  // Button click olayını ekleme
  $("#xmlstart").on('click', function() {
    var tedarikciAdi = $("#tedarikciadi").val();
    var tedarikciLink = $("#tedarkcilink").val();
    console.log("a", tedarikciAdi);

    // Her iki input da dolu mu ve geçerli bir URL mi kontrol etme
    if (tedarikciAdi.trim() !== '' && tedarikciLink.trim() !== '' ) {
      // AJAX ile verileri post etme
      var formData = {
        tedarikciAdi: tedarikciAdi,
        tedarikciLink: tedarikciLink
      };

      $.ajax({
        type: "POST",
        url: "/Modal/Supplier/Add/Add.php",
        data: formData,
        dataType: "Json",
        beforeSend: function() {
          // İstek gönderilmeden önce Swal ile bekleyin mesajını göster
          Swal.fire({
            title: 'Lütfen bekleyin...',
            html: 'Tedarikçi ekleniyor...',
            allowOutsideClick: false,
            onBeforeOpen: () => {
              Swal.showLoading();
            }
          });
        },
        success: function(response) {
          // İstek başarılı olduğunda Swal'ı kapat
          Swal.close();

          if (response.url) {
            window.location.href = response.url;
          } else if (response.status == false) {
            Swal.fire({
              icon: "error",
              title: "Hata Oluştu...",
              text: response.message,
              footer: '<a href="' + response.urlc + '">Tedarikçiye Gitmek İçin Tıklayın</a>'
            });
          }

          console.log(response);
          // Başarılı bir şekilde gönderildiğinde gerekli işlemleri yapabilirsiniz.
        },
        error: function(error) {
          console.error(error);
          // Hata durumunda gerekli işlemleri yapabilirsiniz.
        }
      });




    } else {
      alert("Lütfen geçerli bilgileri giriniz.");
    }
  });

  // URL geçerliliğini kontrol etme fonksiyonu
  function isValidUrl(url) {
    var pattern = new RegExp('^(https?:\\/\\/)?' +
    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' +
    '((\\d{1,3}\\.){3}\\d{1,3}))' +
    '(\\:\\d+)?(\\/[--a-z\\d%_.~+]*)*' +
    '(\\?[;&a-z\\d%_.~+=-]*)?' +
    '(\\#[-a-z\\d_]*)?$','i');
    return pattern.test(url);
  }
});



function changeJsonContent(slc) {
  // Seçilen değeri al
  var selectedValue = $("#secler"+slc).val();
  var tagValue = $("#taglar"+slc).val();

  // AJAX kullanarak POST isteği gönder
  $.ajax({
    type: "POST",
    url: "/Modal/Supplier/Detail/Detail.php",
    data: { selectedValue: selectedValue,tag:tagValue,SupplierID:param3 }, // Gönderilecek veri
    dataType: "Json",
    success: function(response) {
      if (response.success==true) {
        Swal.fire({
          icon: "success",
          title: "İşleminiz Başarılı..",
          text: "Eşleşme Yapıldı",
        });
        updateOnizlemeget();

      }
      // Başarılı bir şekilde gönderildiğinde yapılacak işlemler
      console.log(response);
    },
    error: function(error) {
      // Hata durumunda yapılacak işlemler
      console.error("Error:", error);
    }
  });
}








function deleteProductToIdeaSoft(productId) {
    // Make an AJAX request
    $.ajax({
        url: '/System/Cron/IdeaSoft/Product-Delete.php?ProductId=' + productId,
        type: 'GET',
        dataType: 'Json',
        success: function(response) {
          if (response.success==true) {

          Swal.fire({
              icon: "success",
              title: "İşleme Alındı",
              text: "Ürün IdeaSoft'dan kaldırılma talebinde bulunuldu",
          });
          var currentPage = $('#UrunList').DataTable().page();

// DataTable'ı yeniden yükle
$('#UrunList').DataTable().ajax.reload(function() {
    // Yeniden yükleme işlemi tamamlandıktan sonra mevcut sayfaya geri dön
    $('#UrunList').DataTable().page(currentPage).draw('page');
});

          }
        },
        error: function() {
            Swal.fire({
                icon: "error",
                title: "Hata!",
                text: "Sunucuyla iletişim sırasında bir hata oluştu",
            });
        }
    });
}


function sendProductToIdeaSoft(productId) {
    // Make an AJAX request
    $.ajax({
        url: '/System/Cron/IdeaSoft/Product-Post.php?ProductId=' + productId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success == true) {
                Swal.fire({
                    icon: "success",
                    title: "İşleminiz Başarılı..",
                    text: "Ürün IdeaSoft'a gönderildi",
                });

                var currentPage = $('#UrunList').DataTable().page();

// DataTable'ı yeniden yükle
$('#UrunList').DataTable().ajax.reload(function() {
    // Yeniden yükleme işlemi tamamlandıktan sonra mevcut sayfaya geri dön
    $('#UrunList').DataTable().page(currentPage).draw('page');
});

            } else {
                Swal.fire({
                    icon: "error",
                    title: "İşlem Başarısız!",
                    text: response.message, // You can display the error message from the server
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: "error",
                title: "Hata!",
                text: "Sunucuyla iletişim sırasında bir hata oluştu",
            });
        }
    });
}


$(document).ready(function() {
  if (param1=='Detail') {
    function updateOnizlemeget() {
      // Make an AJAX request to fetch HTML content from the specified URL
      $.ajax({
        url: '/Modal/Supplier/Bar/BarGet.php?SupplierCode=' + param3,
        method: 'GET',
        dataType: 'html',
        success: function(response) {
          // Update the content inside the onizlemeget div with the fetched HTML
          $('#onizlemeget').html(response);
        },
        error: function(error) {
          console.error('Error fetching HTML:', error);
        }
      });
    }

    // Call the updateOnizlemeget function immediately and then every 3 seconds
    updateOnizlemeget(); // Call once when the page is loaded
    setInterval(updateOnizlemeget, 3000); // Then, call every 3 seconds
  }
});



$(document).ready(function () {

   $('#UrunList').on('change', '.js-example-basic-single', function () {
       var selectedValue = $(this).val();
       var productId = $(this).data('product-selecet-id');

       // AJAX ile POST isteği gönderme
       $.ajax({
           type: 'POST',
           url: '/Modal/Product/Add/Selecet.php',
           dataType: 'Json',
           data: {
               selectedValue: selectedValue,
               productId: productId
           },
           success: function (response) {
             Swal.fire({
               icon: "success",
               title: "İşleminiz Başarılı..",
               text: "Eşleşme Yapıldı",
             });
             var currentPage = $('#UrunList').DataTable().page();

// DataTable'ı yeniden yükle
$('#UrunList').DataTable().ajax.reload(function() {
    // Yeniden yükleme işlemi tamamlandıktan sonra mevcut sayfaya geri dön
    $('#UrunList').DataTable().page(currentPage).draw('page');
});

           },
           error: function (error) {
               // Hata durumunda yapılacak işlemler
               console.error(error);
           }
       });
   });



});

function selectchange(element) {
  var selectedProductId = element.getAttribute('data-product-selecet-id');
  $('#c' + selectedProductId).removeClass('d-none');
  $(element).addClass('d-none');
}




$(document).ready(function() {
    $('#Marka').change(function() {
        var marka = $(this).val();
        $.ajax({
            url: '/Modal/Supplier/Category/Category2.php',
            type: 'POST',
            dataType: 'json',
            data: { Marka: marka },
            success: function(response) {
                var options = '<option selected value="">Model Seçiniz</option>';
                for (var i = 0; i < response.length; i++) {
                    options += '<option value="' + response[i] + '">' + response[i] + '</option>';
                }
                $('#Model').html(options);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Hata durumunda kullanıcıya bilgi vermek için gerekli işlemler yapılabilir
            }
        });
    });
});



$(document).ready(function() {
    $('#Model').change(function() {
        var marka = $('#Marka').val(); // Marka seçeneğinin değerini alır
        var model = $(this).val(); // Model seçeneğinin değerini alır
        $.ajax({
            url: '/Modal/Supplier/Category/Category3.php',
            type: 'POST',
            dataType: 'json',
            data: { Marka: marka, Model: model },
            success: function(response) {
                var options = '<option selected value="">Tür Seçiniz</option>';
                for (var i = 0; i < response.length; i++) {
                    options += '<option value="' + response[i] + '">' + response[i] + '</option>';
                }
                $('#Tur').html(options); // Tür seçeneğini doldurur
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Hata durumunda kullanıcıya bilgi vermek için gerekli işlemler yapılabilir
            }
        });
    });
});
