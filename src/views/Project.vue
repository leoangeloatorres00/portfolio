<template>
  <section id="project">
    <div>
      <h2>All Projects</h2>
      <div class="project-wrapper">
        <CardProject
          :data="project"
          v-for="(project, index) in projects"
          :key="index"
        />
      </div>
      <cite>Note: The projects are set to be released soon.</cite>
    </div>
  </section>
</template>

<script>
import CardProject from "@/components/CardProject.vue";
export default {
  components: {
    CardProject,
  },
  data: () => {
    return {
      projects: [
        {
          title: "AutoPulse",
          description:
            "Explore our vast fleet of well-maintained vehicles and enjoy a seamless car rental experience. Book your ideal ride today!",
        },
        {
          title: "SoundWave",
          description:
            "Discover, stream, and enjoy endless music with our Audio Streaming app. Your perfect soundtrack is just a click away.",
        },
        {
          title: "TicketFlow",
          description:
            "Simplify event ticketing with our efficient management system. Sell, track, and manage tickets seamlessly",
        },
        {
          title: "GroceryGo",
          description:
            "Shop online for all your grocery needs, hassle-free and convenient.",
        },
      ],
    };
  },
};
</script>

<style lang="postcss" scoped>
section {
  text-align: center;

  display: grid;
  justify-content: center;
  margin-inline: auto;
}

.project-wrapper {
  margin: 2rem auto;

  display: grid;
  gap: 20px;
  grid-template-columns: repeat(2, 1fr);

  justify-content: center;

  @media screen and (max-width: 40rem) {
    grid-template-columns: repeat(1, 1fr);
    justify-content: center;
  }
}
</style>
