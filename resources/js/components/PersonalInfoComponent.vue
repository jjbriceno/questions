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
                    <div class="form-group">
                        <label>Nombre(s)</label>
                        <input v-model="firstName" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Apellido(s)</label>
                        <input v-model="lastName" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Cédula</label>
                        <input type="text" onkeypress="return event.charCode>=48 && event.charCode<=57" class="form-control"
                            size="9" v-model="dni" required />
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" v-model="email" pattern=".+@.+\.com" size="30" class="form-control" required />
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
        };
    },
    methods: {
        proceedToQuestions(user_id) {
            // ... Proceed to questionnaire logic ...
            this.$router.push(`/questionnaire/${user_id}`);
        },

        reset() {
            this.firstName = "";
            this.lastName = "";
            this.dni = "";
            this.email = "";
        },

        async submitForm() {
            // Combine questions and answers into an object
            const userResponse =  {
                    firstName: this.firstName,
                    lastName: this.lastName,
                    dni: this.dni,
                    email: this.email,
            };
            // Send the userResponse object to your server or process it as needed
            let user_id = await axios.post('store-user', userResponse);
            console.log(userResponse);
            
            this.proceedToQuestions(user_id);
            // Clear the form after submission
            this.reset();
        },
    },
};
</script>
  