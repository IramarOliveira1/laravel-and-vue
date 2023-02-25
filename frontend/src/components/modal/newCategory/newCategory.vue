
<template>
    <v-row justify="center">
        <v-dialog v-model="openModal" persistent width="500">
            <v-card>
                <v-card-title>
                    <span class="text-h5">CADASTRAR CATEGORIA</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-text-field label="Nova Categoria" v-model="nameCategory" variant="underlined"></v-text-field>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="green-darken-1" @click="closeModal">
                        Fechar
                    </v-btn>
                    <v-btn color="primary" :disabled="!nameCategory?.length > 0" @click="handleCreateCategories">
                        Salvar
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
import axios from '../../../services/api';
export default {
    props: ['modalActive', 'getAll'],
    data() {
        return {
            active: false,
            nameCategory: null
        }
    },
    computed: {
        openModal: {
            get() {
                return this.active = this.modalActive;
            },
        }
    },
    methods: {
        async handleCreateCategories() {
            try {
                const response = await axios.post('/categories', {
                    name: this.nameCategory,
                });

                await this.$emit('callbackCategories');

                alert(response.data.message);

                this.closeModal(true);
            } catch (error) {
                console.log(error);
            }
        },

        closeModal(close) {
            this.$emit('close', close);
        }
    },

}
</script>
