@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{route('ad.search')}}" onsubmit="search(event)"
                id="searchFomr">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="words">
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </form>
                <div id="results">
                @foreach($ads as $ad)
                <div class="card mb-3" style="width: 100%;">
                    <img src="https://via.placeholder.com/350x250" class="card-img-top" alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title">{{$ad->title}}</h5>
                        <small>{{ Carbon\Carbon::parse($ad->created_at)->diffForHumans()}}</small>
                        <p class="card-text text-info">{{$ad->localisation}}</p>
                        <p class="card-text">{{$ad->description}}</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        @endforeach
                </div>
            {{$ads->links()}}
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script>
        function search(event){
            event.preventDefault()
            const words = document.querySelector('#words').value
            const url = document.querySelector('#searchForm').getAttribute('action')
            axios.post(`${url}`, {
                words: words,
                })
                .then(function (response) {
                    const ads = reponse.data.ads
                    let results = document.querySelector('#results')
                    results.innerHTML = ''
                    for(let i = 0; i < ads.lenght; i++) {
                        let card = document.createElement('div')
                        let cardBody = document.createElement('div')
                        cardBody.classList.add('card-body')
                        card.classList.add('card', 'mb-3')
                        let title = document.createElement('h5')
                        title.classList.add('cart-title')
                        title.innerHTML = ads[i].title
                        let description = document.createElement('p')
                        description.classList.add('card-text')
                        description.innerHTML = ads[i].description
                        cardBody.appendChild(title)
                        cardBody.appendChild(description)
                        car.appendChild(cardBody)
                        results.appendChild(card)
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
    </script>
@endsection