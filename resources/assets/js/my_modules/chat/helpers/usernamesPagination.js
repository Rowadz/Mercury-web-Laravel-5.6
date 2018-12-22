let usernamesPagination = {
	current_page :1,
	last_page: undefined,
    first_page_url: '/user/getChatNames?page=1',
	last_page_url: undefined,
    next_page_url: undefined,
    total: undefined
};

const mapUsernamesPagination = obj => {
	for (const key in obj) {
		if (usernamesPagination.hasOwnProperty(key)) {
		usernamesPagination[key] = obj[key];
		}
	}
};

export {usernamesPagination, mapUsernamesPagination};