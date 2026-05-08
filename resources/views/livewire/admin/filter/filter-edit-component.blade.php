<div class="row">
    <div class="col-12 mb-4 position-relative">
        <div class="update-loading" wire:loading wire:target="save">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('admin.filters.index') }}" class="btn btn-primary" wire:navigate>
                    All Filters
                </a>
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
                        <label for="filter_group_id" class="form-label required">Filter Group</label>
                        <select
                            id="filter_group_id"
                            class="custom-select @error('filter_group_id') is-invalid @enderror"
                            wire:model="filter_group_id"
                        >
                            <option value="0">Select filter group...</option>

                            @foreach($filter_groups as $filter_group)
                                <option value="{{ $filter_group->id }}" wire:key="{{ $filter_group->id }}">
                                    {{ $filter_group->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('filter_group_id')
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
