@php
    $title = $title ?? 'Quick Help';
    $text = $text ?? null;
    $tips = $tips ?? [];
@endphp

<aside class="admin-help-panel">
    <h2 class="admin-help-title">{{ $title }}</h2>
    @if($text)
        <p class="admin-help-text">{{ $text }}</p>
    @endif
    @if(!empty($tips))
        <ul class="mt-3 list-disc space-y-1 pl-4 text-xs leading-5 text-slate-600">
            @foreach($tips as $tip)
                <li>{{ $tip }}</li>
            @endforeach
        </ul>
    @endif
</aside>
