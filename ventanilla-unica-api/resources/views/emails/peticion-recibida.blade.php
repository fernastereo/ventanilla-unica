Se ha recibido una Solicitud de: {{ $peticion->nombre }} <a href="mailto:{{ $peticion->email }}">{{ $peticion->email }}</a>, a traves de la Ventanilla Unica Web de la Curaduría Urbana N° 2 de Valledupar.
<br>
<br>
Numero de Radicado: VU-CU2VA-{{ str_pad($peticion->radicado + 1, 4, '0', STR_PAD_LEFT) . "-$peticion->vigencia" }}
<br>
<br>
Tipo de Solicitud: {{ $peticion->tipopeticion->descripcion }}<br>
<br>
Solicitud:
{{ $peticion->mensaje }}<br>