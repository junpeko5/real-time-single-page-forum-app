<template>
    <div v-if="question">
        <edit-question
            :data="question"
            v-if="editing"
        ></edit-question>
        <show-question
            :data="question"
            v-else
        ></show-question>
        <v-container>
            <replies :question="question"></replies>
            <new-reply
                v-if="loggedIn"
                :questionSlug="question.slug"
            ></new-reply>
            <div v-else class="mt-4">
                <router-link to="/login">Login to Reply</router-link>
            </div>
        </v-container>
    </div>
</template>

<script>
    import ShowQuestion from './ShowQuestion'
    import EditQuestion from './EditQuestion'
    import Replies from '../reply/Replies'
    import NewReply from '../reply/NewReply'

    export default {
        components: {
            ShowQuestion,
            EditQuestion,
            Replies,
            NewReply
        },
        data() {
            return {
                question: null,
                editing: false
            }
        },
        created() {
            this.listen()
            this.getQuestion()
        },
        computed: {
            loggedIn() {
                return User.loggedIn()
            }
        },
        methods: {
            listen() {
                EventBus.$on('startEditing', () => {
                    this.editing = true
                })
                EventBus.$on('cancelEditing', () => {
                    this.editing = false
                })
            },
            getQuestion() {
                axios.get(`/api/question/${this.$route.params.slug}`)
                    .then(res => this.question = res.data.data)
            }
        }
    }
</script>
