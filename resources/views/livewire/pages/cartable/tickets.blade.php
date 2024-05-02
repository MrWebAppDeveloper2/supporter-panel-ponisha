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
                            <a href="#" wire:click="open({{ $ticket }})">
                                {{ \Illuminate\Support\Str::words($ticket->title, 3) }}
                                @if($ticket->status == \App\Enums\Ticket\TicketStatus::WAITING->value)
                                    <small class="badge text-white bg-danger p-1">جدید</small>
                                @endif
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
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if($ticket->status == \App\Enums\Ticket\TicketStatus::WAITING->value)
                                    <div class="dropdown-item">
                                        <a wire:click="accept({{ $ticket }})" class="dropdown-item" href="#"><i class="bx bx-message-dots me-1"></i>پذیرش
                                            تیکت</a>
                                    </div>
                                    @endif
                                    @can('update', $ticket)
                                        <a class="dropdown-item" href="#"><i class="bx bx-message-dots me-1"
                                            wire:click="closeTicket({{ $ticket }})"
                                            wire:confirm="ایا از بستن این تیکت مطمئن هستید ؟"></i>بستن تیکت
                                        </a>
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
