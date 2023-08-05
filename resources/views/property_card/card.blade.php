<div class="card" style="width: 18rem;">

@if ($property->getPicture())
  <img src=" {{ $property->getPicture()->getImageUrl() }}" alt="" class="w-100">

@else
  <img src="/empty.jpg" alt="" class="w-100">
@endif
  <div class="card-body">
    <h5 class="card-title"><a href="{{ route('property.show', ['slug'=>$property->getSlug(), 'property' => $property]) }}">{{ $property->title }}</a></h5>
    <p class="card-text">{{ $property->surface }}m² -- {{ $property->city }} ({{ $property->postal_code }})</p>

    <div class="text-primary fw-bold" style="font-size: 1.4rem;">

        {{$property->price}} dhs

    </div>
    <a href="{{ route('property.show', ['slug'=>$property->getSlug(), 'property' => $property]) }}" class="btn btn-primary">Informations</a>
  </div>
</div>