// success message
const successMessage = $('.success-message').data('successmessage')
const failMessage = $('.fail-message').data('failmessage')

if(successMessage){
    Swal.fire(
        'Success',
        successMessage,
        'success'
      )
}

if(failMessage){
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: failMessage
      })
}

$('.button-delete').on('click', function(e){
    e.preventDefault();

    const href = $(this).attr('href');

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Hapus data ini ?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, hapus!',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: false
      }).then((result) => {
        if (result.isConfirmed) {
          document.location.href = href;
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Data anda masih aman :)',
            'success'
          )
        }
      })
})
