@if (session()->has('success') || session()->has('error') || session()->has('info') || session()->has('warning'))
    <script>
        $(document).ready(function() {
            @if (session()->has('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if (session()->has('error'))
                toastr.error("{{ session('error') }}");
            @endif

            @if (session()->has('info'))
                toastr.info("{{ session('info') }}");
            @endif

            @if (session()->has('warning'))
                toastr.warning("{{ session('warning') }}");
            @endif
        });
    </script>
@endif
