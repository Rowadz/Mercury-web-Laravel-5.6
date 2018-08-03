export default function post(){
    // added addPostToWishList outside the Vue instance because 
    // Some wired Error 
     $('#addToWishListButton').click(()=>{
        addPostToWishList($("#addToWishListButton").attr('class'))
     })
     const addPostToWishList = id => {
        axios.post(`/post/add-to-wish-list/${id}`, {
            id: id
        }).then(res => {
            // console.log(res.data)
            let addToWishListButton = $("#addToWishListButton")
            addToWishListButton.addClass("disabled")
            addToWishListButton.html(`<i class="bookmark icon"></i> `)
            $("#addToWishListText").html("The post Added to your wish list")
            M.toast({
                html: res.data.message,
                classes: (res.data.message === "You just saved this post !") ?  'light-blue darken-3' :  'deep-purple darken-2'
            })
        })
            .catch(err => {
                M.toast({
                    html: 'Something went wrong',
                    classes: 'red accent-3'
                })
            })
    }


    const post = new Vue({
        el: "#post",
        data: {
            postId: $("#postId").val(),
            loadedComments: null,
            comment: ''
        },
        methods: {
            // Vue Two way binding did't work with the emoji lib.
            // this is why is use jquery here!
            addComment(){
                let comment = this.comment
                let userName = $("#userName").val()
                let userImage = $("#userImage").val()
                if (comment.length === 0 || comment.trim().length === 0) {
                    M.toast({
                        html: 'Add Some Text, NO white space!',
                        classes: 'red accent-1'
                    })
                } else {
                    comment = comment.trim()
                    userName = userName.trim()
                    userImage = userImage.trim()
                    comment = comment.replace(/(<([^>]+)>)/ig,"")
                    userName = userName.replace(/(<([^>]+)>)/ig,"")
                    userImage = userImage.replace(/(<([^>]+)>)/ig,"")
                    
                    axios.post(`/post/${this.postId}/addComment`, {
                        comment: comment,
                        postId: this.postId
                    }).then(res => {
                        M.toast({
                            html: res.data.message,
                            classes: 'blue accent-2'
                        })
                        $("#addMoreCommentsHere").append(`
                        <div class="col s12 m6" data-aos="zoom-in">
                            <ul class="collection">
                                <li class="collection-item avatar  z-depth-5 white-text blue-grey darken-3">
                                <img src="${userImage}" alt="user image" class="circle  z-depth-5">
                                    <span class="title">
                                        <strong class="usernameComment">
                                            🐻  ${ userName } 
                                        </strong>
                                    </span>
                                    <p> 
                                        <small class="commentDate">
                                            📆 Just now!
                                        </small>
                                    <br><br>
                                            ${ comment }
                                    </p>
                                    <a href="/${userName}" class="secondary-content"><i class="material-icons">person_outline</i></a>
                                </li>
                            </ul>
                        </div>
                        `)
                        this.comment = ''
                    }).catch(err => {
                        M.toast({
                            html: 'Something went wrong, try again',
                            classes: 'red accent-2'
                        })
                    })
                }
                //console.log({comment: $("#commentTextarea").val(), postId: this.postId})
            },
        },

    })
}