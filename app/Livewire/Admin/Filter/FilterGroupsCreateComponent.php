<?php

namespace App\Livewire\Admin\Filter;

use App\Models\FilterGroup;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Create Filter Group')]
class FilterGroupsCreateComponent extends Component
{

    public string $title;

    public function save()
    {
        $validated = $this->validate([
            'title' => 'required|max:255',
        ]);

        FilterGroup::query()->create($validated);

        session()->flash('success', 'Filter Group created successfully.');
        $this->redirectRoute('admin.filter-groups.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.filter.filter-groups-create-component');
    }
}
