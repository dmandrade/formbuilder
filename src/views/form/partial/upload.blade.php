<?php $id = uniqid(); ?>
@if ($showLabel && $showField  && $options['wrapper'] !== false)
    <div {!! $options['wrapperAttrs'] !!} >
        @endif

        @if ($showLabel && $options['label'] !== false && $options['label_show'])
            {!! Form::label($name, $options['label'], $options['label_attr']) !!}
        @endif

            @if ($showField)
                @if(isset($noEdit) and $noEdit === true)
                    {!!$options['default_value'] !!}
                @else
                    <div class="input-group">
                        <?php $options['attr']['id'] = $id; ?>
                        {!! Form::file($name, $options['default_value'], $options['attr']) !!}
                    </div>
                @endif
            @endif

            @include('form-builder::form.partial.errors')

        @if ($showLabel && $showField  && $options['wrapper'] !== false)
    </div>
@endif

