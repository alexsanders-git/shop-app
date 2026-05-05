<option
    value="{{ $item['id'] }}"
    class="{{ $item['parent_id'] == 0 ? 'font-weight-bold' : '' }}"
    wire:key="{{ $item['id'] }}"
>
    {!! $tab .  $item['title'] !!}
</option>

@if(isset($item['children']))
    {!! \App\Helpers\Category\Category::getHtml($item['children'], "&nbsp;$tab - ") !!}
@endif
