
<?php $id = uniqid(); ?>
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
                <?php $options['attr']['class'] .= ' datepicker'; ?>
                @if (! empty($options['range']))
                    <?php
                        $options['attr']['class'] .= ' input-sm'; unset($options['attr']['id']);
                        $startAttr = $endAttr = $options['attr'];
                        $startAttr['name'] .= '[start]';
                        $endAttr['name'] .= '[end]';

                        $startValue = $endValue = $options['default_value'];
                        if(is_array($options['default_value'])){
                            $startValue = $options['default_value']['start'];
                            $endValue = $options['default_value']['end'];
                        }
                    ?>
                    <div id="{{ $id }}" class="input-daterange input-group">
                        {!! Form::input($type, $name, $startValue, $startAttr) !!}
                        <span class="input-group-addon">{{ trans('form-builder::form.to') }}</span>
                        {!! Form::input($type, $name, $endValue, $endAttr) !!}
                    </div>
                @else
                    {!! Form::input($type, $name, $options['default_value'], $options['attr']) !!}
                @endif
            @endif
            @include('form-builder::form.partial.help_block')
        @endif

        @include('form-builder::form.partial.errors')
        @if ($showLabel && $showField && $options['wrapper'] !== false)
    </div>
@endif

@section('scripts')
    <script type="text/javascript">
        jQuery(document).ready(function () {
            @if (! empty($options['range']))
                jQuery('#{!! $id !!} .input-sm')
            @else
                jQuery('#{!! $name !!}')
            @endif.datepicker(jQuery.extend({
                format: '{!! $options['format'] !!}',
                @if (! empty($options['todayHighlight']))
                todayHighlight: true,
                @endif
                        @if (! empty($options['autoclose']))
                autoclose: true,
                @endif
                        @if (! empty($options['language']))
                language: '{!! $options['language'] !!}',
                @endif
                orientation: "left"
            }, {!! json_encode($options['config']) !!})).on('changeDate', function (selected) {
                var startDate = new Date(selected.date.valueOf());
                startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));

                if (jQuery(this).attr('name') == '{{ $options['attr']['name'] . '[end]' }}') {
                    jQuery('input[name="{{ $options['attr']['name'] . '[start]' }}"]').datepicker('setEndDate', startDate);
                } else {
                    jQuery('input[name="{{ $options['attr']['name'] . '[end]' }}"]').datepicker('setStartDate', startDate);
                }
            });
        });
    </script>
@append

