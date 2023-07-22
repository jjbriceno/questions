<template>
    <div class="container mt-5">
        <form @submit.prevent="submitForm">
            <!-- Personal Information -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Información personal</h2>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nombre(s)</label>
                            <input v-model="firstName" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Apellido(s)</label>
                            <input v-model="lastName" class="form-control" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Cédula</label>
                        <input v-model="dni" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input v-model="email" class="form-control" required />
                    </div>
                </div>
            </div>

            <div class="card mt-5 p-4">
                <div class="form-group" v-for="(question, index) in questions" :key="index">
                    <label>{{ question.question_name }}</label>
                    <div class="m-2" v-for="(option, index_) in JSON.parse(question.answers_options)" :key="index_">
                        <input type="radio" :value="option" :name="option" v-model="selectedOptions[index]">
                        <label :for="option"></label>
                        {{ option }}
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2 col-12">Enviar</button>
        </form>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            questions: [],
            answers: [],
            firstName: '',
            lastName: '',
            dni: '',
            email: '',
            selectedOptions: []
        };
    },
    methods: {
        submitForm() {
            // Combine questions and answers into an object
            const userResponse = {
                personalInfo: {
                    firstName: this.firstName,
                    lastName: this.lastName,
                    dni: this.dni,
                    email: this.email,
                },
                answers: this.answers,
            };

            // Send the userResponse object to your server or process it as needed
            console.log(userResponse);

            // Clear the form after submission
            this.answers = [];
            this.firstName = '';
            this.lastName = '';
            this.dni = '';
            this.email = '';
        },
    },

    async created() {
        const vm = this;
        try {
            let response = await axios.get('get-questions');
            vm.questions = response.data.questions;
        } catch (error) {
            console.log(error)
        }
    }
};
</script>
  
<style>
/* Add any additional styling you may need */
</style>
  