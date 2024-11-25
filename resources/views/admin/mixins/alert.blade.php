@props(['type', 'message', 'time' => 4000])

@if($message)
<div class="alert alert-{{ $type }}" 
     show-alert
     data-time="{{ $time }}">

    {{ $message }}
    <span close-alert>x</span>
</div>
@endif
