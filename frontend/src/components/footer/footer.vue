<template>
    <v-app color="#161818" elevation="0">
        <v-footer class="bg-grey-lighten-1 footer-destkop">
            <v-col class="text-center " cols="12">
                <strong>DESENVOLVIDO POR IRAMAR CAPIM</strong>
            </v-col>
        </v-footer>
    </v-app>
</template>

<style>
.v-application__wrap {
    position: fixed !important;
    min-height: 0 !important;
    width: 100%;
    bottom: 0;
}

.footer-destkop {
    height: 50px;
}

@media only screen and (max-width: 880px) {
    .v-application__wrap {
        display: none !important;
    }
}
</style>