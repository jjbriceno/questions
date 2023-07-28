<template>
    <div class="col-md-6">
        <!-- Section 2 -->
        <!-- ... Content for Section 2 ... -->
        <form @submit.prevent="adminLogin">
            <div class="card">
                <div class="card-header d-flex justify-content-center bg-primary text-white">
                    <h2 class="card-title">Iniciar sesión como administrador</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="adminUsername">Usuario</label>
                        <input v-model="adminUsername" type="text" class="form-control" id="adminUsername" required>
                    </div>
                    <div class="form-group">
                        <label for="adminPassword">Contreseña</label>
                        <input v-model="adminPassword" type="password" class="form-control" id="adminPassword" required>
                    </div>
                </div>
            </div>

            <div class="mt-3 d-flex justify-content-center">
                <button type="submit" @click="goToDataSet" class="btn btn-primary">Iniciar sesión</button>
            </div>
        </form>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            adminUsername: '',
            adminPassword: '',
        };
    },
    methods: {
        adminLogin() {
            this.$router.push('/admin-actions');
        },

        reset() {
            this.adminUsername ='';
            this.adminPassword = '';
        },
    },
};
</script>
  