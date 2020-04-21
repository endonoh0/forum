<template>
    <div :id="'reply-'+id" class="card">
        <div class="card-header" :class="isBest ? 'card-success': 'card-default'">
            <div class="level">
                <h6 class="flex">
                    <a :href="'/profiles/' + reply.owner.name"
                        v-text="reply.owner.name">
                    </a> said <span v-text="ago"></span>
                </h6>

                <div v-if="signedIn">
                    <favorite :reply="reply"></favorite>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <wysiwyg v-model="body"></wysiwyg>
                </div>
            </div>
            <div v-else v-html="body"></div>
        </div>

        <div class="card-footer level" v-if="authorize('owns', reply) || authorize('owns', reply.thread)">
            <div v-if="editing">
                <form @submit="update">
                    <button class="button btn-xs btn-primary mr-2" v-show="editing">Update</button>
                    <button class="button btn-xs btn-link" @click="cancel" type="button" v-show="editing">Cancel</button>
                </form>
            </div>

            <div v-if="authorize('owns', reply)">
                <button class="btn-info btn-xs" @click="editing = true" v-show="! editing">Edit</button>
            </div>

            <button class="btn btn-link ml-auto" @click="destroy" v-show="editing">Delete Reply</button>
            <button class="btn-info btn-xs btn-default ml-a" @click="markBestReply" v-if="authorize('owns', reply.thread)" v-show="! editing">Best Reply?</button>
        </div>
    </div>
</template>

<script>
    import Favorite from './Favorite.vue';
    import moment from 'moment';

    export default {
        props: ['reply'],

        components: { Favorite },

        data() {
            return {
                editing: false,
                id: this.reply.id,
                body: this.reply.body,
                isBest: this.reply.isBest
            };
        },

        computed: {
            ago() {
                return moment(this.reply.created_at).fromNow() + '...';
            }
        },

        created () {
            window.events.$on('best-reply-selected', id => {
                this.isBest = (id === this.id);
            });
        },

        methods: {
            update() {
                axios.patch(
                    '/replies/' + this.id, {
                        body: this.body
                })
                .then(() => {
                    this.editing = false;
                    this.body = this.reply.body;
                    flash('Updated!');
                })
                .catch(error => {
                    flash(error.response.data, 'danger');
                });
            },

            cancel() {
                this.body = this.reply.body;
                this.editing = false;
            },

            destroy() {
                axios.delete('/replies/' + this.id);

                this.$emit('deleted', this.id);
            },

            markBestReply() {
                axios.post('/replies/' + this.id + '/best');

                window.events.$emit('best-reply-selected', this.id);
            }
        }
    };
</script>
