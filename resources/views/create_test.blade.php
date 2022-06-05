<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <x-head></x-head>
    <title>Создать новый тест</title>
    <script src="/js/jquery.min.js" ></script>
</head>
<body>
<x-header></x-header>

<div class="main-content">
    <h1>Создание нового теста</h1>

    <form id="test" action="/tests/create" method="post">
        <input placeholder="Название теста" id="testTitle" class="form-control" required><br><br>

        <ol id="question-container">

            <button type="button" class="btn btn-secondary addQuestionButton">Добавить вопрос</button>
        </ol>

        <input type="submit" class="btn btn-primary" value="Создать новый тест">
    </form>

    <!--Template-->

    <ul id="question-template" style="display:none;">

        <li class="question">
            <input placeholder="Введите вопрос" class="form-control questionText" required><br>
            <select class="form-select questionKind">
                <option value="SINGLE_CHOICE">Один вариант ответа</option>
                <option value="MULTIPLY_CHOICE">Несколько вариантов ответа</option>
            </select><br>

            <div class="answer-container">
                <table>
                    <tr class="answer">
                        <td><input type="checkbox" class="form-check-input answerIsCorrect"></td>
                        <td><input placeholder="Введите вариант ответа"
                                   class="form-control answerText" required></td>
                        <td>
                            <button type="button" class="btn btn-secondary removeAnswerButton"
                                    title="Удалить вариант ответа">-
                            </button>
                        </td>
                    </tr>
                </table>
                <br>
                <button type="button" class="btn btn-secondary addAnswerButton" title="Добавить вариант ответа">+
                </button>
            </div>
            <br>
            <button type="button" class="btn btn-danger removeQuestionButton">Удалить вопрос</button>
        </li>
    </ul>
    <br>

    <!---->

</div>


<script>
function addQuestion() {
    let lastQuestion = $("#question-container").find(".question").last();
    if ( !lastQuestion.html()) {
        $("#question-template").find(".question").clone().prependTo("#question-container");
    } else {
        $("#question-template").find(".question").clone().insertAfter(lastQuestion);
    }
}

function addAnswer(question) {
    let lastAnswer = question.find(".answer").last();
    if( !lastAnswer.html() ) {
        $("#question-template").find(".answer").clone().prependTo(question.find(".answer-container"));
    } else {
        $("#question-template").find(".answer").clone().insertAfter(lastAnswer);
    }
}

function serializeQuestion(q){
    let data = {};
    data["text"] = $(q).find(".questionText").val();
    data["questionKind"] = $(q).find(".questionKind").val();
    let answers = [];
    $(q).find(".answer").each(function(){
        let answer = {};
        answer["text"] = $(this).find(".answerText").val();
        answer["isCorrect"] = $(this).find(".answerIsCorrect").is(":checked");
        answers.push(answer);
    });
    data["answers"] = answers;
    return data;
}


function serializeTest(){
    let data = {};
    data["title"] = $("#testTitle").val();

    let questions = [];
    $("#question-container").find(".question").each(function(){
        questions.push(serializeQuestion(this));
    });

    data["questions"] = questions;
    return data;
}

$(document).ready(function(){
    addQuestion();

    $(document).on("click", ".addAnswerButton", function(){
        addAnswer($(this).parents(".question"));
    });

    $(document).on("click", ".removeAnswerButton", function(){
        $(this).parents(".answer").remove();
    });

    $(document).on("click", ".removeQuestionButton", function(){
        $(this).parents(".question").remove();
    });

    $(document).on("click", ".addQuestionButton", function(){
        addQuestion();
    });

    $(document).on("click", ".answerIsCorrect", function(){
        let questionKind = $(this).parents(".question").find(".questionKind").val();
        if (questionKind === "SINGLE_CHOICE"){
            $(this).parents(".question").find(".answerIsCorrect").each(function(){
                $(this).prop("checked", false);
            });
            $(this).prop("checked", true);
        }
    });

    $(document).on("submit", "#test", function(e){
        e.preventDefault();
        $.ajax({
           type: "POST",
           url: $(this).attr("action"),
           contentType: "application/json; charset=utf-8",
           data: JSON.stringify(serializeTest()),
           success: function(data){
               window.location.replace("/tests");
           },
           error: function(){
               alert("Тест с таким названием уже существует");
           }
         });
    });

    $(".questionKind").on( "change", function() {
        if($(this).val() === "SINGLE_CHOICE") {
            let isSelected = false;
            $(this).parents(".question").find(".answer").each(function() {
                let checkbox = $(this).find(".answerIsCorrect");

                if(isSelected) {
                    checkbox.prop("checked", false);
                } else if(checkbox.is(":checked"))
                        isSelected = true;
            });
        }
    });
});

</script>


</body>
</html>