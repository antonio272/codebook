<template>
    <div>


        <button class="btn btn-primary ml-4" @click="CommentPost" v-text="buttonComment">Commentbutton</button>



    </div>
</template>

<script>
    export default {

        props: ['postId', 'commentario'],


        mounted() {
            console.log('Component mounted.')
        },

        data:function () {
            return{
                status :this.commentario,
            }
        },/**/

        methods: {
            CommentPost(){
                axios.post('/comment/' + this.postId) 
                    .then(response => {
                        this.status = !this.status;
                        //alert(response.data);
                    })
                    .catch(errors =>{
                        if(errors.response.status == 401) {
                            window.location = '/login'
                        }
                    });/**/
                    
                }
            },

        computed : {
            buttonComment() {
                
            }

        }/**/
    }
</script>
