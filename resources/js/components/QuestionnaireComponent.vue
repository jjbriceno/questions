<template>
    <div class="col-md-6">
        <!-- Section 5 -->
        <!-- ... Content for Section 5 ... -->
        <form @submit.prevent="submitForm">
            <div class="card">
                <div class="card-header d-flex justify-content-center text-white bg-primary">
                    <h2 class="card-title">Cuestionario de Matemáticas</h2>
                </div>
                <div class="card-body" v-if="currentQuestion">
                    <div class="mb-3 d-flex justify-content-center">
                        <h5 class="mb-2">Categoría {{ currentQuestion.category.category_number }}:
                            {{ currentQuestion.category.name }}
                            <div class="d-flex justify-content-center">
                                <h6 class="mb-2"> (Nivel de dificultad: {{ currentQuestion.category.level }})</h6>
                            </div>
                        </h5>
                    </div>
                    <div class="mb-3">
                        <label><strong>P{{ currentQuestion.id }}:</strong> {{ currentQuestion.question_name }}</label>
                    </div>
                    <div class="m-2 opciones" v-for="(option, index_) in JSON.parse(currentQuestion.answers_options)"
                        :key="index_">
                        <input type="radio" :value="option" :name="option" v-model="selectedOptions[currentQuestionIndex]"
                            class="form-check-input" :id="'opcion-' + index_" />
                        <label :for="'opcion-' + index_">{{ option + " " + currentQuestion.unit }}</label>
                    </div>
                </div>
            </div>

            <div class="mt-3 d-flex justify-content-between">
                <button v-if="currentQuestionIndex > 0" type="button" class="btn btn-primary" @click="prevQuestion">
                    Anterior
                </button>
                <button v-if="currentQuestionIndex < questions.length - 1" type="button" class="btn btn-primary"
                    @click="nextQuestion" :disabled="!isOptionSelected">
                    Siguiente
                </button>
                <button v-if="currentQuestionIndex === questions.length - 1" type="button" class="btn btn-primary"
                    @click="submitForm" :disabled="!isOptionSelected">
                    Enviar
                </button>
            </div>
        </form>
    </div>
</template>
  
<script>
export default {
    props: {
        id: Number,
    },
    data() {
        return {
            questions: [],
            selectedOptions: [],
            currentQuestionIndex: 0,
        };
    },
    methods: {
        reset() {
            this.answers = [];
            this.selectedOptions = [];
            this.currentQuestionIndex = 0;
        },

        nextQuestion() {
            this.currentQuestionIndex++;
        },
        prevQuestion() {
            this.currentQuestionIndex--;
        },

        submitForm() {
            // Combine questions and answers into an object
            const answers = this.selectedOptions;
            // Send the userResponse object to your server or process it as needed
            console.log(answers);

            // Clear the form after submission
            this.reset();
        },
    },

    computed: {
        currentQuestion() {
            return this.questions[this.currentQuestionIndex];
        },
        isOptionSelected() {
            // Check if an option is selected for the current question
            console.log(this.currentQuestionIndex);
            return this.selectedOptions[this.currentQuestionIndex] !== undefined;
        },
    },

    async created() {
        const vm = this;
        try {
            let response = await axios.get("get-questions");
            vm.questions = response.data.questions;
        } catch (error) {
            console.log(error);
        }

        vm.id = this.$route.params.id;
    },
};
</script>

<style>
/* Estilos para el componente Vue */
.opciones input[type="radio"] {
    display: none;
}

.opciones label {
    display: block;
    padding: 10px;
    background-color: #f8f9fa;
    border-radius: 5px;
    cursor: pointer;
}

.opciones label:hover {
    background-color: #e9ecef;
}

.opciones input[type="radio"]:checked+label {
    background-color: #0d6efd;
    color: #fff;
}
</style>
  