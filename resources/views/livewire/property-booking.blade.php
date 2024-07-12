<div>
    <style>
        .padding {
            padding-bottom: 3rem !important;
        }
    </style>
    <div class="padding">

    </div>
    
    <section class="ftco-section goto-here">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                    <span class="subheading">What we offer</span>
                    <h2 class="mb-2">Exclusive Offer For You</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($list_data as $row)
                    <div class="col-md-4 d-flex ftco-animate" >
                        <div class="blog-entry align-self-stretch" style="display: flex;">
                            <img alt="image" src="{{ Storage::url($row->image) }}" class="block-20 rounded"
                                style="width: 300px; height:200px; object-fit:cover">
                            <div class="text p-4  text-center">
                                <h3 class="heading"><a href="#"></a>{{ $row->property_name }}</h3>
                                <div class="meta mb-2">
                                    <div><a href="#">{{ $row->property_type }}</a></div>|
                                    <div><a href="#">{{ $row->price }}</a></div>|
                                    <div><a href="#">{{ $row->location }}</a></div>
                                    <div><a href="#">{{ $row->description }}</a></div>

                                </div>
                                <a type="button" href="/bookyourproperty/{{ $row->id }}"
                                    class="btn btn-primary">Book</a>
                            </div>
                        </div>
                    </div>
                @endforeach
    </section>
</div>
