<script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';

  const apiUrl = import.meta.env.VITE_APP_API_URL;
  const peticions = ref([]);

  onMounted(async () => {
    const {data} = await axios.get(apiUrl + '/peticions');
    peticions.value = data;
  });

</script>

<template>
  <div class="">
    <div class="">
      <table class="">
        <thead>
          <tr>
            <th scope="col">Radicado</th>
            <th scope="col">Fecha</th>
            <th scope="col">Tipo</th>
            <th scope="col">Nombre</th>
            <th scope="col">Telefono</th>
            <th scope="col">Estado</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="peticion in peticions" :key="peticion.id">
            <th scope="row">VU-CU2VA-{{ String(peticion.id).padStart(4, '0') }}-{{ peticion.vigencia }}</th>
            <td>{{ peticion.fecha_peticion }}</td>
            <td>{{ peticion.tipopeticion.descripcion }}</td>
            <td><a href="mailto:{{ peticion.email }}">{{ peticion.nombre }}</a></td>
            <td>{{ peticion.telefono }}</td>
            <td><span class="">Finalizado</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>