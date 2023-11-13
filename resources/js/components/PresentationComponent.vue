<template>
    <div class="col-md-6">
        <!-- Section 1 -->
        <!-- ... Content for Section 1 ... -->
        <h1 class="text-center">Bienvenido al Cuestionario de Matemáticas para la recolección de datos de los estudiantes de primaria</h1>
        <div class="d-flex justify-content-center mt-3">
            <button class="btn btn-primary mx-2" @click="checkPersonalInfo">Ir al cuestionario</button>
            <!-- <button class="btn btn-primary mx-2" @click="adminLogin">Entrar al sistema como Admin</button> -->
        </div>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            showPresentation: true,
        };
    },
    methods: {
        checkPersonalInfo() {
            this.$router.push('/personal-info');
        },
        adminLogin() {
            this.$router.push('/admin-login');
            // ... Implement admin login logic ...
        },
    },
};
</script>
  