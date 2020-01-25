<script>
  $(document).ready(function(){
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-top-right",
      "onclick": null,
      "showDuration": "1000",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    //datatables
    table = $('#table').DataTable({
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.

      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?=site_url('users/ajax_list')?>",
        "type": "POST"
      },

      //Set column definition initialisation properties.
      "columnDefs": [
        { 
          "targets": [ 0, 2 ], //first column / numbering column
          "orderable": false, //set not orderable
        },
        {
          "targets": [2],
          "className": 'text-center'
        }
      ],
    });

    $('#refresh').on('click', function(){
      table.ajax.reload();
    });   

  });

  function reset(id, username)
  {
    console.log(id, username);
    $('#modal-reset').modal('show');
    $('#id').val(id);
    $('#username').val(username);

    $('#form-reset').validate({
      debug: true,
      errorClass: 'help-inline text-danger',
      rules:{
        username:{
          required:true
        },
        new_password:{
          required:true
        }
      },
      submitHandler: function( form ) {

        swal.fire({
          type: "question",
          title: "Konfirmasi Reset Password "+username,
          html: "Kamu akan melakukan Reset Password untuk Username "+username+" ?",
          focusConfirm: false,
          showConfirmButton: true,
          showCancelButton: true,
          allowOutsideClick: false,
          confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ya',
          customClass: {
            confirmButton: 'btn blue-madison'
          },
          cancelButtonText: '<i class="fa fa-times"></i> Batalkan'
        })
        .then((result) => {
          if (result.value) {
            $.ajax({
              url         : '<?=site_url('users/reset');?>',
              method      : 'PUT',
              data        : { id:id, new_password:$('#new_password').val() },
              beforeSend  : function(){
                $('#form-reset').block({ message: '<i class="fa fa-spinner fa-spin"></i> Silahkan Tunggu...' });
              },
              statusCode  : {
                200: function() {
                  toastr.success('Proses Reset Pasword Berhasil.', 'Success');
                  setTimeout(function(){
                    table.ajax.reload();
                    $('#form-reset').unblock();
                    $('#modal-reset').modal('hide');
                  }, 2000)
                },
                404: function() {
                  $('#form-reset').unblock();
                  toastr.error('Page Not Found.', 'Error 404');
                },
                405: function() {
                  $('#form-reset').unblock();
                  toastr.error('Method not Allowed.', 'Error 405');
                },
                500: function() {
                  $('#form-reset').unblock();
                  toastr.error('Not connect with database.', 'Error 500');
                }
              }
            });

          } 
        });

      }
    });
  }

  function deleted(id, username)
  {
    swal.fire({
      type: "question",
      title: "Konfirmasi Delete "+username,
      html: "Kamu akan melakukan Delete untuk Username "+username+" ?",
      focusConfirm: false,
      showConfirmButton: true,
      showCancelButton: true,
      allowOutsideClick: false,
      confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ya',
      customClass: {
        confirmButton: 'btn blue-madison'
      },
      cancelButtonText: '<i class="fa fa-times"></i> Batalkan'
    })
    .then((result) => {
      if (result.value) {
        $.ajax({
          url         : '<?=site_url('users/delete/');?>'+id,
          method      : 'DELETE',
          beforeSend  : function(){
            $.blockUI({ message: '<i class="fa fa-spinner fa-spin"></i> Silahkan Tunggu...' });
          },
          statusCode  : {
            200: function() {
              toastr.success('Proses Delete Berhasil.', 'Success');
              setTimeout(function(){
                $.unblockUI();
                table.ajax.reload();
                //window.location.reload();
              }, 2000)
            },
            404: function() {
              $.unblockUI();
              toastr.error('Page Not Found.', 'Error 404');
            },
            405: function() {
              $.unblockUI();
              toastr.error('Method not Allowed.', 'Error 405');
            },
            500: function() {
              $.unblockUI();
              toastr.error('Not connect with database.', 'Error 500');
            }
          }
        });

      } 
    });
  }
</script>