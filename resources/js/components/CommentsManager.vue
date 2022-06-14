<template>
    <div>
        <h1>Hello World</h1>
    </div>
</template>
<script>
    export default {
        data: function() {
    return {
        comments: [
            {
                id: 1,
                body: "How's it going?",
                edited: false,
                created_at: new Date().toLocaleString(),
                author: {
                    id: 1,
                    name: 'Nick Basile',
                }
            }
        ]
    }
},
    }
</script>