@extends('index')
@section('section')
<h2>Liste de tous les livres</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Résumé</th>
            <th>Prix</th>
            <th>Catégorie</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    
    @foreach ($livres as $livre)
    <tr>
        <td>{{ $livre->titre }}</td>
        <td>{{ $livre->resume }}</td>
        <td>{{ $livre->prix }}</td>
        <td>{{ $livre->libelle }}</td>
        <td>
            <a href="modification?id={{$livre->id}}" class="btn btn-danger">Modifier</a>
        </td>
        <td>
            <a href="supprimer?id={{$livre->id}}" class="btn btn-warning">Supprimer</a>
        </td>
    </tr>
    @endforeach
</table>
@stop