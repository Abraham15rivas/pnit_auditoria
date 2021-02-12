$(".ofDate").inputmask("yyyy-mm-dd", {"placeholder": "aaaa-mm-dd"});
$("[data-mask]").inputmask();

function clickTag() {
    if ($("#tag-proyectos").css('display') == 'none') $("#tag-proyectos").css('display', 'block');
    else $("#tag-proyectos").css('display', 'none');
}