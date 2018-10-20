export default function initSortingForProfile(){
	// for page showUserPosts
	let x =  document.getElementById('sortingForm');
	let sortUrl = {
		sortOption: 'Descending',
		postsType: 'Available',
		formAction: (typeof(x) !== 'undefined' && x !== null) ? document.getElementById('sortingForm').action : null
	};
	$('#sortOption').change(()=>{
		let selectedOption = $('#sortOption option:selected').val();
		sortUrl.sortOption = selectedOption;
	});
	$('#postsType').change(()=>{
		let selectedOption = $('#postsType option:selected').val();
		sortUrl.postsType = selectedOption;
	});

	$('#sortPostsUserProfileButton').click(()=>{
		let sortingForm = document.getElementById('sortingForm');
		sortingForm.action = `${sortUrl.formAction}${sortUrl.sortOption}N${sortUrl.postsType}/`;
		sortingForm.submit();
	});

}
