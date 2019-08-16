<template>
    <div>
        <quiz-start v-if="currentStep === 1"
                    :name="name" v-bind:quizzes="quizzes"
                    @quiz-started="onQuizStarted">
        </quiz-start>

        <quiz-questions :current-question="currentQuestion"
                        v-else-if="currentStep === 2"
                        @results-received="onResultsReceived">

        </quiz-questions>

        <quiz-results v-else-if="currentStep === 3"
                      @quiz-finished="onQuizFinished" :current-quiz="currentQuiz" :result="result">
        </quiz-results>

        <div v-else>
            <button @click="currentStep = 1">
                Uz sākumu
            </button>
        </div>

    </div>


</template>

<script>
    import QuizStartComponent from './quiz-start.vue';
    import QuizQuestionsComponent from './quiz-question.vue';
    import QuizResultsComponent from './quiz-results.vue';
    import {Quiz} from './../models/quiz.models.js';

    export default {
        components: {
            'quiz-start': QuizStartComponent,
            'quiz-questions' : QuizQuestionsComponent,
            'quiz-results' : QuizResultsComponent,
        },

        props: {
            name: {
              required: true,
            },
          quizzesProp: {
              default: [],                              //datus sūta no backenda uz prop
              required: true,
          },
        },

        created() {
          this.quizzes = this.quizzesProp.map((quizDatum) => {
              return Quiz.fromArray(quizDatum);
          });
        },

        data() {
            return {
                /** @type {Array<Quiz>} */              //datus apstrādā
                quizzes: [],
                /** @type {Number} */
                currentStep: 1,
                /** @type {?Number} */
                currentQuiz: null,
                /** @type {?Number} */
                currentQuestion: null,
                /** @type {Result} */
                result: null,
            }
        },

        methods: {
            /**
             *
             * @param {{quizId: Number, firstQuestion: Question}} emittedData
             */
            onQuizStarted(emittedData) {
                let quizId = emittedData.quizId;

                this.currentQuiz = this.quizzes.find(
                    (quiz) => {return quiz.id === quizId}
                );
                this.currentQuestion = emittedData.firstQuestion;

                this.currentStep++;
            },
            /**
             *
             * @param {Result} emittedResult
             */
            onResultsReceived(emittedResult) {
                this.result = emittedResult;
                this.currentStep++;
                this.currentQuestion = null;
            },

            onQuizFinished() {
                this.currentStep = 1;
                this.result = null;
                this.currentQuiz = null;
            }
        },
    }
</script>