<template>
    <div class="media post">
        <div class="d-flex flex-column vote-controls">

        <vote :model= "answer" name="answer"></vote>
            
        </div>
        <div class="media-body">
            <form v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <textarea v-model="body" rows="10" class="form-control"></textarea>
                </div>
                <button class="btn btn-outline-info btn-sm" :disabled="isInvalid">Update</button>
                <button @click.prevent = "cancel" class="btn btn-outline-danger btn-sm" type="button">Cancel</button>
            </form>
            <div v-if="!editing">
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                                <a v-if="authorize('modify', answer)" @click.prevent="edit" class="btn btn-outline-info btn-sm">Edit</a>  
                                
                                <button v-if="authorize('modify', answer)" @click.prevent = "destroy" class="btn btn-outline-danger btn-sm">Delete</button> 
                        </div>
                    </div>
                    <div class="col-4">
                        
                    </div>
                    <div class="col-4">
                    
                            <user-info :model="answer" label='answerd'></user-info>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>
export default {
    props: ['answer'],

    data(){
        return {
            editing:false,
            body: this.answer.body,
            bodyHtml: this.answer.body_html,
            id: this.answer.id,
            questionId: this.answer.question_id,
            beforeEditCache: null
        }
    },

    methods: {
        edit(){
            this.beforeEditCache = this.body;
            this.editing = true;
        },

        cancel () {
            this.body = this.beforeEditCache;
            this.editing = false;
        },
        update (){
            axios.patch( this.endpoint ,{
                body: this.body
            })
            .then(res => {
                console.log(res);
                this.editing = false;
                this.bodyHtml = res.data.body_html;
                this.$toast.success(res.data.message, "Uspesno", { timeout: 3000 });
            })
            .catch(err =>{
                this.$toast.error(err.response.data.message, "Neuspesno", { timeout: 3000 });
                
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
            
                            axios.delete( this.endpoint)
                            .then(res => {
                                this.$emit('deleted')
                            }).catch(err =>{
                                this.$toast.error(err.response.data.message, "Neuspesno", { timeout: 3000 });
                            });

                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            
                    }, true],
                    ['<button>NO</button>', function (instance, toast) {
            
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            
                    }],
                ]
            });

            
        }
    },

    computed: {
        isInvalid () {
            return this.body.length < 10;
        },
        endpoint () {
            return `/questions/${this.questionId}/answers/${this.id}`;
        }

    }
}
</script>