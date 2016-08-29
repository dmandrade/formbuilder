<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        @foreach($options['tabs'] as $i => $tab)
            <li class="{{ $options['active'] == $i ? 'active' : '' }}">
                <a href="#tab_{{ $i }}" data-toggle="tab">{{ isset($tab['name']) ? $tab['name'] : '-' }}</a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content">
        @foreach($options['tabs'] as $i => $tab)
            <div class="tab-pane {{ $options['active'] == $i ? 'active' : '' }}" id="tab_{{ $i }}">
                @foreach($tab['fields'] as $field)
                    {!! $field->render() !!}
                @endforeach
            </div>
        @endforeach
    </div>
</div> {{-- end nav-tabs-custom --}}