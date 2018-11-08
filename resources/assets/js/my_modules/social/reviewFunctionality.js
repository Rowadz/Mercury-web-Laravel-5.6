/*eslint no-console: */
export default function reviewInit() {
    let typeObj = {
        type: ''
    };
    // select this data-usertoreview="2"
    $('.emotionsReview').on('click',  e => {
        const $this = $(e.currentTarget);
        const userId = $this.attr('data-usertoreview');
        const type = $this.attr('data-type');
        // TODO swtich between these ~ if the user changed his/her mind
        $this.css('opacity', 0.1);
        typeObj.type = type;
        addReview(userId, type);
    });
    $('.reviewButtonSubmit').on('click', e => {
        const $this = $(e.currentTarget);
        validateReviewForm($this.attr('data-addreviewtouser'), typeObj);
    });
}

function addReview(userId, type){
    fetch('/addReview', {
        method: 'POST',
        body: JSON.stringify({userId, type}),
    }).then(res => console.log(res))
      .catch(err => console.log(err));
}

function validateReviewForm(id, typeObj) {
  const M = window.M;
  const inputHeader = $(`[data-inputHeader="${id}"]`);
  const inputbody = $(`[data-inputbody=${id}]`);
  const inputHeaderVal = inputHeader.val().trim();
  const inputbodyVal = inputbody.val().trim();
  if (!inputbodyVal) {
    inputbody.addClass(['invalid', 'animated jello']);
    M.toast({
        html: 'You can\'t have empty body to the review',
        classes: ' red lighten-1',
        displayLength: 1000
      });
  } else inputbody.removeClass('invalid');
  if (!inputHeaderVal) {
    inputHeader.addClass(['invalid', 'animated jello']);
    M.toast({
        html: 'You can\'t have empty header to the review',
        classes: ' red lighten-1',
        displayLength: 1000
      });
  } else inputHeader.removeClass('invalid');

  if(!typeObj.type) $(`.emotionsReview[data-usertoreview="${id}"]`).addClass('animated jello');
  if(['sad', 'happy', 'angry'].indexOf(typeObj.type) > -1 && inputbodyVal && inputHeaderVal){
    // TODO send request now !
    console.log('%cValid', 'color:green; font-size:50px;');
  }
}
