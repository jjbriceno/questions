<template>
    <div class="col-md-6">
        <!-- Section 3 -->
        <!-- ... Content for Section 3 ... -->
        <form>
            <div class="card">
                <div class="card-header d-flex justify-content-center bg-primary text-white">
                    <h2 class="card-title">Cuestionario Completado</h2>
                </div>
                <div class="card-body">
                    <p class="text-center">Usted ha completado el Cuestionario de Matemáticas con un puntaje de:</p>
                    <p v-if="scores.score < 3*scores.total/4" class="text-center text-danger">
                        <b>{{ scores.score }}/{{ scores.total }}</b>
                    </p>
                    <p v-else class="text-center text-success">
                        <b>{{ scores.score }}/{{ scores.total }}</b>
                    </p>
                    <div class="mt-3 d-flex justify-content-center">
                        <button type="submit" @click="goHome" class="btn btn-primary">Ir a Inicio</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user_id: '',
            scores: {
                total: '',
                score: '',
            }
        };
    },

    methods : {
        async goHome() {
            this.$router.push(`/`);
            this.reset();
        },

        async reset(){
            this.user_id = '',
            this.scores = {
                total: '',
                score: '',
            }
        }
    },

    async created() {
        const vm = this;
        vm.user_id = parseInt(this.$route.params.id);
        try {
            let response = await axios.get(`data-set/get-score/${vm.user_id}`);
            vm.scores = response.data.scores;
        } catch (error) {
            console.log(error);
        }
    },
};
</script>