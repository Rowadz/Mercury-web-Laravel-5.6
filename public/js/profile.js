$(document).ready(()=>{
	const xcsrfHeaders = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	const unFollowEndPoint = "/unFollow"
	unFollow = id =>{
		$("#unFollowButton").addClass("loading disabled")
		$.ajax({
			url: unFollowEndPoint,
			data: {
				id : id
			},
			method: "POST",
			headers: xcsrfHeaders
		})
		.done(res => {
			$("#unFollowButton").removeClass("loading")
			$("#unFollowButton").addClass("disabled")
		})
		.fail(err => {
			$("#unFollowButton").removeClass("loading disabled")
		})
	}
})