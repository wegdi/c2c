
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

            // Redirect to the success page after the delay
            if (refresh == 0) {
              window.location.reload();
            } else {
              if (url == "/Modal/Leads/Add/NoteAdd.php") {
                var musteriID = $("#CustomerIDPostGET").val();
                CustomerGet(musteriID);
              }
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
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params="+param2,
        "type": "POST",
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


$(document).ready(function() {
   // Her iki input için keyup olayı ekleme
   $("#tedarikciadi, #tedarkcilink").on('keyup', function() {
     // Tedarikçi Adı'nı büyük harfe çevirme
     var tedarikciAdi = $("#tedarikciadi").val();
     $("#tedarikciadi").val(tedarikciAdi.toUpperCase());

     // Tedarikçi Linki'ni kontrol etme
     var tedarikciLink = $("#tedarkcilink").val();

     // Her iki input da dolu mu kontrol etme
     if (tedarikciAdi.trim() !== '' && tedarikciLink.trim() !== '') {
       // Geçerli bir URL ise "Onaylandı" simgesini gösterme
       if (isValidUrl(tedarikciLink)) {
         $("#xmlstart").html("Kaydet <i class='fa fa-check'></i>");
       } else {
         $("#xmlstart").html("Geçerli bir URL değil");
       }
     } else {
       $("#xmlstart").html("");
     }

     // Baştan ve sondan boşlukları silme
     $("#tedarkcilink").val(tedarikciLink.trim());
   });

   // Button click olayını ekleme
   $("#xmlstart").on('click', function() {
     var tedarikciAdi = $("#tedarikciadi").val();
     var tedarikciLink = $("#tedarkcilink").val();

     // Her iki input da dolu mu ve geçerli bir URL mi kontrol etme
     if (tedarikciAdi.trim() !== '' && tedarikciLink.trim() !== '' && isValidUrl(tedarikciLink)) {
       // AJAX ile verileri post etme
       var formData = {
         tedarikciAdi: tedarikciAdi,
         tedarikciLink: tedarikciLink
       };

       $.ajax({
         type: "POST",
         url: "/Modal/Supplier/Add/Add.php",
         data: JSON.stringify(formData),
         contentType: "application/json",
         success: function(response) {
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
