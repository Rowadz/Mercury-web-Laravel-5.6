// calling the infinite scroll in the home
// using Vue
export default function feed () {
    const x = new Vue({
        el: "#feed",
        data: {
            posts: [],
            lastId: $("#lastId").val(),
            counter : 0,
            commentNumber : [],
            tagNames: [],
            users: [],
            imageLocation: []
        },
        methods: {
            brokenImageHandling(image){
                image.src = "/images/404.png"
                // $('.faildToLoadImage').show()
                this.removeLoader()
            },
            removeLoader(){
                $(".imageLoader").hide()
            },
            removeSpecificLoader(id){
                console.log(`imageLoader${id}`)
                $(`.imageLoader${id}`).hide()
            },
            loadMorePosts(){
                // console.log('@click="loadMorePosts')
                $("#dimmerHere").addClass('disabled')
                $("#dimmerHere").html(`
                        <div class="preloader-wrapper big active">
                        <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div><div class="gap-patch">
                            <div class="circle"></div>
                        </div><div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                        </div>
                    </div>
                `)
                $('#dimmerImage').removeClass(`scale-out`)
                $('#dimmerImage').removeClass(`scale-in`)
                $('#dimmerImage').addClass(`scale-out`)
                let url = null
                if($("#feedNoAuth").length)  url = '/show/all/postsNoAuth'
                else if($('#profile').length) url = '/show/user/posts/profile'
                else  url = '/home/loadMorePosts'
                axios.post(url, {
                    lastId: this.lastId,
                    userId : ($('#userIdProfile').length) ? $('#userIdProfile').val() : null
                })
                    .then((response) => {
                        $("#dimmerHere").html("More")
                        $("#dimmerHere").removeClass('disabled')
                        //console.log(typeof (response.data.posts))
                        let allPosts = response.data.posts
                        let x = allPosts.length
                        for(let i = 0; i < x; i++) this.posts.push(allPosts[i])
                        // console.log(this.posts)
                        let allCommentNumber = response.data.commentNumber
                        x = allCommentNumber.length
                        for(let i = 0; i < x; i++) this.commentNumber.push(allCommentNumber[i])
                        //this.commentNumber = response.data.
                        let allTagsNames = response.data.tagNames
                        x =  allTagsNames.length
                        for(let i = 0; i < x; i++) this.tagNames.push(allTagsNames[i])
                        let users = response.data.users
                        x =  users.length
                        for(let i = 0; i < x; i++) this.users.push(users[i])
                        //this.tagNames = response.data.tagNames
                        let imageLocation = response.data.imageLocation
                        x = imageLocation.length
                        for(let i = 0; i < x; i++) this.imageLocation.push(imageLocation[i])
                        this.lastId = allPosts[allPosts.length -1 ].id
                        //console.log(this.lastId)
                        $('#dimmerImage').attr("src", "/images/returnHome.png")
                        let audio = new Audio('/sounds/service-bell_daniel_simion.mp3')
                        $('#dimmerImage').addClass(`
                             scale-in
                        `)
                        audio.play()
                    })
                    .catch((error) => {
                        console.log(error)
                        let audio = new Audio('/sounds/Lightsaber_Turn_Off.mp3')
                        audio.play()
                        $('#dimmerImage').attr("src", "/images/404.png")
                        $('#dimmerImage').addClass(`scale-in`)
                        $("#dimmerHere").html(`🤖`)
                    })
            }
        }
    })
}
