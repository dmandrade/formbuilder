@if ($showLabel && $showField && $options['wrapper'] !== false)
    <div {!! $options['wrapperAttrs'] !!} >
        @endif

        @if ($showLabel && $options['label'] !== false && $options['label_show'])
            {!! Form::label($name, $options['label'], $options['label_attr']) !!}
        @endif

        @if ($showField)
            <?php $emptyVal = $options['empty_value'] ? ['' => $options['empty_value']] : null; ?>
            @if(isset($noEdit) and $noEdit === true)
                {!! (isset($options['choices']) and isset($options['choices'][$options['selected']]))?$options['choices'][$options['selected']]:'' !!}
            @else
                {!! Form::select($name, (array)$emptyVal + $options['choices'], (array)$options['selected'], $options['attr'])!!}
            @endif
            @include('form-builder::form.partial.help_block')
        @endif

        @include('form-builder::form.partial.errors')
        @if ($showLabel && $showField && $options['wrapper'] !== false)
    </div>
@endif
