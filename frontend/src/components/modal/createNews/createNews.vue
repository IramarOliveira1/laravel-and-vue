
<template>
    <v-row justify="center">
        <v-dialog v-model="openModal" persistent width="700">
            <v-card>
                <v-card-title>
                    <span class="text-h5">CADASTRAR NOTICIAS</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-text-field label="Titulo da Noticia" variant="underlined" v-model="title">
                        </v-text-field>
                        <v-textarea label="Descrição da Noticia" variant="underlined" maxlength="1200"
                            v-model="description">
                        </v-textarea>
                        <div class="text-end mb-5">
                            <span>{{ `${description?.length}/1200` }}</span>
                        </div>
                        <Error v-if="!categories?.length > 0" type="warning"
                            text="Para cadastrar uma noticia primeiro cadastre uma categoria!" />

                        <v-combobox label="Nome da Categoria" v-model="category_id" :items="categories" item-title="name"
                            item-value="id" variant="underlined">
                        </v-combobox>
                    </v-container>
                </v-card-text>
                <v-card-actions class="mb-5 d-flex justify-end align-center flex-wrap ">
                    <v-spacer></v-spacer>
                    <v-btn color="green-darken-1" @click="closeModal">
                        Fechar
                    </v-btn>
                    <v-btn color="warning" @click="openModalNewCategory">
                        Cadastrar Categoria
                    </v-btn>
                    <v-btn color="primary" @click="handleCreateNews"
                        :disabled="!categories?.length > 0 || !title?.length > 0 || !description?.length > 0">
                        Salvar
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <newCategory :modalActive="openModalCategory" :getAll="this.getAll" @close="openModalCategory = false"
            @callbackCategories="callbackCategories" />
    </v-row>
</template>

<script>
import axios from '../../../services/api'
import Error from '../../error/error.vue';
import newCategory from '../newCategory/newCategory.vue';

export default {
    props: ['modalActive', 'categories', 'getAll', 'callbackCategories'],
    components: {
        Error,
        newCategory
    },
    data() {
        return {
            active: false,
            title: null,
            description: '',
            category_id: null,
            openModalCategory: false,
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
        async handleCreateNews() {
            try {
                const response = await axios.post('/news', {
                    title: this.title,
                    description: this.description,
                    category_id: this.category_id.id
                });

                this.$emit('teste')
                this.getAll.handleAll();

                this.closeModal(true);

                this.title = null
                this.description = ''
                this.category_id = null

                alert(response.data.message);
            } catch (error) {
                console.log(error);
            }

        },
        closeModal(close) {
            this.$emit('close', close);
        },
        openModalNewCategory() {
            this.openModalCategory = true;
        }
    }
}
</script>
