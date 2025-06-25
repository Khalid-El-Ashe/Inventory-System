@if ($errors->any())
<div class="position-fixed top-50 start-50 translate-middle p-3" style="z-index: 11">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white">
            <strong class="me-auto fw-boald">خطأ في الإدخال</strong>
            <button type="button" class="btn-close btn-close-white fw-boald" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
        <div class="toast-body bg-white text-dark">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function () {
            var toastEl = document.getElementById('liveToast');
            if (toastEl) {
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        });
</script>
@endif