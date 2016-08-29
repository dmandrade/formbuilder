<?php
$id = uniqid();
?>
@if ($showLabel && $showField && $options['wrapper'] !== false)
    <div {!! $options['wrapperAttrs']!!} >
        @endif

        @if ($showLabel && $options['label'] !== false && $options['label_show'])
            {!! Form::label($name, $options['label'], $options['label_attr']) !!}
        @endif

        <?php $options['attr']['class'] .= ' ' . $id; ?>
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
@section('scripts')
    <script type="text/javascript" src='{{ asset(config('form-builder.tinymce_path')) }}'></script>
    <script type="text/javascript">
        $(document).ready(function () {
            tinymce.init({
                selector: "#{{$name}}",
                plugins: [
                    "{!!!empty($options['moxiemanager'])?'moxiemanager':''!!}  advlist autolink lists link image charmap hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                toolbar2: "media | forecolor backcolor emoticons",
                image_advtab: true,
                relative_urls: false,
                body_class: "content",
                templates: []
            });
        });

    </script>
@stop
@endif
