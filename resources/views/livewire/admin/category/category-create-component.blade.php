<div class="row">
    <div class="col-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary" wire:navigate>All Categories</a>
            </div>
            <div class="card-body">
                <form wire:submit="save">
                    <div class="mb-3">
                        <label for="title" class="form-label required">Title</label>
                        <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            placeholder="Title"
                            wire:model="title"
                        >
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="parent_id" class="form-label required">Parent Category</label>
                        <select
                            id="parent_id"
                            class="custom-select @error('parent_id') is-invalid @enderror"
                            wire:model="parent_id"
                        >
                            <option value="0" wire:key="0">Root category</option>
                            {!! \App\Helpers\Category\Category::getMenu('incs.menu-select-tpl') !!}
                        </select>
                        @error('parent_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary d-flex">
                            Save

                            <div class="ml-2" wire:loading wire:target="save">
                                <div class="spinner-grow spinner-grow-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
