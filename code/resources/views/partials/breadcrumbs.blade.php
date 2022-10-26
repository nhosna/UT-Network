@if (count($breadcrumbs))

    <ol class="breadcrumb" style="font-size: 18px;background-color: rgb(255, 255, 255);">
        @foreach ($breadcrumbs as $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item  " style="  word-break:break-word;"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item active  " style="word-break:break-word;">{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ol>

@endif
