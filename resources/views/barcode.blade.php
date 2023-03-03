<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <style>
        .svg {
            transform: rotate(270deg);
            margin-top: -90px;
            margin-left: -50px;
        }
    </style>

    <script type="text/javascript">
        function imprimir() {
            if (window.print) {
                window.print();
            } else {
                alert("La función de impresión no esta soportada por su navegador.");
            }
        }
    </script>

</head>

<body onload="imprimir();">
    <svg class="svg">
        {!! DNS1D::getBarcodeSVG($codigo, 'C39',0.9,50,'black',true) !!}
    </svg>
</body>

</html>