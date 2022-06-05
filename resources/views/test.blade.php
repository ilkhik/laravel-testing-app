<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <x-head></x-head>
    <title>{{$test->title}}</title>
    <script src="/js/jquery.min.js"></script>
</head>
<body>
    <script>
function serializeTestTaking() {
    let data = {};
    let questions = [];

    $(".question").each(function () {
        let question = {};
        question["number"] = $(this).attr("data-question-num");
        question["answers"] = [];
        $(this).find(".answer").each(function () {
            if ($(this).is(':checked'))
                question["answers"].push(parseInt($(this).attr("data-answer-num")));
        });


        questions.push(question);
    });

    data["questions"] = questions;
    return data;
}


$(document).ready(function () {
    $(document).on("submit", "#test", function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify(serializeTestTaking()),
            success: function (data) {
                window.location.replace("");
            },
            error: function () {
                alert("Error!");
                window.location.replace("");
            }
        });
    });
});


    </script>
<x-header></x-header>
<div class="main-content">
    <h1>Тест "<span>{{$test->title}}</span>"</h1>
    <form action="/tests/{{$test->id}}" method="post" id="test">
        <ol>
            @foreach ($test->questions as $question)
            <li class="question" data-question-num="{{$question->number}}">
                <div>{{$question->text}}</div>
                <fieldset>
                    <ol>
                        @foreach ($question->answers as $answer)
                        @if ($question->questionKind === 'SINGLE_CHOICE')
                        <input type="radio"
                               name="question{{$question->number}}" class="answer"
                               data-answer-num="{{$answer->number}}">
                        @else
                        <input type="checkbox"
                               name="question{{$question->number}}" class="answer"
                               data-answer-num="{{$answer->number}}">
                        @endif
                        <li style="display:inline;">{{$answer->text}}</li><br>
                        @endforeach
                    </ol>
                </fieldset>
            </li>
            <br>
            @endforeach
        </ol>
        <input type="submit" id="takeTestButton" class="btn btn-primary" value="Готово" style="margin-left:30%;">
    </form>
</div>
</body>
</html>