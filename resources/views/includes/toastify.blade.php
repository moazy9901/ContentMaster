@php
    $toastMessage = session('success') ?? session('fail') ?? session('error') ?? null;
    $toastColor = session('success') ? 'green' : (session('fail') || session('error') ? 'red' : 'blue');
@endphp

@if($toastMessage)
<script>
  document.addEventListener("DOMContentLoaded", function () {
    Toastify({
      text: @json($toastMessage),
      duration: 4000,
      close: true,
      gravity: "top",
      position: "right",
      stopOnFocus: true,
      style: {
        background: "{{ $toastColor }}",
        borderRadius: "8px",
        fontSize: "15px",
      },
      offset: {
        x: 20,
        y: 20
      },
    }).showToast();
  });
</script>
@endif
