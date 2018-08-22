/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

import './bootstrap';
import initSortingForProfile from './my_modules/sortPaginationProfilePosts'
import profileFollowFunctions from './my_modules/profileFollowFunctionallies'
import init from './my_modules/init'
import feed from './my_modules/vue/infiniteScrollHome'
// import post from './my_modules/social/postFunctionalities'
import followRequestsFunctionality from './my_modules/social/followRequestsFunctionality'
// import seeFollowersFunctionality from './my_modules/social/seeFollowersFunctionality'
// import seeFollwoingFunctionality from './my_modules/social/followingFunctionality'
import generalSocialFun from './my_modules/social/generalSocialFun'
import postFunctions from './my_modules/social/postFunctionalities'
import wishes from './my_modules/social/wishes'
import * as particle from './lib/particles'
import sendExchangeRequestInit from './my_modules/social/sendExchangeRequest'
import exchangeRequestsInit from './my_modules/exchangeRequests'
/**
  * Created by LT on 19/05/2018.
*/

// init function should always run before anything so the website won't appear frozened
// execute before the page load ( for slow images )
// so the user can comment before the images loads 
// in case they take long time
// This is AN IFFE
(()=>{
    if ($("#post").length) postFunctions()
    $('.sidenav').sidenav()
    // if($('img').length) handleImageLoading()
    handleImageLoading()
})()

// execute when the page loads
window.onload = () => {
    init()
    if ($("#feed").length) feed()
    if($('#sortPostsUserProfile').length) initSortingForProfile()
    if($("#followingRequests").length) approveDeclineFollow()
    // if the image did not load  (Broken Image Handling)
    if($("#whishedPosts").length) deleteAWish()
    if($('img').length) handleImageLoading()
    if($("#profile").length) profileFollowFunctions()
    followRequestsFunctionality()
    if( $("#welcomePage").length){
        particlesJS.load('particles-js','./json/wlecome', () => {
            
        })
    } else if($("#registerPage").length){
        particlesJS.load('particles-js','./json/register', () => {
            
        })
    } else if($("#loginPage").length){
        particlesJS.load('particles-js','./json/login', () => {
            
        })
    }
    if ($("#post").length) {
        sendExchangeRequestInit()
    }
    $('.peopleYouAreFollowingModalTrigger').click(()=>{
        generalSocialFun(
            '/user/following',
            'seeFollowingModal',
            'modalSection-following',
            'followingNumberModal',
            'getpeopleYouAreFollowingNumber',
            'following'
        )
    })
    $('.followersModalTrigger').click(()=>{
        generalSocialFun(
            '/user/followers',
            'seeFollowersModal',
            'modalSection-followers',
            'followersNumberModal',
            'getFollowersNumber',
            'followers'
        )
    })
    $('.wishesModalTrigger').click(()=>{
        wishes()
    })
    if($("#exchangeRequestsPage").length) exchangeRequestsInit()
}


// This is lexical scoping, which describes how a parser resolves variable names when functions are nested. 
// The word "lexical" refers to the fact that lexical scoping uses the location where a variable is declared
//  within the source code to determine where that variable is available.
// Nested functions have access to variables declared in their outer scope.

// TODO delete the outer function
function handleImageLoading(){
    // TODO add event listners to do this
    const  brokenImageHandling = (image) => {
        image.src = "/images/404.png"
        // $('.faildToLoadImage').show()
        removeLoader()
    }
    
    const  removeLoader = () => {
        $(".imageLoader").hide()
    }
    // removeSpecificLoader = (id) => $(`.imageLoader${id}`).hide()
}

// TODO delete the outer function
const deleteAWish = () =>{
    const deleteWish = id => { // deleteWish() inner function, a closure
        axios.post(`/user/delete-wished-post/${id}`, {
            id:id
        }).then(res => {
            $(`#${id}`).fadeOut()
            iziToast.success({
                title: 'OK',
                message: res.data.success
            })
        }).catch(() => {
            iziToast.error({
                title: 'OK',
                message: "Something went wrong!"
            })
        })
    }
}


