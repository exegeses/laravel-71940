@include('layouts.header')

<main>
    <div class="mx-auto max-w-4xl py-12 px-8">

        <h1 class="text-2xl font-bold">Baja de una región</h1>

        <!-- formulario -->
        <div class="shadow-xl rounded-md max-w-3xl mb-72">
            <form action="/region/destroy" method="post">
            @csrf
                <div class="p-6">
                    <label for="nombre" class="block text-sm font-medium text-gray-400">
                        Nombre de la región
                    </label>
                    <div class="w-full mb-6 group">
                        <span type="text" name="nombre" id="nombre"
                               class="block py-2.5 px-0 w-full text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-teal-400 dark:border-gray-600 dark:focus:border-teal-500 focus:outline-none focus:ring-0 focus:border-teal-600">
                            {{ $region->nombre }}
                        </span>
                    </div>
                    <input type="hidden" name="idRegion"
                           value="{{ $region->idRegion }}">


                    <div class="flex justify-between">
                        <button type="submit" class="text-white bg-rose-500 hover:bg-rose-600 focus:ring-4 focus:outline-none focus:ring-rose-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-rose-500 dark:hover:bg-rose-600 dark:focus:ring-rose-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="float-left w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Eliminar región
                        </button>

                        <a href="/regiones" type="button" class="ml-4 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="float-left w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75L14.25 12m0 0l2.25 2.25M14.25 12l2.25-2.25M14.25 12L12 14.25m-2.58 4.92l-6.375-6.375a1.125 1.125 0 010-1.59L9.42 4.83c.211-.211.498-.33.796-.33H19.5a2.25 2.25 0 012.25 2.25v10.5a2.25 2.25 0 01-2.25 2.25h-9.284c-.298 0-.585-.119-.796-.33z" />
                            </svg>
                            Volver a panel de regiones
                        </a>
                    </div>

                </div>
            </form>
        </div>
        <!-- FIN formulario -->

    </div>
</main>

@include('layouts.footer')
