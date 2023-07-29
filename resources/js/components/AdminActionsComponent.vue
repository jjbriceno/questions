<template>
    <div class="col-md-6">
        <!-- Section 3 -->
        <!-- ... Content for Section 3 ... -->
        <form>
            <div class="card">
                <div class="card-header d-flex justify-content-center bg-primary text-white">
                    <h2 class="card-title">Acciones del Administrador</h2>
                </div>
                <div class="card-body">
                    <p class="text-center">¿Desea descargar el Dataset?</p>
                    <div class="d-flex justify-content-center mt-3">
                        <a class="btn btn-primary" :href="'/data-set/export'" title="Download" data-toggle="tooltip" v-has-tooltip
                            target="_blank">
                            Descargar
                        </a>
                    </div>
                </div>
            </div>
        </form>
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
