<template>
  <section id="about">
    <div>
      <h2>About Me</h2>
      <div class="wrapper">
        <div id="typing-text"></div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data: () => {
    return {
      text: [
        "Hi, my name is Leo Angelo Torres. I graduated from Manuel S. Enverga University Foundation Corp. Inc. with a degree in Bachelor of Science in Computer Science in 2011. I am a Software Engineer for almost 8 years with experience in frontend and background programming. My technical skills include proficiency in HTML, CSS, Bootstrap, Javascript, JQuery, VueJS, Laravel and SQL.",
        "In my free time, I enjoy reading manga and watching anime and movies. I also like cycling and playing video games.",
        "I believe in the power of technology to solve complex problems and make the world a better place.",
        "Below are details of some projects I have developed over the 8 years of coding experience.",
      ],
      speed: 50, // time delay of print out
      index: 0, // start printing array at this posision
      arrayLength: 0, // the length of the text array
      scrollAt: 20, // start scrolling up at this many lines

      textPosition: 0, // initialise text position
      contents: "", // initialise contents variable
      row: 0, // initialise current row
    };
  },
  mounted() {
    this.arrayLength = this.text[0].length;
    this.typingText();
  },
  methods: {
    typingText() {
      this.contents = " ";
      this.row = Math.max(0, this.index - this.scrollAt);
      var destination = document.getElementById("typing-text");

      while (this.row < this.index) {
        this.contents += this.text[this.row++] + "<br /><br />";
      }
      destination.innerHTML =
        this.contents +
        this.text[this.index].substring(0, this.textPosition) +
        "_";
      if (this.textPosition++ == this.arrayLength) {
        this.textPosition = 0;
        this.index++;
        if (this.index != this.text.length) {
          this.arrayLength = this.text[this.index].length;
          setTimeout(this.typingText, 50);
        }
      } else {
        setTimeout(this.typingText, this.speed);
      }
    },
  },
};
</script>

<style lang="postcss" scoped>
section {
  max-width: 800px;
  margin-inline: auto;
}

.wrapper {
  margin-block: 2rem 1rem;

  display: flex;
  justify-content: center;

  text-align: justify;
  text-justify: inter-word;
}

#typing-text {
  min-height: 450px;
  max-width: 100%;

  font-family: "Montserrat";
  font-size: 1.25rem;

  color: #818286;
}
</style>
