<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="my-0">فروش</h4>
        <div>

        </div>
    </div>
    <div class="card-body">
        <x-alert/>
        <div class="table-responsive text-nowrap overflow-visible">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>مبلغ</th>
                    <th>شماره تماس</th>
                    <th>اوپراتور</th>
                    <th>تاریخ فروش</th>
                    <th>عمل‌ها</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($purchases as $purchase)
                    <tr wire:key="{{ $purchase->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $purchase->fullname }}</td>
                        <td>{{ number_format((int)$purchase->amount_paid) }} تومان</td>
                        <td>{{ $purchase->phone }}</td>
                        <td>{{ $purchase->creator->name }}</td>
                        <td>{{ \Morilog\Jalali\Jalalian::forge($purchase->sale_date)->format('%D') }}</td>
                        <td>
{{--                            @can('view', $purchase)--}}
{{--                                <a href="{{ route('purchase.show', $purchase) }}" class="btn btn-outline-primary btn-sm"--}}
{{--                                   wire:navigate>مشاهده جزئیات</a>--}}
{{--                            @endcan--}}
                            @can('delete', $purchase)
                                <button class="btn btn-outline-danger btn-sm" type="button"
                                        wire:click="delete({{ $purchase }})"
                                        wire:confirm="آیا از حذف این فروش مطمئن هستید ؟">حذف
                                </button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

