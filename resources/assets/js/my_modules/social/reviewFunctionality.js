/*eslint no-console: */
import { applicationHeaders } from '../helpers/headers';
export default function reviewInit() {
    let typeObj = {
        type: ''
    };
    // select this data-usertoreview="2"
    $(document).on('click', '.emotionsReview' ,e => {
        const $this = $(e.currentTarget);
        const userId = $this.attr('data-usertoreview');
        const type = $this.attr('data-type');
        typeObj.type = type;
        switchNdisable(userId, typeObj);
    });
    $(document).on('click','.reviewButtonSubmit' ,e => {
        const $this = $(e.currentTarget);
        validateReviewForm($this.attr('data-addreviewtouser'), typeObj);
    });
}

function addReview(userId, type, header, body){
    const M = window.M;
    fetch('/addReview', {
        headers: applicationHeaders,
        method: 'POST',
        body: JSON.stringify({userId, type, header, body}),
    }).then(res => {
        if(res.status === 500)  throw new Error(res.error);
        return res.json();
    })
      .then(res => {
        $(`[data-divuser="${userId}"]`).fadeOut(200, () => M.toast({html: 'Sucess !'}));
        console.log(res);
      })
      .catch(err => {
        $(`.progress[data-userid=${userId}]`).replaceWith(`<button class="waves-effect waves-light btn floatRight grey darken-4 reviewButtonSubmit"data-addreviewtouser="${userId}">✅</button>`);
        M.toast({html: '🤯 Somehting went wrong, please try again later'});
        console.log(err);
      });
}

function validateReviewForm(userId, {type}) {
  const M = window.M;
  const inputHeader = $(`[data-inputHeader="${userId}"]`);
  const inputbody = $(`[data-inputbody=${userId}]`);
  const inputHeaderVal = inputHeader.val().trim();
  const inputbodyVal = inputbody.val().trim();
  if (!inputbodyVal) {
    inputbody.addClass(['invalid', 'animated jello']);
    M.toast({
        html: '🤯 You can\'t have empty body to the review U+1F92F',
        classes: ' cyan darken-4',
      });
  } else inputbody.removeClass('invalid');
  if (!inputHeaderVal) {
    inputHeader.addClass(['invalid', 'animated jello']);
    M.toast({
        html: '🤯 You can\'t have empty header to the review',
        classes: ' cyan darken-4',
      });
  } else inputHeader.removeClass('invalid');
  console.log(type);
  if(!type) {
    $(`.emotionsReview[data-usertoreview="${userId}"]`).addClass('animated jello');
    M.toast({
        html: '🤯 please select an image',
        classes: ' cyan darken-4',
      });
  }
  if(['sad', 'happy', 'angry'].indexOf(type) > -1 && inputbodyVal && inputHeaderVal){
    $(`.reviewButtonSubmit[data-addreviewtouser=${userId}]`).replaceWith(`<div class="progress" data-userid=${userId}><div class="indeterminate"></div></div>`);
    addReview(userId, type, inputHeaderVal, inputbodyVal);
    console.log('%cValid', 'color:green; font-size:50px;');
  }
}


function switchNdisable(userId, {type}){
    $(`.emotionsReview[data-usertoreview="${userId}"][data-type=${type}]`).css('opacity', 1);
    $(`.emotionsReview[data-usertoreview="${userId}"]:not([data-type=${type}])`).css('opacity', 0.1);
}
