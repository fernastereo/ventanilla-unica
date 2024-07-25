Hola {{ $peticion->nombre }}. 
<br>
<br>
Su solicitud ha sido recibida por la Curaduría Urbana N° 2 de Valledupar! Nuestro equipo de profesionales pronto se pondrá en contacto con usted.
<br>
<br>
Su numero de Radicado: VU-CU2VA-{{ str_pad($peticion->radicado + 1, 5, '0', STR_PAD_LEFT) . "-$peticion->vigencia" }}
<br>
<br>
Gracias por elegirnos
<br>
<br>
Curaduría Urbana N° 2 de Valledupar