<template>
    <div class="container">
        <h1>Cuestionario de Matemáticas</h1>

        <div class="pregunta-container">
            <div class="categoria">{{ pregunta.categoria }}</div>
            <div class="pregunta">{{ pregunta.pregunta }}</div>
            <ul class="opciones">
                <li v-for="(opcion, index) in pregunta.opciones" :key="index">
                    <input type="radio" :id="'opcion-' + index" name="respuesta" :value="opcion" v-model="selectedOption">
                    <label :for="'opcion-' + index">{{ opcion }}</label>
                </li>
            </ul>
        </div>

        <div class="botones">
            <button class="btn btn-primary" @click="anteriorPregunta">Anterior</button>
            <button class="btn btn-primary" @click="siguientePregunta">Siguiente</button>
        </div>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            preguntas: [
                {
                    categoria: "Categoría 1: Aritmética básica (Nivel de dificultad bajo)",
                    pregunta:
                        "Si un libro cuesta 25 bolívares y quiero comprar 2 libros, ¿cuánto dinero necesito?",
                    opciones: ["45 bolívares", "50 bolívares", "55 bolívares", "60 bolívares"],
                },
                {
                    categoria: "Categoría 1: Aritmética básica (Nivel de dificultad bajo)",
                    pregunta:
                        "Si un paquete contiene 10 galletas y quiero repartirlas entre 2 personas por igual, ¿cuántas galletas le tocan a cada persona?",
                    opciones: ["3 galletas", "4 galletas", "5 galletas", "6 galletas"],
                },
                // ... Add the rest of the questions with their corresponding options
            ],
            preguntaActual: 0,
            selectedOption: "",
        };
    },
    computed: {
        pregunta() {
            return this.preguntas[this.preguntaActual];
        },
    },
    methods: {
        siguientePregunta() {
            this.preguntaActual++;
            if (this.preguntaActual >= this.preguntas.length) {
                this.preguntaActual = 0;
            }
        },
        anteriorPregunta() {
            this.preguntaActual--;
            if (this.preguntaActual < 0) {
                this.preguntaActual = this.preguntas.length - 1;
            }
        },
    },
    mounted() {
        this.selectedOption = this.pregunta.opciones[0];
    },
};
</script>
  
<style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f8f9fa;
}

.container {
    max-width: 500px;
    padding: 40px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 40px;
}

.pregunta-container {
    margin-bottom: 40px;
}

.categoria {
    font-weight: bold;
    margin-bottom: 10px;
}

.opciones {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

.opciones li {
    margin-bottom: 10px;
}

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

.botones {
    text-align: center;
}

.btn {
    margin-right: 10px;
}
</style>
  