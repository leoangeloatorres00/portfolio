<template>
  <div id="test" class="container">
    <Navbar />

    <Home />
    <About />
    <Project />
    <Contact />

    <Footer></Footer>
  </div>
</template>

<script>
import Navbar from "@/components/Navbar.vue";
import Footer from "@/components/Footer.vue";

import Home from "@/views/Home.vue";
import About from "@/views/About.vue";
import Project from "@/views/Project.vue";
import Contact from "@/views/Contact.vue";

export default {
  name: "App",
  components: {
    Navbar,
    Footer,

    Home,
    About,
    Project,
    Contact,
  },
};
</script>

<style>
* {
  padding: 0;
  margin: 0;
}

html,
body {
  scroll-behavior: smooth;
}

#app {
  font-family: "Montserrat";
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
</style>
