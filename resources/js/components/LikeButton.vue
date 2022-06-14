<template>
    <div>


        
        <!--<i class="fa fa-thumbs-o-up" @click="LikePost" v-text="buttonLike"></i>-->
        
        <!--<a @click="LikePost"> 
        <i :class="[likes ? 'fa fa-thumbs-o-up' : 'fa fa-thumbs-o-down', 'fa']"></i>
        </a>-->

        <a @click="LikePost"> 
        <i :class="buttonLike" style="font-size:24px; color: #E94040"></i>
        </a>
        
        
        

    </div>
</template>

<script>
    export default {

        props: ['postId', 'likes'/**/],


        mounted() {
            console.log('Component mounted.')
        },

        data:function () {
            return{
                status :this.likes,/**/
            }
        },

        methods: {
            LikePost(){
                axios.post('/like/' + this.postId) 
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

       /*computed : {
            buttonLike() {
                return (this.status) ? 'Unlike' : 'Like';
            }

        } */
       computed : {
            buttonLike() {
                return (this.status) ? 'fa fa-solid fa-heart' : 'fa fa-heart-o';
            }

        } /**/
    }
</script>
