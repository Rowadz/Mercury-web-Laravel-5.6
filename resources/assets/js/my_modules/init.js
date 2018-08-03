export default function init  () {
    AOS.init()
        // if ($("#userNameForCheckNewFollowers").length) checkForFollowers()
    
   
    $('.sidenav').sidenav()
    // init the navbar
    $(".dropdown-trigger").dropdown({
        constrainWidth: false,
        onCloseStart : () => {
            $('.card').css('z-index', 1)
            $('.card-title').css('z-index', 1)
            $('.postImage').css('z-index', 1)
            $('.parallax-container').css('z-index', 1)
        }
    })
    if($('.mainResgister').length) initSignUp()
    $('.tooltipped').tooltip()
    $('.fixed-action-btn').floatingActionButton()
    $('.materialboxed').materialbox()
    clickStuff()
    overFlow()
    $('.modal').modal()
    $('.parallax').parallax()
    $('select').formSelect()
}




const overFlow = () => {
    // the li that opens the dropdown list in the navbar
    $("#fixOverFlowIssue").click(()=>{
        $('.card').css('z-index',-1)
        $('.chip').css('z-index', 1)
        $('.postImage').css('z-index', -1)
        $('.parallax-container').css('z-index', -1)
    })
}
const clickStuff = () => {
    $('#scrollTop').click(()=>{
        $('html, body').animate({
            scrollTop: $("#feed").offset().top
        }, 1000);
    })
}

const initSignUp = () => {
    $('select').formSelect()
    $('.datepicker').datepicker()
}

