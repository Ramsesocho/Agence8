@extends('admin.admin')


@section('title', $property->exists ? "Editer un bien" : "créer un bien")


@section('content')

    <h1>@yield('title')</h1>

    <form class="vstack gap-2" action="{{ route($property->exists ? 'admin.property.update' : 'admin.property.store', $property) }}"
     method="post" enctype="multipart/form-data">

        @csrf
        @method($property->exists ? 'put' : 'post')

            <div class="row">

                 <div class="col vstack gap-2" style="flex: 100">
                     <div class="row">
                        @include('shared.input', ['class'=>'col','name'=>'title', 'value'=>$property->title])
                        <div class="col row">
                             @include('shared.input', ['class'=>'col','name'=>'surface', 'value'=>$property->surface])
                            @include('shared.input', ['class'=>'col','label'=>'prix','name'=>'price', 'value'=>$property->price])
                        </div>
                    </div>     

                         @include('shared.input', ['type'=>'textarea', 'class'=>'col','name'=>'description', 'value'=>$property->description])
                     <div class="row">
                        @include('shared.input', ['class'=>'col','label'=>'Pieces','name'=>'rooms', 'value'=>$property->rooms])
                         @include('shared.input', ['class'=>'col','label'=>'Chambres','name'=>'bedrooms', 'value'=>$property->bedrooms])
                         @include('shared.input', ['class'=>'col','label'=>'Etage','name'=>'floor', 'value'=>$property->floor])
                    </div>

                    <div class="row">
                         @include('shared.input', ['class'=>'col','label'=>'Adresse','name'=>'address', 'value'=>$property->address])
                         @include('shared.input', ['class'=>'col','label'=>'Ville','name'=>'city', 'value'=>$property->city])
                         @include('shared.input', ['class'=>'col','label'=>'Code Postal','name'=>'postal_code', 'value'=>$property->postal_code])
                     </div>

                         @include('shared.select', ['name'=>'options','label'=>'Options', 'value'=>$property->options()->pluck('id'), 'multiple'=>true])
                         @include('shared.checkbox', ['label'=>'Vendu','name'=>'sold', 'value'=>$property->sold, 'options'=>$options])

                         <div class="d-flex gap-2 w-100">
                             <button class="btn btn-primary">
                                  @if($property->exists)
                                   Modifier
                                    @else
                                        Créer
                                    @endif
                                </button>
                                <button class="btn btn-primary">
                                <a href="{{ route('admin.property.index')}}" class="btn btn-primary">Annuler</a>
                                </button>
                            </div>
                 </div>

                 <div class="col vstack gap-4" style="flex: 25">

                    @foreach($property->pictures as $picture)

                        <div id="picture{{ $picture->id }}" class="position-relative">
                            <img src="{{ $picture->getImageUrl() }}" alt=""  class="w-100 d-block">
                            <button type="button" class="btn btn-danger position-absolute bottom-0 w-100 start-0" hx-delete="{{ route('admin.picture.destroy', $picture) }}" hx-swap="delete" hx-target="#picture{{ $picture->id }}">
                               
                                <span class="htmx-indicator spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Supprimer
                            </button>
                        </div>
                       
                    @endforeach
                        @include('shared.upload', ['label'=>'Images','name'=>'pictures', 'multiple'=>true])
                 </div>

            </div>

    </form>

@endsection