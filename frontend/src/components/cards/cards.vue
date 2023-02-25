<template>
    <v-container>
        <div>
            <div class="d-flex justify-start align-center flex-wrap card-mobile">
                <v-col xs="12" sm="6" md="4" v-for="news in newsFilter.data ? newsFilter.data : news.data" :key="news.id">
                    <v-card :title="news.title"
                        :subtitle="`Categoria: ${news.categories?.name ? news.categories.name : news.name}`"
                        :text="news.description.length > 230 ? `${news.description.substring(0, 230)}...` : news.description"
                        height="330">
                        <div class="text-center mt-10 mb-5 d-flex justify-center align-center ">
                            <v-btn class="btn-details" variant="tonal" @click="openModal(news)">Acessar</v-btn>
                        </div>
                    </v-card>
                </v-col>
            </div>
            <div class="text-center">
                <v-container>
                    <v-row justify="center" v-if="news.data?.length > 0">
                        <v-col cols="8">
                            <v-container class="max-width">
                                <div class="text-center">
                                    <v-pagination v-model="page" :length="news.last_page" :total-visible="7"></v-pagination>
                                </div>
                            </v-container>
                        </v-col>
                    </v-row>
                    <Error v-if="news.data?.length === 0" type="warning" text="Nenhuma noticia cadastrada!" />
                </v-container>
                <Error v-if="newsFilter.data?.length === 0" type="warning" text="Nenhuma noticia encontrada para filtro!" />
            </div>
        </div>
    </v-container>
    <Modal :modalActive="modalActive" :news="data" @close="modalActive = false" />
</template>

<script>
import axios from '../../services/api';
import Error from '../error/error.vue'
import Modal from '../modal/detail/detail.vue';

export default {
    props: ['newsFilter', 'clearFilter'],
    components: {
        Error,
        Modal,
    },
    data() {
        return {
            news: [],
            page: 1,
            modalActive: false,
            data: [],
            loading: false
        }
    },
    mounted() {
        this.handleAll();
    },
    watch: {
        page() {
            this.handleAll();
        }
    },

    methods: {
        async handleAll() {
            try {
                const response = await axios.get(`news?page=${this.page}`);

                return this.news = response.data;
            } catch (error) {
                console.log(error);
            }
        },
        openModal(data) {
            this.data = data;
            this.modalActive = true;
        },
    }
}
</script>

<style>
.v-card-text {
    height: 50%;
}

@media only screen and (max-width: 600px) {
    .card-mobile {
        display: flex;
        flex-direction: column;
    }
}
</style>