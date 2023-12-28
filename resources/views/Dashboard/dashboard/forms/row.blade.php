    @if($row['inputType'] == "file")
    <div class="row">
        <input type="hidden" name="input_type[]" id="input_type" value="{{ $row['inputType'] }}">
        <div class="col-3">
            <input type="text" class="form-control" placeholder="Name" name="fieldName[]"
                value="{{ $row['name'] }}" required id="name">
        </div>
        <div class="col-3">
            <input type="number" class="form-control" placeholder="File Size" name="fileSize[]"
                min="0" max="9999999" value="{{ $row['fileSize'] }}" required id="fileSize">
        </div>
        <div class="col-3">
            <label for="fileTypes">File Types:</label>
            <select id="fileTypes" name="fileTypes[]" class="custom-select select2"
                multiple="multiple">
                <option value="png">PNG</option>
                <option value="pdf">PDF</option>
                <option value="jpg">JPG</option>
                <option value="xls">XLS</option>
            </select>
        </div>
        @if ($row['multiFile'])
        <div class="col-3">
            <input type="number" class="form-control" placeholder="Files Number" min="0"
                max="9999999" name="filesNum[]" value="{{ $row['filesNum'] }}" required
                id="filesNum">
        </div>
        @endif
        <div class="col-3">
            <label class="form-check-label">Multiple Files</label>
            <input class="form-check-input" type="checkbox" name="multiFile[]" @if(
                $row['multiFile'] )
            checked
            @endif id="multiFile">
        </div>

        <div class="col-3">
            <label class="form-check-label">Required</label>
            <input class="form-check-input" type="checkbox" name="required[]" @if(
                $row['required'] )
            checked
            @endif id="required">
        </div>
        <div class="col-3">
            <a onclick="removeTr(this)" class="btn btn-danger">Remove</a>
        </div>
    </div>
    @elseif($row['inputType'] == "email")
    <div class="row">
        <input type="hidden" name="input_type[]" id="input_type" value="{{ $row['inputType'] }}">
        <div class="col-3">
            <input type="text" class="form-control" placeholder="Name" name="fieldName[]"
                value="{{ $row['name'] }}" required id="name">
        </div>
        <div class="col-3">
            <input type="text" class="form-control" placeholder="Placeholder"
                name="placeholder[]" value="{{ $row['placeholder'] }}" required
                id="placeholderid">
        </div>
        <div class="col-3">
            <label class="form-check-label">Required</label>
            <input class="form-check-input" type="checkbox" name="required[]" @if(
                $row['required'] )
            checked
            @endif id="required">
        </div>
        <div class="col-3">
            <a onclick="removeTr(this)" class="btn btn-danger">Remove</a>
        </div>
    </div>
    @else
    <div class="row">
        <input type="hidden" name="input_type[]" id="input_type" value="{{ $row['inputType'] }}">
        <div class="col-3">
            <input type="text" class="form-control" placeholder="Name" name="fieldName[]"
                value="{{ $row['name'] }}" required id="name">
        </div>
        <div class="col-3">
            <input type="text" class="form-control" placeholder="Placeholder"
                name="placeholder[]" value="{{ $row['placeholder'] }}" required
                id="placeholderid">
        </div>
        <div class="col-3">
            <input type="number" class="form-control" placeholder="Length" min="0" max="9999999"
                name="length[]" value="{{ $row['length'] }}" required id="lengthid">
        </div>
        <div class="col-3">
            <label class="form-check-label">Required</label>
            <input class="form-check-input" type="checkbox" name="required[]" @if(
                $row['required'] )
            checked
            @endif id="required">
        </div>
        <div class="col-3">
            <a onclick="removeTr(this)" class="btn btn-danger">Remove</a>
        </div>
    </div>
    @endif
