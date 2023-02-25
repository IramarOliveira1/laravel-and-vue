<template>
  <div>
    <NavBar />
    <Footer></Footer>
  </div>
</template>

<script>
import NavBar from './components/navbar/navbar.vue';
import Footer from './components/footer/footer.vue';

export default {
  components: {
    NavBar,
    Footer,
  }
}
</script>