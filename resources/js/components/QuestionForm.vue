<template>
    <div class="container mt-5">
        <form @submit.prevent="submitForm">
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

            <div class="card mt-5 p-4" v-if="currentQuestion">
                <div class="form-group">
                    <label>{{ currentQuestion.question_name }}</label>
                    <div class="m-2" v-for="(option, index_) in JSON.parse(currentQuestion.answers_options)" :key="index_">
                        <input type="radio" :value="option" :name="option" v-model="selectedOptions[currentQuestionIndex]">
                        <label :for="option"></label>
                        {{ option + ' ' + currentQuestion.unit }}
                    </div>
                </div>
            </div>

            <div class="mt-3 d-flex justify-content-between">
                <button v-if="currentQuestionIndex > 0" type="button" class="btn btn-primary"
                    @click="prevQuestion">Anterior</button>
                <button v-if="currentQuestionIndex < questions.length - 1" type="button" class="btn btn-primary"
                    @click="nextQuestion">Siguiente</button>
                <button v-if="currentQuestionIndex === questions.length - 1" type="submit"
                    class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            questions: [],
            firstName: '',
            lastName: '',
            dni: '',
            email: '',
            selectedOptions: [],
            currentQuestionIndex: 0,
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
            this.reset();
        },

        reset() {
            this.answers = [];
            this.firstName = '';
            this.lastName = '';
            this.dni = '';
            this.email = '';
            this.selectedOptions = [];
            this.currentQuestionIndex = 0;
        },

        nextQuestion() {
            this.currentQuestionIndex++;
        },

        prevQuestion() {
            this.currentQuestionIndex--;
        },
    },

    async created() {
        const vm = this;
        try {
            let response = await axios.get('get-questions');
            vm.questions = response.data.questions;
            console.log(vm.questions);
        } catch (error) {
            console.log(error)
        }
    },

    computed: {
        currentQuestion() {
            return this.questions[this.currentQuestionIndex];
        },
    },
};
</script>
  
<style>
/* Add any additional styling you may need */
</style>
  