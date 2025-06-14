<!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
@if (session()->has($type))
<div class="toast bg-info fade show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header"><strong class="mr-auto">Toast Title</strong><small>Subtitle</small><button
            data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close"><span
                aria-hidden="true">×</span></button></div>
    <div class="toast-body">{{session($type)}}</div>
</div>
@endif
