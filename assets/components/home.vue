<script>
import {defineComponent} from 'vue';

export default defineComponent({
    name: "Legend",
    props: {
        title: {
            type: String,
            required: true,
        }
    },
    data() {
        return {
            name: 'Symfony Vue Product',
        };
    },
})
</script>

<template>
<div class="container">
    <h3 class="text-success text-bg-warning"> {{ title }}</h3>
    <div class="text-bg-info">
        {{ name }}
        let's see !!
    </div>
</div>
</template>

<style scoped>
div .text-bg-info{
    padding: 0 5px 0 5px;
}
</style>
