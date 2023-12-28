<div class="input-group input-group-lg">
    <div class="input-group-prepend col-12">
<div class="mb-4">
    <div class="input-group">
      <span class="input-group-text">
       {{$text}}
      </span>
      <input type="{{$type}}" @if ($type=="number")
      min="0"
      @endif class="form-control " id="{{$id}}" name="{{$name}}" placeholder="{{$placeholder}}" value="{{$value}}">
    </div>
  </div>

    </div>

