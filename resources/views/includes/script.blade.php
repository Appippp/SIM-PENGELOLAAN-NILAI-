  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>
  <!-- Page level plugins -->
  <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>



  <script>
      function confirmDelete(id) {
          Swal.fire({
              title: 'Apakah Anda yakin?',
              text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Ya, hapus!',
          }).then((result) => {
              if (result.isConfirmed) {
                  document.getElementById('deleteForm' + id).submit();
              }
          });
      }
  </script>

  <script>
      document.addEventListener('DOMContentLoaded', function() {
          document.getElementById('logoutLink').addEventListener('click', function(event) {
              event.preventDefault();

              Swal.fire({
                  icon: 'warning',
                  title: 'Konfirmasi Logout',
                  text: 'Apakah Anda yakin ingin logout?',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Ya, Logout!'
              }).then((result) => {
                  if (result.isConfirmed) {
                      document.getElementById('logout-form').submit();
                  }
              });
          });
      });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
