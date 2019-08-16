<template>
    <div class="container-fluid d-flex h-100 flex-column align-items-center">
        <h1>Čau, {{ name }}!</h1>
        <div>
        <div v-if="error.length" class="alert alert-danger">
            {{ error }}
        </div>
        </div>
        <div>
        <select v-model="selectedQuizId">
            <option value="">Izvēlies tēmu</option>
            <option :value="quiz.id" v-for="quiz in quizzes">
                {{ quiz.title }}
            </option>
        </select>
        </div>
        <br />
        <div>
        <button @click="startQuiz" :disabled="!canStartQuiz" class="btn btn-success">
            Sākt
        </button>
        </div>
        <br />
        </div>
</template>

<script>
    import axios from 'axios';
    import {Question} from "../models/quiz.models.js";

    export default {
        props: {
            name: {
                required: true,
            },
            quizzes: {
                default: [],
                required: true,
            }
        },

        data() {
            return {
              selectedQuizId: '',
                error: '',
                loading: false,
            }
        },

        methods: {
            startQuiz() {
                if(!this.canStartQuiz){
                    return;
                }

                let data = new FormData;
                data.append('quizId', this.selectedQuizId);

                this.loading = true;

                axios.post('/quiz/start', data)
                    .then((response) => {
                        if (response.data.error) {
                            this.error = response.data.error;
                            return;
                        }
                        let question = Question.fromArray((response.data.questionData));

                        this.$emit('quiz-started', {            //paziņo mainam, ka jāsāk quiz iekš main.vue line 5
                            'quizId' : this.selectedQuizId,
                            'firstQuestion' : question,
                        });

                }).finally(() => {this.loading = false});
            }
        },

        computed: {
            canStartQuiz() {
                return !!this.selectedQuizId && !this.loading;
            }
        }
    }
</script>