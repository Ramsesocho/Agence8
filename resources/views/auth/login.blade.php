@extends('base')


@section('title', 'Se connecter')


@section('content')

    <div class="mt-4 container">
        <h1>@yield('title')</h1>

        @include('shared.flash')

        <span class="border border-white">


        
        </span>

        <form method="post" action="{{ route('login') }}" class="vstack gap-3">
                @csrf
                <div class="mb-4">
                    <label for="exampleFormControlInput1" class="form-label">Addresse Email </label>
                    <input type="email" class="form-control border-success" id="exampleFormControlInput1" placeholder="name@example.com" name='email'>
                </div>
                <div class="mb-4">
                    <label for="exampleFormControlInput1" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control border-success" id="exampleFormControlInput1" placeholder="**********" name='password'>
                </div>
              <!--  @include('shared.input', ['type'=>'email','class'=>'col','label'=>'Email address','name'=>'email']) -->
             <!--   @include('shared.input', ['type'=>'password','class'=>'col','label'=>'Mot de passe','name'=>'password'])-->

                <div>
                    <button class="btn btn-primary">Se connecter</button>
                </div>

        </form>
    </div>

    <hr>

<div class="d-flex justify-content-center">
  <div class="spinner-border" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>






@endsection