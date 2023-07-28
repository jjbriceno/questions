<template>
    <div class="col-md-6">
        <!-- Section 4 -->
        <!-- ... Content for Section 4 ... -->
        <!-- Personal Information Form -->
        <form @submit.prevent="proceedToQuestions">
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
                <button type="submit" class="btn btn-primary" @click="proceedToQuestions">Siguiente</button>
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
        proceedToQuestions() {
            // ... Proceed to questionnaire logic ...
            this.$router.push('/questionnaire');
        },

        reset() {
            this.firstName = "";
            this.lastName = "";
            this.dni = "";
            this.email = "";
        },

        submitForm() {
                // Combine questions and answers into an object
                const userResponse = {
                    personalInfo: {
                    firstName: this.firstName,
                    lastName: this.lastName,
                    dni: this.dni,
                    email: this.email,
                    },
                };

                // Send the userResponse object to your server or process it as needed
                console.log(userResponse);

                // Clear the form after submission
                this.reset();
            },
    },
};
</script>
  