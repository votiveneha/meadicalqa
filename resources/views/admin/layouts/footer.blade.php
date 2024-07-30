 <!--  Customizer -->
    <!--  Import Js Files -->
    <script src="{{ asset('assets/admin/dist/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/admin/dist/libs/simplebar/dist/simplebar.min.js')}}"></script>
    <script src="{{ asset('assets/admin/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
     <!-- DataTables JavaScript -->
     <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
     <!-- Initialize DataTables -->
    <!--  core files -->
    <script src="{{ asset('assets/admin/dist/js/app.min.js')}}"></script>
    <script src="{{ asset('assets/admin/dist/js/app.init.js')}}"></script>
    <script src="{{ asset('assets/admin/dist/js/app-style-switcher.js')}}"></script>
    <script src="{{ asset('assets/admin/dist/js/sidebarmenu.js')}}"></script>
    <script src="{{ asset('assets/admin/dist/js/custom.js')}}"></script>
    <!--  current page js files -->
    <script src="{{ asset('assets/admin/dist/libs/owl.carousel/dist/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/admin/dist/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
    <script src="{{ asset('assets/admin/dist/js/dashboard.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
     $(document).ready(function() {
           $('.table').DataTable({
               searching: true,
               lengthChange: false,
               paging: true,
               info: false,

           });
       });   
   </script>
   