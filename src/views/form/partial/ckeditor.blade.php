<?php
$id = 'ck' . uniqid();
?>
@if ($showLabel && $showField && $options['wrapper'] !== false)
    <div {!! $options['wrapperAttrs']!!} >
        @endif

        @if ($showLabel && $options['label'] !== false && $options['label_show'])
            {!! Form::label($name, $options['label'], $options['label_attr']) !!}
        @endif

        <?php if (!isset($options['attr']['id'])) $options['attr']['id'] = $id; ?>
        @if ($showField)
            @if(isset($noEdit) and $noEdit === true)
                {!! $options['default_value'] !!}
            @else
                {!! Form::textarea($name, $options['default_value'], $options['attr']) !!}
            @endif
            @include('form-builder::form.partial.help_block')
        @endif


        @include('form-builder::form.partial.errors')
        @if ($showLabel && $showField && $options['wrapper'] !== false)
    </div>
@endif
@if(empty($noEdit))
    <script type="text/javascript">
        (function () {
            var waitCKEDITOR = setInterval(function () {
                if (window.CKEDITOR) {
                    clearInterval(waitCKEDITOR);
                    CKEDITOR.replace({{$options['attr']['id']}}, {!! isset($options['config']) ? json_encode($options['config']) : '{}' !!});
                }
            }, 100)
        })();
    </script>
@section('scripts')

@endsection
@endif
