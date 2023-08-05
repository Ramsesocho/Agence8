@extends('base')



@section('content')
    
<div class="bg-light p-5 mb-5 text-center">
  
<div class="container">
    <h1>Agence8 </h1>
</div>

</div>

<div class="container">
    <h2>Nos derniers biens</h2>
    <div class="row">

        @foreach ($properties as $property)
            
        <div class="col">
                @include('property_card.card')
        </div>

        @endforeach

    </div>
</div>

@endsection