@if (session('success') || session('error'))
<div id="flash-messages" style="position:fixed;top:20px;right:20px;z-index:9999;min-width:300px;max-width:420px;">

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow" role="alert"
        style="border-left:4px solid #28a745;border-radius:8px;padding:14px 16px;">
        <span style="font-size:1.3rem;margin-right:10px;">&#10003;</span>
        <div style="flex:1;font-size:0.95rem;">{{ session('success') }}</div>
        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center shadow" role="alert"
        style="border-left:4px solid #dc3545;border-radius:8px;padding:14px 16px;">
        <span style="font-size:1.3rem;margin-right:10px;">&#9888;</span>
        <div style="flex:1;font-size:0.95rem;">{{ session('error') }}</div>
        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

</div>
<script>
    setTimeout(function () {
        document.querySelectorAll('#flash-messages .alert').forEach(function (el) {
            el.classList.remove('show');
            setTimeout(function () { el.remove(); }, 300);
        });
    }, 4000);
</script>
@endif
