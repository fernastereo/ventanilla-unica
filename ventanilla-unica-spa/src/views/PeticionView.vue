<script setup>
  import { ref, onMounted, reactive } from 'vue'
  import axios from 'axios';
  
  const apiUrl = import.meta.env.VITE_APP_API_URL;
  const webUrl = import.meta.env.VITE_APP_WEB_URL;
  const tipopeticions = ref([]);
  const errorResult = ref(false);
  const showResult = ref(false);

  const form = reactive({
    nombre: null,
    email: null,
    telefono: null,
    tipoPeticionId: null,
    mensaje: null,
    // archivo: null
  });

  onMounted(async () => {
    const {data} = await axios.get(apiUrl + '/api/tipopeticions');
    tipopeticions.value = data;
  });

  const handleSubmit = async (e) => {
    await axios.get(apiUrl + '/sanctum/csrf-cookie');
    
    const result = await axios.post(apiUrl + '/api/peticions', form, {});
    
    showResult.value = result.data.radicado;
    errorResult.value = result.data.error;
    console.log(result.data);
  }
</script>

<template>
  <div class="container">
    <div class="row justify-content-center">
      <h2 class="text-center">Curaduría Urbana 2 de Valledupar</h2>
      <h3 class="text-center">Arq. Arianna Zuleta Oñate</h3>
      <h4 class="text-center mb-2">Servicio de Ventanilla Unica de Recepción de Solicitudes</h4>
      <div class="col-md-10">
        <div v-if="showResult" class="alert" v-bind:class="{ 'alert-danger': errorResult, 'alert-success': !errorResult }" role="alert">
          {{ errorResult ? 'Error al enviar la solicitud' : 'Solicitud enviada con exito' }}. Su radicado es: {{ showResult }}
        </div>
        <div class="card">
          <form @submit.prevent="handleSubmit">
            <div class="card-header d-flex justify-content-between">
              <h5>Nueva Solicitud</h5>
              <a :href="webUrl" class="btn btn-success btn-sm">Regresar</a>
            </div>
            <div class="card-body">
              <div class="form-row col-md-12">
                <label for="inputName" class="form-control-sm">Nombre</label>
                <input type="text" class="form-control form-control-sm" id="inputName" v-model="form.nombre" aria-describedby="nameHelp">
              </div>
              <div class="form-row col-md-12">
                <label for="inputEmail" class="form-control-sm">Email</label>
                <input type="email" class="form-control form-control-sm" id="inputEmail" v-model="form.email" aria-describedby="emailHelp">
              </div>
              <div class="form-row col-md-12">
                <label for="inputTelefono" class="form-control-sm">Teléfono</label>
                <input type="Telefono" class="form-control form-control-sm" id="inputTelefono" v-model="form.telefono" aria-describedby="emailHelp">
              </div>
              <div class="form-row col-md-12">
                <label for="inputTipoServicio" class="form-control-sm">Tipo de Solicitud</label>
                <select class="form-select form-select-sm" id="inputTipoServicio" v-model="form.tipoPeticionId" aria-label="">
                  <option selected>-- Seleccione el Servicio Deseado --</option>
                  <option v-for="tipo in tipopeticions" :key="tipo.id" :value="tipo.id">{{ tipo.descripcion }}</option>
                </select>
              </div>
              <div class="form-row col-md-12 mb-3">
                <label for="inputMensaje" class="form-control-sm">Mensaje</label>
                <textarea class="form-control form-control-sm" rows="5" id="inputMensaje" v-model="form.mensaje"></textarea>
              </div>
              <div class="form-row col-md-12">
                <label for="inputArchivo" class="form-control-sm">Adjuntar Archivo:</label>
                <input class="form-control form-control-sm" type="file" id="inputArchivo">
              </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
              <button type="submit" class="btn btn-primary btn-sm">Enviar Solicitud</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>