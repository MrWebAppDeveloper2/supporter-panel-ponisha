<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="my-0">فایل ها</h4>
        @can('upload', \App\Models\Media::class)
            <div>
                <a href="{{ route('media.upload') }}" class="btn btn-primary">آپلود فایل جدید</a>
            </div>
        @endcan
    </div>
    <div class="card-body">
        <x-alert/>
        <div class="table-responsive text-nowrap overflow-visible">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    {{--                    <th>حجم</th>--}}
                    <th>عمل‌ها</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($medias as $media)
                    <tr wire:key="{{ $media->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $media->name }}</td>
                        {{--                        <td>--}}
                        {{--                        </td>--}}
                        <td>
                            @can('download', $media)
                                <button class="btn btn-sm btn-outline-primary">دانلود</button>
                            @endcan
                            @can('delete', $media)
                                <button class="btn btn-sm btn-outline-danger">حذف</button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $medias->links('vendor.livewire.bootstrap') }}
        </div>
    </div>
</div>

