@extends('layouts.frontend')

@section('content')
    <section id="Banner">
        <div class="row">
            <div class="col-md-6 pt-5 pt-lg-5 d-flex justify-content-center flex-column order-lg-1 order-2">
                <h1>
                    Continous Learning and Keep Up to Date with
                    <strong class="text-primary">Inixindo Bandung</strong>
                </h1>
                <div class="my-3">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati voluptate tempore iste
                    exercitationem laborum deserunt. Ut obcaecati odit doloremque sunt? Eaque tempora fugit pariatur ad
                    voluptates a dolorem, porro ea.
                </div>
                <div class="mt-4">
                    <a href="#" class="btn btn-outline-primary">Get Started</a>
                </div>
            </div>
            {{-- hero section --}}
            <div class="col-md-6 pt-5 order-lg-2 order-1">
                <img src="{{ asset('assets/images/banner.svg') }}" alt="banner bank" class="img-fluid animation">
            </div>
        </div>
    </section>
@endsection
