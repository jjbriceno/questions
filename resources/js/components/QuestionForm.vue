<template>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="col-md-6">
            <!-- Vista de presentación -->
            <div v-if="showPresentation">
                <h1 class="text-center">Bienvenido a la recolección de datos de los estudiantes de primaria</h1>
                <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-primary mx-2" @click="proceedToQuestionnaire">Ir al cuestionario</button>
                <button class="btn btn-primary mx-2" @click="adminLogin">Entrar al sistema como Admin</button>
                </div>
            </div>
            <!-- Vista de inicio de sesión para el administrador -->
            <div v-if="showAdminLogin">
                <form @submit.prevent="adminLogin">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center">
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
            <!-- downloadDataset -->
            <div v-if="showAdminActions">
                <h2 class="text-center">Acciones del Administrador</h2>
                <p class="text-center">¿Desea descargar el Dataset?</p>
                <div class="d-flex justify-content-center mt-3">
                    <a
                        class="btn btn-primary"
                        :href="'/data-set/export'"
                        title="Download"
                        data-toggle="tooltip"
                        v-has-tooltip
                        target="_blank"
                    >
                    Descargar
                    </a>
                </div>
            </div>

            <div v-if="showPersonalInfo">
                <!-- Personal Information Form -->
                <form @submit.prevent="proceedToQuestions">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center">
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
                                <input  type="text"
                                        onkeypress="return event.charCode>=48 && event.charCode<=57"
                                        class="form-control"
                                        size="9"
                                        v-model="dni" 
                                        required 
                                    />
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input  type="email"
                                        v-model="email"
                                        pattern=".+@.+\.com"
                                        size="30"
                                        class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Siguiente</button>
                    </div>
                </form>
            </div>

            <div v-if="showQuestionnaire">
                <!-- Questionnaire -->
                <form @submit.prevent="submitForm">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center">
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
                            <div
                            class="m-2 opciones"
                            v-for="(option, index_) in JSON.parse(currentQuestion.answers_options)"
                            :key="index_"
                            >
                            <input
                                type="radio"
                                :value="option"
                                :name="option"
                                v-model="selectedOptions[currentQuestionIndex]"
                                class="form-check-input"
                                :id="'opcion-' + index_"
                            />
                            <label :for="'opcion-' + index_">{{ option + " " + currentQuestion.unit }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 d-flex justify-content-between">
                        <button
                        v-if="currentQuestionIndex > 0"
                        type="button"
                        class="btn btn-primary"
                        @click="prevQuestion"
                        >
                        Anterior
                        </button>
                        <button
                        v-if="currentQuestionIndex < questions.length - 1"
                        type="button"
                        class="btn btn-primary"
                        @click="nextQuestion"
                        :disabled="!isOptionSelected"
                        >
                        Siguiente
                        </button>
                        <button
                        v-if="currentQuestionIndex === questions.length - 1"
                        type="submit"
                        class="btn btn-primary"
                        >
                        Enviar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
            showPersonalInfo: true,
            questions: [],
            selectedOptions: [],
            currentQuestionIndex: 0,
            firstName: "",
            lastName: "",
            dni: "",
            email: "",
            adminUsername: '',
            adminPassword: '',
            showPresentation: true,
            showPersonalInfo: false,
            showQuestionnaire: false,
            showAdminLogin: false,
            showAdminActions: false,
            };
        },
        methods: {
            proceedToQuestionnaire() {
                this.showPresentation = false;
                this.showPersonalInfo = true;
            },

            redirectToAdminPage() {
            // Aquí redireccionas a la página del sistema de administración
            // por ejemplo, mediante router.push('/admin') si estás usando Vue Router
            },
            proceedToQuestions() {
                this.showPersonalInfo = false;
                this.showQuestionnaire = true;
                this.getQuestions();
            },
            nextQuestion() {
                this.currentQuestionIndex++;
            },
            prevQuestion() {
                this.currentQuestionIndex--;
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
                    answers: this.answers,
                };

                // Send the userResponse object to your server or process it as needed
                console.log(userResponse);

                // Clear the form after submission
                this.reset();
            },
            async getQuestions() {
                const vm = this;
                try {
                    let response = await axios.get("get-questions");
                    vm.questions = response.data.questions;
                    console.log(vm.questions);
                } catch (error) {
                    console.log(error);
                }
            },
            adminLogin() {
                // Aquí implementas la lógica para verificar el inicio de sesión del administrador.
                // Por ejemplo, puedes comparar el usuario y la clave ingresados con los valores correctos.
                // Si el inicio de sesión es exitoso, puedes redirigir al administrador a la página de acciones de admin.
                // Por ejemplo, mediante router.push('/admin-actions') si estás usando Vue Router.

                // Luego de completar el formulario de inicio de sesión, reseteamos los valores
                // y mostramos el formulario de información personal o el cuestionario.
                this.adminUsername = '';
                this.adminPassword = '';
                this.showAdminLogin = true;
                this.showPresentation = false;
            },
            goToDataSet() {
                this.showAdminLogin = false;
                this.showAdminActions = true;
            },
            async downloadDataset() {
                const vm = this;
                try {
                    await axios.get("data-set/export");
                    local.refece
                    console.log('Download');
                } catch (error) {
                    console.log(error);
                }
            },
            reset() {
                this.answers = [];
                this.firstName = "";
                this.lastName = "";
                this.dni = "";
                this.email = "";
                this.selectedOptions = [];
                this.currentQuestionIndex = 0;
                this.showPresentation = true;
                this.showPersonalInfo = false;
                this.showQuestionnaire = false;
                this.showAdminLogin = false;
            },
        },
        async created() {
            // const vm = this;
            // try {
            //     let response = await axios.get("get-questions");
            //     vm.questions = response.data.questions;
            //     console.log(vm.questions);
            // } catch (error) {
            //     console.log(error);
            // }
        },
        computed: {
            currentQuestion() {
                return this.questions[this.currentQuestionIndex];
            },
            isOptionSelected() {
                // Check if an option is selected for the current question
                return this.selectedOptions[this.currentQuestionIndex] !== undefined;
            },
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

    .opciones input[type="radio"]:checked + label {
        background-color: #0d6efd;
        color: #fff;
    }
</style>