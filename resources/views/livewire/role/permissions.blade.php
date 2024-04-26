<div>
    <h4>دسترسی های نقش {{ $role->name }}</h4>
    <hr>
    <form action="" class="">
        <ul class="list-unstyled d-flex justify-content-center justify-content-around row">
            <li class="col-3 text-center">Model</li>

            @foreach(\App\Enums\Permission\BasicPermission::cases() as $permission)
                <li class="col-2 text-center">{{ $permission->value }}</li>
            @endforeach

            @php
                $models =  $models = glob(app_path('/Models') . DIRECTORY_SEPARATOR . '*.php');

                $rolePermissions = $role->permissions;
            @endphp

            @foreach($models as $model)
                <li class="col-3 mt-4 text-center">{{ __('model.'. pathinfo($model, PATHINFO_FILENAME))  }}</li>

                @foreach(\App\Enums\Permission\BasicPermission::cases() as $permission)
                    <li class="col-2 text-center">
                        <div class="form-check mt-3 d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1"
                                   @if($rolePermissions->where(['model' => "App\Models\\" . pathinfo($model, PATHINFO_BASENAME)]))
                                   checked
                                @endif>
                        </div>
                    </li>
                @endforeach
            @endforeach
        </ul>
    </form>
</div>
