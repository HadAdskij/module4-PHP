$(document).ready(function(){
    $(".addRate, .subRate").click(function(){
        var $this = $(this);
        $.post(
            "JS.php",
            {
                className: $(this).attr('class'),
                id: $(this).val()
            },
            onAjaxSuccess
        );
        function onAjaxSuccess(data)
        {
            newRate =  $this.parent().children('span').html();
            newRate = newRate.replace(/: -*[0-9]+/i, ": " + data);
            $this.parent().children('span').replaceWith("<span>" + newRate + "</span>");
        }
    });

    $(".answerCom").click(function () {
        classs= '.ans' + $(this).val();
        $(classs).css({'display' : 'block'});
    })

    $(".modify").click(function () {
        classs= '.mod' + $(this).val();
        $(classs).css({'display' : 'block'});
    })
});

$(document).ready(function () {
    setInterval(function getReaders() {
        var current = Math.floor((Math.random() * 5) + 1);
        $.post(
            "JS.php",
            {
                getReaders: $('input#article').val(),
                curr: current
            },
            onAjaxSuccess
        );
        function onAjaxSuccess(data)
        {
            div = $('#readers').html();
            div = div.replace(/і [0-9]+ в/i, 'і ' + current + ' в');
            div = div.replace(/и [0-9]+ р/i, 'и ' + data + ' р');
            $('#readers').replaceWith("<div id='readers'>" + div + "</div>");
        }
    }, 5000 );
})