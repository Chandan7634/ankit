 <head>
     <meta charset="utf-8" />
     <title>Dashboard | Larkon - Responsive Admin Dashboard Template</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

     <!-- App css (Require in all Page) -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />



     <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

     <!-- Theme Config js (Require in all Page) -->
     <script src="{{ asset('assets/js/config.js') }}"></script>
     <style>
         .form-group {
             margin-bottom: 15px;
         }

         .dataTables_wrapper.no-footer {
             position: relative;
             padding-top: 10px;
         }

         .dataTables_length {
             position: absolute;
             top: 0px;
         }

         .dataTables_wrapper.no-footer input,
         select {
             border: none;
             padding-left: 40px;
             padding-right: 15px;
             background-color: var(--bs-topbar-search-bg);
             -webkit-box-shadow: none;
             box-shadow: none;
             height: 35px;
             display: block;
             width: 100%;
             padding: 0.5rem 1rem;
             font-size: 0.875rem;
             font-weight: 400;
             line-height: 1.5;
             color: var(--bs-body-color);
             -webkit-appearance: none;
             -moz-appearance: none;
             appearance: none;
             background-color: var(--bs-secondary-bg);
             background-clip: padding-box;
             border: var(--bs-border-width) solid var(--bs-input-border-color);
             border-radius: var(--bs-border-radius-sm);
         }
     </style>
     @stack('styles')
 </head>
