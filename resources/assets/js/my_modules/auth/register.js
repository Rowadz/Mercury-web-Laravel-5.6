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
	// nameValidate(M);
	// emailValidation(M);
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


function disableButton(){
	const registerButton = $('#registerButton');
	addClass(registerButton, 'disabled');
}

function enableButton(){
	const registerButton = $('#registerButton');
	removeClass(registerButton, 'disabled');
}