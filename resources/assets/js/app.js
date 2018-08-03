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
import post from './my_modules/vue/postFunctionalities'
import followRequestsFunctionality from './my_modules/followRequestsFunctionality'
/**
  * Created by LT on 19/05/2018.
*/

// init function should always run before anything so the website won't appear frozened
// execute before the page load ( for slow images )
// so the user can comment before the images loads 
// in case they take long time
(()=>{
    if ($("#post").length) post()
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


