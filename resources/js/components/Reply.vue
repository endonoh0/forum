<script>
    import Favorite from './Favorite.vue';
    // Export vue instance to determine the reply layout
    export default {
        props: ['attributes'], // equals to $reply

        components: { Favorite }, // child-component <Favorite></favorite>

        // between v-f and v-else
        data() {
            return {
                editing: false,
                body: this.attributes.body
            };
        },

        methods: {
            update() {
                // axios request: patch to this uri, send through the updated body
                axios.patch('/replies/' + this.attributes.id, {
                    body: this.body
                });

                this.editing = false;

                flash('Updated!');
            },

            destroy() {
                axios.delete('/replies/' + this.attributes.id);

                $(this.$el).fadeOut(300, () => {
                    flash('Your reply has been deleted.');
                });
            }
        }
    }
</script>
