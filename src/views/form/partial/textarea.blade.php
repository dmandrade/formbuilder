@if($type == 'hidden')
    {!! Form::input($type, $name, $options['default_value'], $options['attr']) !!}
@else
    @if ($showLabel && $showField && $options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!} >
            @endif

            @if ($showLabel && $options['label'] !== false && $options['label_show'])
                {!! Form::label($name, $options['label'], $options['label_attr']) !!}
            @endif

            @if ($showField)
                @if(isset($noEdit) and $noEdit === true)
                    {!!$options['default_value'] !!}
                @else
                    {!! Form::textarea($name, $options['default_value'], $options['attr']) !!}
                @endif
                @include('form-builder::form.partial.help_block')
            @endif

            @include('form-builder::form.partial.errors')
            @if ($showLabel && $showField && $options['wrapper'] !== false)
        </div>
    @endif
@endif
