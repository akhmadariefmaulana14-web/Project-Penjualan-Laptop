const flashData = $('.data-alert').data('flashdata');

if(flashData) {
    Swal.fire({
    icon: 'warning',
    title: 'Warning',
    text: flashData
    });
}

const transaksiSuccess = $('.alert-success').data('flashdata')

if(transaksiSuccess) {
Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Pesanan Anda Sedang Kami Proses',
  showConfirmButton: false,
  timer: 1500
});
}

var truePassword = document.getElementById('password')
var confirmPassword = document.getElementById('password-konfirmasi')
if(truePassword != null && confirmPassword != null){
confirmPassword.addEventListener('keyup', function() {
    if (confirmPassword.value != truePassword.value) {
        document.getElementById('message').innerHTML = 'password tidak sesuai';
        $('.btn-confirmation').prop('disabled', true);
    } else {
        document.getElementById('message').innerHTML = 'password sesuai';
        $('.btn-confirmation').prop('disabled', false);
    }
});
}


$('.del-btn').on('click', function (e) {
   
    e.preventDefault(); 
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah Anda Yakin',
        text: 'Menghapus Data Ini ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: 'd33',
        confirmButtonText: 'Hapus Data !'
    }).then((result) => {
        if (result.isConfirmed){

            document.location.href = href;
        }
    })
});