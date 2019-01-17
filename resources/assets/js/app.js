import './bootstrap';
import initSortingForProfile from './my_modules/sortPaginationProfilePosts';
import profileFollowFunctions from './my_modules/profileFollowFunctionallies';
import init from './my_modules/init';
import feed from './my_modules/vue/infiniteScrollHome';
import followRequestsFunctionality from './my_modules/social/followRequestsFunctionality';
import generalSocialFun from './my_modules/social/generalSocialFun';
import postFunctions from './my_modules/social/postFunctionalities';
import wishes from './my_modules/social/wishes';
// eslint-disable-next-line no-unused-vars
import * as particles from './lib/particles';
import sendExchangeRequestInit from './my_modules/social/sendExchangeRequest';
import exchangeRequestsInit from './my_modules/exchangeRequests';
import register from './my_modules/auth/register';
import home from './my_modules/home';
import initSearch from './my_modules/searchPage';
import reviewInit from './my_modules/social/reviewFunctionality';
import notifications from './my_modules/realTime/notifications';
import io from 'socket.io-client';
import initAddPost from './my_modules/posts/addPost';
import initChat from './my_modules/chat/initChat';
import {
  subscribeToOpensUserRoom
} from './my_modules/chat/realTimeRoom/trRoom';
import {
  profileMessageInit
} from './my_modules/chat/profile/profileStartChat';
// init function should always run before anything so the website won't appear frozened
// execute before the page load ( for slow images )
// so the user can comment before the images loads 
// in case they take long time
// This is AN IFFE
(() => {
  if ($('#post').length) postFunctions(io);
  notifications(io);
  $('.sidenav').sidenav();
})();

/** 
 * this will run before window.onload
 */
document.addEventListener('DOMContentLoaded', () => {
  if ($('#registerForm').length) register();
  $('.dropdown-trigger-filter').dropdown();
  initSearch();
  reviewInit();
  init();
  home();
  if ($('#feed').length) feed();
  if ($('#addPost').length) initAddPost();
  if ($('#chat').length) initChat(io);
  else localStorage.removeItem('userChat');
  subscribeToOpensUserRoom($('#authUserIdForNotify').val(), io);
  if ($('#messageFromProfileTrigger').length) profileMessageInit();
});

/** 
 * this function will run after the page loaded! .
 * in many browsers, the window.onload event is not triggered until all images have loaded
 */

window.onload = () => {
  if ($('#sortPostsUserProfile').length) initSortingForProfile();
  // if the image did not load  (Broken Image Handling)
  if ($('#profile').length) profileFollowFunctions();
  followRequestsFunctionality();
  /*eslint no-undef: */
  if ($('#welcomePage').length) particlesJS.load('particles-js', './json/wlecome', () => {});
  else if ($('#registerPage').length) particlesJS.load('particles-js', './json/register', () => {});
  else if ($('#loginPage').length) particlesJS.load('particles-js', './json/login', () => {});
  if ($('#post').length) sendExchangeRequestInit();
  $('.peopleYouAreFollowingModalTrigger').click(() => {
    generalSocialFun(
      '/user/following',
      'seeFollowingModal',
      'modalSection-following',
      'followingNumberModal',
      'getpeopleYouAreFollowingNumber',
      'following'
    );
  });
  $('.followersModalTrigger').click(() => {
    generalSocialFun(
      '/user/followers',
      'seeFollowersModal',
      'modalSection-followers',
      'followersNumberModal',
      'getFollowersNumber',
      'followers'
    );
  });
  $('.wishesModalTrigger').click(() => {
    wishes();
  });
  if ($('#exchangeRequestsPage').length) exchangeRequestsInit();
};
