@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Novo Equipamento</h1>
    <form action="{{ route('equipamentos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="text" name="preco" id="preco" class="form-control">
        </div>
        <div class="mb-3">
            <label for="peso" class="form-label">Peso</label>
            <input type="number" name="peso" id="peso" class="form-control" step="0.1">
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
