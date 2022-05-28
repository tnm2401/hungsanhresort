$(function () {
    // Scroll Menu
    // Show Modal Guest Response

    $(window).on("scroll",function () {
        if($(document).scrollTop() > 50)
        {
            $("#header").addClass("active ");

        }
        else{
            $("#header").removeClass("active ");

        }
    });
$(".navbar-toogle").on("click", function() {
    $(".menu_toogle").slideToggle(200);

})
$(".dropmenumobile span").on("click", function() {
    $(this).nextAll().toggleClass("active");

})

    // Show Guest

    $("#guest").on("click",function () {
        $("#listGuest").toggleClass("active");
    });
    $("#closeG").on("click",function () {
        $("#listGuest").removeClass("active");
    });


    // Get So Luong

    const pluss = $(".plus");
    const minuss = $(".minus");
    const soPersons = $(".soPerson");
    const soPerson = $(".soPersons");

    const obj = {

    };

    console.log(soPersons)
    $.each(pluss, function (i, item) {
         obj[`num${i}`] = 1;
        $(item).on("click", function () {
            const typeObject = $(this).parent().data().person;

            obj[`num${i}`]++;

             $(soPerson[i]).html(obj[`num${i}`]);
             $(soPersons[i]).val(obj[`num${i}`]);


            $("#personMain").html(sum(obj));
            $("#guest").val(sum(obj));
         });
    });
    $.each(minuss, function (i, item) {
        $(item).on("click",function(){
            const typeObject = $(this).parent().data().person;

           if(obj[`num${i}`] > 0)
           {
               obj[`num${i}`]--;
            }

            $(soPerson[i]).html(obj[`num${i}`]);
            $(soPersons[i]).val(obj[`num${i}`]);


           $("#personMain").html(sum(obj));
           $("#guest").val(sum(obj));

        });
   });

});
//$("#form-book").submit(function (e) {
//    e.preventDefault();
//    console.log($(this).serializeArray());
//});
//$.each(pluss, function (i, item) {
//    obj[`num${i}`] = 1;
//    $(item).on("click", function () {

//        const typeObject = $(this).parent().data().person;

//        obj[`num${i}`]++;

//        $(`#${typeObject}`).html(obj[`num${i}`]);
//        $(`#${typeObject}`).val(obj[`num${i}`]);
//        $("#personMain").html(sum(obj));
//        $("#guest").val(sum(obj));
//    });
//});
//$.each(minuss, function (i, item) {
//    $(item).on("click", function () {
//        const typeObject = $(this).parent().data().person;
//        if (obj[`num${i}`] > 0) {
//            obj[`num${i}`]--;
//        }
//        $(`#${typeObject}`).html(obj[`num${i}`]);
//        $(`#${typeObject}`).val(obj[`num${i}`]);
//        $("#personMain").html(sum(obj));
//        $("#guest").val(sum(obj));

//    });
//});
//});


$(function () {
    $("#from-date").on("change",function (){
        const d = new Date($(this).val());
        const dateFrom = d.toLocaleString("en-US",{
            dateStyle : "long",
        });
        let arrDate = dateFrom.split(" ");

        console.log(arrDate);
        $(this).next().find(".day").html(arrDate[1]);
        $(this).next().find(".month").html(arrDate[0]);
        $(this).next().find(".year").html(arrDate[2]);
    });
    $("#to-date").on("change",function (){
        const d = new Date($(this).val());
        const dateFrom = d.toLocaleString("en-US",{
            dateStyle : "long",
        });

        let arrDate = dateFrom.split(" ");

        console.log(arrDate);


        $(this).next().find(".day").html(arrDate[1]);
        $(this).next().find(".month").html(arrDate[0]);
        $(this).next().find(".year").html(arrDate[2]);
    });


    //$("#bookNow").on("click",function(e){
    //    e.preventDefault();
    //    console.log($("#from-date").val(),$("#to-date").val(),$("#guest").val());
    //    console.log($("#adults").text(),$("#children").text(),$("#infants").text());
    //});


});
function sum(obj) {
    return Object.values(obj).reduce((acc,item)=>{
        return acc + item;
    },0)
}






 $(function(){
    const tabLinks = $(".facility__menu .tab_links a");
    const tabContents = $(".facility__menu .tab_content .tab_item");
    $.each(tabLinks, function (i, item) {
         $(item).on("click",function(e){
            e.preventDefault();
            removeActive(tabLinks);
            removeActive(tabContents);
            const dataId = $(this).attr("data-id");
            $(this).addClass("active");
            $(`#${dataId}`).addClass("active");
         });
    });
 });

 function removeActive(list) {
     for(let i = 0 ; i < list.length;i++)
     {
         list[i].classList.remove("active");
     }
    }
$(".stretcher-item").mouseenter(function() {
    $(this).addClass("active");
    $(this).next().addClass("inactive");
    $(this).prev().addClass("inactive");
    $(".stretcher-item.more").removeClass("inactive");

})

$(".stretcher-item").mouseleave(function() {
    $(this).removeClass("active");
    $(this).next().removeClass("inactive");
    $(this).prev().removeClass("inactive");

})
$(".stretcher-item").eq(3).mouseenter(function() {
    $(this).addClass("active");
    $(this).prevUntil().addClass("inactive");
})
$(".stretcher-item").eq(4).mouseenter(function() {
    $(this).addClass("active");
    $(this).prevUntil().addClass("inactive");
})
$(".stretcher-item").eq(3).mouseleave(function() {
    $(this).removeClass("active");
    $(this).prevUntil().removeClass("inactive");
})
$(".stretcher-item").eq(4).mouseleave(function() {
        $(this).removeClass("active");
        $(this).prevUntil().removeClass("inactive");
    })


$("figure").mouseenter(function() {
    $(this).addClass("active");
})
$("figure").mouseleave(function() {
    $(this).removeClass("active");
})

// end hover activite
// hover team
$(".teamimage").mouseenter(function() {
    $(this).addClass("active").siblings().removeClass("active");
})
