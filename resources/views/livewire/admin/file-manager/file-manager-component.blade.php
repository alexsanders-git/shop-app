<div class="mb-2">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fileManager">
        File Manager
    </button>

    <!-- Modal -->
    <div class="modal fade" id="fileManager" tabindex="-1" aria-labelledby="fileManagerLabel" aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="update-loading" wire:loading>
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <div class="modal-header">
                    <h5 class="modal-title" id="fileManagerLabel">File Manager</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="path" class="form-label">Image</label>

                        <div class="input-group">
                            <input
                                type="file"
                                class="form-control @error('path') is-invalid @enderror"
                                id="path"
                                wire:model="path"
                            >
                            <div class="input-group-append">
                                <button class="btn btn-primary" wire:click="saveMedia">Save</button>
                            </div>
                        </div>

                        @error('path')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror

                        <div wire:loading wire:target="path">
                            <span class="text-success">Uploading...</span>
                        </div>

                        @if(!$errors->has('path') && $path && $path->isPreviewable())
                            <p class="text-danger">Click on the photo to delete it</p>
                            <img
                                src="{{ $path->temporaryUrl() }}"
                                alt="preview"
                                width="100px"
                                wire:click="removeUpload('path', '{{ $path->getFilename() }}')"
                            >
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <tbody>
                            @foreach($media as $item)
                                <tr wire:key="{{ $item->id }}">
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <img src="{{ asset($item->path) }}" height="50">
                                    </td>
                                    <td>{{ $item->path }}</td>
                                    <td>
                                        <div x-data="{ input: '{{ asset($item->path) }}', showMsg: false }">
                                            <div class="overflow-hidden">
                                                <button
                                                    class="btn btn-warning"
                                                    title="Copy URL"
                                                    @click="navigator.clipboard.writeText(input), showMsg = true, setTimeout(() => showMsg = false, 1000)"
                                                >
                                                    <i class="fa-solid fa-copy"></i>
                                                </button>

                                                <p
                                                    class="media-copied"
                                                    style="display: none"
                                                    x-show="showMsg"
                                                    @click.away="showMsg = false"
                                                >
                                                    Copied to Clipboard
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $media->links(data: ['scrollTo' => false]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
