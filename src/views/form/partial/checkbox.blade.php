@if(isset($noEdit) and $noEdit === true)
    @if ($showLabel && $showField && !$options['is_child'] && $options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!} >
            @endif
                @if ($showLabel)
                    {!! $options['label'].': ' !!}
                @endif
                <span class="label label-{!! $options['checked']?'success':'danger' !!} ">{!! \Dmandrade\FormBuilder\Helpers\StaticLabel::yesNo($options['checked']) !!} </span>
            @if ($showLabel && $showField && !$options['is_child'])
        </div>
    @endif
@else
    @if ($showLabel && $showField && !$options['is_child'] && $options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!} >
                @endif
                @if ($showField)
                    {!! Form::checkbox($name, $options['default_value'], $options['checked'], $options['attr']) !!}
                    @include('form-builder::form.partial.help_block')
                @endif

                @if ($showLabel && $options['label'] !== false && $options['label_show'])
                    @if ($options['is_child'])
                        <label {!! $options['labelAttrs'] !!} >{!! $options['label'] !!} </label>
                    @else
                        {!! Form::label($name, $options['label'], $options['label_attr']) !!}
                    @endif
                @endif

                @include('form-builder::form.partial.errors')

                @if ($showLabel && $showField && $options['wrapper'] !== false)
        </div>
    @endif
@endif

