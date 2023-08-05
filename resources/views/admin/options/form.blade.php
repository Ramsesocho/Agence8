@extends('admin.admin')


@section('title', $option->exists ? "Editer une option" : "créer une option")


@section('content')

    <h1>@yield('title')</h1>

    <form class="vstack gap-2" action="{{ route($option->exists ? 'admin.option.update' : 'admin.option.store', $option) }}" method="post">

        @csrf
        @method($option->exists ? 'put' : 'post')

            @include('shared.input', ['name'=>'name', 'label'=>'Nom', 'value' => $option->name])
            <div class="d-flex gap-2 w-100">
            <button class="btn btn-primary">
                @if($option->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
            <button class="btn btn-primary">
            <a href="{{ route('admin.option.index')}}" class="btn btn-primary">Annuler</a>
            </button>
        </div>

    </form>

@endsection