<template>
    <div>
        
    <button class="btn btn-primary ml-4" @click="CommentPost" type="submit">Submit</button>
           
    </div>
</template>


<script>
export default {
    props: ['postId'],
    mounted() {
        console.log('Component mounted.')
                
    },
    data() {
        return {
            
        }
    },
    methods: {
        CommentPost() {
            axios.post('/commentario/' + this.postId)
                .then(response => {
                        
                        alert(response.data);
            });
        }
    }
}
</script>
