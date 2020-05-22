<!doctype html>
<html lang="es">
    <body>
        <h1>¡Gracias por estar interezado en nuestros servicios, {{$nombre}}!</h1>
        <p>El estado de tu orden es 
    @switch($status)
    @case(1)
        <strong> Pago pendiente cuando pagues llegara el certificado</strong>
    @break

    @case(2)
        <strong> Pago Aceptado se adjunto ademas un PDF con el certificado</strong>
    @break

    @case(3)
        <strong>Pago rechazado! algo sucede con tu cuenta</strong>
    @break

    @case(4)
        <strong>Pago Anulado! Se anulo el pago </strong>
    @break

    @default
        <strong>Algo salio mal</strong>
    @endswitch
        </p>
    </body>
</html>
</html>