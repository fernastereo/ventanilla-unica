<script setup>

</script>

<template>
  <div class="bg-white dark:bg-gray-900">
    <div class="flex justify-center h-screen">
      <div class="hidden bg-cover lg:block lg:w-2/3" style="background-image: url(https://images.unsplash.com/photo-1504868584819-f8e8b4b6d7e3?q=80&w=2076&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D)">
        <div class="flex items-end h-full px-20 bg-gray-900 bg-opacity-40">
          <div class="mb-24">
            <h2 class="text-4xl font-bold mb-9 text-white">Ventanilla Unica</h2>
            <p class="max-w-2xl mt-3 text-gray-300 text-justify">Bienvenido al servicio de Ventanilla Única de Recepción de Documentos y Peticiones. Nuestro objetivo es ofrecerle una experiencia eficiente y simplificada al centralizar todos sus trámites en un solo lugar. Aquí podrá gestionar de manera rápida y transparente sus solicitudes, desde aclaratorias y desistimientos de licencias, hasta la programación de citas y la entrega de anexos. Trabajamos para mejorar la atención al ciudadano, garantizando un acceso más fácil a la información y agilizando los procesos que necesita. Su tiempo es valioso, y estamos aquí para ayudarle a aprovecharlo al máximo.</p>
          </div>
        </div>
      </div>

      <RouterView />
    </div>
  </div>
</template>

<style scoped>
</style>