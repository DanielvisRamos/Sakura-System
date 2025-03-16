<script>
    // Mostrar alerta de éxito
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            confirmButtonText: 'Aceptar'
        });
    @endif

    // Mostrar alerta de error
    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            confirmButtonText: 'Aceptar'
        });
    @endif

    // Mostrar alerta de advertencia
    @if (session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Advertencia',
            text: '{{ session('warning') }}',
            confirmButtonText: 'Aceptar'
        });
    @endif

    // Mostrar alerta de información
    @if (session('info'))
        Swal.fire({
            icon: 'info',
            title: 'Información',
            text: '{{ session('info') }}',
            confirmButtonText: 'Aceptar'
        });
    @endif
</script>