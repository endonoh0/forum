<template>
    <button type="submit" :class="classes" @click="toggle">
        <i class="fa fa-heart"></i>
        <span v-text="count"></span>
    </button>
</template>

<script>
    export default {
        props: ['reply'],

        data() {
            return {
                count: this.reply.favoritesCount,
                active: this.reply.isFavorited
            }
        },

        computed: {
            classes() {
                return [
                    'btn',
                    this.active ? 'btn-outline-primary d-flex' : 'btn-outline-secondary'
                ];
            },

            endpoint() {
                return '/replies/' + this.reply.id + '/favorites';
            }
        },

        methods: {
            toggle() {
                return this.active ? this.unfavorite() : this.favorite();
            },

            favorite() {
                axios.post(this.endpoint);

                this.active = true;
                this.count++;
            },

            unfavorite() {
                axios.delete(this.endpoint);

                this.active = false;
                this.count--;
            }
        }
    }
</script>
