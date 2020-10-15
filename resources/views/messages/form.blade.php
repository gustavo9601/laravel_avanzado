<form action="{{isset($message) ? route('messages.update', $message->id) :route('messages.store')}}" method="POST">
    @csrf

    @isset($message)
        @method('PUT')
    @endisset

    <div class="form-group">
        <label for="text"> Mensaje </label>
        <textarea type="text" class="form-control" name="text" id="text">{{ $message->text ?? '' }}</textarea>
        {{--Laravel reemplazar el primer error encontrado para el campo name, en :message--}}
        {!! $errors->first('text', '<span class="error">:message</span>') !!}
    </div>
    <button type="submit" class="btn btn-block btn-xs btn-primary">{{$btnText}}</button>

</form>
