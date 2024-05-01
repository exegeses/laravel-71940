{{--
    $slot se utiliza para el contenido interno del componente
    $attributes se utiliza para inyectar los atributos de HTML
    Todos los atributos de HTML
    i.e.: href, id, class, target
--}}
<a {{ $attributes }}
             target="_blank"
             class="bg-teal-500 text-gray-800
                    hover:bg-teal-400
                    p-2 m-4 rounded-lg">
        {{ $slot }}
</a>
