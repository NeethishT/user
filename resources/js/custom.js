var selectAllItems = "#select-all";
var checkboxItem = ":checkbox";
$(selectAllItems).click(function () {
    if (this.checked) {
        $(checkboxItem).each(function () {
            this.checked = true;
        });
    } else {
        $(checkboxItem).each(function () {
            this.checked = false;
        });
    }
});

$('input[type=checkbox]').click(function () {
    $(this).parent().find('li input[type=checkbox]').prop('checked', $(this).is(':checked'));
    var sibs = false;
    $(this).closest('ul').children('li').each(function () {
        if ($('input[type=checkbox]', this).is(':checked')) sibs = true;
    });
    $(this).parents('ul').prev().prop('checked', sibs);
});

$('body').on('click', '.expand-row', function () {
    $('#modal-popup-content').text($(this).find(".expand_content").text());
});

$('body').on('click', '.expand-row-json', function () {
    $("#modal-popup-content").html(JSON.stringify(JSON.parse($(this).find(".expand_content").text()), 10, 5));
});




// Add Sone Content Start
$('#bannerAcc').is(":checked") ? $("#bannerAccShow").show() : $("#bannerAccShow").hide();

$("body").on("click", "#bannerAcc", function() {
    $(this).is(":checked") ? $("#bannerAccShow").show() : $("#bannerAccShow").hide()
});

$('#contentCardAcc').is(":checked") ? $("#contentCardAccShow").show() : $("#contentCardAccShow").hide();

$("body").on("click", "#contentCardAcc", function() {
    $(this).is(":checked") ? $("#contentCardAccShow").show() : $("#contentCardAccShow").hide()
});

$('#carouselCardAcc').is(":checked") ? $("#carouselCardAccShow").show() : $("#carouselCardAccShow").hide();

$("body").on("click", "#carouselCardAcc", function() {
    $(this).is(":checked") ? $("#carouselCardAccShow").show() : $("#carouselCardAccShow").hide()
});

$('#contentListAcc').is(":checked") ? $("#contentListAccShow").show() : $("#contentListAccShow").hide();

$("body").on("click", "#contentListAcc", function() {
    $(this).is(":checked") ? $("#contentListAccShow").show() : $("#contentListAccShow").hide()
});

$("body").on("click", ".addListItem", function () {
    $('#contentListAccItems').append($('#contentListAccItems .itemList').html());
});


// Add Sone Content End