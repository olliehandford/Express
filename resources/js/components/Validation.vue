<template>
    <div class="validation">
        <span v-for="(value, key, i) in errors" v-bind:key="i" class="error">{{ errors[key][0] }}</span>
        <span class="success">{{ success }}</span>
    </div>
</template>

<script>
export default {
    data() {
        return {
            
        }
    },
    props: ['errors', 'success'],
    computed: {
        handleErrors() {
            let errors = Object.values(this.errors);
                errors = errors.flat();

            return errors;
        },
        handleSuccess() {
            let success = this.success
            return sucess;
        }
    }
}
</script>

<style>
.wrapper {
    max-width: 700px;
}
</style>
