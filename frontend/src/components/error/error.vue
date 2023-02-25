<template>
    <v-alert density="compact" :type="type" :text="text"></v-alert>
</template>

<script>
export default {
    props: ['type', 'text']
}
</script>