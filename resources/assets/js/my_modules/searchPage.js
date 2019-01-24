export default function initSearch() {
  const inputSearch = $('#moh-search');
  const buttonSearch = $('#moh-go');
  buttonSearch.click(() => {
    window.location = `/posts/search/cus?q=${inputSearch.val()}`;
  });
}
