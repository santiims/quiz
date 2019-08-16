<template>
    <div class="container-fluid d-flex flex-column align-items-center">
        <h2>{{ currentQuestion.text }}</h2>
            <br />
            <div>
                <template v-for="answer in currentQuestion.answers">
                    <button @click="selectAnswer(answer)" :class="getAnswerButtonClass(answer)">
                        {{ answer.text }}
                    </button>
                </template>
            </div>
        <div>
            <button class="btn btn-primary" @click="getNextQuestion" :disabled="isButtonDisabled">
                Nākamais jautājums
            </button>
        </div>
    </div>
</template>

<script>
    import {Answer, Question, Result} from "../models/quiz.models.js";
    import axios from 'axios';

    export default {
        props: {
            currentQuestion: {
                required: true,
            },
        },

        data() {
            return {
                /** @type {?Answer} */
                selectedAnswer: null,
                /** @type {boolean} */
                loading: false,
            }
        },

        methods :{
            selectAnswer(answer) {
                this.selectedAnswer = answer;
            },
            getAnswerButtonClass(answer) {
                return {
                    'btn btn-dark': answer !== this.selectedAnswer,
                    'btn btn-success': answer === this.selectedAnswer,
                }
            },
            getNextQuestion() {
                if (this.isButtonDisabled) {
                    return;
                }

                let data = new FormData;
                data.append('answerId', this.selectedAnswer.id);

                this.loading = true;

                axios.post('/quiz/next-question', data)
                    .then((response) => {

                        if (response.data.error) {
                            window.alert(response.data.error);
                            return;
                        }

                        if (response.data.resultData) {
                            this.onResultsReceived(response.data.resultData);
                            return;
                        }

                        this.selectedAnswer = null;
                        let nextQuestion = Question.fromArray(response.data.questionData);

                        this.currentQuestion.id = nextQuestion.id;
                        this.currentQuestion.text = nextQuestion.text;
                        this.currentQuestion.answers = nextQuestion.answers;
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },
            onResultsReceived(resultData) {
                let result = Result.fromArray(resultData);
                this.$emit('results-received', result);
            }
        },

        computed: {
            isButtonDisabled() {
                return !this.selectedAnswer || this.loading;
            }
        }
    }
</script>
