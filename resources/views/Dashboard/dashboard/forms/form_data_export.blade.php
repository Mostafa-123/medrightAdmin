<table id="formData" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            @if (isset($form)&&isset($form->fields))
            @foreach ($form->fields as $field)
            @if ($field['input_type']=='password')
            @else
            <th>{{$field['name']}}</th>
            @endif
            @endforeach
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($form->units as $unit)
        <tr>
            @foreach ($form->fields as $field)
            @php
                $formRequest = $unit->formRequests->where('field_id', $field['id'])->first();
            @endphp
            @if ($field['input_type']=='password')
            @else
            <td>
                @if ($formRequest)
                @if($field['input_type']=='file')
                @if($field['multi_file'])
                @php
                    $fiels=json_decode($formRequest->value,true)
                @endphp
                @foreach ($fiels as $file)
                <a href="{{$file}}">{{ $file }}</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @endforeach
                @else
                <a href="{{$formRequest->value}}">{{ $formRequest->value }}</a>
                @endif
                @elseif($field['input_type']=='selector'&&$formRequest->value==0)
                Any Of Choices
                @else
                {{ $formRequest->value }}
                @endif
                @endif
            </td>
            @endif

            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
