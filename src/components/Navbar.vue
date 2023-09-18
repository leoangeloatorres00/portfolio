<template>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark">
    <div class="container" style="padding-inline: 40px">
      <a class="navbar-brand"><span>Leo</span> Angelo</a>
      <button
        class="navbar-toggler btn-small"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbar"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div :class="isNavbarCollapse" id="navbar">
        <div class="navbar-nav">
          <a class="nav-link" @click="scroll('home')">Home</a>
          <a class="nav-link" @click="scroll('about')">About</a>
          <a class="nav-link" @click="scroll('project')">Projects</a>
          <a class="nav-link" @click="scroll('contact')">Contact</a>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  data: () => {
    return {
      width: window.innerWidth,
    };
  },
  created() {
    window.addEventListener("resize", this.onResize);
  },
  mounted() {
    this.$nextTick(() => {
      window.addEventListener("resize", this.onResize);
    });
  },
  destroyed() {
    window.removeEventListener("resize", this.onResize);
  },
  computed: {
    isNavbarCollapse() {
      return this.width < 992 ? "collapse navbar-collapse" : "d-flex";
    },
  },
  methods: {
    onResize() {
      this.width = window.innerWidth;
    },
    scroll(element) {
      let el = document.querySelector(`#${element}`);
      el.scrollIntoView({ behavior: "smooth", block: "end" });
    },
  },
};
</script>

<style scoped lang="postcss">
.navbar {
  text-align: left;
}

.navbar-brand {
  & span {
    font-family: "Montserrat-Bold";
  }
}

.nav-link {
  cursor: pointer;
}
</style>
