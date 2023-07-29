<template>
    <div class="col-md-6">
        <!-- Section 4 -->
        <!-- ... Content for Section 4 ... -->
        <!-- Personal Information Form -->
        <form>
            <div class="card">
                <div class="card-header d-flex justify-content-center text-white bg-primary">
                    <h2 class="card-title">Información personal</h2>
                </div>
                <div class="card-body">
                    <div class="form-group pb-3">
                        <label>Nombre(s)</label>
                        <input v-model="firstName" class="form-control" placeholder="Nombre(s)"
                            :style="errors.error.firstName && (firstName === '' || errors.inputs.firstName) ? 'border-color: red' : ''" />
                        <p v-if="errors.error.firstName" class="text-danger">
                            <b>{{ errors.inputs.firstName === firstName || firstName === '' ? errors.error.firstName[0] : ''
                            }}</b>
                        </p>
                    </div>
                    <div class="form-group pb-3">
                        <label>Apellido(s)</label>
                        <input v-model="lastName" class="form-control" placeholder="Apellidos(s)"
                            :style="errors.error.lastName && lastName === '' ? 'border-color: red' : ''" />
                        <p v-if="errors.error.lastName" class="text-danger">
                            <b>{{ errors.inputs.lastName === lastName || lastName === '' ? errors.error.lastName[0] : ''
                            }}</b>
                        </p>
                    </div>
                    <div class="form-group pb-3">
                        <label>Cédula</label>
                        <input type="text" onkeypress="return event.charCode>=48 && event.charCode<=57" class="form-control"
                            v-model="dni" placeholder="Cédula"
                            :style="errors.error.dni && (dni === '' || errors.inputs.dni === dni) ? 'border-color: red' : ''" />
                        <p v-if="errors.error.dni" class="text-danger">
                            <b>{{ errors.inputs.dni === dni || dni === '' ? errors.error.dni[0] : ''
                            }}</b>
                        </p>
                    </div>
                    <div class="form-group pb-3">
                        <label>Email</label>
                        <input type="email" v-model="email" pattern=".+@.+\.com" size="100" class="form-control"
                            placeholder="Email"
                            :style="errors.error.email && (email === '' || errors.inputs.email === email) ? 'border-color: red' : ''" />
                        <p v-if="errors.error.email" class="text-danger">
                            <b>{{ errors.inputs.email === email || email === '' ? errors.error.email[0] : ''
                            }}</b>
                        </p>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" @click="submitForm">Siguiente</button>
            </div>
        </form>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            firstName: "",
            lastName: "",
            dni: "",
            email: "",
            errors: {
                error: {},
                inputs: {}
            }
        };
    },
    methods: {
        async proceedToQuestions(user_id) {
            // ... Proceed to questionnaire logic ...
            this.$router.push(`/questionnaire/${user_id}`);
        },

        async reset() {
            this.firstName = "";
            this.lastName = "";
            this.dni = "";
            this.email = "";
        },

        async resetErrors() {
            const vm = this;
            Object.keys(vm.errors.error).length !== 0 && (vm.errors.error = {}) && (vm.errors.inputs = {});
        },

        async submitForm() {
            // Combine questions and answers into an object
            const vm = this;

            await vm.resetErrors();

            const userResponse = {
                firstName: vm.firstName,
                lastName: vm.lastName,
                dni: vm.dni,
                email: vm.email,
            };
            // Send the userResponse object to your server or process it as needed
            try {
                let response = await axios.post('store-user', userResponse);
                let user_id = response.data.user.id;
                await vm.reset();
                await vm.proceedToQuestions(user_id);
            } catch (error) {
                vm.errors.error = error.response.data.errors;
                vm.errors.inputs = error.response.data.inputs;
                console.log(vm.errors);
            }
        },
    },
};
</script>
  