<template>
    <div class="container mt-5">
        <h2>Questionnaire</h2>
        <form @submit.prevent="submitForm">
            <!-- Personal Information -->
            <div class="card">
                <div class="card-header">
                    <h2>Personal information</h2>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>First Name</label>
                            <input v-model="firstName" class="form-control" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name</label>
                            <input v-model="lastName" class="form-control" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>DNI</label>
                        <input v-model="dni" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input v-model="email" class="form-control" required />
                    </div>
                </div>
            </div>

            <!-- Questions -->
            <div class="form-group" v-for="(question, index) in questions" :key="index">
                <label>{{ question }}</label>
                <input v-model="answers[index]" class="form-control" />
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            questions: [
                'What is your favorite color?',
                'What is your favorite animal?',
                'What is your favorite food?',
            ],
            answers: [],
            firstName: '',
            lastName: '',
            dni: '',
            email: '',
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
};
</script>
  
<style>
/* Add any additional styling you may need */
</style>
  