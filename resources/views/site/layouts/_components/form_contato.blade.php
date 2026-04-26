{{ $slot }}    

<form action={{ route('site.contato') }} method="post">
    @csrf
    <input name="nome" value="{{ old('nome') }}" type="text" placeholder="Nome" class="{{ $classe }}">
    @if($errors->has('nome'))
        {{ $errors->first('nome') }}
    @endif
    <br>
    <input name="telefone" value="{{ old('telefone') }}" type="text" placeholder="Telefone" class="{{ $classe }}">
    @if($errors->has('telefone'))
        {{ $errors->first('telefone') }}
    @endif
    <br>
    <input name="email" value="{{ old('email') }}" type="text" placeholder="E-mail" class="{{ $classe }}">
    @if($errors->has('email'))
        {{ $errors->first('email') }}
    @endif
    <br>
    <select name="motivo_contatos_id" class="{{ $classe }}">
        <option value="">Qual o motivo do contato?</option>

        @foreach ($motivo_contatos as $key => $motivo_contato )
            <option value="{{ $motivo_contato->id }} {{ old('motivo_contatos_id') == $motivo_contato->id ?'selected' : '' }}">{{ $motivo_contato->motivo_contato }}</option>
        @endforeach
    </select>
    @if($errors->has('motivo_contatos_id'))
        {{ $errors->first('motivo_contatos_id') }}
    @endif
    <br>
    <textarea name="mensagem" class="{{ $classe }}" style="text-align: left;"> @if(old('mensagem') != '') {{ old('mensagem') }} @else Preencha aqui a sua mensagem @endif
    </textarea>
    @if($errors->has('mensagem'))
        {{ $errors->first('mensagem') }}
    @endif
    <br>
    <button type="submit" class="{{ $classe }}">ENVIAR</button>
</form>

@if($errors->any())
    <div style="position: fixed; top: 0; left: 0; width: 100%; background: red; z-index: 9999;">
        <ul>
            @foreach($errors->all() as $error)
                <li style="color: white;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif