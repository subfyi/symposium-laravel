
<div class="form-group row">
    <label class="col-md-3 col-sm-3 col-xs-12"
           for="first-name">{{$isim}}
    </label>
    <div class="col-md-9 col-sm-9 col-xs-9">
        {{ Form::text($name, $value, array_merge(['class' => 'form-control col-md-7 col-xs-12'], $attributes)) }}
    </div>
</div>