@if ($showLabel && $showField && $options['wrapper'] !== false)
    <div {!! $options['wrapperAttrs'] !!} >
        @endif
        @if ($showLabel && $options['label'] !== false && $options['label_show'])
            {!! Form::label($name, $options['label'], $options['label_attr']) !!}
        @endif

        <div class="col-md-4">
            @if ($showField)
                <<?= $options['tag'] ?> <?= $options['elemAttrs'] ?>><?= $options['value'] ?></<?= $options['tag'] ?>>
        @endif

        @if(isset($options['help']))
            <span class="help-block">{!!$options['help']!!} </span>
        @endif

    </div>
    @if ($showLabel && $showField && !$options['is_child'])
    </div>
@endif
