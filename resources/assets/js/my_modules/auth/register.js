/*eslint no-console: */
/**
 *
 * where every thing starts !
 * @export
 */
export default function init() {
  disableButton();
  let ableTosubmit = {
    email: false,
    date: true,
    password: false,
    user: false // name
  };
  const M = window.M;
  const inputNames = ['name', 'email'];
  inputNames.forEach(name => validation(name, M, ableTosubmit));
  validatePassword(ableTosubmit);
  const datePicker = $('.datepicker');
  $('select').formSelect();
  validateDate(datePicker, M, ableTosubmit);
}

/**
 *
 *
 * @param { string } name
 * @param { materializecss } M
 */
function validation(name, M, ableTosubmit) {
  const input = $(`#${name}`);
  const route = getRoute(name);
  input.blur(() => {
    if (input.val().trim() === '') {
      M.toast({
        html: `You can't have empty ${name}`
      });
    } else {
      fetch(`/register/${route}/${input.val().trim()}`)
        .then(res => res.json())
        .then(res => {
          if (res.message.indexOf('✔️') > -1) {
            addClass(input, 'valid');
            removeClass(input, 'invalid');
            M.toast({
              html: res.message
            });
            ableTosubmit[route] = true;
            enableButton(ableTosubmit);
          } else {
            addClass(input, 'invalid');
            removeClass(input, 'valid');
            M.toast({
              html: res.message
            });
            ableTosubmit[route] = false;
          }
        })
        .catch(err => {
          M.toast({
            html: 'Something went wrong, while checking the name'
          });
          console.error(err);
        });
    }
  });
}

/**
 *
 * look in the web.php to see how this works !
 * @param { string } inputName
 * @returns { string }
 */
function getRoute(inputName) {
  switch (inputName) {
    case 'name':
      return 'user';
    case 'email':
      return 'email';
  }
}

/**
 *
 * * el => HTML element
 * @param {*} el
 * @param { string } className
 */
function addClass(el, className) {
  el.addClass(className);
}

/**
 *
 * * el => HTML element
 * @param {*} el
 * @param { string } className
 */
function removeClass(el, className) {
  el.removeClass(className);
}


function validatePassword(ableTosubmit) {
  const passwordInput = $('#password');
  const passwordConfirm = $('#password-confirm');
  const passwordConfirmHelper = $('#password-confirm-helper');
  const inputs = [passwordInput, passwordConfirm];
  inputs.forEach(el => {
    el.blur(() => {
      if (passwordInput.val() !== passwordConfirm.val() && (passwordInput.val() !== '')) {
        addClass(passwordInput, 'invalid');
        addClass(passwordConfirm, 'invalid');
        addClass(passwordConfirmHelper, 'red-text');
        removeClass(passwordConfirmHelper, 'white-text');
        ableTosubmit.password = false;
      } else {
        removeClass(passwordInput, 'invalid');
        removeClass(passwordConfirm, 'invalid');
        removeClass(passwordConfirmHelper, 'red-text');
        addClass(passwordConfirmHelper, 'white-text');
        ableTosubmit.password = true;
        enableButton(ableTosubmit);
      }
    });
  });
}

/**
 *
 *
 * @param {*} datePicker
 */
function validateDate(datePicker, M, ableTosubmit) {
  const DOB = $('#date-of-birth');
  datePicker.datepicker({
    maxDate: new Date('2000-12-30'),
    minDate: new Date('1970-1-1'),
    defaultDate: new Date('1990-1-1'),
    showClearBtn: true,
    onClose: () => {
      const ageMS = Date.parse(Date()) - Date.parse(datePicker.val());
      const age = new Date();
      age.setTime(ageMS);
      const ageYear = age.getFullYear() - 1970;
      if (ageYear < 18) {
        addClass(DOB, 'invalid');
        removeClass(DOB, 'valid');
        M.toast({
          html: 'You should at least be 18 years old'
        });
        ableTosubmit.date = false;
      } else {
        enableButton(ableTosubmit);
        ableTosubmit.date = true;
        addClass(DOB, 'valid');
        removeClass(DOB, 'invalid');
      }
    }
  });
}

function disableButton() {
  const registerButton = $('#registerButton');
  addClass(registerButton, 'disabled');
}

function enableButton(ableTosubmit) {
  const {
    user,
    email,
    password,
    date
  } = ableTosubmit;
  if (user && email && password && date) {
    const registerButton = $('#registerButton');
    removeClass(registerButton, 'disabled');
  }
}
