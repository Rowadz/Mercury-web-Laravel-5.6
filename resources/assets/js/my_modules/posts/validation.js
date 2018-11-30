// eslint-disable-next-line no-unused-vars
import validate from 'jquery-validation';



function initValidation() {
  $('#addPostForm').validate({
    onkeyup: () => $('#addPostForm').valid() ? $('#submitAddPost').removeAttr('disabled') : $('#submitAddPost').attr('disabled', 'disabled'),
    rules: {
      header: {
        required: true
      },
      body: {
        required: true
      },
      location: {
        required: true
      },
      quantity: {
		required: true,
		min:1,
		max:100
      },
      image1: {
        required: true
      },
      tag: {
        required: true
      }
    }
  });
}


export {
  initValidation
};
