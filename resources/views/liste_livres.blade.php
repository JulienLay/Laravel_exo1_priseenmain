@extends('index')
@section('section')
<h2>Liste de tous les livres</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Prix</th>
            <th>Résumé</th>
            <th>Catégorie</th>
        </tr>
    </thead>
    
    @foreach ($livres as $livre)
    <tr>
        <td>{{ $livre->titre }}</td>
        <td>{{ $livre->resume }}</td>
        <td>{{ $livre->prix }}</td>
        <td>{{ $livre->libelle }}</td>
    </tr>
    @endforeach
</table>
@stop