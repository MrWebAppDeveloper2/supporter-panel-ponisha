<div></div>
{{--<div class="card">--}}
{{--    <div class="card-header d-flex justify-content-between align-items-center">--}}
{{--        <h5>وظایف</h5>--}}
{{--        <a href="" class="btn btn-primary">ایجاد وظیفه</a>--}}
{{--    </div>--}}
{{--    <div class="card-body">--}}
{{--        <div class="table-responsive text-nowrap overflow-visible">--}}
{{--            <table class="table table-striped">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>#</th>--}}
{{--                    <th>عنوان</th>--}}
{{--                    <th>وضعیت</th>--}}
{{--                    <th>تاریخ</th>--}}
{{--                    <th>عمل‌ها</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody class="table-border-bottom-0">--}}
{{--                @foreach($tickets as $ticket)--}}
{{--                    <tr wire:key="{{ $ticket->id }}">--}}
{{--                        <td>{{ $loop->iteration }}</td>--}}
{{--                        <td class="underline">--}}
{{--                            <a href="{{ route('ticket.show', $ticket) }}">{{ $ticket->title }}</a>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <x-ticket-status :status="$ticket->status"/>--}}
{{--                        </td>--}}
{{--                        <td>{{ \Morilog\Jalali\Jalalian::forge($ticket->created_at)->format('%D') }}</td>--}}
{{--                        <td>--}}
{{--                            @can('update', $ticket)--}}
{{--                                <button class="btn btn-outline-warning btn-sm"--}}
{{--                                        wire:click="closeTicket({{ $ticket }})"--}}
{{--                                        wire:confirm="ایا از بستن این تیکت مطمئن هستید ؟">بستن تیکت--}}
{{--                                </button>--}}
{{--                            @endcan--}}
{{--                            @can('view', $ticket)--}}
{{--                                <button class="btn btn-outline-primary btn-sm">گفتگو</button>--}}
{{--                            @endcan--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</div>--}}
