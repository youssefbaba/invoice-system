<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fatoura</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('font/css/all.css') }}">
    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_skellet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/showclient1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/addclient.css') }}">
    <link rel="stylesheet" href="{{ asset('css/voir_client1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/showfacture1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/facture_voirplus.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/avoir.css') }}">
</head>
<body >
        <div class="sidebar">
            @yield('content')
        </div>
        <div class="content">
            <div class="content_header">
                <button id="clicka">☰</button>
                @yield('header_content')
            </div>
            <div class="content_inside">
                @yield('contenu_inside')
            </div>
        </div>
    <!-- Scripts -->
    <script>

    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#clicka').on('click',function(){
                $('.sidebar').toggleClass("show");
                $(this).toggleClass("move");
            });
        });
    </script>
    @yield('script')
    @yield('select2')
    <script src="{{ asset('js/showclient.js') }}">
    <script src="{{ asset('js/showdevi.js') }}">
    <script src="{{ asset('js/showfacture.js') }}">
    <script src="{{ asset('js/showfacturepaye.js') }}">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>


    @if (Session::get('status_add_client'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_add_client')}}",
                    icon:"success",
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_update_client'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_update_client')}}",
                    icon: 'info',
                    confirmButtonColor: '#3FC3EE',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_delete_client'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_delete_client')}}",
                    icon: 'error',
                    confirmButtonColor: '#F27474',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_add_devis'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_add_devis')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_update_devis'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_update_devis')}}",
                    icon: 'info',
                    confirmButtonColor: '#3FC3EE',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_destroy_devis'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_destroy_devis')}}",
                    icon: 'error',
                    confirmButtonColor: '#F27474',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>

    @endif
    @if (Session::get('status_finalise_devi'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_finalise_devi')}}",
                    icon: 'info',
                    confirmButtonColor: '#3FC3EE',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_annuler_refuse'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_annuler_refuse')}}",
                    icon: 'info',
                    confirmButtonColor: '#3FC3EE',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_annuler_signature'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_annuler_signature')}}",
                    icon: 'info',
                    confirmButtonColor: '#3FC3EE',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_signe_devis'))
    <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_signe_devis')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_refuse_devis'))
    <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_refuse_devis')}}",
                    icon: 'error',
                    confirmButtonColor: '#F27474',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif

    @if (Session::get('status_delete_devi'))
    <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_delete_devi')}}",
                    icon: 'error',
                    confirmButtonColor: '#F27474',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_duplicate_devi'))
    <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_duplicate_devi')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_duplicate_devi_en_facture'))
    <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_duplicate_devi_en_facture')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_add_facture'))
    <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_add_facture')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_finalise_facture'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_finalise_facture')}}",
                    icon: 'info',
                    confirmButtonColor: '#3FC3EE',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_update_facture'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_update_facture')}}",
                    icon: 'info',
                    confirmButtonColor: '#3FC3EE',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_destroy_facture'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_destroy_facture')}}",
                    icon: 'error',
                    confirmButtonColor: '#F27474',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_dupliquer_facture'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_dupliquer_facture')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_duplicate_facture_en_devi'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_duplicate_facture_en_devi')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_delete_facture'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_delete_facture')}}",
                    icon: 'error',
                    confirmButtonColor: '#F27474',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_paye_facture'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_paye_facture')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_annuler_paiement'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_annuler_paiement')}}",
                    icon: 'error',
                    confirmButtonColor: '#F27474',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_add_avoir'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_add_avoir')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_finalise_avoir'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_finalise_avoir')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_update_avoir'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_update_avoir')}}",
                    icon: 'info',
                    confirmButtonColor: '#3FC3EE',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_destroy_avoir'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_destroy_avoir')}}",
                    icon: 'error',
                    confirmButtonColor: '#F27474',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_dupliquer_avoir_en_facture'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_dupliquer_avoir_en_facture')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_delete_avoir'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_delete_avoir')}}",
                    icon: 'error',
                    confirmButtonColor: '#F27474',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_remboursé_devis'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_remboursé_devis')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_annuler_remboursement_avoir'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_annuler_remboursement_avoir')}}",
                    icon: 'error',
                    confirmButtonColor: '#F27474',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_update_coordonnée'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_update_coordonnée')}}",
                    icon: 'info',
                    confirmButtonColor: '#3FC3EE',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_update_mot_passe'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_update_mot_passe')}}",
                    icon: 'info',
                    confirmButtonColor: '#3FC3EE',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('error'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('error')}}",
                    icon: 'error',
                    confirmButtonColor: '#F27474',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_add_utilisateur'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_add_utilisateur')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_updated_role_user'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_updated_role_user')}}",
                    icon: 'info',
                    confirmButtonColor: '#3FC3EE',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_delete_utilisateur'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_delete_utilisateur')}}",
                    icon: 'error',
                    confirmButtonColor: '#F27474',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_duplicate_avoir_en_devi'))
        <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_duplicate_avoir_en_devi')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif

    @if (Session::get('status_add_utilisateur'))
            <script type="text/javascript">
                swal({
                    title:"{{Session::get('status_add_utilisateur')}}",
                    icon:"{{Session::get('statuscode')}}",
                    button:'OK',
                });
                location.reload();
            </script>
    @endif
    @if (Session::get('status_updated_role_user'))
            <script type="text/javascript">
                swal({
                    title:"{{Session::get('status_updated_role_user')}}",
                    icon:"{{Session::get('statuscode')}}",
                    button:'OK',
                });
                location.reload();
            </script>
    @endif
    @if (Session::get('status_delete_utilisateur'))
            <script type="text/javascript">
                swal({
                    title:"{{Session::get('status_delete_utilisateur')}}",
                    icon:"{{Session::get('statuscode')}}",
                    button:'OK',
                });
                location.reload();
            </script>
    @endif

    @if (Session::get('status_send_mail_facture'))
    <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_send_mail_facture')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_send_mail_devis'))
    <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_send_mail_devis')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_send_mail_avoir'))
    <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_send_mail_avoir')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_send_mail_feedback'))
    <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_send_mail_feedback')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif
    @if (Session::get('status_finish_information_user'))
    <script type="text/javascript">
            Swal.fire({
                    title:"{{Session::get('status_finish_information_user')}}",
                    icon: 'success',
                    confirmButtonColor: '#A5DC86',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if(result){
                        location.reload();
                    }})
        </script>
    @endif































</body>
</html>
