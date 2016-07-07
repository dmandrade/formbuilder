@if($options['attr']['type'] == 'submit')
    <?php $options['label'] .= ' <i class="m-icon-swapright m-icon-white"></i>'; ?>
@endif
{!! Html::buttonWithIcon($options['label'], $options['attr']) !!}
