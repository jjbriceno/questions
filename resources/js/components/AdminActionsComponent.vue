<template>
    <div>
        <!-- Section 3 -->
        <!-- ... Content for Section 3 ... -->
        <h2 class="text-center">Acciones del Administrador</h2>
        <p class="text-center">¿Desea descargar el Dataset?</p>
        <div class="d-flex justify-content-center mt-3">
            <a class="btn btn-primary" :href="'/data-set/export'" title="Download" data-toggle="tooltip" v-has-tooltip
                target="_blank">
                Descargar
            </a>
        </div>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            showAdminActions: false,
        };
    },
};
</script>
  