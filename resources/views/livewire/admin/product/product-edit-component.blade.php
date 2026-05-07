<div class="row">
    <div class="col-12 mb-4 position-relative">
        <div class="update-loading" wire:loading wire:target="save, category_id">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary" wire:navigate>All Products</a>
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
                        <label for="category_id" class="form-label required">Category</label>
                        <select
                            id="category_id"
                            class="custom-select @error('category_id') is-invalid @enderror"
                            wire:model.live="category_id"
                        >
                            <option>Select category</option>
                            {!! \App\Helpers\Category\Category::getMenu('incs.menu-select-tpl') !!}
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="row">
                        @foreach($this->filters as $key => $filter_group)
                            <div class="col-lg-3 col-md-6" wire:key="{{ $key }}">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="font-weight-bold text-primary m-0">
                                            {{ $filter_group[0]->title }}
                                        </h6>
                                    </div>

                                    <div class="card-body">
                                        @foreach($filter_group as $filter)
                                            <div wire:key="{{ $filter->filter_id }}">
                                                <input
                                                    type="checkbox"
                                                    id="filter-{{ $filter->filter_id }}"
                                                    value="{{ $filter->filter_id }}"
                                                    wire:model="selectedFilters"
                                                >
                                                <label for="filter-{{ $filter->filter_id }}" class="form-check-label">
                                                    {{ $filter->filter_title }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label required">Price</label>
                        <input
                            type="number"
                            class="form-control @error('price') is-invalid @enderror"
                            id="price"
                            placeholder="Price"
                            wire:model="price"
                        >
                        @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="old_price" class="form-label">Old Price</label>
                        <input
                            type="number"
                            class="form-control @error('old_price') is-invalid @enderror"
                            id="old_price"
                            placeholder="Old price"
                            wire:model="old_price"
                        >
                        @error('old_price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="is_hit" class="form-check-label">Is Hit</label>
                        <input
                            type="checkbox"
                            class="@error('is_hit') is-invalid @enderror"
                            id="is_hit"
                            wire:model="is_hit"
                        >
                        @error('is_hit')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="is_new" class="form-check-label">Is New</label>
                        <input
                            type="checkbox"
                            class="@error('is_new') is-invalid @enderror"
                            id="is_new"
                            wire:model="is_new"
                        >
                        @error('is_new')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <input
                            type="text"
                            class="form-control @error('excerpt') is-invalid @enderror"
                            id="excerpt"
                            placeholder="Excerpt"
                            wire:model="excerpt"
                        >
                        @error('excerpt')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="summernote" class="form-label required">Content</label>
                        <div wire:ignore>
                            <textarea
                                class="form-control @error('content') is-invalid @enderror"
                                id="summernote"
                                placeholder="Content"
                                rows="10"
                                wire:model="content"
                            ></textarea>
                        </div>
                        @error('content')
                        <div class="invalid-feedback text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        @if($photo)
                            <img src="{{ asset($photo) }}" alt="" height="50">
                        @else
                            <img src="{{ asset($product->getImage()) }}" alt="" height="50">
                        @endif
                        <input
                            type="file"
                            class="form-control @error('image') is-invalid @enderror"
                            id="image"
                            wire:model="image"
                        >
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <div wire:loading wire:target="image">
                            <span class="text-success">Uploading...</span>
                        </div>

                        @if(!$errors->has('image') && $image && $image->isPreviewable())
                            <p class="text-danger">Click on the photo to delete it</p>
                            <img
                                src="{{ $image->temporaryUrl() }}"
                                alt="preview"
                                width="100px"
                                wire:click="removeUpload('image', '{{ $image->getFilename() }}')"
                            >
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="gallery" class="form-label">Gallery</label>
                        @if($photos)
                            <div>
                                <p class="text-danger">Click on the photo to delete it</p>

                                @foreach($photos as $key => $item)
                                    <img
                                        src="{{ asset($item) }}"
                                        alt=""
                                        height="50"
                                        wire:key="{{ $key }}"
                                        wire:click="deleteGalleryItem({{ $key }})"
                                        wire:confirm="Are you sure?"
                                    >
                                @endforeach
                            </div>
                        @endif
                        <input
                            type="file"
                            class="form-control @error('gallery.*') is-invalid @enderror"
                            id="gallery"
                            multiple
                            wire:model="gallery"
                        >
                        @error('gallery.*')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <div wire:loading wire:target="gallery">
                            <span class="text-success">Uploading...</span>
                        </div>

                        @if($gallery)
                            <p class="text-danger">Click on the photo to delete it</p>
                            <div class="mt-2">
                                @foreach($gallery as $photo)
                                    @if($photo->isPreviewable())
                                        <img
                                            src="{{ $photo->temporaryUrl() }}"
                                            alt="preview"
                                            width="100px"
                                            wire:click="removeUpload('gallery', '{{ $photo->getFilename() }}')"
                                        >
                                    @else
                                        <span class="text-danger">Error...</span>
                                    @endif
                                @endforeach
                            </div>
                        @endif
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

@script
<script>
    $(function () {
        $('#summernote').summernote({
            callbacks: {
                onChange: function (contents, $editable) {
                    $wire.$set('content', contents, false)
                }
            },
            height: 300
        });
    })
</script>
@endscript
