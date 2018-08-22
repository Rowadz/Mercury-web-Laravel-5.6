export default function init  () {
    AOS.init()
    if($('.mainResgister').length) initSignUp()
    $('.tooltipped').tooltip()
    $('.fixed-action-btn').floatingActionButton()
    $('.materialboxed').materialbox()
    scrollToTop()
    overFlowDropDownMenu()
    $('.modal').modal()
    $('.parallax').parallax()
    $('select').formSelect()
    M.FloatingActionButton.init($('.fixed-action-btn'), {
      direction: 'top',
      hoverEnabled: false
    })
}

function overFlowDropDownMenu(){
    $(".dropdown-trigger").dropdown({
        constrainWidth: false,
        onCloseStart : () => {
            $('.card').css('z-index', 1)
            $('.card-title').css('z-index', 1)
            $('.postImage').css('z-index', 1)
            $('.parallax-container').css('z-index', 1)
            $('.collection').css('z-index', 1)
        },
        onOpenStart: () => {
                $('.card').css('z-index',-1)
                $('.chip').css('z-index', 1)
                $('.postImage').css('z-index', -1)
                $('.parallax-container').css('z-index', -1)
                $('.collection').css('z-index', -1)
        }
    })
}

function scrollToTop(){
    $('#scrollTop').click(()=>{
        $('html, body').animate({
            scrollTop: $("#scrollTopFinalDest").offset().top
        }, 1000);
    })
}

function initSignUp(){
    $('select').formSelect()
    $('.datepicker').datepicker()
}