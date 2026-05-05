<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use App\Models\FilterGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Edit Category')]
class CategoryEditComponent extends Component
{

    public Category $category;
    public $id;
    public string $title;
    public int $parent_id = 0;
    public array $selectedCategoryFilters = [];

    public function mount(Category $category): void
    {
        $this->category = $category;
        $this->id = $category->id;
        $this->title = $category->title;
        $this->parent_id = $category->parent_id;
        $this->selectedCategoryFilters = DB::table('category_filters')
            ->where('category_id', '=', $this->category->id)
            ->pluck('filter_group_id')
            ->toArray();
    }

    public function save(): void
    {
        $validated = $this->validate([
            'title' => 'required|max:255',
            'parent_id' => 'required|integer',
            'selectedCategoryFilters.*' => 'numeric',
        ]);

        try {
            DB::beginTransaction();

            $this->category->update($validated);

            // Remove all filters group
            DB::table('category_filters')
                ->where('category_id', '=', $this->category->id)
                ->delete();

            // Save new value for filters group
            if (!empty($validated['selectedCategoryFilters'])) {
                $data = [];

                foreach ($validated['selectedCategoryFilters'] as $category_filter) {
                    $data[] = [
                        'category_id' => $this->category->id,
                        'filter_group_id' => $category_filter,
                    ];
                }

                DB::table('category_filters')->insert($data);
            }

            DB::commit();

            cache()->forget('categories_html');
            session()->flash('success', 'Category created successfully.');
            $this->redirectRoute('admin.categories.index', navigate: true);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error updating category')");
        }
    }

    public function render()
    {
        $filter_groups = FilterGroup::all();

        return view('livewire.admin.category.category-edit-component', [
            'filter_groups' => $filter_groups,
        ]);
    }
}
