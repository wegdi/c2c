





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


$(document).ready(function () {
  // Check if an element with ID "NegatifeGoogle" exists on the page
  if ($("#NegatifeGoogle").length > 0) {
    $('#NegatifeGoogle').DataTable({
      "processing": true,
      "serverSide": true,
      "searching": false,
      "bLengthChange": false,
      "ajax": {
        "url": "/Modal/Google/Keyword/NegatifGoogle.php",
        "type": "POST",
      },
      "pageLength": 3, // Her sayfada 3 veriyi görüntüle
    });
  }
});







$(document).ready(function () {
  // Check if an element with ID "GoogleAds" exists on the page
  if ($("#GoogleConversion").length > 0) {
    var GoogleConversion =$('#GoogleConversion').DataTable({
      "processing": true,
      "serverSide": true,
      "searching": false,
      "bLengthChange": false,
      "ajax": {
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params=" + param2,
        "type": "POST",
        "data": function (d) {
          d.StartDate = $('#StartDate').val();
          d.EndDate = $('#EndDate').val();

        }
      }
    });
    $('#StartDate, #EndDate').on('change', function () {
      GoogleConversion.draw(); // DataTable'ı yeniden çizerek filtrelemeyi uygular
    });
  }
});



$(document).ready(function () {
  // Check if an element with ID "GoogleAds" exists on the page
  if ($("#OrderList").length > 0) {
    var OrderList = $('#OrderList').DataTable({
      "processing": true,
      "serverSide": true,
      "searching": false,
      "bLengthChange": false,
      "ajax": {
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params=" + param2,
        "type": "POST",
        "data": function (d) {
          d.StartDate = $('#StartDate').val();
          d.EndDate = $('#EndDate').val();
          d.Company = $('#Company').val();
          d.OrderNo = $('#OrderNo').val();

        }
      }
    });

    // Add keyup event listener for the Company input
    $('#Company,#OrderNo').on('keyup', function () {
      OrderList.draw(); // Redraw DataTable to apply filtering
    });

    // Add change event listeners for StartDate and EndDate inputs
    $('#StartDate, #EndDate').on('change', function () {
      OrderList.draw(); // Redraw DataTable to apply filtering
    });
  }
});




$(document).ready(function () {
  // Check if an element with ID "GoogleAds" exists on the page
  if ($("#GoogleAds").length > 0) {
    var GoogleAdsTable =$('#GoogleAds').DataTable({
      "processing": true,
      "serverSide": true,
      "searching": false,
      "bLengthChange": false,
      "ajax": {
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params=" + param3,
        "type": "POST",
        "data": function (d) {
          d.StartDate = $('#StartDate').val();
          d.EndDate = $('#EndDate').val();

        },
        "dataSrc": function (json) {
          // DataTables sonuçlarından footer verilerini al
          var footerData = json.footer;
          if (footerData) {
            // İstediğiniz bir elemente footer verilerini ekleyebilirsiniz
            $("#tbm").text(footerData.tbm);
            $("#CampaignView").text(footerData.CampaignView);
            $("#CampaignClick").text(footerData.CampaignClick);
            $("#CampaignConversion").text(footerData.CampaignConversion);
            $("#DailyBudget").text(footerData.DailyBudget);
            $("#Remaining_Budget").text(footerData.Remaining_Budget);

          }
          return json.data; // DataTables için ana veri
        }
      }
    });
    $('#StartDate, #EndDate').on('change', function () {
      GoogleAdsTable.draw(); // DataTable'ı yeniden çizerek filtrelemeyi uygular
    });
  }
});




$(document).ready(function () {
  // Check if an element with ID "GoogleAds" exists on the page
  if ($("#MetaAdss").length > 0) {
    var MetaAds =$('#MetaAdss').DataTable({
      "processing": true,
      "serverSide": true,
      "searching": false,
      "bLengthChange": false,
      "ajax": {
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params=" + param2,
        "type": "POST",
        "data": function (d) {
          d.StartDate = $('#StartDate').val();
          d.EndDate = $('#EndDate').val();

        },
        "dataSrc": function (json) {
          // DataTables sonuçlarından footer verilerini al
          var footerData = json.footer;

          return json.data; // DataTables için ana veri
        }
      }
    });
    $('#StartDate, #EndDate').on('change', function () {
      MetaAds.draw(); // DataTable'ı yeniden çizerek filtrelemeyi uygular
    });
  }
});

$(document).ready(function () {
  // Check if an element with ID "GoogleAds" exists on the page
  if ($("#MetaAdsGroup").length > 0) {
    var MetaAds =$('#MetaAdsGroup').DataTable({
      "processing": true,
      "serverSide": true,
      "searching": false,
      "bLengthChange": false,
      "ajax": {
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params=" + param2,
        "type": "POST",
        "data": function (d) {
          d.StartDate = $('#StartDate').val();
          d.EndDate = $('#EndDate').val();

        },
        "dataSrc": function (json) {
          // DataTables sonuçlarından footer verilerini al
          var footerData = json.footer;

          return json.data; // DataTables için ana veri
        }
      }
    });
    $('#StartDate, #EndDate').on('change', function () {
      MetaAds.draw(); // DataTable'ı yeniden çizerek filtrelemeyi uygular
    });
  }
});

$(document).ready(function () {
  // Check if an element with ID "GoogleAds" exists on the page
  if ($("#MetaAds").length > 0) {
    var MetaAds =$('#MetaAds').DataTable({
      "processing": true,
      "serverSide": true,
      "searching": false,
      "bLengthChange": false,
      "ajax": {
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params=" + param2,
        "type": "POST",
        "data": function (d) {
          d.StartDate = $('#StartDate').val();
          d.EndDate = $('#EndDate').val();

        },
        "dataSrc": function (json) {
          // DataTables sonuçlarından footer verilerini al
          var footerData = json.footer;

          return json.data; // DataTables için ana veri
        }
      }
    });
    $('#StartDate, #EndDate').on('change', function () {
      MetaAds.draw(); // DataTable'ı yeniden çizerek filtrelemeyi uygular
    });
  }
});


$(document).ready(function () {
  // Check if an element with ID "GoogleAds" exists on the page
  if ($("#GoogleAdGroup").length > 0) {
    var GoogleAdGroup =$('#GoogleAdGroup').DataTable({
      "processing": true,
      "serverSide": true,
      "searching": false,
      "bLengthChange": false,
      "ajax": {
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params=" + param3 +"&Params3=" + param4,
        "type": "POST",
        "data": function (d) {
          d.StartDate = $('#StartDate').val();
          d.EndDate = $('#EndDate').val();

        },
        "dataSrc": function (json) {
          // DataTables sonuçlarından footer verilerini al
          var footerData = json.footer;
          if (footerData) {
            // İstediğiniz bir elemente footer verilerini ekleyebilirsiniz
            $("#tbm").text(footerData.tbm);
            $("#CampaignView").text(footerData.CampaignView);
            $("#CampaignClick").text(footerData.CampaignClick);
            $("#CampaignConversion").text(footerData.CampaignConversion);
            $("#DailyBudget").text(footerData.DailyBudget);
            $("#Remaining_Budget").text(footerData.Remaining_Budget);

          }
          return json.data; // DataTables için ana veri
        }
      }
    });
    $('#StartDate, #EndDate').on('change', function () {
      GoogleAdGroup.draw(); // DataTable'ı yeniden çizerek filtrelemeyi uygular
    });
  }
});






$(document).ready(function () {
  // Check if an element with ID "GoogleAds" exists on the page
  if ($("#GoogleKeywords").length > 0) {
    var GoogleKeywords =$('#GoogleKeywords').DataTable({
      "processing": true,
      "serverSide": true,
      "searching": false,
      "bLengthChange": false,
      "ajax": {
        "url": "/Modal/" + param0 + "/" + param1 + "/" + param1 + ".php?Params=" + param3+"&Params3="+ param4,
        "type": "POST",
        "data": function (d) {
          d.StartDate = $('#StartDate').val();
          d.EndDate = $('#EndDate').val();

        },
        "dataSrc": function (json) {
          // DataTables sonuçlarından footer verilerini al
          var footerData = json.footer;
          if (footerData) {
            // İstediğiniz bir elemente footer verilerini ekleyebilirsiniz
            $("#tbm").text(footerData.tbm);
            $("#CampaignView").text(footerData.CampaignView);
            $("#CampaignClick").text(footerData.CampaignClick);
            $("#CampaignConversion").text(footerData.CampaignConversion);
            $("#DailyBudget").text(footerData.DailyBudget);
            $("#Remaining_Budget").text(footerData.Remaining_Budget);

          }
          return json.data; // DataTables için ana veri
        }
      }
    });
    $('#StartDate, #EndDate').on('change', function () {
      GoogleKeywords.draw(); // DataTable'ı yeniden çizerek filtrelemeyi uygular
    });
  }
});




function GoogleCampingStatus(status, camping) {
    $.ajax({
        type: "POST",
        url: "/Modal/Google/Edit/CampaignStatus.php",
        dataType: 'JSON',
        data: { Status: status, CampingId: camping },
        success: function (response) {
            if (response.Result == true) {
                Swal.fire({
                    title: "Reklam Durumu",
                    text: "Reklamınızın Durumu Güncellendi",
                    icon: 'success'
                });

                // Reload the DataTable on success
                GoogleAdsTable.draw();
            } else {
                Swal.fire({
                    title: "Reklam Durumu",
                    text: "Reklamınızın Durumu Güncellenemedi",
                    icon: 'error'
                });
            }
        }
    });
}






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












$(document).ready(function () {
  if ($("#MetaUser").length > 0) {
    var table = $('#MetaUser').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "/Modal/Meta5/Customers/Customers.php",
        "type": "POST",
        "data": function (d) {
          d.LoginID = $('#LoginID').val();
          d.LikeNameSurname = $('#LikeNameSurname').val();
          d.Meta5Groups = $('#Meta5Groups').val();
          d.UserFiltre = $('#UserFiltre').val();
          d.SwitchCheck9 = $('#SwitchCheck9').prop('checked') ? 1 : 0;
          d.FiltreStatus = $('#FiltreStatus').val();
          d.floatingSelect = $('#floatingSelect').val();

        }
      },
       "searching": false,
       "lengthChange": true,
       "paging": true,
       "pageLength": 20,

    });



    $('#LoginID').on('keyup', function () {
      table.draw(); // DataTable'ı yeniden çizerek filtrelemeyi uygular
    });
    $('#LikeNameSurname').on('keyup', function () {
      table.draw(); // DataTable'ı yeniden çizerek filtrelemeyi uygular
    });


    // "change" olayını dinleyerek "floatingSelect" alanında değer değiştiğinde filtrelemeyi yapar
    $('#Meta5Groups').on('change', function () {
      table.draw(); // DataTable'ı yeniden çizerek filtrelemeyi uygular
    });

    $('#UserFiltre').on('change', function () {
      table.draw(); // DataTable'ı yeniden çizerek filtrelemeyi uygular
    });

    $('#FiltreStatus').on('change', function () {
      table.draw(); // DataTable'ı yeniden çizerek filtrelemeyi uygular
    });



    $('#UserFiltre').on('change', function () {
      table.draw(); // DataTable'ı yeniden çizerek filtrelemeyi uygular
    });

    $('#floatingSelect').on('change', function () {
      table.draw(); // DataTable'ı yeniden çizerek filtrelemeyi uygular
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






function fetchDataAndInsert(url, elementId) {
  // Veriyi çekmek için AJAX isteği gönderiyoruz
  $.ajax({
    url: url,
    type: 'GET',
    dataType: 'html',
    success: function (data) {
      // Veriyi çektikten sonra belirtilen div içine ekliyoruz
      $('#' + elementId).html(data);
    },
    error: function (error) {
      console.error('Veri çekme hatası:', error);
    }
  });
}

// Sayfa yüklendiğinde ve her 30 saniyede bir veriyi çekmek için zamanlayıcı kullanıyoruz

$(document).ready(function () {
  if ($("#Refreans").length > 0) {
  // İlk parametre URL, ikinci parametre ise elementId'dir
  fetchDataAndInsert('/Modal/Analytics/Report/Report.php', 'Refreans');
  fetchDataAndInsert('/Modal/Analytics/Report/Report2.php', 'eventler');
  fetchDataAndInsert('/Modal/Analytics/Report/Report3.php', 'country');
  fetchDataAndInsert('/Modal/Analytics/Report/Report4.php', 'city');
  fetchDataAndInsert('/Modal/Analytics/Report/Report5.php', 'unifiedScreenName');

  // Her 30 saniyede bir tekrarla
  setInterval(function () {
    fetchDataAndInsert('/Modal/Analytics/Report/Report.php', 'Refreans');
    fetchDataAndInsert('/Modal/Analytics/Report/Report2.php', 'eventler');
    fetchDataAndInsert('/Modal/Analytics/Report/Report3.php', 'country');
    fetchDataAndInsert('/Modal/Analytics/Report/Report4.php', 'city');
    fetchDataAndInsert('/Modal/Analytics/Report/Report5.php', 'unifiedScreenName');

  }, 30000);
  }
});



$(document).ready(function() {
  // InputMask eklentisi ile para miktarı maskesini tanımlayın
  $('#currency').inputmask("currency", {
    radixPoint: ".", // Ondalık ayırıcı karakteri
    groupSeparator: ".", // Binlik ayırıcı karakteri
    autoGroup: true,
    digits: 1, // Ondalık basamak sayısı
    prefix: '₺', // Önek (örneğin, "$" gibi)
    rightAlign: false // Sağa hizalama
  });

  // Currency input değiştiğinde işlem yap
  $('#currency').on('input', function() {
    var currencyValue = parseFloat($(this).inputmask('unmaskedvalue')); // Para miktarını al
    if (!isNaN(currencyValue)) {
      var kdvDahilTutar = currencyValue + (currencyValue * 0.35); // %35 ekleyerek hesapla
      $('#kdvnetg').text('Toplam KDV Dahil Tutar: ₺' + kdvDahilTutar.toFixed(2)); // İlgili p etiketine sonucu yaz
      $('#AmountTotal').val(kdvDahilTutar.toFixed(2)); // İlgili p etiketine sonucu yaz

    }
  });
});





$(document).ready(function() {
  // Form gönderildiğinde çalışacak fonksiyon
  $("#googlepagespeed").submit(function(event) {
    // Formun otomatik olarak sayfa yenilenmesini engellemek için kullanılır
    $("#loaddingg").removeClass("d-none");
    event.preventDefault();

    // "Lütfen bekleyin" mesajını göster

    // Form verilerini alın
    var pageUrl = $("#PageUrl").val();

    // Verileri bir JSON nesnesine dönüştürün
    var formData = {"PageUrl": pageUrl};

    // AJAX isteği oluşturun
    $.ajax({
      type: "POST",
      url: "/System/Cron/GooglePagespeed/Tecnical.php", // API URL'sini buraya ekleyin
      data: formData,
      dataType: "html",
      success: function(response) {
        $("#loaddingg").addClass("d-none");
        $('#sonccs').html(response);

        var audio = new Audio('/Notification.mp3');
        audio.play();

      },
      error: function(error) {
        // İsteğin başarısız olduğunda hata mesajını işleyin
        console.error(error);
      }
    });
  });
});





function updateIframeContent() {
        // Use jQuery to fetch HTML content from the PHP file
        $.ajax({
            url: '/Modal/Analytics/Report/Report6.php',
            type: 'GET',
            dataType: 'html',
            success: function (htmlContent) {
                // Update the content of the iframe
                $('#haritaFrame').contents().find('html').html(htmlContent);
            },
            error: function () {
                console.error('Failed to fetch data from Report6.php.');
            }
        });
    }


    $(document).ready(function () {
        // Handle form submission
        $("#Vstart").on("click", function () {
            // Manually construct the form data object
            var formData = {
                firstName: $("#firstName").val(),
                lastName: $("#lastName").val(),
                tckimlik: $("#tckimlik").val(),
                dyili: $("#dyili").val(),
                vatNo: $("#vatNo").val(),
                vatDair: $("#vatDair").val(),
                sphone: $("#sphone").val(),
                type: $("#type").val()
            };

            // Check for required fields
            var requiredFields = ["tckimlik", "dyili", "sphone"];
            if (formData.type === "kurumsal") {
                requiredFields.push("vatNo", "vatDair");
            } else {
                requiredFields.push("firstName", "lastName");
            }

            var allFieldsFilled = true;

            for (var i = 0; i < requiredFields.length; i++) {
                var field = requiredFields[i];
                if (formData[field].trim() === "") {
                    // If any required field is empty, mark it in red and set the flag to false
                    $("#" + field).addClass("is-invalid");
                    allFieldsFilled = false;
                } else {
                    $("#" + field).removeClass("is-invalid");
                }
            }

            // If all required fields are filled, proceed with the AJAX request
            if (allFieldsFilled) {
                // Assuming you want to post the form data to Verification.php using AJAX
                $.ajax({
                    type: "POST",
                    url: "/Modal/Kyc/Verification/Verification.php",
                    data: formData,
                    success: function (response) {
                        // Parse the JSON response
                        var jsonResponse = JSON.parse(response);

                        // Check the parsed response from the server
                        if (jsonResponse.respons == "ok") {
                            // If the response is OK, hide the Vstart button and show the nextb button
                            $("#Vstart").addClass("d-none");
                            $("#nextb").removeClass("d-none");
                            $("#step01").removeClass("d-none");
                            $("#step0001").addClass("d-none");

                            $("#alertci").removeClass("d-none");
                            $("#alertver").html('<i class="ri-notification-off-line me-3 align-middle"></i> <strong>Başarılı</strong> ' + jsonResponse.message);

                            // Reload the page after 3 seconds
                            setTimeout(function () {
                                location.reload();
                            }, 3000);
                        } else if (jsonResponse.respons == "no") {
                            $("#alertci").removeClass("d-none");
                            $("#alertver").html('<i class="ri-notification-off-line me-3 align-middle"></i> <strong>Başarısız</strong> ' + jsonResponse.message);
                        } else {
                            // Handle other responses or errors here
                            console.log("Error or unexpected response: " + response);
                        }
                    },
                    error: function (error) {
                        // Handle AJAX errors here
                        console.log("AJAX Error: " + error);
                    }
                });
            }
        });

        // Show/hide kurumsalFields based on the selected type
        $("#type").on("change", function () {
            var selectedType = $(this).val();
            if (selectedType === "kurumsal") {
                $("#kurumsalFields").show();
                $("#kurumsalFieldsx").show();
            } else {
                $("#kurumsalFields").hide();
                $("#kurumsalFieldsx").hide();
            }
        });
    });
