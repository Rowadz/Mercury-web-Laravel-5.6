	// the code here is not loaded 
	// just to return here if anything go wrong
	// the smae code is now in the app.js file
	// under the approveDeclineFollow function



$(document).ready(()=>{
	const approveEndPoint = "/approve/follow"
	const declineEndPoint = "/decline/follow"
	const xcsrfHeaders = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	
	approve = id =>{
		$.ajax({
			url : approveEndPoint,
			data: {
				id: id
			},
			method: "POST",
			headers: xcsrfHeaders
		}).done(res => {
			if(res === "Approved!"){
					iziToast.success({
						title: 'Success',
						message: res,
					})
			}else{
				iziToast.error({
					title: 'Error',
					message: `${res} 🤷`,
				})
			}
			let followCard = $(`#followCard${id}`)
			followCard.hide()
		})
		.fail(err => {
			iziToast.error({
    			title: 'Error',
    			message: 'Something Went Wrong 🤷',
			})
		})
	}

	decline = id => {
		$.ajax({
			url : declineEndPoint,
			data: {
				id: id
			},
			method: "POST",
			headers: xcsrfHeaders
		}).done(res => {
			iziToast.success({
    			title: 'Success',
    			message: res,
			})
			let followCard = $(`#followCard${id}`)
			followCard.hide()
		})
		.fail(err => {
			iziToast.error({
    			title: 'Error',
    			message: 'Something Went Wrong 🤷',
			})
		})
	}

})