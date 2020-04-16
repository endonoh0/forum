<template>
    <div :id="'reply-'+id" class="card">
        <div class="card-header" :class="isBest ? 'card-success': 'card-default'">
            <div class="level">
                <h6 class="flex">
                    <a :href="'/profiles/'+data.owner.name"
                        v-text="data.owner.name">
                    </a> said <span v-text="ago"></span>
                </h6>

                <div v-if="signedIn">
                    <favorite :reply="data"></favorite>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div v-if="editing">
                <form @submit="update">
                    <div class="form-group">
                        <textarea class="form-control" v-model="body" required></textarea>
                    </div>
                    <button class="button btn-xs btn-primary">Update</button>
                    <button class="button btn-xs btn-link" @click="editing = false" type="button">Cancel</button>
                </form>
            </div>
            <div v-else v-html="body"></div>
        </div>

        <div class="card-footer level">
            <div v-if="authorize('updateReply', reply)">
                <button class="btn-info btn-xs mr-3" @click="editing = true">Edit</button>
                <button class="btn-info btn-xs btn-danger mr-3" @click="destroy">Delete</button>
            </div>
            <button class="btn-info btn-xs btn-default ml-a" @click="markBestReply" v-show="!isBest">Best Reply?</button>
        </div>
    </div>
</template>

<script>
    import Favorite from './Favorite.vue';
    import moment from 'moment';

    export default {
        props: ['data'],

        components: { Favorite },

        data() {
            return {
                editing: false,
                id: this.data.id,
                body: this.data.body,
                isBest: false,
                reply: this.data
            };
        },

        computed: {
            ago() {
                return moment(this.data.created_at).fromNow() + '...';
            }
        },

        methods: {
            update() {
                axios.patch(
                    '/replies/' + this.data.id, {
                        body: this.body
                })
                .catch(error => {
                    flash(error.response.data, 'danger');
                });

                this.editing = false;

                flash('Updated!');
            },

            destroy() {
                axios.delete('/replies/' + this.data.id);

                this.$emit('deleted', this.data.id);
            },

            markBestReply() {
                this.isBest = true;
            }
        }
    };
</script>
