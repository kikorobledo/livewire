@extends('layouts.base')

@section('content')
<section class="text-blueGray-700 ">

    <div class="items-center px-5 py-12 lg:px-20">

        <div class="mx-auto mb-5">
            <img src="/img/icono.png" class="mx-auto h-28 w-auto" alt="Inout Logo">
        </div>

        <div>
            {{ $slot }}

        </div>

    </div>

</section>

@endsection

