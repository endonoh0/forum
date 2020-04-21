<template>
    <div>
        <input id="trix" type="hidden" :name="name" :value="value">
        <trix-editor ref="trix" input="trix"></trix-editor>
    </div>
</template>

<script>
    import Trix from 'trix';

    export default {
        props: ['name', 'value'],

        mounted () {
            this.$refs.trix.addEventListener('trix-change', e => {
                console.log('Handing');
                this.$emit('input', e.target.innerHTML);
            });
        }
    };
</script>
