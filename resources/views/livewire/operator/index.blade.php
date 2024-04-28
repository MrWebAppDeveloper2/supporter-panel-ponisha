<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="my-0">اوپراتور ها</h4>

{{--        <div>--}}
{{--            <a href="{{ route('workgroup.add.user', $workgroup) }}" class="btn btn-outline-primary" wire:navigate>اضافه کردن عضو</a>--}}
{{--        </div>--}}
    </div>
    <div class="card-body">
        <x-alert/>
        <div class="table-responsive text-nowrap overflow-visible">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>ایمیل</th>
                    <th>عمل‌ها</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($users as $user)
                    <tr wire:key="{{ $user->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

