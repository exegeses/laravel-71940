<?php

    class Bar
    {
        private $x;
        public function __construct( $datoX )
        {
            $this->x = $datoX;
        }
        public function mosrtrar()
        {
            return 'atributo x: '.$this->x;
        }
    }

    function foo( int $numero, string $nombre ) : string
    {
        return 'nombre: '. $nombre;
    }
    // toma como parámetro un objeto de tipo Bar
    // type hinting
    function fooBar( Bar $bar )
    {
        echo $bar->mosrtrar();
    }


    echo foo( 10, 'marcos' );
    $b = new Bar( 'soy el dato X' );
    fooBar( $b );

