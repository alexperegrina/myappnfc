/**
 * Created by irinavasilieva on 17/05/16.
 */

/*var inputElement = document.createElement('input');
inputElement.type = "button"
inputElement.addEventListener('click', function(){
    $(".bt1").click(function(){
        $(this).attr("disabled", "disabled");
        $(".bt2").removeAttr("disabled");
    });

    $(".bt2").click(function () {
        $(this).attr("disabled", "disabled");
        $(".bt1").removeAttr("disabled");
    });
});*/

var theParent = document.getElementById('theDude');
theParent.addEventListener('click', changeStatus, false);

function changeStatus(e) {
    if (e.target !== e.currentTarget) {
        var clickedItem = e.target.id;
        $(clickedItem).attr("disabled", "disabled");
    }
    e.stopPropagation();
}