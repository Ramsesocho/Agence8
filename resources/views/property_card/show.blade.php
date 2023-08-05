@extends('base')


@section('title', $property->title)



@section('content')

<div class="container mt-4">

        <div class="row">
            
                <div class="col-8">

                    <div id="carouselExampleIndicators" class="carousel slide" style="max-width: 800px;">
                            <div class="carousel-inner">
                                @foreach ($property->pictures as $k => $picture)
                                    <div class="carousel-item {{ $k === 0 ? 'active' : '' }}">
                                        <img src="{{ $picture-> getImageUrl() }}" class="d-block w-100" alt="...">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                    </div>

                </div>

            <div class="col-4">

                 <h1>{{ $property->title }}</h1>
                 <h2>{{ $property->rooms }} pièces - {{ $property->surface }} m²</h2>
    
                 <div class="text-primary fw-bold" style="font-size: 4rem;">

                     {{$property->price}} dhs

                 </div>

                        <hr>

                <div class="mt-4">
                     <h4>Interessé par ce bien</h4>

                     @include('shared.flash')

                     <form action="{{ route('property.contact', $property) }}"  method="post" class="vstack gap-3">

                          @csrf

                        <div class="row">
                                @include('shared.input', ['class'=>'col','label'=>'Prénom','name'=>'firstname'])
                                @include('shared.input', ['class'=>'col','label'=>'Nom','name'=>'lastname'])
                        </div>

                        <div class="row">
                                @include('shared.input', ['class'=>'col','label'=>'Téléphone','name'=>'phone'])
                                @include('shared.input', ['type'=>'email','class'=>'col','label'=>'Email','name'=>'email'])
                        </div>

                        @include('shared.input', ['type'=>'textarea','class'=>'col','label'=>'Votre message','name'=>'message'])

                        <div>
                            <button class="btn btn-primary">Contacter-Nous</button>
                        </div>

                     </form>

                 </div>
             </div>
   
        </div>


        <div class="mt-4">
            <p>{!! nl2br($property->description) !!}</p>
        </div>

        <div class="row">
            <div class="col-8">
                <h2>Caractéristique</h2>
                <table class="table table-striped">
                    <tr>
                        <td> Surface habitable </td>
                        <td> {{$property->surface}} m² </td>
                    </tr>
                    <tr>
                        <td> Pièces </td>
                        <td> {{$property->rooms}} </td>
                    </tr>
                    <tr>
                        <td> Nombre de Chambres </td>
                        <td> {{$property->bedrooms}} </td>
                    </tr>
                    <tr>
                        <td> Etage </td>
                        <td> {{$property->floor ?: 'Rez de chaussé'}} </td>
                    </tr>
                    <tr>
                        <td> Localisation </td>
                        <td> 
                             {{ $property->address }}
                             {{ $property->city }}  -  {{ $property->postal_code }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <h2>Spécificités</h2>
                <ul class="list-group">

                    @foreach ($property->options as $option)
                        <li class="list-group-item">{{$option->name}}</li>
                    @endforeach

                </ul>
            </div>
        </div>
@endsection