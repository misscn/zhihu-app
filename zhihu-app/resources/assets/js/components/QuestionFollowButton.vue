<template>
    <button
            class="btn btn-default"
            v-text="text"

    ></button>
</template>

<script>
    export default {
        //props: ['question', 'user'],
        props:['question'],
        mounted(){
            this.$http.Post('/api/question/follower',{'question':this.question}).then(response => {
                console.log(response.data);
            })
        },
//        mounted() {
//            this.$http.post('/api/question/follower', {'question': this.question, 'user': this.user}).then(response => {
//            //this.$http.post('/api/question/follower', {}).then(response => {
//                //this.followed = response.data.followed
//                console.log(response.data)
//            })
//        },

        data() {
            return {
                followed: false
            }
        },

        computed: {
            text() {
                return this.followed ? '已关注' : '关注此问题'
            }
        },
//
//        methods: {
//            follow() {
//                this.$http.post('/api/question/follow', {
//                    'question': this.question,
//                    'user': this.user
//                }).then(response => {
//                    this.followed = response.data.followed
//                })
//            }
//        }
    }
</script>
