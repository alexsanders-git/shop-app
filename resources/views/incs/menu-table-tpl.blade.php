<tr wire:key="{{ $item['id'] }}">
    <td>{{ $item['id'] }}</td>
    <td>
        <span style="padding-left: {{ strlen($tab) * 3 }}px">{{ $tab .  $item['title'] }}</span>
    </td>
    <td>
        <a href="{{ route('category', $item['slug']) }}" class="btn btn-info" target="_blank">
            <i class="fa-solid fa-eye"></i>
        </a>
        <a href="{{ route('admin.categories.edit', $item['id']) }}" class="btn btn-warning" wire:navigate>
            <i class="fa-solid fa-pencil"></i>
        </a>
        <button
            class="btn btn-danger"
            wire:click="deleteCategory({{ $item['id'] }})"
            wire:confirm="Are you sure?"
            wire:loading.attr="disabled"
        >
            <i class="fa-solid fa-trash"></i>
        </button>
    </td>
</tr>

@if(isset($item['children']))
    {!! \App\Helpers\Category\Category::getHtml($item['children'], "$tab - ") !!}
@endif
