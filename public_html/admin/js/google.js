$(document).ready(function () {


    function setCount(src, elem) {
        var limit = 5000;
        var chars = src.val().length;
        if (chars > limit) {
            src.value = src.value.substr(0, limit);
            chars = limit;
        }
        elem.html(limit - chars);
    }

    $("#inptSeoKeywords").autocomplete({
        delay: 100,
        source: function (request, response) {

            // Suggest URL
            //alert($('#inptSeoKeywords').data('currentlang'));
            var suggestURL = "http://suggestqueries.google.com/complete/search?client=chrome&hl=tr&q=%QUERY";

            var aktifdil = $('#inptSeoKeywords').data('currentlang');

            if (aktifdil != '') {
                suggestURL = suggestURL.replace('aktifdili', $('#inptSeoKeywords').data('currentlang'));
            }
            else
            {
                suggestURL = suggestURL.replace('aktifdili', 'tr');
            }

            suggestURL = suggestURL.replace('%QUERY', request.term);

            //alert(suggestURL);

            // JSONP Request
            $.ajax({
                method: 'GET',
                dataType: 'jsonp',
                jsonpCallback: 'jsonCallback',
                url: suggestURL
            })
            .success(function (data) {
                response(data[1]);
            });
        },
        select: function (event, ui) {

            var targetElement = $('#' + $(this).data('targetelement'));

			

            if (targetElement.val() == '') {
                targetElement.val(ui.item.value);
            }
            else {
                targetElement.val(targetElement.val() + ', ' + ui.item.value);
            }

			var targetElement2 = $('#etiket_sistemi2');

			if (targetElement2.val() == '') {
                targetElement2.val(ui.item.value);
            }
            else {
                targetElement2.val(targetElement2.val() + ', ' + ui.item.value);
            }

            var viewr = $("#charsKeywords");
            setCount($(".txtseoKeywords"), viewr);

            $(this).val("");
            return false;

        }
    });


});