<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form class="card-body" v-if="editing" @submit.prevent="update">
                    <div class="card-title">
                        <input type="text" class="form-control form-control-lg" v-model="title">
                    </div>
                    <hr>
                    <div class="media">
                        <div class="media-body">
                            <div class="form-group">
                                <textarea v-model="body" rows="10" class="form-control"></textarea>
                            </div>
                            <button class="btn btn-outline-info btn-sm" :disabled="isInvalid">Update</button>
                            <button @click.prevent = "cancel" class="btn btn-outline-danger btn-sm" type="button">Cancel</button>
                        </div>
                    </div>
                </form>
                <div class="card-body" v-else>
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{ title }}</h1>
                            <div class="ml-auto">
                                <a href="/questions" class="btn btn-outline-secondary">Vrati se na sva pitanja</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">

                        <vote :model= "question" name="question"></vote>
                       
                        <div class="media-body">
                                <div v-html="bodyHtml"></div>
                                    <div class="ml-auto">
                                            <a v-if="authorize('modify', question)" @click.prevent="edit" class="btn btn-outline-info btn-sm">Edit</a>  
                                            
                                            <button v-if="authorize('deleteQuestion', question)" @click.prevent = "destroy" class="btn btn-outline-danger btn-sm">Delete</button> 
                                    </div>
                                <div class="float-right">
                                  
                                    <user-info :model= "question" label='answerd'></user-info>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['question'],

    data (){
        return {
            title: this.question.title,
            body: this.question.body,
            bodyHtml: this.question.body_html,
            editing: false,
            id: this.question.id,
            beforeEditChache: {}
        }
    },

    computed: {
        isInvalid () {
            return this.body.length < 10 || this.body.length < 10;
        },

        endpoint () {
            return `/questions/${this.id}`;
        },
    },

    methods : {
        edit () {
            this.beforeEditChache = {
                body: this.body,
                title: this.title
            };
            this.editing = true;
        },

        cancel() {
            this.body = this.beforeEditChache.body;
            this.title = this.beforeEditChache.title;
            this.editing = false;
        },

        update (){
            axios.put(this.endpoint, {
                body: this.body,
                title: this.title
            })
            .catch(({response}) => {
                this.$toast.error(response.data.message, "Error", { timeout: 3000});
            })
            .then(({data}) => {
                this.bodyHtml = data.body_html;
                this.$toast.success(data.message, "Success", { timeout: 3000});
                this.editing = false;
            });
        },
        destroy () {

            this.$toast.question('Dali si siguran?', "Potvrdi",{
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                title: 'Hey',
                position: 'center',
                buttons: [
                    ['<button><b>YES</b></button>', (instance, toast) => {
            
                            axios.delete(this.endpoint)
                            .then(({data}) => {
                                this.$toast.success(data.message, "Success", { timeout: 3000});
                            });

                            setTimeout(() => {
                                window.location.href = "/questions";
                            },3000);

                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            
                    }, true],
                    ['<button>NO</button>', function (instance, toast) {
            
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            
                    }],
                ]
            });

            
        }
    }
}
</script>
