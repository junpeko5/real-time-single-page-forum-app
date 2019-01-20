<template>
    <v-container fluid>
        <v-card>
            <v-form
                @submit.prevent="update"
            >
                <v-text-field
                    v-model="form.title"
                    label="Title"
                    type="text"
                    required
                ></v-text-field>

                <!--<v-autocomplete-->
                    <!--:items="categories"-->
                    <!--v-model="form.category_id"-->
                    <!--item-text="name"-->
                    <!--item-value="id"-->
                    <!--label="Category"-->
                <!--&gt;</v-autocomplete>-->
                <markdown-editor v-model="form.body"></markdown-editor>
                <v-card-actions>
                    <v-btn icon small type="submit">
                        <v-icon color="teal">save</v-icon>
                    </v-btn>
                    <v-btn icon small @click="cancel">
                        <v-icon>cancel</v-icon>
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-container>
</template>

<script>
    export default {
        props: [
            'data'
        ],
        data() {
            return {
                form: {
                    title: null,
                    category_id: null,
                    body: null
                },
                categories: [],
                errors: {}
            }
        },
        mounted() {
            this.form = this.data
        },
        // created() {
        //     axios.get('/api/category')
        //         .then(res => this.categories = res.data.data)
        // },
        methods: {
            update() {
                axios.patch(`/api/question/${this.form.slug}`, this.form)
                    .then(res => this.cancel())
                    .catch(error => this.errors = error.response.data.error)
            },
            cancel() {
                EventBus.$emit('cancelEditing')
            }
        }
    }
</script>
