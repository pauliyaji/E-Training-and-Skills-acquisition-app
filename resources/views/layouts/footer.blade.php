@section('scripts')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('/js/demo/datatables-demo.js') }}"></script>

@endsection
