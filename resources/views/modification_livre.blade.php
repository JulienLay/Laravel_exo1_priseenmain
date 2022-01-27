@extends('index')
@section('section')
    <form action="modifier" method="get">
        <div class="mb-3">
            <input type="text" class="form-control" id="" name="id" ariadescribedby="" hidden value="{{$livre->id}}">
        </div>
        <div class="mb-3">
            <label for="titre" class="form-label">Titre du livre</label>
            <input type="text" class="form-control" id="titre" name="titre" ariadescribedby="titre" value="{{$livre->titre}}">
        </div>
        <div class="mb-3">
            <label for="resume" class="form-label">Resumé</label>
            <input type="text" class="form-control" id="resume" name="resume" value="{{$livre->resume}}">
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix du livre</label>
            <input type="text" class="form-control" id="prix" name="prix" value="{{$livre->prix}}">
        </div>
        <div class="mb-3">
            <label for="categorie" class="form-label">Catégorie</label>
            <select type="text" class="form-control" id="categorie_id" name="categorie_id">
            @foreach ($categories as $categorie)
            @if ($categorie->id == $livre->categorie_id) 
                <option value="{{$categorie->id}}" selected>{{$categorie->libelle}}</option>
            @else
                <option value="{{$categorie->id}}">{{$categorie->libelle}}</option>
            @endif
            @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
@stop
