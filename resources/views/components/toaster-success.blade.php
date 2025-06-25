@if (session('success'))
<div class="position-fixed top-0 start-0 translate-middle p-3" style="z-index: 11">
    <div id="successToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white">
            <strong class="me-auto fw-bold">نجاح</strong>
            <button type="button" class="btn-close btn-close-white fw-bold" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
        <div class="toast-body bg-white text-dark">
            {{ session('success') }}
        </div>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function () {
            var toastEl = document.getElementById('successToast');
            if (toastEl) {
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        });
</script>
@endif