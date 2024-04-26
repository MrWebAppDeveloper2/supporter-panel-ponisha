<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="my-0">نقش ها</h4>

        <a href="{{ route('role.index') }}" class="btn btn-primary">
            <i class='bx bxs-plus-circle' style="padding-left: 10px"></i>
            <span>نقش جدید</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive text-nowrap overflow-visible">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>تعداد کاربران</th>
                    <th>عمل‌ها</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($roles as $role)
                    <tr wire:key="{{ $role->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->users()->count() }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#{{ $role->name }}-permissions"><i class='bx bx-universal-access me-1'></i></i>دسترسی ها</button>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> ویرایش</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> حذف</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- Permission Modal -->
                    <div class="modal fade" id="{{ $role->name }}-permissions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <livewire:role.permissions :$role :key="$role->id"/>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
        {{ $roles->links('vendor.livewire.bootstrap') }}
</div>

