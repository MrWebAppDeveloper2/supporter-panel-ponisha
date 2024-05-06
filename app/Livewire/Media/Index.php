<?php

namespace App\Livewire\Media;

use App\Models\Media;
use App\Repositories\MediaRepository;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    private MediaRepository $mediaRepository;

    public function download(Media $media)
    {
        $this->authorize('download', $media);

        return Storage::disk(config('media.disk'))->download($media->path);
    }

    public function __construct()
    {
        $this->mediaRepository = app()->make(MediaRepository::class);
    }

    public function mount()
    {
        $this->authorize('viewAny', Media::class);
    }

    public function render()
    {
        return view('livewire.pages.media.index')
            ->with('medias', $this->mediaRepository->paginate());
    }
}
