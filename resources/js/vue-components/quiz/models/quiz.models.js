class Quiz
{

    constructor()
    {
        /** @type {?int} */
        this.id = null;

        /** @type {string} */
        this.title = '';

        /** @type {Number} */
        this.questionCount = 0;
    }

    static fromArray(rawData)
    {
        let quiz = new Quiz();

        quiz.id = rawData.id;
        quiz.title = rawData.title;
        quiz.questionCount = rawData.questionCount;

        return quiz;
    }
}

class Question
{
    constructor()
    {
        /** @type {?int} */
        this.id = null;

        /** @type {string} */
        this.text = '';

        /** @type {Array<Answer>} */
        this.answers = [];
    }

    static fromArray(rawData)
    {
        let question = new Question();

        question.id = rawData.id;
        question.text = rawData.text;
        question.answers = rawData.answers.map((answerDatum) => {return Answer.fromArray(answerDatum)});

        return question;
    }
}

class Answer
{
    constructor()
    {
        this.id = null;

        this.text = '';
    }

    static fromArray(rawData) {
        let answer = new Answer();

        answer.id = rawData.id;
        answer.text = rawData.text;

        return answer;
    }
}

class Result
{
    constructor()
    {
        this.correctAnswerCount = 0;
    }

    static fromArray(rawData)
    {
        let result = new Result();

        result.correctAnswerCount = rawData.correctAnswerCount;

        return result;
    }
}

export {Quiz, Question, Answer, Result}