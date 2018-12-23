let messagesPagination = {
  current_page: 1,
  last_page: undefined,
  first_page_url: '/user/getChatNames?page=1',
  last_page_url: undefined,
  next_page_url: undefined,
  total: undefined
};

const mapMessagesPaginationPagination = obj => {
	for (const key in obj) {
		if (messagesPagination.hasOwnProperty(key)) {
		messagesPagination[key] = obj[key];
		}
	}
};

export {
  messagesPagination,
  mapMessagesPaginationPagination
};
