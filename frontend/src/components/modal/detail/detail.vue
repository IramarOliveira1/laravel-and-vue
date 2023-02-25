<template>
    <v-row justify="center">
        <v-dialog v-model="openModal" persistent width="500">
            <v-card :title="news.title" :subtitle="`Categoria: ${news.categories?.name ? news.categories.name : news.name}`" :text="news.description">
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="green-darken-1" variant="text" @click="closeModal">
                        Fechar
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
export default {
    props: ['modalActive', 'news'],
    data() {
        return {
            active: false
        }
    },
    methods: {
        closeModal() {
            this.$emit('close');
        }
    },
    computed: {
        openModal: {
            get() {
                return this.active = this.modalActive;
            },
        }
    }

}
</script>
