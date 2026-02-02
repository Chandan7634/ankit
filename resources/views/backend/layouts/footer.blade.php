   <!-- ========== Footer Start ========== -->
   <footer class="footer">
       <div class="container-fluid">
           <div class="row">
               <div class="col-12 text-center">
                   Developed By <iconify-icon icon="iconamoon:heart-duotone"
                       class="fs-18 align-middle text-danger"></iconify-icon> <a href="tel:7634049585"
                       class="fw-bold footer-text" target="_blank">Chandan</a>
               </div>
           </div>
       </div>
   </footer>
   </div>
   </div>
   <script src="{{ asset('assets/js/vendor.js') }}"></script>
   <script src="{{ asset('assets/js/app.js') }}"></script>
   <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
   {{-- <script src="{{ asset('assets/vendor/jsvectormap/js/jsvectormap.min.js') }}"></script> --}}
   {{-- <script src="{{ asset('assets/vendor/jsvectormap/maps/world-merc.js') }}"></script> --}}
   {{-- <script src="{{ asset('assets/vendor/jsvectormap/maps/world.js') }}"></script> --}}
   {{-- <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script> --}}

   {{-- old  --}}
   <script src="{{ asset('assets/old/vendor/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('assets/old/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script> --}}
   <script src="{{ asset('assets/old/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
   <script src="{{ asset('assets/old/js/sb-admin-2.min.js') }}"></script>

   <script src="{{ asset('assets/old/vendor/chart.js/Chart.min.js') }}"></script>

   @stack('scripts')
