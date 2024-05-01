@include('layouts.header')
    <main>
        <div class="bg-gray-800">
            <div class="relative isolate px-6 pt-14 lg:px-8">

                <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">

                    <div class="text-center">
                        <h1 class="text-4xl font-bold tracking-tightsm:text-6xl">Data to enrich your online business</h1>

                        curso: {{ $curso }}
                        <br>
                        fruta: {{ $fruta }}

                        <hr class="my-8">
                    @if( $numero < 100 )
                        es menor que 100
                    @else()
                        no es menor que 100
                    @endif

                        <hr class="my-8">
                    @foreach( $zeppelin as $integrante )
                        {{ $integrante }} <br>
                    @endforeach
                    </div>
                </div>

            </div>
        </div>
    </main>
@include('layouts.footer')
