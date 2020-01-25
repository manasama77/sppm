<script>
  $(document).ready(function(){
    let usernameForm = $('#usernamex');
    $('button[type=submit]').attr('disabled', true);
    usernameForm.on('change', function(){
      let username = $(this).val();
      checkUsername(username);
    });

    $('#form-create').validate({
      errorElement: 'span', //default input error message container
      errorClass: 'help-block help-block-error text-danger', // default input error message class
      focusInvalid: true, // do not focus the last invalid input
      ignore: "",  // validate all fields including form hidden input
      rules: {
        usernamex: {
          required: true
        },
        password1: {
          required: true,
        },
        password2: {
          required: true,
          equalTo: '#password1'
        },
      },

      errorPlacement: function (error, element) { // render error placement for each input type
        var icon = $(element).parent('.input-icon').children('i');
        icon.removeClass('fa-check').addClass("fa-warning");  
        icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
      },

      highlight: function (element) { // hightlight error inputs
        $(element).closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group   
      },

      unhighlight: function (element) { // revert the change done by hightlight

      },

      success: function (label, element) {
        var icon = $(element).parent('.input-icon').children('i');
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
        icon.removeClass("fa-warning").addClass("fa-check");
      },

      submitHandler: function (form) {
        console.log(form);
        $.ajax({
          url: '<?=site_url();?>users/store',
          method: 'post',
          data: $('#form-create').serialize(),
          beforeSend: function(){
            $.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Proses Check Username'});
          },
          statusCode: {
            200: function(){
              console.log(200);
              toastr.success('Proses Create Users Berhasil', 'Oops...');
              setTimeout(function(){
                window.location.replace('<?=site_url();?>users/index');
                $.unblockUI();
              }, 2000);
            },
            400: function(){
              console.log(400);
              toastr.warning('Error 400', 'Oops...');
              $.unblockUI();
            },
            404: function(){
              console.log(404);
              toastr.warning('Error 404', 'Oops...');
              $.unblockUI();
            },
            500: function(){
              console.log(500);
              toastr.warning('Error 500', 'Oops...');
              $.unblockUI();
            }
          }
        });
      }

    });
  });

  function checkUsername(username)
  {
    $.ajax({
      url: `<?=site_url();?>users/chk_username/${username}`,
      method: 'get',
      data: $('#form-create').serialize(),
      beforeSend: function(){
        $.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Proses Check Username'});
      },
      statusCode: {
        200: function(){
          console.log(200);
          $('button[type=submit]').attr('disabled', false);
          $.unblockUI();
        },
        400: function(){
          console.log(400);
          const pesanError = 'Username telah digunakan, silahkan gunakan username lain';
          $('#usernamex').closest('.form-group').removeClass("has-success").addClass('has-error');
          $('#usernamex').parent('.input-icon').children('i').removeClass('fa-check').addClass("fa-warning").attr("data-original-title", pesanError).tooltip({'container': 'body'});
          $('button[type=submit]').attr('disabled', true);
          toastr.warning(pesanError, 'Oops...');
          $.unblockUI();
        },
        404: function(){
          console.log(404);
          $.unblockUI();
        },
        500: function(){
          console.log(500);
          $.unblockUI();
        }
      }
    });
  }
</script>