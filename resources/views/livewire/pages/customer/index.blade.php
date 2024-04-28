<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="my-0">مشتریان</h4>

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
                    <th>نوع</th>
                    <th>تاریخ ثبت نام</th>
                    <th>عمل‌ها</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($customers as $customer)
                    <tr wire:key="{{ $customer->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->type }}</td>
                        <td>{{ \Morilog\Jalali\Jalalian::forge('last sunday')->format('%D') }}</td>
                        <td>
                            <a href="{{ route('customer.show', $customer) }}" class="btn btn-outline-primary btn-sm">مشاهده جزئیات</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

