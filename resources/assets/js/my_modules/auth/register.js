/*eslint no-console: */
/**
 *
 * where every thing starts !
 * @export
 */
export default function init(){
	const M = window.M;
	const inputNames = ['name', 'email'];
	inputNames.forEach(name => validation(name, M));
	validatePassword();
	const datePicker = $('.datepicker');
	$('select').formSelect();
	validateDate(datePicker, M);
}

/**
 *
 *
 * @param { string } name
 * @param { materializecss } M
 */
function validation(name, M){
	const input = $(`#${name}`);
	const route = getRoute(name);
	input.blur(() => {
		if(input.val().trim() === '') {
			M.toast({html: `You can't have empty ${name}`});
		}else {
			fetch(`/register/${route}/${input.val().trim()}`)
				.then(res => res.json())
				.then(res => {
					if(res.message.indexOf('✔️') > -1){
						addClass(input, 'valid');
						removeClass(input, 'invalid');
						M.toast({html: res.message});
					} else {
						addClass(input, 'invalid');
						removeClass(input, 'valid');
						M.toast({html: res.message});
					}
				})
				.catch(err => {
					M.toast({html: 'Something went wrong, while checking the name'});
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
function getRoute(inputName){
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
function addClass(el, className){
	el.addClass(className);
}

/**
 *
 * * el => HTML element
 * @param {*} el
 * @param { string } className
 */
function removeClass(el, className){
	el.removeClass(className);
}


function validatePassword(){
	const passwordInput = $('#password');
	const passwordConfirm = $('#password-confirm');
	const passwordConfirmHelper = $('#password-confirm-helper');
	const inputs = [passwordInput, passwordConfirm];
	inputs.forEach(el => {
		el.blur(() => {
			if(passwordInput.val() !== passwordConfirm.val()){
				addClass(passwordInput, 'invalid');
				addClass(passwordConfirm, 'invalid');
				addClass(passwordConfirmHelper, 'red-text');
				removeClass(passwordConfirmHelper, 'white-text');
			} else {
				removeClass(passwordInput, 'invalid');
				removeClass(passwordConfirm, 'invalid');
				removeClass(passwordConfirmHelper, 'red-text');
				addClass(passwordConfirmHelper, 'white-text');
			}
		});
	});
}

/**
 *
 *
 * @param {*} datePicker
 */
function validateDate(datePicker, M){
	const DOB = $('#date-of-birth');
	datePicker.datepicker({
		maxDate : new Date(),
		minDate: new Date('1970-1-1'),
		defaultDate: new Date('1990-1-1'),
		showClearBtn: true,
		onClose: () => {
			const ageMS = Date.parse(Date()) - Date.parse(datePicker.val());
			const age = new Date();
			age.setTime(ageMS);
			const ageYear = age.getFullYear() - 1970;		  
			if(ageYear < 18) {
				addClass(DOB, 'invalid');
				removeClass(DOB, 'valid');
				M.toast({html: 'You should at least be 18 years old'});
			}
			else {
				addClass(DOB, 'valid');
				removeClass(DOB, 'invalid');
			}
		}
	});
}
// function disableButton(){
// 	const registerButton = $('#registerButton');
// 	addClass(registerButton, 'disabled');
// }

// function enableButton(){
// 	const registerButton = $('#registerButton');
// 	removeClass(registerButton, 'disabled');
// }