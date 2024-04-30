<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="my-0">تیکت ها</h4>

        @can('create', \App\Models\Ticket::class)
            <a href="{{ route('ticket.create') }}" wire:navigate class="btn btn-primary">
                <i class='bx bxs-plus-circle' style="padding-left: 10px"></i>
                <span>تیکت جدید</span>
            </a>
        @endcan
    </div>
    <div class="card-body">
        <x-alert/>
        <div class="table-responsive text-nowrap overflow-visible">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>وضعیت</th>
                    <th>تاریخ</th>
                    <th>عمل‌ها</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($tickets as $ticket)
                    <tr wire:key="{{ $ticket->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ticket->title }}</td>
                        <td>
                            <x-ticket-status :status="$ticket->status"/>
                        </td>
                        <td>{{ \Morilog\Jalali\Jalalian::forge($ticket->created_at)->format('%D') }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @can('view', $ticket)
                                        <a class="dropdown-item" href="{{ route('ticket.permission', $ticket) }}"
                                           wire:navigate><i class='bx bx-universal-access me-1'></i></i>دسترسی ها</a>

                                        <a class="dropdown-item" href="{{ route('ticket.users', $ticket) }}"
                                           wire:navigate><i class='bx bxs-user-detail me-1'></i></i>کاربران</a>
                                    @endcan

                                    @can('update', $ticket)
                                        <a class="dropdown-item" href="{{ route('ticket.edit', $ticket)}}"
                                           wire:navigate><i class="bx bx-edit-alt me-1"></i> ویرایش</a>
                                    @endcan

                                    @can('delete', $ticket)
                                        <button class="dropdown-item" wire:click="delete({{ $ticket }})"><i
                                                class="bx bx-trash me-1"></i> حذف
                                        </button>
                                    @endcan
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $tickets->links('vendor.livewire.bootstrap') }}
</div>

