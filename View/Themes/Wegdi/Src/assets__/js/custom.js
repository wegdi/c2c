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



function StatusCheng(id,status){
  $.ajax({
    type: "POST",
    url: "/Modal/Payments/Edit/Edit.php",
    dataType: 'JSON',
    data: {oid:id,st:status}, // Use FormData object to send form data and files
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

function ModalSavePazarama(url) {
  var CategoryId = $('#PazaramaCategoryId').val();
  var Type = $('#PazaramaType').val();
  var selectElement = $('#PazaramaKategori');
  var selectedValue = selectElement.val();

  $.ajax({
    type: "POST",
    url: url+'.php', // param0 yerine sabit bir değer kullanın veya param0 değişkenini tanımlayın
    dataType: 'JSON',
    data: {'CategoryId': CategoryId, 'Type': Type, 'PazaramaId': selectedValue}, // ':' eklemeyi unutmayın
    success: function (response) {
      if (response.success == true) {
        Swal.fire({
          title: save,
          text: savetext,
          icon: 'success'
        }).then(function () {
          // Başarı mesajı sonra belirtilen süre kadar görüntülendikten sonra sayfayı yeniden yükle
          var table = $('#Brand').DataTable(); // DataTable'inizi seçin
          table.ajax.reload(); // DataTable'i yeniden yükle
          $('#my_amazing_Pazarama').modal('hide'); // Modal'ı kapat

        });
      } else {
        Swal.fire({
          title: save,
          text: deletetitle,
          icon: 'error'
        }).then(function () {
          // Başarısız mesajı sonra belirtilen süre kadar görüntülendikten sonra sayfayı yeniden yükle
          var table = $('#Brand').DataTable(); // DataTable'inizi seçin
          table.ajax.reload(); // DataTable'i yeniden yükle
        });
      }
    }
  });
}


function ModalSaveTy(url) {
  var CategoryId = $('#TyCategoryId').val();
  var Type = $('#TyType').val();
  var selectElement = $('#TrendyolKategori');
  var selectedValue = selectElement.val();

  $.ajax({
    type: "POST",
    url: url+'.php', // param0 yerine sabit bir değer kullanın veya param0 değişkenini tanımlayın
    dataType: 'JSON',
    data: {'CategoryId': CategoryId, 'Type': Type, 'TrendyolId': selectedValue}, // ':' eklemeyi unutmayın
    success: function (response) {
      if (response.success == true) {
        Swal.fire({
          title: save,
          text: savetext,
          icon: 'success'
        }).then(function () {
          // Başarı mesajı sonra belirtilen süre kadar görüntülendikten sonra sayfayı yeniden yükle
          var table = $('#Brand').DataTable(); // DataTable'inizi seçin
          table.ajax.reload(); // DataTable'i yeniden yükle
          $('#my_amazing_modal').modal('hide'); // Modal'ı kapat

        });
      } else {
        Swal.fire({
          title: save,
          text: deletetitle,
          icon: 'error'
        }).then(function () {
          // Başarısız mesajı sonra belirtilen süre kadar görüntülendikten sonra sayfayı yeniden yükle
          var table = $('#Brand').DataTable(); // DataTable'inizi seçin
          table.ajax.reload(); // DataTable'i yeniden yükle
        });
      }
    }
  });
}


function ModalSaveCs(url) {
  var CategoryId = $('#CsCategoryId').val();
  var Type = $('#CsType').val();
  var selectElement = $('#CiceksepetiKategori');
  var selectedValue = selectElement.val();

  $.ajax({
    type: "POST",
    url: url+'.php', // param0 yerine sabit bir değer kullanın veya param0 değişkenini tanımlayın
    dataType: 'JSON',
    data: {'CategoryId': CategoryId, 'Type': Type, 'CiceksepetiId': selectedValue}, // ':' eklemeyi unutmayın
    success: function (response) {
      if (response.success == true) {
        Swal.fire({
          title: save,
          text: savetext,
          icon: 'success'
        }).then(function () {
          // Başarı mesajı sonra belirtilen süre kadar görüntülendikten sonra sayfayı yeniden yükle
          var table = $('#Brand').DataTable(); // DataTable'inizi seçin
          table.ajax.reload(); // DataTable'i yeniden yükle
          $('#my_amazing_ciceksepeti').modal('hide'); // Modal'ı kapat

        });
      } else {
        Swal.fire({
          title: save,
          text: deletetitle,
          icon: 'error'
        }).then(function () {
          // Başarısız mesajı sonra belirtilen süre kadar görüntülendikten sonra sayfayı yeniden yükle
          var table = $('#Brand').DataTable(); // DataTable'inizi seçin
          table.ajax.reload(); // DataTable'i yeniden yükle
        });
      }
    }
  });
}



function ModalSaveN11(url) {
  var CategoryId = $('#N11CategoryId').val();
  var Type = $('#N11Type').val();
  var selectElement = $('#N11Kategori');
  var selectedValue = selectElement.val();

  $.ajax({
    type: "POST",
    url: url+'.php', // param0 yerine sabit bir değer kullanın veya param0 değişkenini tanımlayın
    dataType: 'JSON',
    data: {'CategoryId': CategoryId, 'Type': Type, 'N11Id': selectedValue}, // ':' eklemeyi unutmayın
    success: function (response) {
      if (response.success == true) {
        Swal.fire({
          title: save,
          text: savetext,
          icon: 'success'
        }).then(function () {
          // Başarı mesajı sonra belirtilen süre kadar görüntülendikten sonra sayfayı yeniden yükle
          var table = $('#Brand').DataTable(); // DataTable'inizi seçin
          table.ajax.reload(); // DataTable'i yeniden yükle
          $('#my_amazing_n11').modal('hide'); // Modal'ı kapat

        });
      } else {
        Swal.fire({
          title: save,
          text: deletetitle,
          icon: 'error'
        }).then(function () {
          // Başarısız mesajı sonra belirtilen süre kadar görüntülendikten sonra sayfayı yeniden yükle
          var table = $('#Brand').DataTable(); // DataTable'inizi seçin
          table.ajax.reload(); // DataTable'i yeniden yükle
        });
      }
    }
  });
}



function ModalSaveHb(url) {
  var CategoryId = $('#HbCategoryId').val();
  var Type = $('#HbType').val();
  var selectElement = $('#HepsiburadaKategori');
  var selectedValue = selectElement.val();

  $.ajax({
    type: "POST",
    url: url+'.php', // param0 yerine sabit bir değer kullanın veya param0 değişkenini tanımlayın
    dataType: 'JSON',
    data: {'CategoryId': CategoryId, 'Type': Type, 'HepsiburadaId': selectedValue}, // ':' eklemeyi unutmayın
    success: function (response) {
      if (response.success == true) {
        Swal.fire({
          title: save,
          text: savetext,
          icon: 'success'
        }).then(function () {
          var table = $('#Brand').DataTable(); // DataTable'inizi seçin
          table.ajax.reload(); // DataTable'i yeniden yükle
          $('#my_amazing_hepsiburada').modal('hide'); // Modal'ı kapat
        });
      } else {
        Swal.fire({
          title: save,
          text: deletetitle,
          icon: 'error'
        }).then(function () {
          // Başarısız mesajı sonra belirtilen süre kadar görüntülendikten sonra sayfayı yeniden yükle
          var table = $('#Brand').DataTable(); // DataTable'inizi seçin
          table.ajax.reload(); // DataTable'i yeniden yükle
        });
      }
    }
  });
}

function FromSaveGlobal(form,url,refresh=0) {
  //tinyMCE.triggerSave();

  var requiredFields = $(form + ' [required]').length,
  validRequiredFields = $(form + ' [required]:valid').length;
  if (requiredFields == validRequiredFields) {
    var formdata = new FormData($(form)[0]);

    $.ajax({
      type: "POST",
      url: url+'.php',
      dataType: 'JSON',
      data: formdata, // Use FormData object to send form data and files
      processData: false,
      contentType: false,
      success: function (response) {
        if (response.success==true) {
          Swal.fire({
            title: save,
            text:  savetext,
            icon: 'success'
          }).then(function () {
            // Redirect to the success page after the delay
            if (refresh==0) {
              window.location.reload();
            }else {

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



function setCategoryIdTrendyol(ıd) {
  $('#TyCategoryId').val(ıd); // input değerini güncelleyin
}

function setCategoryIdPazarama(ıd) {
  $('#PazaramaCategoryId').val(ıd); // input değerini güncelleyin
}

function setCategoryIdN11(ıd) {
  $('#N11CategoryId').val(ıd); // input değerini güncelleyin
}
function setCategoryIdCiceksepeti(ıd) {
  $('#CsCategoryId').val(ıd); // input değerini güncelleyin
}
function setCategoryIdHepsiburada(ıd) {
  $('#HbCategoryId').val(ıd); // input değerini güncelleyin
}

$(document).ready(function () {
  $('#my_amazing_hepsiburada select').select2({
    dropdownParent: $('#my_amazing_hepsiburada')
  });

  // Make an AJAX request to fetch JSON data
  $.ajax({
    url: '/System/Cron/Hepsiburada/Category.php', // AJAX isteği gönderilecek URL'yi güncelleyin
    dataType: 'json',
    success: function (data) {
      // Iterate through the JSON data and add options to the select element
      $.each(data, function (index, item) {
        $('#HepsiburadaKategori').append(new Option(item.name, item.id, false, false));
      });


    },
    error: function () {
      // Handle any errors here
    }
  });
});


$(document).ready(function () {
  $('#my_amazing_Pazarama select').select2({
    dropdownParent: $('#my_amazing_Pazarama')
  });

  // Make an AJAX request to fetch JSON data
  $.ajax({
    url: '/System/Cron/Pazarama/Category.php', // AJAX isteği gönderilecek URL'yi güncelleyin
    dataType: 'json',
    success: function (data) {
      // Iterate through the JSON data and add options to the select element
      $.each(data, function (index, item) {
        $('#PazaramaKategori').append(new Option(item.name, item.id, false, false));
      });


    },
    error: function () {
      // Handle any errors here
    }
  });
});



$(document).ready(function () {
  $('#my_amazing_n11 select').select2({
    dropdownParent: $('#my_amazing_n11')
  });

  // Make an AJAX request to fetch JSON data
  $.ajax({
    url: '/System/Cron/N11/CategoryJson.php', // AJAX isteği gönderilecek URL'yi güncelleyin
    dataType: 'json',
    success: function (data) {
      // Iterate through the JSON data and add options to the select element
      $.each(data, function (index, item) {
        $('#N11Kategori').append(new Option(item.name, item.id, false, false));
      });


    },
    error: function () {
      // Handle any errors here
    }
  });
});


$(document).ready(function () {
  $('#my_amazing_modal select').select2({
    dropdownParent: $('#my_amazing_modal')
  });

  // Make an AJAX request to fetch JSON data
  $.ajax({
    url: '/System/Cron/Trendyol/Category.php', // AJAX isteği gönderilecek URL'yi güncelleyin
    dataType: 'json',
    success: function (data) {
      // Iterate through the JSON data and add options to the select element
      $.each(data, function (index, item) {
        $('#TrendyolKategori').append(new Option(item.name, item.id, false, false));
      });

      // Select2'yi etkinleştirmek için modalı manuel olarak açın

    },
    error: function () {
      // Handle any errors here
    }
  });
});






$(document).ready(function () {
  $('#my_amazing_ciceksepeti select').select2({
    dropdownParent: $('#my_amazing_ciceksepeti')
  });

  // Make an AJAX request to fetch JSON data
  $.ajax({
    url: '/System/Cron/Ciceksepeti/Category.php', // AJAX isteği gönderilecek URL'yi güncelleyin
    dataType: 'json',
    success: function (data) {
      // Iterate through the JSON data and add options to the select element
      $.each(data, function (index, item) {
        $('#CiceksepetiKategori').append(new Option(item.name, item.id, false, false));
      });

      // Select2'yi etkinleştirmek için modalı manuel olarak açın

    },
    error: function () {
      // Handle any errors here
    }
  });
});




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


$(document).ready(function() {
  // Add a submit event handler to the form
  $('#filterForm').submit(function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Serialize the form data as a JSON string
    const formDataJson = JSON.stringify($('#filterForm').serializeArray());

    // Encode the JSON string as Base64
    const base64Data = btoa(formDataJson);

    // Get the current URL and create a URL object
    const currentUrl = new URL(window.location.href);

    // Remove any existing "data" query parameter
    currentUrl.searchParams.delete('data');

    // Append the Base64 data as a new "data" query parameter
    if (base64Data !== '') {
      currentUrl.searchParams.set('data', base64Data);
    }

    // Redirect to the new URL
    window.location.href = currentUrl.href;
  });

  // Add a click event handler to the "Clear Filter" button
  $('#clearFilterButton').click(function(event) {
    event.preventDefault();

    // Redirect to the URL without the "data" query parameter
    const currentUrl = new URL(window.location.href);
    currentUrl.searchParams.delete('data');
    window.location.href = currentUrl.href;
  });
});


$(document).ready(function () {
  // Check if an element with ID "MetaTable" exists on the page
  if ($("#PlatformsList").length > 0) {
    $('#PlatformsList').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params="+param2,
        "type": "POST",
      }
    });
  }
});



$(document).ready(function () {
  // Initialize Select2
  $('#categorySelect').select2();

  // Make an AJAX request to fetch JSON data
  $.ajax({
    url: '/Modal/Category/Query/Query.php', // Update the URL accordingly
    dataType: 'json',
    success: function (data) {
      // Iterate through the JSON data and add options to the select element
      $.each(data, function (index, item) {
        $('#categorySelect').append(new Option(item.text, item.id, false, false));
      });

      // Refresh Select2 to display the new options
      $('#categorySelect').trigger('change.select2');
    },
    error: function () {
      // Handle any errors here
    }
  });
});





$(document).ready(function () {

  var currentDataTable; // Dışarıda bir değişken tanımlayın.

  function createDataTable(tableId, url) {
    if (currentDataTable) {
      currentDataTable.destroy();
    }

    if ($("#" + tableId).length > 0) {
      currentDataTable = $("#" + tableId).DataTable({
        "processing": true,
        "serverSide": true,
        "searching": false,
        "lengthChange": false,
        "ajax": {
          "url": url,
          "type": "POST",
          "data": function (data) {
            data.SearchFiltre = $('#SearchFiltre').val();
            data.StatusFiltre = $('#StatusFiltre').val();
            data.PlatformFiltre = $('#PlatformFiltre').val();
            data.DateFiltre = $('#DateFiltre').val();
            data.DateFiltreEnd = $('#DateFiltreEnd').val();

          }
        }
      });

      $('#SearchFiltre, #StatusFiltre, #PlatformFiltre, #DateFiltre,#DateFiltreEnd').on('input change', function () {
        // Değişiklik olduğunda AJAX isteği göndermeden önce bir bekleme süresi ekleyelim.
        // Bu süre içinde başka değişiklikler olduğunda öncekiler iptal edilir.
        if (window.searchTimeout) {
          clearTimeout(window.searchTimeout);
        }

        window.searchTimeout = setTimeout(function () {
          currentDataTable.ajax.reload();
        }, 100); // 500 milisaniye (yarım saniye) süreyle bekleyelim.
      });
    }
  }



  var url = "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params=";
  createDataTable("AllOrder", url);
  $('.nav-pills .nav-link').on('click', function () {
    var tabparams = $(this).data('tab-params');
    var url = "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params=" + tabparams;
    createDataTable("AllOrder", url);
  });

});

$(document).ready(function () {
  // Check if an element with ID "MetaTable" exists on the page
  if ($("#MetaTable").length > 0) {
    $('#MetaTable').DataTable({
      "processing": true,
      "serverSide": true,
      "searching": false, // Arama işlemini kapat
      "lengthChange": false, // Gösterilen öğe sayısını değiştirme işlemini kapat
      "ajax": {
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params="+param3,
        "type": "POST",
      }
    });
  }
});



$(document).ready(function () {
  // Check if an element with ID "MetaTable" exists on the page
  if ($("#CompaniesList").length > 0) {
    $('#CompaniesList').DataTable({
      "processing": true,
      "serverSide": true,
      "searching": false, // Search işlemini kapat
      "ajax": {
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params="+param2,
        "type": "POST",
        "data": function (d) {
          d.Companycode = $("#COMPANY_CODE").val();
          d.Companyname = $("#COMPANY_NAME").val();
          d.Companyvat = $("#COMPANY_VAT").val();
          d.Companylisanceend = $("#COMPANY_LISANCE_END").val();
          d.Companyusers = $("#COMPANY_USERS").val();
        }
      }
    });
  }
});


$('#ParentID').keyup(function() {
  // Kullanıcının girdiği metni alın
  var inputValue = $(this).val();

  // AJAX isteği yapın sadece metin uzunluğu 3 veya daha fazlaysa
  if (inputValue.length >= 1) {
    $.ajax({
      type: 'POST', // POST veya GET isteği yapabilirsiniz
      url: 'sorgula.php', // PHP dosyasının yolu
      data: { inputValue: inputValue }, // Kullanıcının girdiği metni gönderin
      dataType: 'json', // Gelen verinin JSON formatında olduğunu belirtin
      success: function(response) {
        // Başarılı bir yanıt geldiğinde çalışacak kod
        if (response.error) {
          $('#sonuc').html('Hata: ' + response.error);
        } else {
          // JSON'dan gelen değerleri kullanarak input, placeholder ve sonuç div'i güncelleyin
          $('#ParentID').val(response.id);
          $('#ParentID').attr('placeholder', response.text);
          $('#sonuc').html('ID: ' + response.id + '<br>Text: ' + response.text);
        }
      },
      error: function() {
        // İstekte hata oluştuğunda çalışacak kod
        $('#sonuc').html('İstekte hata oluştu.');
      }
    });
  } else {
    // Metin uzunluğu 3'ten azsa sonucu temizleyin ve placeholder'ı geri yükleyin
    $('#sonuc').html('');
    $('#ParentID').val('');
    $('#ParentID').attr('placeholder', 'Text');
  }
});







$(document).ready(function () {
  // DataTable başlatma kodu burada

  if ($("#Brand").length > 0) {
    var table = $('#Brand').DataTable({
      "processing": true,
      "serverSide": true,
      "searching": false,
      "lengthChange": false,
      "ajax": {
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params=" + param2,
        "type": "POST",
        "data": function (d) {
          d.BrandName = $("#SearchBrand").val();
        }
      }
    });
  }

  table.on('draw.dt', function () {
    $('.js-example-basic-single-Trendyol').select2({
      placeholder: 'Seçin',
      ajax: {
        url: '/System/Cron/Trendyol/Brand.php',
        data: function (params) {
          var query = {
            search: params.term,
            type: 'public'
          }
          return query;
        }
      }
    });

    $('.js-example-basic-single-Pazarama').select2({
      placeholder: 'Seçin',
      ajax: {
        url: '/System/Cron/Pazarama/Brand.php',
        data: function (params) {
          var query = {
            search: params.term,
            type: 'public'
          }
          return query;
        }
      }
    });

    $('.js-example-basic-single-Trendyol').on('select2:select', function (e) {
      var selectedValue = e.params.data.id; // Seçilen değeri alın
      var selectedText = e.params.data.text; // Seçilen değeri alın

      var companyId = $(this).data('company-id'); // Şirket ID'sini alın

      // Şirket ID'si ve seçilen değeri AJAX ile "/Modal/Brand/Add/Add.php" adresine post edin
      $.ajax({
        url: '/Modal/Brand/Edit/Edit.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
          TrendyolId: selectedValue,
          BrandId: companyId,
          BrandNameTrenyol: selectedText,
          Platform: 'Ty'
        },
        success: function (response) {
          if (response.success==true) {
            Swal.fire({
              title: save,
              text:   savetext,
              icon: 'success'
            }).then(function () {
              // Redirect to the success page after the delay
              //window.location.reload();
            });

          } else {

            Swal.fire({
              title: response.title,
              text: response.message,
              icon: 'error'
            });

          }

        },
        error: function (xhr, status, error) {
          // Hata durumunda yapılacak işlemleri burada ekleyin
          console.error('Post işlemi sırasında hata oluştu: ' + error);
        }
      });
    });
  });
});






$(document).ready(function () {
  // DataTable başlatma kodu burada

  if ($("#Category").length > 0) {
    var table = $('#Category').DataTable({
      "processing": true,
      "serverSide": true,
      "searching": false,
      "lengthChange": false,
      "ajax": {
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params=" + param2,
        "type": "POST",
        "data": function (d) {
          d.CategoryBrand = $("#CategoryBrand").val();
        }
      }
    });
  }
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

function loadMenuContent() {
  // AJAX isteği gönderme
  $.ajax({
    url: "/Modal/Menu/Menu/Menu.php",
    type: "GET",
    dataType: "html",
    success: function(data) {
      // AJAX isteği başarılı olduğunda, aldığımız içeriği yukarıdaki div içine ekliyoruz.
      $("#all-noti-tab").html(data);
    },
    error: function(xhr, status, error) {
      console.error("AJAX isteği başarısız oldu: " + error);
    }
  });
}

$(document).ready(function() {
  // #page-header-notifications-dropdown butonuna tıklama olayı ekleyin
  $("#page-header-notifications-dropdown").click(function() {
    loadMenuContent(); // Tıklama olayı tetiklendiğinde loadMenuContent() fonksiyonunu çağırın
  });
});


var customerDataTable = null;
var notesDataTable = null;

function createCustomerDataTable(musteriID) {
  if ($.fn.DataTable.isDataTable("#CustomerDateTable")) {
    customerDataTable.clear().destroy();
  }

  customerDataTable = $('#CustomerDateTable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "/Modal/Leads/Query/Calls.php?CustomerID=" + musteriID,
      "type": "POST",
    },
    "searching": false,
    "lengthChange": false
  });
}






$(document).ready(function () {
  if ($("#LeadsAggenct").length > 0) {
    var table3 = $('#LeadsAggenct').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php",
        "type": "POST",
        "data": function (d) {
          d.Namex = $("#Name").val();
          d.Statusx = $("#Statusxx").val();
          d.Sourcex = $("#Source").val();
          d.CallNotx = $("#CallNot").val();
          d.Transferx = $("#Transfer").val();
        },
        "searching": false,
        "lengthChange": false,
        "paging": true, // Sayfalama işlemini aktif hale getirir
        "pageLength": 20 // Sayfada 100 satır gösterir
      }
    });

    $('#Name').on('input', function () {
      table3.draw();
    });
    $('#CallNot').on('input', function () {
      table3.draw();
    });
    $('#Transfer').on('input', function () {
      table3.draw();
    });
    $('#Source').on('change', function () {
      table3.draw();
    });

    $('#Statusxx').on('change', function () {
      table3.draw();
    });
  }
});












var data = [
  {
    "il": "Adana",
    "plaka": 1,
    "ilceleri": [
      "Aladağ",
      "Ceyhan",
      "Çukurova",
      "Feke",
      "İmamoğlu",
      "Karaisalı",
      "Karataş",
      "Kozan",
      "Pozantı",
      "Saimbeyli",
      "Sarıçam",
      "Seyhan",
      "Tufanbeyli",
      "Yumurtalık",
      "Yüreğir"
    ]
  },
  {
    "il": "Adıyaman",
    "plaka": 2,
    "ilceleri": [
      "Besni",
      "Çelikhan",
      "Gerger",
      "Gölbaşı",
      "Kahta",
      "Merkez",
      "Samsat",
      "Sincik",
      "Tut"
    ]
  },
  {
    "il": "Afyonkarahisar",
    "plaka": 3,
    "ilceleri": [
      "Başmakçı",
      "Bayat",
      "Bolvadin",
      "Çay",
      "Çobanlar",
      "Dazkırı",
      "Dinar",
      "Emirdağ",
      "Evciler",
      "Hocalar",
      "İhsaniye",
      "İscehisar",
      "Kızılören",
      "Merkez",
      "Sandıklı",
      "Sinanpaşa",
      "Sultandağı",
      "Şuhut"
    ]
  },
  {
    "il": "Ağrı",
    "plaka": 4,
    "ilceleri": [
      "Diyadin",
      "Doğubayazıt",
      "Eleşkirt",
      "Hamur",
      "Merkez",
      "Patnos",
      "Taşlıçay",
      "Tutak"
    ]
  },
  {
    "il": "Amasya",
    "plaka": 5,
    "ilceleri": [
      "Göynücek",
      "Gümüşhacıköy",
      "Hamamözü",
      "Merkez",
      "Merzifon",
      "Suluova",
      "Taşova"
    ]
  },
  {
    "il": "Ankara",
    "plaka": 6,
    "ilceleri": [
      "Altındağ",
      "Ayaş",
      "Bala",
      "Beypazarı",
      "Çamlıdere",
      "Çankaya",
      "Çubuk",
      "Elmadağ",
      "Güdül",
      "Haymana",
      "Kalecik",
      "Kızılcahamam",
      "Nallıhan",
      "Polatlı",
      "Şereflikoçhisar",
      "Yenimahalle",
      "Gölbaşı",
      "Keçiören",
      "Mamak",
      "Sincan",
      "Kazan",
      "Akyurt",
      "Etimesgut",
      "Evren",
      "Pursaklar"
    ]
  },
  {
    "il": "Antalya",
    "plaka": 7,
    "ilceleri": [
      "Akseki",
      "Alanya",
      "Elmalı",
      "Finike",
      "Gazipaşa",
      "Gündoğmuş",
      "Kaş",
      "Korkuteli",
      "Kumluca",
      "Manavgat",
      "Serik",
      "Demre",
      "İbradı",
      "Kemer",
      "Aksu",
      "Döşemealtı",
      "Kepez",
      "Konyaaltı",
      "Muratpaşa"
    ]
  },
  {
    "il": "Artvin",
    "plaka": 8,
    "ilceleri": [
      "Ardanuç",
      "Arhavi",
      "Merkez",
      "Borçka",
      "Hopa",
      "Şavşat",
      "Yusufeli",
      "Murgul"
    ]
  },
  {
    "il": "Aydın",
    "plaka": 9,
    "ilceleri": [
      "Merkez",
      "Bozdoğan",
      "Efeler",
      "Çine",
      "Germencik",
      "Karacasu",
      "Koçarlı",
      "Kuşadası",
      "Kuyucak",
      "Nazilli",
      "Söke",
      "Sultanhisar",
      "Yenipazar",
      "Buharkent",
      "İncirliova",
      "Karpuzlu",
      "Köşk",
      "Didim"
    ]
  },
  {
    "il": "Balıkesir",
    "plaka": 10,
    "ilceleri": [
      "Altıeylül",
      "Ayvalık",
      "Merkez",
      "Balya",
      "Bandırma",
      "Bigadiç",
      "Burhaniye",
      "Dursunbey",
      "Edremit",
      "Erdek",
      "Gönen",
      "Havran",
      "İvrindi",
      "Karesi",
      "Kepsut",
      "Manyas",
      "Savaştepe",
      "Sındırgı",
      "Gömeç",
      "Susurluk",
      "Marmara"
    ]
  },
  {
    "il": "Bilecik",
    "plaka": 11,
    "ilceleri": [
      "Merkez",
      "Bozüyük",
      "Gölpazarı",
      "Osmaneli",
      "Pazaryeri",
      "Söğüt",
      "Yenipazar",
      "İnhisar"
    ]
  },
  {
    "il": "Bingöl",
    "plaka": 12,
    "ilceleri": [
      "Merkez",
      "Genç",
      "Karlıova",
      "Kiğı",
      "Solhan",
      "Adaklı",
      "Yayladere",
      "Yedisu"
    ]
  },
  {
    "il": "Bitlis",
    "plaka": 13,
    "ilceleri": [
      "Adilcevaz",
      "Ahlat",
      "Merkez",
      "Hizan",
      "Mutki",
      "Tatvan",
      "Güroymak"
    ]
  },
  {
    "il": "Bolu",
    "plaka": 14,
    "ilceleri": [
      "Merkez",
      "Gerede",
      "Göynük",
      "Kıbrıscık",
      "Mengen",
      "Mudurnu",
      "Seben",
      "Dörtdivan",
      "Yeniçağa"
    ]
  },
  {
    "il": "Burdur",
    "plaka": 15,
    "ilceleri": [
      "Ağlasun",
      "Bucak",
      "Merkez",
      "Gölhisar",
      "Tefenni",
      "Yeşilova",
      "Karamanlı",
      "Kemer",
      "Altınyayla",
      "Çavdır",
      "Çeltikçi"
    ]
  },
  {
    "il": "Bursa",
    "plaka": 16,
    "ilceleri": [
      "Gemlik",
      "İnegöl",
      "İznik",
      "Karacabey",
      "Keles",
      "Mudanya",
      "Mustafakemalpaşa",
      "Orhaneli",
      "Orhangazi",
      "Yenişehir",
      "Büyükorhan",
      "Harmancık",
      "Nilüfer",
      "Osmangazi",
      "Yıldırım",
      "Gürsu",
      "Kestel"
    ]
  },
  {
    "il": "Çanakkale",
    "plaka": 17,
    "ilceleri": [
      "Ayvacık",
      "Bayramiç",
      "Biga",
      "Bozcaada",
      "Çan",
      "Merkez",
      "Eceabat",
      "Ezine",
      "Gelibolu",
      "Gökçeada",
      "Lapseki",
      "Yenice"
    ]
  },
  {
    "il": "Çankırı",
    "plaka": 18,
    "ilceleri": [
      "Merkez",
      "Çerkeş",
      "Eldivan",
      "Ilgaz",
      "Kurşunlu",
      "Orta",
      "Şabanözü",
      "Yapraklı",
      "Atkaracalar",
      "Kızılırmak",
      "Bayramören",
      "Korgun"
    ]
  },
  {
    "il": "Çorum",
    "plaka": 19,
    "ilceleri": [
      "Alaca",
      "Bayat",
      "Merkez",
      "İskilip",
      "Kargı",
      "Mecitözü",
      "Ortaköy",
      "Osmancık",
      "Sungurlu",
      "Boğazkale",
      "Uğurludağ",
      "Dodurga",
      "Laçin",
      "Oğuzlar"
    ]
  },
  {
    "il": "Denizli",
    "plaka": 20,
    "ilceleri": [
      "Acıpayam",
      "Buldan",
      "Çal",
      "Çameli",
      "Çardak",
      "Çivril",
      "Merkez",
      "Merkezefendi",
      "Pamukkale",
      "Güney",
      "Kale",
      "Sarayköy",
      "Tavas",
      "Babadağ",
      "Bekilli",
      "Honaz",
      "Serinhisar",
      "Baklan",
      "Beyağaç",
      "Bozkurt"
    ]
  },
  {
    "il": "Diyarbakır",
    "plaka": 21,
    "ilceleri": [
      "Kocaköy",
      "Çermik",
      "Çınar",
      "Çüngüş",
      "Dicle",
      "Ergani",
      "Hani",
      "Hazro",
      "Kulp",
      "Lice",
      "Silvan",
      "Eğil",
      "Bağlar",
      "Kayapınar",
      "Sur",
      "Yenişehir",
      "Bismil"
    ]
  },
  {
    "il": "Edirne",
    "plaka": 22,
    "ilceleri": [
      "Merkez",
      "Enez",
      "Havsa",
      "İpsala",
      "Keşan",
      "Lalapaşa",
      "Meriç",
      "Uzunköprü",
      "Süloğlu"
    ]
  },
  {
    "il": "Elazığ",
    "plaka": 23,
    "ilceleri": [
      "Ağın",
      "Baskil",
      "Merkez",
      "Karakoçan",
      "Keban",
      "Maden",
      "Palu",
      "Sivrice",
      "Arıcak",
      "Kovancılar",
      "Alacakaya"
    ]
  },
  {
    "il": "Erzincan",
    "plaka": 24,
    "ilceleri": [
      "Çayırlı",
      "Merkez",
      "İliç",
      "Kemah",
      "Kemaliye",
      "Refahiye",
      "Tercan",
      "Üzümlü",
      "Otlukbeli"
    ]
  },
  {
    "il": "Erzurum",
    "plaka": 25,
    "ilceleri": [
      "Aşkale",
      "Çat",
      "Hınıs",
      "Horasan",
      "İspir",
      "Karayazı",
      "Narman",
      "Oltu",
      "Olur",
      "Pasinler",
      "Şenkaya",
      "Tekman",
      "Tortum",
      "Karaçoban",
      "Uzundere",
      "Pazaryolu",
      "Köprüköy",
      "Palandöken",
      "Yakutiye",
      "Aziziye"
    ]
  },
  {
    "il": "Eskişehir",
    "plaka": 26,
    "ilceleri": [
      "Çifteler",
      "Mahmudiye",
      "Mihalıççık",
      "Sarıcakaya",
      "Seyitgazi",
      "Sivrihisar",
      "Alpu",
      "Beylikova",
      "İnönü",
      "Günyüzü",
      "Han",
      "Mihalgazi",
      "Odunpazarı",
      "Tepebaşı"
    ]
  },
  {
    "il": "Gaziantep",
    "plaka": 27,
    "ilceleri": [
      "Araban",
      "İslahiye",
      "Nizip",
      "Oğuzeli",
      "Yavuzeli",
      "Şahinbey",
      "Şehitkamil",
      "Karkamış",
      "Nurdağı"
    ]
  },
  {
    "il": "Giresun",
    "plaka": 28,
    "ilceleri": [
      "Alucra",
      "Bulancak",
      "Dereli",
      "Espiye",
      "Eynesil",
      "Merkez",
      "Görele",
      "Keşap",
      "Şebinkarahisar",
      "Tirebolu",
      "Piraziz",
      "Yağlıdere",
      "Çamoluk",
      "Çanakçı",
      "Doğankent",
      "Güce"
    ]
  },
  {
    "il": "Gümüşhane",
    "plaka": 29,
    "ilceleri": [
      "Merkez",
      "Kelkit",
      "Şiran",
      "Torul",
      "Köse",
      "Kürtün"
    ]
  },
  {
    "il": "Hakkari",
    "plaka": 30,
    "ilceleri": [
      "Çukurca",
      "Merkez",
      "Şemdinli",
      "Yüksekova"
    ]
  },
  {
    "il": "Hatay",
    "plaka": 31,
    "ilceleri": [
      "Altınözü",
      "Arsuz",
      "Defne",
      "Dörtyol",
      "Hassa",
      "Antakya",
      "İskenderun",
      "Kırıkhan",
      "Payas",
      "Reyhanlı",
      "Samandağ",
      "Yayladağı",
      "Erzin",
      "Belen",
      "Kumlu"
    ]
  },
  {
    "il": "Isparta",
    "plaka": 32,
    "ilceleri": [
      "Atabey",
      "Eğirdir",
      "Gelendost",
      "Merkez",
      "Keçiborlu",
      "Senirkent",
      "Sütçüler",
      "Şarkikaraağaç",
      "Uluborlu",
      "Yalvaç",
      "Aksu",
      "Gönen",
      "Yenişarbademli"
    ]
  },
  {
    "il": "Mersin",
    "plaka": 33,
    "ilceleri": [
      "Anamur",
      "Erdemli",
      "Gülnar",
      "Mut",
      "Silifke",
      "Tarsus",
      "Aydıncık",
      "Bozyazı",
      "Çamlıyayla",
      "Akdeniz",
      "Mezitli",
      "Toroslar",
      "Yenişehir"
    ]
  },
  {
    "il": "İstanbul",
    "plaka": 34,
    "ilceleri": [
      "Adalar",
      "Bakırköy",
      "Beşiktaş",
      "Beykoz",
      "Beyoğlu",
      "Çatalca",
      "Eyüp",
      "Fatih",
      "Gaziosmanpaşa",
      "Kadıköy",
      "Kartal",
      "Sarıyer",
      "Silivri",
      "Şile",
      "Şişli",
      "Üsküdar",
      "Zeytinburnu",
      "Büyükçekmece",
      "Kağıthane",
      "Küçükçekmece",
      "Pendik",
      "Ümraniye",
      "Bayrampaşa",
      "Avcılar",
      "Bağcılar",
      "Bahçelievler",
      "Güngören",
      "Maltepe",
      "Sultanbeyli",
      "Tuzla",
      "Esenler",
      "Arnavutköy",
      "Ataşehir",
      "Başakşehir",
      "Beylikdüzü",
      "Çekmeköy",
      "Esenyurt",
      "Sancaktepe",
      "Sultangazi"
    ]
  },
  {
    "il": "İzmir",
    "plaka": 35,
    "ilceleri": [
      "Aliağa",
      "Bayındır",
      "Bergama",
      "Bornova",
      "Çeşme",
      "Dikili",
      "Foça",
      "Karaburun",
      "Karşıyaka",
      "Kemalpaşa",
      "Kınık",
      "Kiraz",
      "Menemen",
      "Ödemiş",
      "Seferihisar",
      "Selçuk",
      "Tire",
      "Torbalı",
      "Urla",
      "Beydağ",
      "Buca",
      "Konak",
      "Menderes",
      "Balçova",
      "Çiğli",
      "Gaziemir",
      "Narlıdere",
      "Güzelbahçe",
      "Bayraklı",
      "Karabağlar"
    ]
  },
  {
    "il": "Kars",
    "plaka": 36,
    "ilceleri": [
      "Arpaçay",
      "Digor",
      "Kağızman",
      "Merkez",
      "Sarıkamış",
      "Selim",
      "Susuz",
      "Akyaka"
    ]
  },
  {
    "il": "Kastamonu",
    "plaka": 37,
    "ilceleri": [
      "Abana",
      "Araç",
      "Azdavay",
      "Bozkurt",
      "Cide",
      "Çatalzeytin",
      "Daday",
      "Devrekani",
      "İnebolu",
      "Merkez",
      "Küre",
      "Taşköprü",
      "Tosya",
      "İhsangazi",
      "Pınarbaşı",
      "Şenpazar",
      "Ağlı",
      "Doğanyurt",
      "Hanönü",
      "Seydiler"
    ]
  },
  {
    "il": "Kayseri",
    "plaka": 38,
    "ilceleri": [
      "Bünyan",
      "Develi",
      "Felahiye",
      "İncesu",
      "Pınarbaşı",
      "Sarıoğlan",
      "Sarız",
      "Tomarza",
      "Yahyalı",
      "Yeşilhisar",
      "Akkışla",
      "Talas",
      "Kocasinan",
      "Melikgazi",
      "Hacılar",
      "Özvatan"
    ]
  },
  {
    "il": "Kırklareli",
    "plaka": 39,
    "ilceleri": [
      "Babaeski",
      "Demirköy",
      "Merkez",
      "Kofçaz",
      "Lüleburgaz",
      "Pehlivanköy",
      "Pınarhisar",
      "Vize"
    ]
  },
  {
    "il": "Kırşehir",
    "plaka": 40,
    "ilceleri": [
      "Çiçekdağı",
      "Kaman",
      "Merkez",
      "Mucur",
      "Akpınar",
      "Akçakent",
      "Boztepe"
    ]
  },
  {
    "il": "Kocaeli",
    "plaka": 41,
    "ilceleri": [
      "Gebze",
      "Gölcük",
      "Kandıra",
      "Karamürsel",
      "Körfez",
      "Derince",
      "Başiskele",
      "Çayırova",
      "Darıca",
      "Dilovası",
      "İzmit",
      "Kartepe"
    ]
  },
  {
    "il": "Konya",
    "plaka": 42,
    "ilceleri": [
      "Akşehir",
      "Beyşehir",
      "Bozkır",
      "Cihanbeyli",
      "Çumra",
      "Doğanhisar",
      "Ereğli",
      "Hadim",
      "Ilgın",
      "Kadınhanı",
      "Karapınar",
      "Kulu",
      "Sarayönü",
      "Seydişehir",
      "Yunak",
      "Akören",
      "Altınekin",
      "Derebucak",
      "Hüyük",
      "Karatay",
      "Meram",
      "Selçuklu",
      "Taşkent",
      "Ahırlı",
      "Çeltik",
      "Derbent",
      "Emirgazi",
      "Güneysınır",
      "Halkapınar",
      "Tuzlukçu",
      "Yalıhüyük"
    ]
  },
  {
    "il": "Kütahya",
    "plaka": 43,
    "ilceleri": [
      "Altıntaş",
      "Domaniç",
      "Emet",
      "Gediz",
      "Merkez",
      "Simav",
      "Tavşanlı",
      "Aslanapa",
      "Dumlupınar",
      "Hisarcık",
      "Şaphane",
      "Çavdarhisar",
      "Pazarlar"
    ]
  },
  {
    "il": "Malatya",
    "plaka": 44,
    "ilceleri": [
      "Akçadağ",
      "Arapgir",
      "Arguvan",
      "Darende",
      "Doğanşehir",
      "Hekimhan",
      "Merkez",
      "Pütürge",
      "Yeşilyurt",
      "Battalgazi",
      "Doğanyol",
      "Kale",
      "Kuluncak",
      "Yazıhan"
    ]
  },
  {
    "il": "Manisa",
    "plaka": 45,
    "ilceleri": [
      "Akhisar",
      "Alaşehir",
      "Demirci",
      "Gördes",
      "Kırkağaç",
      "Kula",
      "Merkez",
      "Salihli",
      "Sarıgöl",
      "Saruhanlı",
      "Selendi",
      "Soma",
      "Şehzadeler",
      "Yunusemre",
      "Turgutlu",
      "Ahmetli",
      "Gölmarmara",
      "Köprübaşı"
    ]
  },
  {
    "il": "Kahramanmaraş",
    "plaka": 46,
    "ilceleri": [
      "Afşin",
      "Andırın",
      "Dulkadiroğlu",
      "Onikişubat",
      "Elbistan",
      "Göksun",
      "Merkez",
      "Pazarcık",
      "Türkoğlu",
      "Çağlayancerit",
      "Ekinözü",
      "Nurhak"
    ]
  },
  {
    "il": "Mardin",
    "plaka": 47,
    "ilceleri": [
      "Derik",
      "Kızıltepe",
      "Artuklu",
      "Merkez",
      "Mazıdağı",
      "Midyat",
      "Nusaybin",
      "Ömerli",
      "Savur",
      "Dargeçit",
      "Yeşilli"
    ]
  },
  {
    "il": "Muğla",
    "plaka": 48,
    "ilceleri": [
      "Bodrum",
      "Datça",
      "Fethiye",
      "Köyceğiz",
      "Marmaris",
      "Menteşe",
      "Milas",
      "Ula",
      "Yatağan",
      "Dalaman",
      "Seydikemer",
      "Ortaca",
      "Kavaklıdere"
    ]
  },
  {
    "il": "Muş",
    "plaka": 49,
    "ilceleri": [
      "Bulanık",
      "Malazgirt",
      "Merkez",
      "Varto",
      "Hasköy",
      "Korkut"
    ]
  },
  {
    "il": "Nevşehir",
    "plaka": 50,
    "ilceleri": [
      "Avanos",
      "Derinkuyu",
      "Gülşehir",
      "Hacıbektaş",
      "Kozaklı",
      "Merkez",
      "Ürgüp",
      "Acıgöl"
    ]
  },
  {
    "il": "Niğde",
    "plaka": 51,
    "ilceleri": [
      "Bor",
      "Çamardı",
      "Merkez",
      "Ulukışla",
      "Altunhisar",
      "Çiftlik"
    ]
  },
  {
    "il": "Ordu",
    "plaka": 52,
    "ilceleri": [
      "Akkuş",
      "Altınordu",
      "Aybastı",
      "Fatsa",
      "Gölköy",
      "Korgan",
      "Kumru",
      "Mesudiye",
      "Perşembe",
      "Ulubey",
      "Ünye",
      "Gülyalı",
      "Gürgentepe",
      "Çamaş",
      "Çatalpınar",
      "Çaybaşı",
      "İkizce",
      "Kabadüz",
      "Kabataş"
    ]
  },
  {
    "il": "Rize",
    "plaka": 53,
    "ilceleri": [
      "Ardeşen",
      "Çamlıhemşin",
      "Çayeli",
      "Fındıklı",
      "İkizdere",
      "Kalkandere",
      "Pazar",
      "Merkez",
      "Güneysu",
      "Derepazarı",
      "Hemşin",
      "İyidere"
    ]
  },
  {
    "il": "Sakarya",
    "plaka": 54,
    "ilceleri": [
      "Akyazı",
      "Geyve",
      "Hendek",
      "Karasu",
      "Kaynarca",
      "Sapanca",
      "Kocaali",
      "Pamukova",
      "Taraklı",
      "Ferizli",
      "Karapürçek",
      "Söğütlü",
      "Adapazarı",
      "Arifiye",
      "Erenler",
      "Serdivan"
    ]
  },
  {
    "il": "Samsun",
    "plaka": 55,
    "ilceleri": [
      "Alaçam",
      "Bafra",
      "Çarşamba",
      "Havza",
      "Kavak",
      "Ladik",
      "Terme",
      "Vezirköprü",
      "Asarcık",
      "Ondokuzmayıs",
      "Salıpazarı",
      "Tekkeköy",
      "Ayvacık",
      "Yakakent",
      "Atakum",
      "Canik",
      "İlkadım"
    ]
  },
  {
    "il": "Siirt",
    "plaka": 56,
    "ilceleri": [
      "Baykan",
      "Eruh",
      "Kurtalan",
      "Pervari",
      "Merkez",
      "Şirvan",
      "Tillo"
    ]
  },
  {
    "il": "Sinop",
    "plaka": 57,
    "ilceleri": [
      "Ayancık",
      "Boyabat",
      "Durağan",
      "Erfelek",
      "Gerze",
      "Merkez",
      "Türkeli",
      "Dikmen",
      "Saraydüzü"
    ]
  },
  {
    "il": "Sivas",
    "plaka": 58,
    "ilceleri": [
      "Divriği",
      "Gemerek",
      "Gürün",
      "Hafik",
      "İmranlı",
      "Kangal",
      "Koyulhisar",
      "Merkez",
      "Suşehri",
      "Şarkışla",
      "Yıldızeli",
      "Zara",
      "Akıncılar",
      "Altınyayla",
      "Doğanşar",
      "Gölova",
      "Ulaş"
    ]
  },
  {
    "il": "Tekirdağ",
    "plaka": 59,
    "ilceleri": [
      "Çerkezköy",
      "Çorlu",
      "Ergene",
      "Hayrabolu",
      "Malkara",
      "Muratlı",
      "Saray",
      "Süleymanpaşa",
      "Kapaklı",
      "Şarköy",
      "Marmaraereğlisi"
    ]
  },
  {
    "il": "Tokat",
    "plaka": 60,
    "ilceleri": [
      "Almus",
      "Artova",
      "Erbaa",
      "Niksar",
      "Reşadiye",
      "Merkez",
      "Turhal",
      "Zile",
      "Pazar",
      "Yeşilyurt",
      "Başçiftlik",
      "Sulusaray"
    ]
  },
  {
    "il": "Trabzon",
    "plaka": 61,
    "ilceleri": [
      "Akçaabat",
      "Araklı",
      "Arsin",
      "Çaykara",
      "Maçka",
      "Of",
      "Ortahisar",
      "Sürmene",
      "Tonya",
      "Vakfıkebir",
      "Yomra",
      "Beşikdüzü",
      "Şalpazarı",
      "Çarşıbaşı",
      "Dernekpazarı",
      "Düzköy",
      "Hayrat",
      "Köprübaşı"
    ]
  },
  {
    "il": "Tunceli",
    "plaka": 62,
    "ilceleri": [
      "Çemişgezek",
      "Hozat",
      "Mazgirt",
      "Nazımiye",
      "Ovacık",
      "Pertek",
      "Pülümür",
      "Merkez"
    ]
  },
  {
    "il": "Şanlıurfa",
    "plaka": 63,
    "ilceleri": [
      "Akçakale",
      "Birecik",
      "Bozova",
      "Ceylanpınar",
      "Eyyübiye",
      "Halfeti",
      "Haliliye",
      "Hilvan",
      "Karaköprü",
      "Siverek",
      "Suruç",
      "Viranşehir",
      "Harran"
    ]
  },
  {
    "il": "Uşak",
    "plaka": 64,
    "ilceleri": [
      "Banaz",
      "Eşme",
      "Karahallı",
      "Sivaslı",
      "Ulubey",
      "Merkez"
    ]
  },
  {
    "il": "Van",
    "plaka": 65,
    "ilceleri": [
      "Başkale",
      "Çatak",
      "Erciş",
      "Gevaş",
      "Gürpınar",
      "İpekyolu",
      "Muradiye",
      "Özalp",
      "Tuşba",
      "Bahçesaray",
      "Çaldıran",
      "Edremit",
      "Saray"
    ]
  },
  {
    "il": "Yozgat",
    "plaka": 66,
    "ilceleri": [
      "Akdağmadeni",
      "Boğazlıyan",
      "Çayıralan",
      "Çekerek",
      "Sarıkaya",
      "Sorgun",
      "Şefaatli",
      "Yerköy",
      "Merkez",
      "Aydıncık",
      "Çandır",
      "Kadışehri",
      "Saraykent",
      "Yenifakılı"
    ]
  },
  {
    "il": "Zonguldak",
    "plaka": 67,
    "ilceleri": [
      "Çaycuma",
      "Devrek",
      "Ereğli",
      "Merkez",
      "Alaplı",
      "Gökçebey"
    ]
  },
  {
    "il": "Aksaray",
    "plaka": 68,
    "ilceleri": [
      "Ağaçören",
      "Eskil",
      "Gülağaç",
      "Güzelyurt",
      "Merkez",
      "Ortaköy",
      "Sarıyahşi"
    ]
  },
  {
    "il": "Bayburt",
    "plaka": 69,
    "ilceleri": [
      "Merkez",
      "Aydıntepe",
      "Demirözü"
    ]
  },
  {
    "il": "Karaman",
    "plaka": 70,
    "ilceleri": [
      "Ermenek",
      "Merkez",
      "Ayrancı",
      "Kazımkarabekir",
      "Başyayla",
      "Sarıveliler"
    ]
  },
  {
    "il": "Kırıkkale",
    "plaka": 71,
    "ilceleri": [
      "Delice",
      "Keskin",
      "Merkez",
      "Sulakyurt",
      "Bahşili",
      "Balışeyh",
      "Çelebi",
      "Karakeçili",
      "Yahşihan"
    ]
  },
  {
    "il": "Batman",
    "plaka": 72,
    "ilceleri": [
      "Merkez",
      "Beşiri",
      "Gercüş",
      "Kozluk",
      "Sason",
      "Hasankeyf"
    ]
  },
  {
    "il": "Şırnak",
    "plaka": 73,
    "ilceleri": [
      "Beytüşşebap",
      "Cizre",
      "İdil",
      "Silopi",
      "Merkez",
      "Uludere",
      "Güçlükonak"
    ]
  },
  {
    "il": "Bartın",
    "plaka": 74,
    "ilceleri": [
      "Merkez",
      "Kurucaşile",
      "Ulus",
      "Amasra"
    ]
  },
  {
    "il": "Ardahan",
    "plaka": 75,
    "ilceleri": [
      "Merkez",
      "Çıldır",
      "Göle",
      "Hanak",
      "Posof",
      "Damal"
    ]
  },
  {
    "il": "Iğdır",
    "plaka": 76,
    "ilceleri": [
      "Aralık",
      "Merkez",
      "Tuzluca",
      "Karakoyunlu"
    ]
  },
  {
    "il": "Yalova",
    "plaka": 77,
    "ilceleri": [
      "Merkez",
      "Altınova",
      "Armutlu",
      "Çınarcık",
      "Çiftlikköy",
      "Termal"
    ]
  },
  {
    "il": "Karabük",
    "plaka": 78,
    "ilceleri": [
      "Eflani",
      "Eskipazar",
      "Merkez",
      "Ovacık",
      "Safranbolu",
      "Yenice"
    ]
  },
  {
    "il": "Kilis",
    "plaka": 79,
    "ilceleri": [
      "Merkez",
      "Elbeyli",
      "Musabeyli",
      "Polateli"
    ]
  },
  {
    "il": "Osmaniye",
    "plaka": 80,
    "ilceleri": [
      "Bahçe",
      "Kadirli",
      "Merkez",
      "Düziçi",
      "Hasanbeyli",
      "Sumbas",
      "Toprakkale"
    ]
  },
  {
    "il": "Düzce",
    "plaka": 81,
    "ilceleri": [
      "Akçakoca",
      "Merkez",
      "Yığılca",
      "Cumayeri",
      "Gölyaka",
      "Çilimli",
      "Gümüşova",
      "Kaynaşlı"
    ]
  }
]
function search(nameKey, myArray){
  for (var i=0; i < myArray.length; i++) {
    if (myArray[i].plaka == nameKey) {
      return myArray[i];
    }
  }
}
$( document ).ready(function() {
  $.each(data, function( index, value ) {
    $('#Iller').append($('<option>', {
      value: value.plaka,
      text:  value.il
    }));
  });
  $("#Iller").change(function(){
    var valueSelected = this.value;
    if($('#Iller').val() > 0) {
      $('#Ilceler').html('');
      $('#Ilceler').append($('<option>', {
        value: 0,
        text:  'Lütfen Bir İlçe seçiniz'
      }));
      $('#Ilceler').prop("disabled", false);
      var resultObject = search($('#Iller').val(), data);
      $.each(resultObject.ilceleri, function( index, value ) {
        $('#Ilceler').append($('<option>', {
          value: value,
          text:  value
        }));
      });
      return false;
    }
    $('#Ilceler').prop("disabled", true);
  });
});





function triggerGETRequests() {
  var urls = [
    "https://ent.wegdi.com/System/Cron/Trendyol/Live/OrderShipped.php",
    "https://ent.wegdi.com/System/Cron/Trendyol/Live/OrderPicking.php",
    "https://ent.wegdi.com/System/Cron/Trendyol/Live/OrderNew.php",
    "https://ent.wegdi.com/System/Cron/Trendyol/Live/OrderDelivered.php"
  ];

  urls.forEach(function(url) {
    fetch(url, {
      method: 'GET'
    })
    .then(function(response) {
      if (response.status === 200) {
        //console.log('GET request successful for ' + url);
        //console.clear();
      } else {
        //console.error('GET request failed for ' + url);
        console.clear();
      }
    })
    .catch(function(error) {
      //console.error('Error while making GET request for ' + url, error);
    });
  });
}

// Belirli aralıklarla GET isteklerini tetiklemek için setInterval kullanabilirsiniz.
var interval = 30000; // 30 saniye
setInterval(triggerGETRequests, interval);








var option_value_row = 0;
function addOptionValue() {
    html  = '<tr id="option-value-row' + option_value_row + '">';
    html += '  <td class="text-left"><input type="text" class="form-control"  placeholder="Seçenek Değeri" name="option_value[' + option_value_row + '][option_value_id]" value="" />';
    html += ' </td>';
    html += '  <td class="text-right"><input type="text" name="option_value[' + option_value_row + '][sort_order]" value="" placeholder="Sıralama" class="form-control" /></td>';
    html += '  <td class="text-right"><button type="button" onclick="$(\'#option-value-row' + option_value_row + '\').remove();" data-toggle="tooltip" title="Kaldır" class="btn btn-sm btn-danger"><i class="ri-delete-bin-5-line"></i></button></td>';
    html += '</tr>';
    $('#option-value tbody').append(html);
    option_value_row++;
}
