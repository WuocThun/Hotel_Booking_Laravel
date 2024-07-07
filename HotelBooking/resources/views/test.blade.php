@foreach($hotels as $hotels)
    <div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
        <div class="d-block services-wrap text-center">
            <div class="img"
                 style="background-image: url( {{asset('assets/images/'.$hotels->image.'')}} );"></div>
            <div class="media-body py-4 px-3">
                <h3 class="heading">{{$hotels->name}}</h3>
                <p> {{$hotels->description}} </p>
                <p>Location: {{$hotels->location}}.</p>
                <p><a href="rooms.html" class="btn btn-primary">View rooms</a></p>
            </div>
        </div>
    </div>

@endforeach
