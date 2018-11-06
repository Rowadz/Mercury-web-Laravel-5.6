/*eslint no-console: */
export default function reviewInit() {
    // select this data-usertoreview="2"
    console.log(123);
    $('.emotionsReview').on('click', function () {
        const userId = $(this).attr('data-usertoreview');
        const type = $(this).attr('data-type');
        addReview(userId, type);
    });
}

function addReview(userId, type){
    fetch('/addReview', {
        method: 'POST',
        body: JSON.stringify({userId, type}),
    }).then(res => console.log(res))
      .catch(err => console.log(err));
}

