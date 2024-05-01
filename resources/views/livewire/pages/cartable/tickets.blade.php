<div class="card">
    <div class="card-header">
        <h5>تیکت ها</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive text-nowrap overflow-visible">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="d-none d-xl-table-cell">#</th>
                    <th>عنوان</th>
                    <th class="d-none d-sm-table-cell d-xl-none">وضعیت</th>
                    <th>تاریخ</th>
                    <th>عمل ها</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($tickets as $ticket)
                    <tr wire:key="{{ $ticket->id }}">
                        <td class="d-none d-xl-table-cell">{{ $loop->iteration }}</td>
                        <td class="underline">
                            <a href="{{ route('ticket.show', $ticket) }}">
                                {{ \Illuminate\Support\Str::words($ticket->title, 4) }}
                            </a>
                        </td>
                        <td class="d-none d-sm-table-cell d-xl-none">
                            <x-ticket-status :status="$ticket->status"/>
                        </td>
                        <td>
                            <small>{{ \Morilog\Jalali\Jalalian::forge($ticket->created_at)->format('H:i Y/m/d') }}</small>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @can('update', $ticket)
                                        <button class="btn btn-outline-warning btn-sm"
                                                wire:click="closeTicket({{ $ticket }})"
                                                wire:confirm="ایا از بستن این تیکت مطمئن هستید ؟">بستن تیکت
                                        </button>
                                    @else
                                        <p class="p-3 my-0">
                                            در حال حاضر عملی در دسترس نیست !
                                        </p>
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
</div>
