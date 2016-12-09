
$(document).ready(function() {
    setTimeout(function () {
        $(".subscribe").css({'display'
        :
        'block'}
        )}, 5000);
    });

$(document).ready(function() {

    var Warm = true;

    $("a").click(function () {
        Warm = false;
        setTimeout(function () {
            Warm = true;
        }, 3000)
    });

    $("form").submit(function () {
        Warm = false;
        setTimeout(function () {
            Warm = true;
        }, 3000)
    });

    window.onbeforeunload=function(){
        if (Warm)
            return ('ok');
    }
});

$(document).ready(function() {

    $('input#searchTag').focus(function () {
        $(".searchPanel").css({'display' : 'block'});
    })

    $(document).click(function () {
        if (event.target.nodeName.toString() === 'DIV')
            $(".searchPanel").css({'display' : 'none'});
    })
});

$(document).ready( function() {


    $('input#searchTag').autocomplete({
        source: function (request, response) {
            $.post(
                "JS.php",
                {
                    tags: request['term']
                },
                onAjaxSuccess
            );

            function onAjaxSuccess(data) {
                window.availableTags = JSON.parse(data);
            }
            response(availableTags);
        }
    });

    $('#startSearch').click(function () {
        locat = "index/search/@" + $('#categorySelect').val() + '@' + $('input#searchTag').val() + '@';
        locat = locat + $('#fromDate').val() + '@' + $('#toDate').val() + '@';
        return location.href = locat;
    })

    $('#closeSubscribe').click(function () {
        $('div.subscribe').css({'display' : 'none'});
    })

    $('.caption').mouseover(function () {
        var $this = $(this);
        var sell = $(this).find('.price').html() * 0.9;
        $(this).find('.price').replaceWith("<span class = \"price\">" + sell + "</span>")
   })

    $('.caption').mouseout(function () {
        var $this = $(this);
        var sell = $(this).find('.price').html() / 0.9;
        $(this).find('.price').replaceWith("<span class = \"price\">" + sell + "</span>")
})


} );
