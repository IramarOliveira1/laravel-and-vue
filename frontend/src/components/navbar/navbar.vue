<template>
    <v-card class="navbar-general">
        <v-layout>
            <v-app-bar color="#DEDEDE" elevation="0">
                <v-container>
                    <div class="navbar-desktopOrMobile">
                        <v-main class="main-desktop">
                            <v-app-bar-nav-icon variant="text" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                        </v-main>
                        <div class="img-mobile">
                            <img src="../../assets/image/logo.svg" alt="Logo investidor 10">
                        </div>
                        <div class="btn-desktop">
                            <v-btn color="primary" @click="openModalNews">CADASTRAR NOTICIAS</v-btn>
                            <v-btn color="primary" @click="clearFilter">
                                {{ news.data?.length > 0
                                    ? 'LIMPAR FILTRO'
                                    : 'EXIBIR NOTICIAS'
                                }}
                            </v-btn>
                            <input type="text" v-model="search" class="input-search">
                            <button :disabled="!search?.length > 0" @click="handleFilter">
                                <img src="../../assets/image/search.svg" class="icon-search" alt="" width="30" height="30">
                            </button>
                        </div>
                    </div>
                </v-container>
            </v-app-bar>
            <v-navigation-drawer v-model="drawer" temporary>
                <v-container>
                    <v-btn color="primary" variant="text" class="mb-2" @click="openModalNews">CADASTRAR NOTICIAS</v-btn>
                    <v-btn color="primary" variant="text" class="mb-2" @click="clearFilter">EXIBIR NOTICIAS</v-btn>
                    <input type="text" v-model="search" class="input-search mb-2">
                    <v-btn class="mb-2" :disabled="!search?.length > 0" @click="handleFilter">FILTRAR</v-btn>
                    <v-btn color="warning" @click="clearFilter">LIMPAR FILTRO</v-btn>
                    <strong class="author-mobile">DESENVOLVIDO POR IRAMAR CAPIM</strong>
                </v-container>
            </v-navigation-drawer>
        </v-layout>
    </v-card>
    <Cards :newsFilter="news" ref="form" />
    <createNews :modalActive="modalActive" @close="modalActive = false" :categories="categories" :getAll="$refs.form"
        :callbackCategories="handleAllCategory" />
</template>
  
<script>
import axios from '../../services/api';
import Cards from '../cards/cards.vue';
import createNews from '../modal/createNews/createNews.vue';
export default {
    components: {
        Cards,
        createNews
    },
    data() {
        return {
            search: null,
            drawer: null,
            news: [],
            modalActive: false,
            categories: []
        };
    },
    mounted() {
        this.handleAllCategory();
    },
    methods: {
        async handleFilter() {
            try {
                const response = await axios.get(`filter?search=${this.search}`);
                this.search = null;

                this.$refs.form.news = [];

                this.news = response;
            } catch (error) {
                console.log(error);
            }
        },
        async handleAllCategory() {
            try {

                const response = await axios.get('/categories');

                this.categories = response.data;
            } catch (error) {
                console.log(error);
            }

        },
        async clearFilter() {
            const clearFilter = await this.$refs.form.handleAll();
            this.$refs.form.page = 1;
            this.news = clearFilter.data;
        },
        openModalNews() {
            this.modalActive = true;
        },
    }

}
</script>

<style>
.v-card.v-theme--light.v-card--density-default.v-card--variant-elevated.navbar-general {
    z-index: 1000;
    margin-bottom: 90px;
}

.icon-search {
    position: relative;
    top: 3px;
    background-color: #fff;
    right: 3px;
    border-radius: 0 5px 5px 0;
    height: 34px;
    width: 60px;
}

.v-navigation-drawer {
    width: 0px !important;
    background-color: #DEDEDE !important;
}

.navbar-desktopOrMobile {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}

.btn-desktop {
    display: flex;
    align-items: center;
}

.input-search {
    background-color: #fff;
    border-radius: 5px;
    padding: 5px;
}

input:focus {
    outline: none;
}

.main-desktop {
    padding-top: 0 !important;
    display: none;
}

@media only screen and (max-width: 880px) {
    .main-desktop {
        display: block;
        margin-top: 15px;
    }

    .btn-desktop {
        display: none;
    }

    .img-mobile {
        margin-top: 20px;
        width: 100%;
        text-align: center;
    }

    .v-navigation-drawer {
        width: 256px !important;
    }

    .icon-search {
        top: 0;
        left: 10px;
    }

    .author-mobile {
        font-size: 12px;
        position: absolute;
        bottom: 80px;
        right: 0;
        left: 15px;
    }
}
</style>