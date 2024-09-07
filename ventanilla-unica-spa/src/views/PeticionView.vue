<script setup>
  import { ref, onMounted, reactive } from 'vue'
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  
  const router = useRouter();
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
    archivo: null
  });

  onMounted(async () => {
    const {data} = await axios.get(apiUrl + '/api/tipopeticions');
    tipopeticions.value = data;
  });

  const handleSubmit = async (e) => {
    const result = await axios.post(apiUrl + '/api/peticions', form);
    
    showResult.value = result.data.radicado;
    errorResult.value = result.data.error;
    console.log(result.data);
  }

  const onLogout = async () => {
    await axios.post(apiUrl + '/logout');
    router.push({name: "login", params: {client_id: 1}});
  }
</script>

<template>
  <div class="">
    <div class="">
      <h2 class="">Curaduría Urbana 2 de Valledupar</h2>
      <h3 class="">Arq. Arianna Zuleta Oñate</h3>
      <h4 class="">Servicio de Ventanilla Unica de Recepción de Solicitudes</h4>
      <br/>
      <button class="" @click="onLogout">logout</button>
      <div class="">
        <div v-if="showResult" class="" v-bind:class="{ 'alert-danger': errorResult, 'alert-success': !errorResult }" role="alert">
          {{ errorResult ? 'Error al enviar la solicitud' : 'Solicitud enviada con exito' }}. Su radicado es: {{ showResult }}
        </div>
        <div class="">
          <form @submit.prevent="handleSubmit">
            <div class="">
              <h5>Nueva Solicitud</h5>
              <a :href="webUrl" class="">Regresar</a>
            </div>
            <div class="">
              <div class="">
                <label for="inputName" class="">Nombre</label>
                <input type="text" class="" id="inputName" v-model="form.nombre" aria-describedby="nameHelp">
              </div>
              <div class="">
                <label for="inputEmail" class="">Email</label>
                <input type="email" class="" id="inputEmail" v-model="form.email" aria-describedby="emailHelp">
              </div>
              <div class="">
                <label for="inputTelefono" class="">Teléfono</label>
                <input type="Telefono" class="" id="inputTelefono" v-model="form.telefono" aria-describedby="emailHelp">
              </div>
              <div class="">
                <label for="inputTipoServicio" class="">Tipo de Solicitud</label>
                <select class="" id="inputTipoServicio" v-model="form.tipoPeticionId" aria-label="">
                  <option selected>-- Seleccione el Servicio Deseado --</option>
                  <option v-for="tipo in tipopeticions" :key="tipo.id" :value="tipo.id">{{ tipo.descripcion }}</option>
                </select>
              </div>
              <div class="">
                <label for="inputMensaje" class="">Mensaje</label>
                <textarea class="" rows="5" id="inputMensaje" v-model="form.mensaje"></textarea>
              </div>
              <div class="">
                <label for="inputArchivo" class="">Adjuntar Archivo:</label>
                <input class="" type="file" id="inputArchivo">
              </div>
            </div>
            <div class="">
              <button type="submit" class="">Enviar Solicitud</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>