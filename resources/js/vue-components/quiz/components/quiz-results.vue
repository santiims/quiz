<template>
    <div class="container-fluid d-flex flex-column align-items-center">
        <div>
        <h1>Rezultāti</h1>
        </div>
        <div>
        <p>Jūs pareizi atbildējāt uz {{ result.correctAnswerCount }} no {{ currentQuiz.questionCount }} jautājumiem.</p>
        </div>
        <div>
        <button @click="endQuiz" class="btn btn-success">
            Uz sākumu
        </button>
        <button class="btn btn-success">
            Pareizās atbildes
        </button>
        </div>
        <br />
    </div>
</template>

<script>
    export default {
        props: {
            /**
             * @type {Quiz}
             */
            currentQuiz: {
                required: true,
            },
            /**
             * @type {Result}
             */
            result: {
                required: true,
            },
        },

        methods: {
            endQuiz() {
                this.$emit('quiz-finished');
            },
        }
    }


</script>