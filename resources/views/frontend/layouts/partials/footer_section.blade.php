@if(count($section_data['section_content']) > 0)
<div class="footer-menu ml-0 col-md col-sm-12">
    <h2 class="widget-title">{{ $section_data['section_title'] }}</h2>
    <ul class="list-inline p-0 px-2">
        @for ($i = 0; $i < 4; $i++)
            @if (isset($section_data['section_content'][$i]))
                @php
                    $item = $section_data['section_content'][$i];
                @endphp
                <li><a class="text-light" href="{{ $item['link'] }}"><i class="fas fa-caret-right"></i><span class="mx-2">{{ \Illuminate\Support\Str::limit($item['label'],40) }}</span></a></li>
            @endif
        @endfor
    </ul>
</div>
@endif