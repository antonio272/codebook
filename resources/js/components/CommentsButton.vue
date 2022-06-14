<template>
    <div>
        <form action="" @submit.prevent="submitComment">
            <div>
                <div>
                    <textarea name="commentario" id="commentario" cols="30" rows="5" v-model="commentario"></textarea>
                </div>
                <button type="submit">Submit</button>
            </div>
        </form>
        <div v-for="commentario in commentarios" :key="commentario.id" class="mb-4">
            {{ commentario.commentario }}
        </div>
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
            commentarios: [],
            commentario: ''
        }
    },
    methods: {
        submitComment() {
            axios.post('/commentarios/' + this.postId, {
                commentario: this.commentario
            })
                .then(response => {
                    console.log(response.data)
                    this.commentarios.push(response.data)
                })
        }
    }
}
</script>